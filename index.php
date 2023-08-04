<?php


//Ouverture d'une session
session_start();


//All requires
require "logics/Router.php";

require "entities/User.php";

require "managers/AbstractManager.php";
require "managers/UserManager.php";

require "controllers/AbstractController.php";
require "controllers/UserController.php";


//Appel de la function checkRoute de Router.php
if(isset($_GET["route"]))
{
    checkRoute($_GET["route"]);
}
else
{
    checkRoute("");
}

?>