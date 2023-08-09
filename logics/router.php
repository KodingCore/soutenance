<?php

function checkRoute($route)
{
    $homepageController = new HomepageController();
    $userController = new UserController();

    if($route === "login")
    {
        $userController->login();
    }
    else if($route === "register")
    {
        $userController->register();
    }
    else if($route === "account")
    {
        $userController->account();
    }
    else if($route === "contact")
    {

    }
    else if($route === "disconnect")
    {
        unset($_SESSION["user_id"]);
        unset($_SESSION["role"]);
        $homepageController->index();
    }
    else if($route === "dashboard")
    {

    }
    else if($route === "shop")
    {

    }
    else if($route === "quote")
    {

    }
    else
    {
        $homepageController->index();
    }
}