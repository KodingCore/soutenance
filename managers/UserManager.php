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
            $userInstance->setUserId($user["user_id"]);
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
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["user_id"]);
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
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["user_id"]);
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
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["user_id"]);
            return $userInstance;
        }
        else
        {
            return null;
        }
    }

    public function insertUser(User $user)
    {
        $query = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES(:username, :email, :password, :role)");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "role" => $user->getRole()
        ];
        $query->execute($parameters);
    }


    public function editUser(User $user)
    {
        $user_test = $this->getUserByEmail($user->getEmail());
        if($user_test)
        {
            if($user_test->getUserId() !== $_SESSION["user_id"])
            {
                return "Un compte existe déjà à cette adresse";
            }
        }

        $user_test = $this->getUserByUsername($user->getUsername());
        if($user_test)
        {
            if($user_test->getUserId() !== $_SESSION["user_id"])
            {
                return "Ce nom d'utilisateur est déjà pris";
            }
        }

        $query = $this->db->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE user_id = :user_id");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "user_id" => $_SESSION["user_id"]
        ];
        $query->execute($parameters);
    }
}
?>