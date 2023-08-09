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


    //** ---------------------------------- */
    //* Fonction de connexion de l'utilisateur
    //** ---------------------------------- */
    public function login()
    {
        if (!empty($_POST["username_email"]) && !empty($_POST["password"])) 
        {
            //* Variable de récolte d'érreur
            $error = null;

            //* Contre mesure d'injection de code
            $userTag = htmlspecialchars($_POST["username_email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

            $user = null;

            //* Validation de la longueur du champ username_email
            $error = $this->controlStrlen("Email / Username", $userTag, 49);

            //* Validation de la longueur du champ password
            $error = $this->controlStrlen("Password", $password, 49);

            //* Validation de la saisie d'identification
            if (filter_var($userTag, FILTER_VALIDATE_EMAIL)) //* Si c'est une adresse e-mail
            {
                $user = $this->userManager->getUserByEmail($userTag); //* On recherche l'utilisateur avec l'email
            } 
            else //* Si ce n'est pas une adresse e-mail
            {
                $user = $this->userManager->getUserByUsername($userTag); //* On recherche l'utilisateur avec l'username
            }

            if(!$user) //* Si aucun utilisateur n'est enrégistré avec ces identifiants
            {
                $error = "Email / username ou password invalide";
            }

            if (!$error) //* S'il n'y a pas d'erreur
            {
                if (!password_verify($password, $user->getPassword())) //* Mais que le password est mauvais
                {
                    $error = "Email / username ou password invalide"; //* Password invalide
                }
            }

            if ($error) //* Si il y a une erreur
            {
                $this->render("views/guest/login.phtml", ["message" => $error]); //* Afficher l'erreur et rediriger vers le formulaire de connexion
            } 
            else //* Les champs sont valides
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
                $this->render("views/homepage.phtml", []); //* Retour sur la homepage
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

            //* On set par défaut une variable roole sur "user"
            $role = "user";

            //* tableau des emails Admin
            $adminEmails = [
                "kcorvais@gmail.com"
            ];
            
            //* Contre mesure d'injection de code
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
            $confirm_password = htmlspecialchars($_POST["confirm_password"], ENT_QUOTES, 'UTF-8');
    
            //* Validation des longueur de chaines
            $error = $this->controlStrlen("Username", $username, 49);
            $error = $this->controlStrlen("Email", $email, 49);
            $error = $this->controlStrlen("Password", $password, 49);
            $error = $this->controlStrlen("Confirm password", $confirm_password, 49);

            //* Validation de l'égalité des saisies password et confirm_password
            if($password != $confirm_password)
            {
                $error = "Les champs de password sont différents";
            }

            //* Validation de la non-existance du username
            if($this->userManager->getUserByUsername($username))
            {
                $error = "Email ou username déjà utilisé";
            }

            //* Validation de la forme d'un email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //* Si ce n'est pas une adresse e-mail
            {
                $error = "Ce n'est pas une adresse email valide";
            } 

            //* Validation de la non-existance de l'email
            if($this->userManager->getUserByEmail($email))
            {
                $error = "Email ou username déjà utilisé";
            }

            if ($error) //* Si il y a une erreur
            { 
                //* Afficher l'erreur et rediriger vers le formulaire d'inscription
                $this->render("views/guest/register.phtml", ["message" => $error]);
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

                $this->render("views/guest/login.phtml", []); //* On se rend sur la page de login
            }
        } 
        else 
        {
            $this->render("views/guest/register.phtml", []); //* Les POST ne sont pas set, on retourne à la page register
        }
    }


    //** -------------------------------------------------------------- */
    //*Cette fonction sert l'édition du profil utilisateur et de ses infos
    //** -------------------------------------------------------------- */
    public function account() 
    {

        //* Variable de récolte d'erreur
        $error = null;

        //* Booléen de changement d'informations
        $info_change = false;

        //* Récuperation des informations du compte
        $user = $this->userManager->getUserByUserId($_SESSION["user_id"]);
        $info = $this->infoManager->getInfoByUserId($_SESSION["user_id"]);

        if (!empty($_POST["username"])) //* Si on édite le username
        {
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Username", $username, 49); //* Validation de la longueur de chaine

            //* Validation de la non-existance du username
            if($this->userManager->getUserByUsername($username))
            {
                $error = "Email ou username déjà utilisé";
            }

            if(!$error) //* Si pas d'erreur
            {
                $user->setUsername($username); //* On reset l'username
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["email"])) //* Si on édite l'email
        {
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Email", $email, 49); //* Validation de la longueur de chaine

            //* Validation de la forme d'un email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //* Si ce n'est pas une adresse e-mail
            {
                $error = "Ce n'est pas une adresse email valide";
            } 

            //* Validation de la non-existance de l'email
            if($this->userManager->getUserByEmail($email))
            {
                $error = "Email ou username déjà utilisé";
            }
            
            if(!$error) //* Si pas d'erreur
            {
                $user->setEmail($email); //* On reset l'email
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["password"]) && !empty($_POST["confirm_password"]))  //* Si on édite le password
        {
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $confirm_password = htmlspecialchars($_POST["confirm_password"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Password", $password, 49); //* Validation de la longueur de chaine
            $error = $this->controlStrlen("Confirm password", $confirm_password, 49); //* Validation de la longueur de chaine

            //* Validation de l'égalité des saisies password et confirm_password
            if($password != $confirm_password)
            {
                $error = "Les champs de password sont différents";
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
            $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Email", $first_name, 49); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setFirstName($first_name); //* On reset le first_name
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["last_name"])) //* Si on édite le last_name
        {
            $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Email", $last_name, 49); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setLastName($last_name); //* On reset le last_name
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["tel"])) //* Si on édite le numéro de téléphone
        {
            $tel = htmlspecialchars($_POST["tel"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Téléphone", $tel, 14); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setTel($tel); //* On reset le numéro de téléphone
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["address"])) //* Si on édite l'adresse
        {
            $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Adresse", $address, 254); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setAddress($address); //* On reset l'adresse
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["zip"])) //* Si on édite le code postal
        {
            $zip = htmlspecialchars($_POST["zip"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Code postal", $zip, 14); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setTel($zip); //* On reset le code postal
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!empty($_POST["city"])) //* Si on édite la ville
        {
            $city = htmlspecialchars($_POST["city"], ENT_QUOTES, 'UTF-8'); //* Contre mesure d'injection de code
            $error = $this->controlStrlen("Ville", $city, 99); //* Validation de la longueur de chaine

            if(!$error) //* Si pas d'erreur
            {
                $info->setCity($city); //* On reset la ville
                $info_change = true; //* Confirmation d'édition
            }
        }

        if(!$error) //* Si il n'y à pas d'erreur
        { 
            //* On édite le profil
            $this->userManager->editUser($user);
            $this->infoManager->editInfo($info);
        }

        if($info_change) //* Si on a modifier les informations utlisateur
        {
            //* On retourne à la page account aevc le message de confirmation
            $this->render("views/user/account.phtml", ["message" => "Le profil à bien été mis à jour", "user" => $user, "info" => $info]);
        }
        else if($error) //* Si il y a un message d'erreur
        {
            //* On retourne à la page account aevc le message d'erreur
            $this->render("views/user/account.phtml", ["message" => $error, "user" => $user, "info" => $info]);
        }
        else
        {
            $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
        }
        
    }
}