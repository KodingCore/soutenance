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
        if (!empty($_POST["username_email"]) && !empty($_POST["password"])) 
        {
            //* Variable de récolte d'érreur
            $error = null;

            //* Contre mesure d'injection de code
            $userTag = htmlspecialchars($_POST["username_email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

            $user = null;

            //* Validation de la longueur du champ username_email
            if (strlen($userTag) > 99) 
            {
                $error = "Saisie du champ Email / Username trop longue (99 caractères maximum)";
            }

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
                $error = "Aucun utilisateur n'est enrégistré avec cet email/username";
            }

            if (!$error) //* S'il n'y a pas d'erreur
            {
                if (!password_verify($password, $user->getPassword())) //* Mais que le password est mauvais
                {
                    $error = "Password invalide"; //* Password invalide
                }
            }

            if ($error) //* Si il y a une erreur
            { 
                //* Afficher l'erreur et rediriger vers le formulaire de connection
                $this->render("views/guest/login.phtml", ["message" => $error]);
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
    
    public function register() {

        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]))
        {
            //* Variable de récolte d'érreur
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
    
            //* Validation de la longueur du champ username
            if (strlen($username) > 49) 
            {
                $error = "Saisie du champ username trop longue (49 caractères maximum)";
            }

            //* Validation de la longueur du champ email
            if (strlen($email) > 99) 
            {
                $error = "Saisie du champ email trop longue (99 caractères maximum)";
            }

            //* Validation de la longueur du champ password
            if (strlen($password) > 49) 
            {
                $error = "Saisie du champ password trop longue (49 caractères maximum)";
            }

            //* Validation de la longueur du champ confirm_password
            if (strlen($confirm_password) > 49) 
            {
                $error = "Saisie du champ confirmation de password trop longue (49 caractères maximum)";
            }

            //* Validation de l'égalité des saisies password et confirm_password
            if($password != $confirm_password)
            {
                $error = "Les champs de password sont différents";
            }

            //* Validation de la non-existance du username
            if($this->userManager->getUserByUsername($username))
            {
                $error = "L'username saisie existe déjà";
            }

            //* Validation de la non-existance de l'email
            if($this->userManager->getUserByEmail($email))
            {
                $error = "L'email saisie existe déjà";
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

                $this->render("views/user/login.phtml", []); //* On se rend sur la page de login
            }
        } else {
            $this->render("views/guest/register.phtml", []); //* Les POST ne sont pas set, on retourne à la page register
        }
    }

    //*Cette fonction sert l'édition du profil utilisateur
    function account() 
    {

    }
}