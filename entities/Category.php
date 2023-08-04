<?php

class Category {
    private int $category_id;
    private string $name;
    private string $description;
    
    public function __construct(int $category_id, string $name, string $description) {
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
    }
    
    // Getters
    public function getCategoryId(): int { return $this->category_id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    
    // Setters
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }
}
