<?php

//Ouverture d'une session
session_start();

//fichier de regroupement de tout les requires
require "logics/requires.php";

//Appel de la function checkRoute de router.php
if(isset($_GET["route"]))
{
    checkRoute($_GET["route"]);
}
else
{
    checkRoute("");
}

?>