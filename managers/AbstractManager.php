<?php
//********************************
// Cette classe abstraite est appelée pour 
// se connecter à la base de donnée dans les managers
//*******************************/
abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
       $dbName = "kevincorvaisier_kodingcore_bddpro";
       $host = "db.3wa.io";
       $port = "3306";
       $username = "kevincorvaisier";
       $password = "04646b679a4ab0a202f8007ea81fe675";
       $connexionString = "mysql:host=$host;charset=utf8;port=$port;dbname=$dbName";
       
       $this->db = new PDO(
           $connexionString,
           $username,
           $password
       );
    }
}
