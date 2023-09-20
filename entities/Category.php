<?php

class Category implements JsonSerializable
{
    private ?int $category_id;
    private string $name;
    private string $description;
    private string $average_price;
    
    public function __construct(string $name, string $description, string $average_price) {
        $this->category_id = null;
        $this->name = $name;
        $this->description = $description;
        $this->average_price = $average_price;
    }
    
    // Getters
    public function getCategoryId(): ? int { return $this->category_id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getAveragePrice(): string { return $this->average_price; }
    
    // Setters
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setAveragePrice(string $average_price): void { $this->average_price = $average_price; }

    public function jsonSerialize() {
        return [
            "category_id" => $this->category_id,
            "name" => $this->name,
            "description" => $this->description,
            "average_price" => $this->average_price
        ];
    }
}
