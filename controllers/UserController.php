<?php

class UserController extends AbstractController
{

    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function login()
    {
        if (!empty($_POST["username_email"]) && !empty($_POST["password"])) 
        {
            $userTag = $_POST["username_email"];
            $password = $_POST["password"];
            $user = null;

            if (filter_var($userTag, FILTER_VALIDATE_EMAIL)) //* Si c'est une adresse e-mail
            {
                $user = $this->userManager->getUserByEmail($userTag); //*On recherche l'utilisateur avec l'email
            } 
            else //* Si ce n'est pas une adresse e-mail
            {
                $user = $this->userManager->getUserByUsername($userTag); //* On recherche l'utilisateur avec l'username
            }
            if ($user !== null) //*S'il y a un utilisateur qui utilise cet email ou username
            {
                if (password_verify($password, $user->getPassword())) //*On vérifie le password
                {
                    if (isset($_SESSION["user_id"])) //*Si la variable de session user_id est déjà définie
                    {
                        unset($_SESSION["user_id"]); //*On la supprime pour la reset à la fin de la fonction
                    }
                    
                    if (isset($_SESSION["role"])) //*Si la variable de session role est déjà définie
                    {
                        unset($_SESSION["role"]); //*On la supprime pour la reset à la fin de la fonction
                    }

                    $_SESSION["user_id"] = $user->getUserId(); //*On set la variable de session user_id
                    $_SESSION["role"] = $user->getRole(); //*On set la variable de session role
                    $this->render("views/general/homepage.phtml", []); //*Retour sur la homepage
                } 
                else 
                { 
                    $this->render("views/user/login.phtml", ["champ" => "password", "message" => "Password invalide"]); //*Password invalide, on retourne sur la page login
                }
            } 
            else 
            { 
                $this->render("views/user/login.phtml", ["champ" => "email", "message" => "Username ou email invalide"]); //*email ou username invalide, on retourne sur la page login
            }
        } 
        else 
        { 
            $this->render("views/user/login.phtml", []); //*les POST ne sont pas set, on retourne à la page login
        }
    }

    public function validateMaxLength($field, $value, $maxLength) {
        if (strlen($value) > $maxLength) {
            return "{$field} trop long (maximum {$maxLength} caractères)";
        }
        return null; //* Pas d'erreur de longueur
    }
    
    public function register() {
        if (!empty($_POST["username"]) && !empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["email"]) && !empty($_POST["tel"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])) {
            $error = null;
    
            $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
            $first_name = htmlspecialchars($_POST["first_name"], ENT_QUOTES, 'UTF-8');
            $last_name = htmlspecialchars($_POST["last_name"], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
            $tel = htmlspecialchars($_POST["tel"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
            $confirm_password = htmlspecialchars($_POST["confirm_password"], ENT_QUOTES, 'UTF-8');
    
            //* Valider la longueur des champs
            $maxLengthErrors = [
                $this->validateMaxLength("Username", $username, 49),
                $this->validateMaxLength("First Name", $first_name, 49),
                $this->validateMaxLength("Last Name", $last_name, 49),
                $this->validateMaxLength("Email", $email, 99),
                $this->validateMaxLength("Téléphone", $tel, 14),
                $this->validateMaxLength("Password", $password, 49),
                $this->validateMaxLength("Confirm Password", $confirm_password, 49)
            ];
    
            //* Vérifier s'il y a des erreurs de longueur
            foreach ($maxLengthErrors as $maxLengthError) {
                if ($maxLengthError) {
                    $error = $maxLengthError;
                    break;
                }
            }
    
            if ($error) {
                //* Afficher l'erreur et rediriger vers le formulaire d'inscription
                $this->render("views/user/register.phtml", ["error" => $error]);
            } else {
                //* Tout est valide, procéder à l'inscription
            }
        } else {
            $this->render("views/user/register.phtml", []);
        }
    }

    //*Cette fonction sert l'édition de l'utilisateur
    function changeUserInfo() 
    {

    }
}