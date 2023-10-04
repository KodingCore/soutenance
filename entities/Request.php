<?php

class Request implements JsonSerializable
{
    private ?int $request_id;
    private int $user_id;
    private int $category_id;
    private string $checkboxes_binaries;
    private string $content_share;
    private string $description;
    private string $created_at;
    private ?string $updated_at;

    public function __construct(int $user_id, int $category_id, string $checkboxes_binaries, string $content_share, string $description, string $created_at) {
        $this->request_id = null;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->checkboxes_binaries = $checkboxes_binaries;
        $this->content_share = $content_share;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->updated_at = null;
    }
    
    // Getters
    public function getRequestId(): int { return $this->request_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getCategoryId(): int { return $this->category_id; }
    public function getCheckboxesBinaries(): string { return $this->checkboxes_binaries; }
    public function getContentShare(): string { return $this->content_share; }
    public function getDescription(): string { return $this->description; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getUpdatedAt(): ?string { return $this->updated_at; }
    
    // Setters
    public function setRequestId(int $request_id): void { $this->request_id = $request_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setCheckboxesBinaries(string $checkboxes_binaries): void { $this->checkboxes_binaries = $checkboxes_binaries; }
    public function setContentShare(string $content_share): void { $this->content_share = $content_share; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setCreatedAt(string $created_at): void { $this->created_at = $created_at; }
    public function setUpdatedAt(string $updated_at): void { $this->updated_at = $updated_at; }

    // fonction pour les requetes API
    public function jsonSerialize() {
        return [
            "request_id" => $this->request_id,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            "checkboxes_binaries" => $this->checkboxes_binaries,
            "content_share" => $this->content_share,
            "description" => $this->description,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
