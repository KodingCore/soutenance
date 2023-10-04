<?php

class UserController extends AbstractController
{

    private UserManager $userManager;
    private InfoManager $infoManager;
    private RequestManager $requestManager;
    private CategoryManager $categoryManager;
    private int $minCharPswrd;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
        $this->requestManager = new RequestManager();
        $this->categoryManager = new CategoryManager();
        $this->minCharPswrd = 12;
    }

    //** ---------------------------------- */
    //* Fonction de connexion de l'utilisateur
    //** ---------------------------------- */
    public function login()
    {
        if (!empty($_POST["username_email"]) && !empty($_POST["password"])) 
        {
            //* Variable de récolte d'érreur
            $error = null;

            //* Contre-mesure d'injection de code
            $usernameEmail = htmlspecialchars($_POST["username_email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

            $user = null;

            //* Validation de la saisie d'identification
            if (filter_var($usernameEmail, FILTER_VALIDATE_EMAIL)) //* Si c'est une adresse e-mail
            {
                $user = $this->userManager->getUserByEmail($usernameEmail); //* On recherche l'utilisateur avec l'email
            } 
            else //* Si ce n'est pas une adresse e-mail
            {
                $user = $this->userManager->getUserByUsername($usernameEmail); //* On recherche l'utilisateur avec l'username
            }

            if(!$user) //* Si aucun utilisateur n'est enrégistré avec ces identifiants
            {
                $error = ["message" => "Email où username invalide", "field" => "username_email"];
            }

            if (!$error) //* S'il n'y a pas d'erreur
            {
                if (!password_verify($password, $user->getPassword())) //* Mais que le password est mauvais
                {
                    $error = ["message" => "Password invalide", "field" => "password"]; //* Password invalide
                }
            }

            if ($error) //* Si il y a une erreur
            {
                $this->render("views/guest/login.phtml", $error); //* Afficher l'erreur et rediriger vers le formulaire de connexion
            } 
            else //* Pas d'erreur, les champs sont valides
            {
                if (isset($_SESSION["user_id"])) //* Si la variable de session user_id est déjà définie
                {
                    unset($_SESSION["user_id"]); //* On la supprime pour la reset à la fin de la fonction
                }
                
                if (isset($_SESSION["role"])) //* Si la variable de session role est déjà définie
                {
                    unset($_SESSION["role"]); //* On la supprime pour la reset à la fin de la fonction
                }
                $_SESSION["user_id"] = $user->getUserId(); //* On set la variable de session user_id
                $_SESSION["role"] = $user->getRole(); //* On set la variable de session role
                header("Location: index.php?route=homepage"); //* Retour sur la homepage
            }
        } 
        else 
        { 
            $this->render("views/guest/login.phtml", []); //* Les POST ne sont pas set, on retourne à la page login
        }
    }

    //** ---------------------------------------------------------------------------- */
    //* Fonction d'enrégistrement de l'utilisateur (instantiation d'une class info vide)
    //** ---------------------------------------------------------------------------- */
    public function register() 
    {
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]))
        {
            //* Variable de récolte d'erreur
            $error = null;

            //* Role "user" par défaut
            $role = "user";

            //* Tableau des emails Admin
            $adminEmails = ["kcorvais@gmail.com"];
            
            //* Contre-mesure d'injection de code
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
            $confirm_password = htmlspecialchars($_POST["confirm_password"], ENT_QUOTES, 'UTF-8');

            //* Validation regex
            if(!preg_match('/^[A-ZÀ-ÿa-z0-9-.]{2,50}$/', $username))
            {
                $error = ["message" => "Username invalide. Uniquement lettres, chiffres, '-', '.' et espaces, de 2 à 50 caractères.", "field" => "username"];
            }
            if(!preg_match('/^[\w\-\.]{2,30}@([\w\-]{2,15}\.)[\w\-]{2,4}$/', $email))
            {
                $error = ["message" => "Email invalide. Uniquement lettres, chiffres, '-' et '.', de 2 à 50 caractères.", "field" => "email"];
            }
            if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^.&*-]).{'.$this->minCharPswrd.',}$/', $password))
            {
                $error = ["message" => "Password invalide. Doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial, au moins 12 caractères", "field" => "password"];
            }

            //* Validation de doublons
            if($this->userManager->getUserByUsername($username))
            {
                $error =  ["message" => "Email ou username déjà utilisé", "field" => "username"];
            }
            if($this->userManager->getUserByEmail($email))
            {
                $error = ["message" => "Email ou username déjà utilisé", "field" => "username"];
            }

            //* Validation de l'égalité des saisies password et confirm_password
            if($password != $confirm_password)
            {
                $error = ["message" => "Les champs de password sont différents", "field" => "confirm_password"];
            }

            if ($error) //* Si il y a une erreur
            { 
                //* Afficher l'erreur et rediriger vers le formulaire d'inscription
                $this->render("views/guest/register.phtml", $error);
            } 
            else //* Les champs sont valides
            {
                //* On test si l'email d'enrégistrement est un email administrateur
                foreach($adminEmails as $adminEmail)
                {
                    if($email === $adminEmail) //* Si oui
                    {
                        $role = "admin"; //* On set le role sur "admin"
                    }
                }

                $password = password_hash($password, PASSWORD_DEFAULT); //* Hashage du password

                $user = new User($username, $email, $password, $role); //* Instantiation d'un nouvel utilisateur
                $this->userManager->insertUser($user); //* On insert l'utilisateur dans la BDD

                $user = $this->userManager->getUserByEmail($email); //* On récupère l'utilisateur dans la BDD pour obtenir son ID
                $info = new Info($user->getUserId()); //* Instantiation d'une info utilisateur à partir de son ID
                $this->infoManager->insertInfo($info); //* On insert l'info dans la BDD
                $this->render("views/guest/login.phtml", ["message" => "Compte créer avec succès", "field" => "general"]); //* Compte créer, on se rend sur la page de login
            }
        } 
        else 
        {
            $this->render("views/guest/register.phtml", []); //* Les POST ne sont pas set, on retourne à la page register
        }
    }

    //** ------------------------------------- */
    //*  Fonction d'édition du profil utilisateur
    //** ------------------------------------- */
    public function account() 
    {
        $error = null; //* Variable de récolte d'erreur

        $info_change = false; //* Booléen de changement d'informations

        //* Récuperation des informations du compte
        $user = $this->userManager->getUserByUserId($_SESSION["user_id"]);
        $info = $this->infoManager->getInfoByUserId($_SESSION["user_id"]);

        if (!empty($_POST["username"])) //* Si on édite le username
        {
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            //* Test regex
            if(!preg_match('/^[A-ZÀ-ÿa-z0-9-.]{2,50}$/', $username))
            {
                $error = ["message" => "Username invalide. Uniquement lettres, chiffres, '-', '.' et espaces, de 2 à 50 caractères.", "field" => "username"];
            }

            //* Control de doublon
            if($this->userManager->getUserByUsername($username) && $user->getUsername() !== $username)
            {
                $error = ["message" => "Username déjà utilisé", "field" => "username"];
            }

            if(!$error) //* Si pas d'erreur
            {
                $user->setUsername($username); //* On reset l'username
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["email"])) //* Si on édite l'email
        {
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            //* Test regex
            if(!preg_match('/^[\w\-\.]{2,30}@([\w\-]{2,15}\.)[\w\-]{2,4}$/', $email))
            {
                $error = ["message" => "Email invalide. Uniquement lettres, chiffres, '-' et '.', de 2 à 50 caractères.", "field" => "email"];
            }

            //* Control de doublon
            if($this->userManager->getUserByEmail($email) && $user->getEmail() !== $email)
            {
                $error = ["message" => "Email déjà utilisé", "field" => "email"];
            }
            
            if(!$error) //* Si pas d'erreur
            {
                $user->setEmail($email); //* On reset l'email
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["password"]) && !empty($_POST["confirm_password"]))  //* Si on édite le password
        {
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            //* Test regex
            if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^.&*-]).{'.$this->minCharPswrd.',}$/', $password))
            {
                $error = ["message" => "Password invalide. Doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial, au moins 12 caractères", "field" => "password"];
            }

            //* Validation de l'égalité des saisies password et confirm_password
            if($password != $confirm_password)
            {
                $error = ["message" => "Les champs de password sont différents", "field" => "confirm_password"];
            }

            if(!$error) //* Si pas d'erreur
            {
                $password = password_hash($password, PASSWORD_DEFAULT); //* Hashage du password
                $user->setPassword($password); //* On reset le passord
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["first_name"])) //* Si on édite le first_name
        {
            $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code
            
            if(preg_match('/^[A-ZÀ-ÿa-z-\s]{2,50}$/', $first_name)) //* Si pas d'erreur
            {
                $info->setFirstName($first_name); //* On reset le first_name
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Prénom invalide. Uniquement lettres, '-' et espaces, de 2 à 50 caractères.", "field" => "first_name"];
            }
        }

        if(!empty($_POST["last_name"])) //* Si on édite le last_name
        {
            $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            if(preg_match('/^[A-ZÀ-ÿa-z-\s]{2,50}$/', $last_name)) //* Si pas d'erreur
            {
                $info->setLastName($last_name); //* On reset le last_name
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Nom invalide. Uniquement lettres, '-' et espaces, de 2 à 50 caractères.", "field" => "last_name"];
            }
        }

        if(!empty($_POST["tel"])) //* Si on édite le numéro de téléphone
        {
            $tel = htmlspecialchars($_POST["tel"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            if(preg_match('/^[0-9]{10,10}$/', $tel)) //* Si pas d'erreur
            {
                $info->setTel($tel); //* On reset le numéro de téléphone
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Numéro de téléphone invalide. Uniquement des chiffres, 10 caractères.", "field" => "tel"];
            }
        }

        if(!empty($_POST["address"])) //* Si on édite l'adresse
        {
            $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            if(preg_match('/^\d[0-9A-ZÀ-ÿa-z\s\-]{2,50}$/', $address)) //* Si pas d'erreur
            {
                $info->setAddress($address); //* On reset l'adresse
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Address invalide. Uniquement lettres, chiffres, '-' et espaces, de 2 à 50 caractères. Commence par un numéro.", "field" => "address"];
            }
        }

        if(!empty($_POST["zip"])) //* Si on édite le code postal
        {
            $zip = htmlspecialchars($_POST["zip"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code
  
            if(preg_match('/^[0-9]{2,15}$/', $zip)) //* Si pas d'erreur
            {
                $info->setZip($zip); //* On reset le code postal
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Code postal invalide. Uniquement des chiffres, de 2 à 15 caractères.", "field" => "zip"];
            }
        }

        if(!empty($_POST["city"])) //* Si on édite la ville
        {
            $city = htmlspecialchars($_POST["city"], ENT_QUOTES, 'UTF-8'); //* Contre-mesure d'injection de code

            if(preg_match('/^[A-ZÀ-ÿa-z0-9-\s]{2,50}$/', $city)) //* Si pas d'erreur
            {
                $info->setCity($city); //* On reset la ville
                $info_change = true; //* Confirmation d'édition
            }
            else
            {
                $error = ["message" => "Ville invalide. Uniquement lettres, '-' et espaces, de 2 à 50 caractères.", "field" => "city"];
            }
        }

        if($info_change) //* Si on a modifier les informations utlisateur
        {
            if(!$error) //* Si il n'y à pas d'erreur
            { 
                //* On édite le profil
                $this->userManager->editUser($user);
                $this->infoManager->editInfo($info);
                //if(count($requests))
                //* On retourne à la page account avec le message de confirmation
                $this->render("views/user/account.phtml", ["message" => "Le profil à bien été mis à jour", "field" => "general", "user" => $user, "info" => $info]);
            }
            else //* Si il y a un message d'erreur
            {
                //* On retourne à la page account avec le message d'erreur
                $globalData = $error;
                $globalData["user"] = $user;
                $globalData["info"] = $info;
                $this->render("views/user/account.phtml", $globalData);
            }
        }
        else
        {
            $requests = $this->requestManager->getRequestsByUserId($_SESSION["user_id"]);
            $categories = [];
            if($requests)
            {
                foreach($requests as $request)
                {
                    $category = $this->categoryManager->getCategoryByCategoryId($request->getCategoryId());
                    array_push($categories, $category);
                }
                $this->render("views/user/account.phtml", ["categories" => $categories, "user" => $user, "info" => $info, "requests" => $requests]);
            }
            else
            {
                $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
            }
            
        }
    }
}