<?php

class UserManager extends AbstractManager
{
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $usersTab = [];
        foreach($results as $user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["id"]);
        }
        return $usersTab;
    }

    public function getUserByEmail(string $email) : ? User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $parameters = [
            "email" => $email
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["id"]);
            return $userInstance;
        }
        else
        {
            return null;
        }
        
    }

    public function getUserByUsername(string $username) : ? User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $parameters = [
            "username" => $username
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["id"]);
            return $userInstance;
        }
        else
        {
            return null;
        }
    }

    public function getUserByUserId(int $user_id) : ? User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $parameters = [
            "id" => $user_id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["id"]);
            return $userInstance;
        }
        else
        {
            return null;
        }
    }
    
}
?>