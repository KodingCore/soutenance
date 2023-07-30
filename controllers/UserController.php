<?php

class UserController extends AbstractController
{

    private UserManager $userManager;
    private InfoManager $infoManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
    }

    public function login()
    {
        if (!empty($_POST["username-email"]) && !empty($_POST["password"])) {
            $userTag = $_POST["username-email"];
            $password = $_POST["password"];
            $user = null;

            if (filter_var($userTag, FILTER_VALIDATE_EMAIL)) { //* Si c'est une adresse e-mail
                $user = $this->userManager->getUserByEmail($userTag); //*On recherche l'utilisateur avec l'email
            } else { //* Si ce n'est pas une adresse e-mail
                $user = $this->userManager->getUserByUsername($userTag); //* On recherche l'utilisateur avec l'username
            }
            if ($user !== null) { //*S'il y a un utilisateur qui utilise cet email ou username
                if (password_verify($password, $user->getPasswordHash())) { //*On vérifie le password
                    if (isset($_SESSION["user_id"])) { //*Si la variable de session user_id est déjà définie
                        unset($_SESSION["user_id"]); //*On la supprime pour la reset à la fin de la fonction
                    }
                    
                    if (isset($_SESSION["role"])) { //*Si la variable de session role est déjà définie
                        unset($_SESSION["role"]); //*On la supprime pour la reset à la fin de la fonction
                    }

                    $_SESSION["user_id"] = $user->getUserId(); //*On set la variable de session user_id
                    $_SESSION["role"] = $user->getRole(); //*On set la variable de session role
                    $this->render("views/general/homepage.phtml", []); //*Retour sur la homepage
                } else { $this->render("views/user/login.phtml", ["champ" => "password", "message" => "Password invalide"]);} //*Password invalide, on retourne sur la page login
            } else { $this->render("views/user/login.phtml", ["champ" => "email", "message" => "Username ou email invalide"]);} //*email ou username invalide, on retourne sur la page login
        } else { $this->render("views/user/login.phtml", []);} //*les POST ne sont pas set, on retourne à la page login
    }

    public function register()
    {
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"])) {//*Tout les champs sont remplis {
            if(strlen($_POST["username"]) < 49 && strlen($_POST["email"]) < 49 && strlen($_POST["password"]) > 8)
                if (htmlentities($_POST["username"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { //*Verification des chaines de caractères
                    if ($_POST["password"] === $_POST["confirm-password"]) { //*Vérification de l'égalisté des passwords d'inscription
                        $user = $this->userManager->getUserByUsername($_POST["username"]); //*On vérifie l'existance de l'username dans la BDD
                        if (!$user) { //*S'il n'existe pas
                            $user = $this->userManager->getUserByEmail($_POST["email"]); //*On vérifie l'existance de l'email dans la BDD
                            if (!$user) { //*Si il n'existe pas
                                //*On défini les variables
                                $username = $_POST["username"];
                                $email = $_POST["email"];
                                $password = $_POST["password"];
                                $password_hash = password_hash($password, PASSWORD_DEFAULT); //*Hash du password

                                $userInstance = new User($username, $email, $password_hash); //*Instantiation d'un nouvel User
                                $this->userManager->insertUser($userInstance); //*Insertion du nouvel User dans la BDD
                                $user = $this->userManager->getUserByEmail($email); //*Récuperation de l'utilisateur dans la BDD
                                $user_id = $user->getUserId(); //*On récupère le user_id
                                $info = new Info($user_id); //*Instantiation et liaison d'une fiche d'info pour le nouvel utilisateur
                                $this->infoManager->insertInfo($info); //*Insertion de l'Info dans la BDD
//*ISSUE                        //*Voir pour mettre une page intermédiaire de confirmation de l'enrégistrement dans la BDD
                                $this->render("views/user/login.phtml", []); //*Retour sur la page de login
                            } else { $this->render("views/user/register.phtml", ["champ" => "email", "message" => "Email déjà utilisé"]);}
                        } else { $this->render("views/user/register.phtml", ["champ" => "username", "message" => "Username déjà utilisé"]);}
                    } else { $this->render("views/user/register.phtml", ["champ" => "password", "message" => "Les passwords sont différents"]);}
                } else { $this->render("views/user/register.phtml", ["champ" => "email", "message" => "Username où email invalide"]);}
        } else { $this->render("views/user/register.phtml", []); }
    }

//*Cette fonction sert l'édition de l'utilisateur et de ses infos
    function changeUserInfo() {
        if (isset($_SESSION["user_id"])) {
            //*Edition de User
            $user = $this->userManager->getUserByUserId($_SESSION["user_id"]); //*déclaration du User renvoyé à la fin

            if (isset($_POST["username"]) && !empty($_POST["username"])) {
                if(strlen($_POST["username"]) < 49){
                    $username = htmlentities($_POST["username"]);
                    $user->setUsername($username);
                }else{
                    $this->render("views/user/account.phtml", ["champ" => "username", "message" => "Nom d'utilisateur trop long (49 caractères maximum)"]);
                }
            }
            if (isset($_POST["email"]) && !empty($_POST["email"])) {
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    if (strlen($_POST["email"]) < 49){
                        $user->setEmail($_POST["email"]);
                    } else {
                        $this->render("views/user/account.phtml", ["champ" => "email", "message" => "Email trop long (49 caractères maximum)"]);
                    }
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "email", "message" => "L'email n'est pas valide!"]);
                }
            }
            if (isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]) && $_POST["password"] === $_POST["confirm-password"]) {
                $password = $_POST["password"];
                if(strlen($password) < 49 || strlen($password) > 20){
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $user->setPasswordHash($password_hash);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "password", "message" => "Le password doit faire entre 20 et 49 caractères"]);
                }
                
            }
            $this->userManager->editUser($user); //*Reset user on BDD

            //*Edition de Info
            $info = $this->infoManager->getInfoByUserId($_SESSION["user_id"]); //*On récolte les infos liés à l'utilisateur connecté
            if (!$info) { //*S'il n'y a pas d'infos
                $info = new Info($_SESSION["user_id"]); //*On instantie une class Info avec le user_id
                $this->infoManager->insertInfo($info); //*Et on l'insert dans la BDD
            }
            if (isset($_POST["first_name"]) && !empty($_POST["first_name"])) {
                $first_name = $_POST["first_name"];
                if(strlen($first_name) < 49){
                    $first_name = htmlentities($_POST["first_name"]);
                    $info->setFirstName($first_name);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "first_name", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            if (isset($_POST["last_name"]) && !empty($_POST["last_name"])) {
                $last_name = $_POST["last_name"];
                if(strlen($last_name) < 49){
                    $last_name = htmlentities($_POST["last_name"]);
                    $info->setLastName($last_name);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "last_name", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
                
            }
            if (isset($_POST["phone_number"]) && !empty($_POST["phone_number"])) {
                $phone_number = $_POST["phone_number"];
                if(strlen($phone_number) < 49){
                    $phone_number = htmlentities($_POST["phone_number"]);
                    $info->setPhoneNumber($phone_number);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "phone_number", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            if (isset($_POST["address"]) && !empty($_POST["address"])) {
                $address = $_POST["address"];
                if(strlen($address) < 49){
                    $address = htmlentities($_POST["address"]);
                    $info->setAddress($address);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "address", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            if (isset($_POST["town"]) && !empty($_POST["town"])) {
                $town = $_POST["town"];
                if(strlen($town) < 49){
                    $town = htmlentities($_POST["town"]);
                    $info->setTown($town);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "town", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            if (isset($_POST["zip"]) && !empty($_POST["zip"])) {
                $zip = $_POST["zip"];
                if(strlen($zip) < 49){
                    $zip = htmlentities($_POST["zip"]);
                    $info->setZip($zip);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "zip", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            if (isset($_POST["country"]) && !empty($_POST["country"])) {
                $country = $_POST["country"];
                if(strlen($country) < 49){
                    $country = htmlentities($_POST["country"]);
                    $info->setCountry($country);
                } else {
                    $this->render("views/user/account.phtml", ["champ" => "country", "message" => "La longueur de chaine doit être inférieur à 49 caractères!"]);
                }
            }
            $this->infoManager->editInfo($info); //*Reset info BDD

            $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
        } else {
            $this->render("views/user/login.phtml", []);
        }
    }
}