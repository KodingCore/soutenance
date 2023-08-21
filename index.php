<?php

//Ouverture d'une session
session_start(); //* Ouverture d'une session

//fichier de regroupement de tout les requires
require "config/autoload.php"; //* require de l'autoload

$router = new Router(); //* Instanciation d'une class Router

//Appel de la function checkRoute de Router.php
if(isset($_GET["route"])) //* Si la variable route est définie
{
    $router->checkRoute($_GET["route"]);
}
else //* Sinon on appel checkRoute sur la homepage
{
    $router->checkRoute("homepage");
}

?>