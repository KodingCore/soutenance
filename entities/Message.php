<?php

class Message {
    private ?int $message_id;
    private string $subject;
    private string $content;
    private int $user_id;
    private string $send_date;

    public function __construct(string $subject, string $content, int $user_id, string $send_date) {
        $this->message_id = null;
        $this->subject = $subject;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->send_date = $send_date;
    }

    public function getMessageId(): int { return $this->message_id; }
    public function getSubject(): string { return $this->subject; }
    public function getContent(): string { return $this->content; }
    public function getUserId(): int { return $this->user_id; }
    public function getSendDate(): string { return $this->send_date; }

    public function setMessageId(int $message_id): void { $this->message_id = $message_id; }
    public function setSubject(string $subject): void { $this->subject = $subject; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setSendDate(string $send_date): void { $this->send_date = $send_date; }
}