<?php

class Quotation implements JsonSerializable
{
    private ?int $quotation_id;
    private int $user_id;
    private int $category_id;
    private string $quotation_date;
    private string $content;
    private string $expiration_date;
    private int $price;
    
    public function __construct(int $user_id, int $category_id, string $quotation_date, string $content, string $expiration_date, int $price) {
        $this->quotation_id = null;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
        $this->quotation_date = $quotation_date;
        $this->content = $content;
        $this->expiration_date = $expiration_date;
        $this->price = $price;
    }
    
    // Getters
    public function getQuotationId(): int { return $this->quotation_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getCategoryId(): int { return $this->category_id; }
    public function getQuotationDate(): string { return $this->quotation_date; }
    public function getContent(): string { return $this->content; }
    public function getExpirationDate(): string { return $this->expiration_date; }
    public function getPrice(): int { return $this->price; }
    
    // Setters
    public function setQuotationId(int $quotation_id): void { $this->quotation_id = $quotation_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setCategoryId(int $category_id): void { $this->category_id = $category_id; }
    public function setQuotationDate(string $quotation_date): void { $this->quotation_date = $quotation_date; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setExpirationDate(string $expiration_date): void { $this->expiration_date = $expiration_date; }
    public function setPrice(): int { return $this->price; }

    public function jsonSerialize() {
        return [
            "quotation_id" => $this->quotation_id,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            "quotation_date" => $this->quotation_date,
            "content" => $this->content,
            "expiration_date" => $this->expiration_date,
            "price" => $this->price
        ];
    }
}
