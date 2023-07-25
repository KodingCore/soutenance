<?php


//Ouverture d'une session
session_start();


//All requires
require "logics/Router.php";

require "models/User.php";
require "models/Info.php";

require "managers/AbstractManager.php";
require "managers/CotationManager.php";
require "managers/InfoManager.php";
require "managers/OrderManager.php";
require "managers/ProjectManager.php";
require "managers/QuoteRequestManager.php";
require "managers/ReviewManager.php";
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