<?php

class Info {
    private ?int $info_id;
    private int $user_id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $tel;

    public function __construct(int $user_id, string $first_name = null, string $last_name = null, string $tel = null) {
        $this->info_id = null;
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->tel = $tel;
    }

    public function getInfoId(): int { return $this->info_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getFirstName(): string { return $this->first_name; }
    public function getLastName(): string { return $this->last_name; }
    public function getTel(): string { return $this->tel; }

    public function setInfoId(int $info_id): void { $this->info_id = $info_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setFirstName(string $first_name): void { $this->first_name = $first_name; }
    public function setLastName(string $last_name): void { $this->last_name = $last_name; }
    public function setTel(string $tel): void { $this->tel = $tel; }
}