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
        if(!empty($_POST["username-email"]) && !empty($_POST["password"]))
        {


            $userTag = $_POST["username-email"];
            $pwd = $_POST["password"];

            $user = null;
            if (filter_var($userTag, FILTER_VALIDATE_EMAIL)) {
                // C'est une adresse e-mail
                // Traiter l'entrée comme une adresse e-mail
                $user = $this->userManager->getUserByEmail($userTag);
            } else {
                // Ce n'est pas une adresse e-mail, on suppose que c'est un nom d'utilisateur
                // Traiter l'entrée comme un nom d'utilisateur
                $user = $this->userManager->getUserByUsername($userTag);
            }

            if($user != null)
            {
                if(password_verify($pwd, $user->getPasswordHash()))
                {
                    //connexion
                }
                else
                {
                    //password faux
                }
            }
            else
            {
                //utilisateur inconnu dans la bdd
            }
        }
    }
    
    public function register()
    {
       if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"]))
       {
            // if(htmlentities($_POST["username"]) && )
            // {
            //     $user = $this->userManager->getUserByUsername($userTag);
            // }


       }
    }
}
?>