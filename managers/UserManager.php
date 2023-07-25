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
            $userInstance = new User($user["username"], $user["email"], $user["password_hash"], $user["role"]);
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
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password_hash"], $user["role"]);
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
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password_hash"], $user["role"]);
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
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user = $result;
        if($user)
        {
            $userInstance = new User($user["username"], $user["email"], $user["password_hash"], $user["role"]);
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
        $query = $this->db->prepare("INSERT INTO users (username, email, password_hash, role) VALUES(:username, :email, :password_hash, :role)");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password_hash" => $user->getPasswordHash(),
            "role" => $user->getRole()
        ];
        $query->execute($parameters);
    }


    public function editUser(User $user): ? string
    {
        $sameUser = $this->getUserByEmail($user->getEmail());

        if($sameUser)
        {
            if($sameUser->getUserId() !== $_SESSION["user_id"])
            {
                return "Un compte existe déjà à cette adresse";
            }
        }

        $sameUser = $this->getUserByUsername($user->getUsername());
        
        if($sameUser)
        {
            if($sameUser->getUserId() !== $_SESSION["user_id"])
            {
                return "Ce pseudo est déjà pris";
            }
        }

        $query = $this->db->prepare("UPDATE users SET username = :username, email = :email, password_hash = :password_hash, role = :role WHERE user_id = :user_id");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password_hash" => $user->getPasswordHash(),
            "role" => $user->getRole(),
            "user_id" => $_SESSION["user_id"]
        ];
        $query->execute($parameters);
        return null;
    }
}
?>