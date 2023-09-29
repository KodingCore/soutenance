<?php

class Request implements JsonSerializable
{
    private ?int $request_id;
    private int $user_id;
    private int $category_id;
    private string $checkboxes_binaries;
    private string $content_share;
    private string $description;
    
    public function __construct(int $user_id, int $category_id, string $checkboxes_binaries, string $content_share, string $description) {
        $this->request_id = null;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->checkboxes_binaries = $checkboxes_binaries;
        $this->content_share = $content_share;
        $this->description = $description;
    }
    
    // Getters
    public function getRequestId(): int { return $this->request_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getCategoryId(): int { return $this->category_id; }
    public function getCheckboxesBinaries(): string { return $this->checkboxes_binaries; }
    public function getContentShare(): string { return $this->content_share; }
    public function getDescription(): string { return $this->description; }
    
    // Setters
    public function setRequestId(int $request_id): void { $this->request_id = $request_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setCheckboxesBinaries(string $checkboxes_binaries): void { $this->checkboxes_binaries = $checkboxes_binaries; }
    public function setContentShare(string $content_share): void { $this->content_share = $content_share; }
    public function setDescription(string $description): void { $this->description = $description; }

    public function jsonSerialize() {
        return [
            "request_id" => $this->request_id,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            "checkboxes_binaries" => $this->checkboxes_binaries,
            "content_share" => $this->content_share,
            "description" => $this->description
        ];
    }
}
