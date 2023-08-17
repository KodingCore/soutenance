<?php

class Category implements JsonSerializable
{
    private ?int $category_id;
    private string $name;
    private string $description;
    
    public function __construct(string $name, string $description) {
        $this->category_id = null;
        $this->name = $name;
        $this->description = $description;
    }
    
    // Getters
    public function getCategoryId(): ? int { return $this->category_id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    
    // Setters
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }

    public function jsonSerialize() {
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
