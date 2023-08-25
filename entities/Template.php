<?php

class Template implements JsonSerializable
{
    private ?int $template_id;
    private ?int $category_id;
    private string $name;
    private string $description;
    private string $image_path;
    private ?float $price;
    private string $created_at;
    private ?string $updated_at;
    
    public function __construct(?int $category_id, string $name, string $description, string $image_path, ?float $price, string $created_at, ?string $updated_at) {
        $this->template_id = null;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->description = $description;
        $this->image_path = $image_path;
        $this->price = $price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    
    // Getters
    public function getTemplateId(): ?int { return $this->template_id; }
    public function getCategoryId(): ?int { return $this->category_id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getImagePath(): string { return $this->image_path; }
    public function getPrice(): ?float { return $this->price; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getUpdatedAt(): ?string { return $this->updated_at; }
    
    // Setters
    public function setTemplateId(int $template_id): void { $this->template_id = $template_id; }
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setImagePath(string $image_path): void { $this->image_path = $image_path; }
    public function setPrice(float $price): void { $this->price = $price; }
    public function setCreatedAt(string $created_at): void { $this->created_at = $created_at; }
    public function setUpdatedAt(string $updated_at): void { $this->updated_at = $updated_at; }

    public function jsonSerialize() {
        return [
            "template_id" => $this->template_id,
            "category_id" => $this->category_id,
            "name" => $this->name,
            "description" => $this->description,
            "image_path" => $this->image_path,
            "price" => $this->price,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
