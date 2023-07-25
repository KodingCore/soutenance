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
                    $_SESSION["user_id"] = $user->getUserId();
                    $_SESSION["role"] = $user->getRole();
                    
                    $this->render("views/general/homepage.phtml", []);
                }
                else
                {
                    $this->render("views/user/login.phtml", ["message" => "Password invalide"]);
                }
            }
            else
            {
                $this->render("views/user/login.phtml", ["message" => "Username où email invalide"]);
            }
        }
        else
        {
            $this->render("views/user/login.phtml", ["message" => "Des champs sont vides"]);
        }
    }
    
    public function register()
    {
       if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"]))
       {
            if(htmlentities($_POST["username"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            {
                if($_POST["password"] === $_POST["confirm-password"])
                {
                    $user = $this->userManager->getUserByUsername($_POST["username"]);
                    if(!$user)
                    {
                        $user = $this->userManager->getUserByEmail($_POST["email"]);
                        if(!$user)
                        {
                            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                            $userInstance = new User($_POST["username"], $_POST["email"], $password_hash);
                            
                            $message = $this->userManager->insertUser($userInstance);
                            $user = $this->userManager->getUserByEmail($_POST["email"]);
                            $user_id = $user->getUserId();
                            $info = new Info($user_id);
                            $this->infoManager->insertInfo($info);
                            if($message)
                            {
                                $this->render("views/user/login.phtml", ["message" => $message]);
                            }
                            else
                            {
                                $this->render("views/user/login.phtml", []);
                            }
                        }
                        else
                        {
                            $this->render("views/user/register.phtml", ["message" => "Email déjà utilisé"]);
                        }
                    }
                    else
                    {
                        $this->render("views/user/register.phtml", ["message" => "Username déjà utilisé"]);
                    }
                }
                else
                {
                    $this->render("views/user/register.phtml", ["message" => "Les passwords sont différents"]);
                }
                
            }
            else
            {
                $this->render("views/user/register.phtml", ["message" => "Username où email invalide"]);
            }
        }
        else
        {
            $this->render("views/user/register.phtml", ["message" => "Des champs sont vides"]);
        }
    }

    public function changeUserInfo()
    {
        if(isset($_SESSION["user_id"]))
        {
            $user = $this->userManager->getUserByUserId($_SESSION["user_id"]);
            if(isset($_POST["username"]) && !empty($_POST["username"]))
            {
                $username = htmlentities($_POST["username"]);
                $user->setUsername($username);
            }
            if(isset($_POST["email"]))
            {
                if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                {
                    $user->setEmail($_POST["email"]);
                }
            }
            if(isset($_POST["password"]))
            {
                $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $user->setPasswordHash($password_hash);
            }
            $this->userManager->editUser($user);

            $info = $this->infoManager->getInfoByUserId($_SESSION["user_id"]);

            if(!$info)
            {
                $info = new Info($_SESSION["user_id"]);
                $this->infoManager->insertInfo($info);
            }
            if(isset($_POST["first_name"]))
            {
                $first_name = htmlentities($_POST["first_name"]);
                $info->setFirstName($first_name);
            }
            if(isset($_POST["last_name"]))
            {
                $last_name = htmlentities($_POST["last_name"]);
                $info->setLastName($last_name);
            }
            if(isset($_POST["phone_number"]))
            {
                $phone_number = htmlentities($_POST["phone_number"]);
                $info->setPhoneNumber($phone_number);
            }
            if(isset($_POST["address"]))
            {
                $address = htmlentities($_POST["address"]);
                $info->setAddress($address);
            }
            if(isset($_POST["town"]))
            {
                $town = htmlentities($_POST["town"]);
                $info->setTown($town);
            }
            if(isset($_POST["zip"]))
            {
                $zip = htmlentities($_POST["zip"]);
                $info->setZip($zip);
            }
            if(isset($_POST["country"]))
            {
                $country = htmlentities($_POST["country"]);
                $info->setCountry($country);
            }

            $this->infoManager->editInfo($info);
            $this->render("views/user/account.phtml", ["user" => $user, "info" => $info]);
        }
        else
        {
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