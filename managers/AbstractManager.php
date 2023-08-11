<?php

abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
       $dbName = "kodingcore_bddpro";
       $host = "127.0.0.1";
       $port = "3306";
       $username = "root";
       $password = "";
       $connexionString = "mysql:host=$host;charset=utf8;port=$port;dbname=$dbName";
       
       $this->db = new PDO(
           $connexionString,
           $username,
           $password
       );
    }
}
