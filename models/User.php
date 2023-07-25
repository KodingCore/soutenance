<?php
class User
{

    private ?int $user_id;
    private string $username;
    private string $email;
    private string $password_hash;
    private string $role;
   
    public function __construct(string $username, string $email, string $password_hash, string $role = "user")
    {
       $this->user_id = null;
       $this->username = $username;
       $this->email = $email;
       $this->password_hash = $password_hash;
       $this->role = $role;
    }
    
    public function getUserId() : ?int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getUsername() : string{  return $this->username;  }
    public function setUsername(string $username){   $this->username = $username;  }

    public function getEmail() : string{  return $this->email;  }
    public function setEmail(string $email){   $this->email = $email;  }

    public function getPasswordHash() : string{  return $this->password_hash;  }
    public function setPasswordHash(string $password_hash){   $this->password_hash = $password_hash;  }

    public function getRole() : string{  return $this->role;  }
    public function setRole(string $role){   $this->role = $role;  }

    /**
 * Get the value of user_id
     *
     * @return  mixed
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setPassword_hash($password_hash)
    {
        $this->password_hash = $password_hash;

        return $this;
    }
}
?>