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
            if(str_contains($userTag, "@"))
            {
                $user = $this->userManager->getUserByEmail($userTag);
            }
            else
            {
                $user = $this->userManager->getUserByUsername($userTag);
            }

            if($user != null)
            {
                if(password_verify($pwd, $user->getPasswordHash()))
                {

                }
            }
        }
    }
    
    public function register()
    {
       if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"]))
       {
            echo htmlentities($_POST["username"]);
            //filter_var($inputValue, $filterType);
            //FILTER_SANITIZE_STRING

            //htmlentities(string $string);


       }
    }
}
?>