<?php

//Ouverture d'une session
session_start();

//fichier de regroupement de tout les requires
require "config/autoload.php";

$router = new Router();

//Appel de la function checkRoute de Router.php
if(isset($_GET["route"]))
{
    $router->checkRoute($_GET["route"]);
}
else
{
    $router->checkRoute("");
}

?>