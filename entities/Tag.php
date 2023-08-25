<?php

class Tag implements JsonSerializable
{
    private ?int $tag_id;
    private int $user_id;
    private int $template_id;
    private string $tag_name;
    
    public function __construct(int $user_id, int $template_id, string $tag_name) {
        $this->tag_id = null;
        $this->user_id = $user_id;
        $this->template_id = $template_id;
        $this->tag_name = $tag_name;
    }
    
    // Getters
    public function getTagId(): int { return $this->tag_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getTemplateId(): int { return $this->template_id; }
    public function getTagName(): string { return $this->tag_name; }
    
    // Setters
    public function setTagId(int $tag_id): void { $this->tag_id = $tag_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setTemplateId(int $template_id): void { $this->template_id = $template_id; }
    public function setTagName(string $tag_name): void { $this->tag_name = $tag_name; }

    public function jsonSerialize() {
        return [
            "tag_id" => $this->tag_id,
            "user_id" => $this->user_id,
            "template_id" => $this->template_id,
            "tag_name" => $this->tag_name
        ];
    }
}
