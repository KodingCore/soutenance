<?php

class Review implements JsonSerializable
{
    private ?int $review_id;
    private int $user_id;
    private string $content;
    private string $send_date;
    private int $notation;
    

    public function __construct(int $user_id, string $content, string $send_date, int $notation) {
        $this->review_id = null;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->send_date = $send_date;
        $this->notation = $notation;
    }

    public function getReviewId(): int { return $this->review_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getContent(): string { return $this->content; }
    public function getSendDate(): string { return $this->send_date; }
    public function getNotation(): int { return $this->notation; }

    public function setReviewId(int $review_id): void { $this->review_id = $review_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setSendDate(string $send_date): void { $this->send_date = $send_date; }
    public function setNotation(int $notation): void { $this->notation = $notation; }

    public function jsonSerialize() {
        return [
            "review_id" => $this->review_id,
            "user_id" => $this->user_id,
            "content" => $this->content,
            "send_date" => $this->send_date,
            "notation" => $this->notation
        ];
    }
    
}