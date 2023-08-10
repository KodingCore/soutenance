<?php

class Review {
    private ?int $review_id;
    private string $content;
    private int $user_id;
    private string $send_date;

    public function __construct(string $content, int $user_id, string $send_date) {
        $this->review_id = null;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->send_date = $send_date;
    }

    public function getReviewId(): int { return $this->review_id; }
    public function getContent(): string { return $this->content; }
    public function getUserId(): int { return $this->user_id; }
    public function getSendDate(): string { return $this->send_date; }

    public function setReviewId(int $review_id): void { $this->review_id = $review_id; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setSendDate(string $send_date): void { $this->send_date = $send_date; }
}