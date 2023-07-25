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
    
    public function login() {
        if(!empty($_POST["username-email"]) && !empty($_POST["password"])) {
            $userTag = $_POST["username-email"];
            $pwd = $_POST["password"];
            $user = null;
            if (filter_var($userTag, FILTER_VALIDATE_EMAIL)) { // Si c'est une adresse e-mail
                $user = $this->userManager->getUserByEmail($userTag); //On recherche l'utilisateur avec l'email
            } else { // Si ce n'est pas une adresse e-mail
                $user = $this->userManager->getUserByUsername($userTag); // On recherche l'utilisateur avec l'username
            }
            if($user !== null) { //Si il y à un utilisateur qui à cet email ou username
                if(password_verify($pwd, $user->getPasswordHash())) { //On vérifie le password
                    if(isset($_SESSION["user_id"])) { //Si la variable de session user_id est déjà définie
                        unset($_SESSION["role"]); //On la supprime pour la reset après avec la nouvelle connexion
                    }
                    $_SESSION["user_id"] = $user->getUserId(); //On set la variable de session user_id 
                    if(isset($_SESSION["role"])) { //Si la variable de session role est déjà définie
                        unset($_SESSION["role"]); //On la supprime pour la reset après avec la nouvelle connexion
                    }
                    $_SESSION["role"] = $user->getRole(); //On set la variable de session role 
                    $this->render("views/general/homepage.phtml", []); //Retour sur la homepage
                }
                else { $this->render("views/user/login.phtml", ["message" => "Password invalide"]); } //Password invalide, on retourne sur la page login 
            } else { $this->render("views/user/login.phtml", ["message" => "Username ou email invalide"]); } //email ou username invalide, on retourne sur la page login
        } else { $this->render("views/user/login.phtml", []); } //les POST ne sont pas set, on retourne à la page login
    }
    
    public function register() {
       if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"])) { //Tout les champs sont remplis
            if(htmlentities($_POST["username"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { //Verification des chaines de caractères
                if($_POST["password"] === $_POST["confirm-password"]) { //Vérification de l'égalisté des passwords d'inscription
                    $user = $this->userManager->getUserByUsername($_POST["username"]); //On vérifie l'existance de l'username dans la BDD
                    if(!$user) { //S'il n'existe pas
                        $user = $this->userManager->getUserByEmail($_POST["email"]); //On vérifie l'existance de l'email dans la BDD
                        if(!$user) { //Si elle n'existe pas
                            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); //Hash du password
                            $userInstance = new User($_POST["username"], $_POST["email"], $password_hash); //Instantiation d'un nouvel User
                            $this->userManager->insertUser($userInstance); //Insertion du nouvel User dans la BDD
                            $user = $this->userManager->getUserByEmail($_POST["email"]); //Récuperation de l'utilisateur dans la BDD
                            $user_id = $user->getUserId(); //On récupère l'e user_id
                            $info = new Info($user_id); //Instantiation et liaison d'une fiche d'info pour le nouvel utilisateur
                            $this->infoManager->insertInfo($info); //Insertion de l'Info dans la BDD
//ISSUE                 //Voir pour mettre une oage intermédiaire de confirmation de l'enrégistrement dans la BDD 
                            $this->render("views/user/login.phtml", []); //Retour sur la page de login
                        }
                        else { $this->render("views/user/register.phtml", ["champ" => "email", "message" => "Email déjà utilisé"]); }
                    } else { $this->render("views/user/register.phtml", ["champ" => "username", "message" => "Username déjà utilisé"]); }
                } else { $this->render("views/user/register.phtml", ["champ" => "password", "message" => "Les passwords sont différents"]); } 
            } else { $this->render("views/user/register.phtml", ["champ" => "email", "message" => "Username où email invalide"]); }
        } else { $this->render("views/user/register.phtml", []); }
    }

    public function changeUserInfo() {
        if(isset($_SESSION["user_id"])) {
            $user = $this->userManager->getUserByUserId($_SESSION["user_id"]);
            if(isset($_POST["username"]) && !empty($_POST["username"])) {
                $username = htmlentities($_POST["username"]);
                $user->setUsername($username);
            }
            if(isset($_POST["email"]) && !empty($_POST["email"])) {
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $user->setEmail($_POST["email"]);
                }
            }
            if(isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]) && $_POST["password"] === $_POST["confirm-password"]) {
                $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $user->setPasswordHash($password_hash);
            }
            $this->userManager->editUser($user);
            $info = $this->infoManager->getInfoByUserId($_SESSION["user_id"]);
            if(!$info) {
                $info = new Info($_SESSION["user_id"]);
                $this->infoManager->insertInfo($info);
            }
            if(isset($_POST["first_name"]) && !empty($_POST["first_name"])) {
                $first_name = htmlentities($_POST["first_name"]);
                $info->setFirstName($first_name);
            }
            if(isset($_POST["last_name"]) && !empty($_POST["last_name"])) {
                $last_name = htmlentities($_POST["last_name"]);
                $info->setLastName($last_name);
            }
            if(isset($_POST["phone_number"]) && !empty($_POST["phone_number"])) {
                $phone_number = htmlentities($_POST["phone_number"]);
                $info->setPhoneNumber($phone_number);
            }
            if(isset($_POST["address"]) && !empty($_POST["address"])) {
                $address = htmlentities($_POST["address"]);
                $info->setAddress($address);
            }
            if(isset($_POST["town"]) && !empty($_POST["town"])) {
                $town = htmlentities($_POST["town"]);
                $info->setTown($town);
            }
            if(isset($_POST["zip"]) && !empty($_POST["zip"])) {
                $zip = htmlentities($_POST["zip"]);
                $info->setZip($zip);
            }
            if(isset($_POST["country"]) && !empty($_POST["country"])) {
                $country = htmlentities($_POST["country"]);
                $info->setCountry($country);
            }
            $this->infoManager->editInfo($info);
            $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
        } else {
            $this->render("views/user/login.phtml", []);
        }
    }

    public function getInformations()
    {
        if(isset($_SESSION["user_id"]))
        {
            $user = $this->userManager->getUserByUserId($_SESSION["user_id"]);
            $info = $this->infoManager->getInfoByUserId($user->getUserId());
            $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
        }
        else
        {
            $this->render("views/user/login.phtml", []);
        }
        
    }
}
?>