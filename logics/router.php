<?php

function checkRoute($route) : void
{
    $homepageController = new HomepageController();
    $userController = new UserController();
    $contactController = new ContactController();
    $dashboardController = new DashboardController();

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
        $contactController->sendMessage();
    }
    else if($route === "disconnect")
    {
        unset($_SESSION["user_id"]);
        unset($_SESSION["role"]);
        session_destroy();
        $homepageController->index();
    }
    else if($route === "dashboard")
    {
        $dashboardController->index();
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