<?php

abstract class AbstractManager
{

    protected PDO $db;

    public function __construct()
    {
       $dbName = "kevincorvaisier_bddpro";
       $host = "loacalhost";
       $port = "3306";
       $username = "root";
       $password = "";
       $connexionString = "mysql:host=$host;port=$port;dbname=$dbName";
       
       $this->db = new PDO(
           $connexionString,
           $username,
           $password
       );
    }

}
?>