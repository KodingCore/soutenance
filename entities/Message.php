<?php

class Message implements JsonSerializable
{
    private ?int $message_id;
    private int $user_id;
    private string $subject;
    private string $content;
    private string $send_date_time;

    public function __construct(int $user_id, string $subject, string $content, string $send_date_time) {
        $this->message_id = null;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->content = $content;
        $this->send_date_time = $send_date_time;
    }

    public function getMessageId(): int { return $this->message_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getSubject(): string { return $this->subject; }
    public function getContent(): string { return $this->content; }
    public function getSendDateTime(): string { return $this->send_date_time; }

    public function setMessageId(int $message_id): void { $this->message_id = $message_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setSubject(string $subject): void { $this->subject = $subject; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setSendDateTime(string $send_date_time): void { $this->send_date_time = $send_date_time; }

    public function jsonSerialize() {
        return [
            "ID du message" => $this->message_id,
            "ID de l'utilisateur" => $this->user_id,
            "Sujet" => $this->subject,
            "Contenu" => $this->content,
            "Date et heure d'envoi" => $this->send_date_time
        ];
    }
}