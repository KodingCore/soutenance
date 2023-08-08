<?php

function checkRoute($route)
{
    $homepageController = new HomepageController();


    if($route === "login")
    {

    }
    else if($route === "register")
    {

    }
    else if($route === "account")
    {

    }
    else if($route === "contact")
    {

    }
    else if($route === "disconnect")
    {

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