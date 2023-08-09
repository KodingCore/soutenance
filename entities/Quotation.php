<?php

class Quotation {
    private int $quotation_id;
    private int $user_id;
    private string $quotation_date;
    private string $content;
    private string $expiration_date;
    private int $template_id;
    
    public function __construct(int $quotation_id, int $user_id, string $quotation_date, string $content, string $expiration_date, int $template_id) {
        $this->quotation_id = $quotation_id;
        $this->user_id = $user_id;
        $this->quotation_date = $quotation_date;
        $this->content = $content;
        $this->expiration_date = $expiration_date;
        $this->template_id = $template_id;
    }
    
    // Getters
    public function getQuotationId(): int { return $this->quotation_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getQuotationDate(): string { return $this->quotation_date; }
    public function getContent(): string { return $this->content; }
    public function getExpirationDate(): string { return $this->expiration_date; }
    public function getTemplateId(): int { return $this->template_id; }
    
    // Setters
    public function setQuotationId(int $quotation_id): void { $this->quotation_id = $quotation_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setQuotationDate(string $quotation_date): void { $this->quotation_date = $quotation_date; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setExpirationDate(string $expiration_date): void { $this->expiration_date = $expiration_date; }
    public function setTemplateId(int $template_id): void { $this->template_id = $template_id; }
}