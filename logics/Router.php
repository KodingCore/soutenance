<?php


function checkRoute(string $route)
{
    $userController = new UserController();

    if($route === "register")
    {
        $userController->register();
    }
    else if($route === "login")
    {
        $userController->login();
    }
    else if($route === "account")
    {
        $userController->changeUserInfo();
    }
    else if($route === "shop-window")
    {
        
    }
    else if($route === "disconnect")
    {
        unset($_SESSION["user_id"]);
        session_destroy();
        $userController->render("views/general/homepage.phtml", []);
    }
    else
    {
        $userController->render("views/general/homepage.phtml", []);
    }
}




?>