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
    else
    {
        $userController->render("views/general/homepage.phtml", []);
    }
}




?>