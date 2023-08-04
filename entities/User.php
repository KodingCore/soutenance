<?php

class User {
    private int $user_id;
    private string $username;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $tel;
    private string $password;
    private string $role;
    
    public function __construct(int $user_id, string $username, string $first_name, string $last_name, string $email, string $tel, string $password, string $role) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->tel = $tel;
        $this->password = $password;
        $this->role = $role;
    }
    
    // Getters
    public function getUserId(): int { return $this->user_id; }
    public function getUsername(): string { return $this->username; }
    public function getFirstName(): string { return $this->first_name; }
    public function getLastName(): string { return $this->last_name; }
    public function getEmail(): string { return $this->email; }
    public function getTel(): string { return $this->tel; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }
    
    // Setters
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setUsername(string $username): void { $this->username = $username; }
    public function setFirstName(string $first_name): void { $this->first_name = $first_name; }
    public function setLastName(string $last_name): void { $this->last_name = $last_name; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setTel(string $tel): void { $this->tel = $tel; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setRole(string $role): void { $this->role = $role; }
}
