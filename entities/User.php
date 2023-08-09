<?php

class User {
    private ?int $user_id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(string $username, string $email, string $password, string $role = "user") {
        $this->user_id = null;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUserId(): int { return $this->user_id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }

    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setUsername(string $username): void { $this->username = $username; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setRole(string $role): void { $this->role = $role; }
}