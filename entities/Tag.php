<?php

class Tag {
    private int $tag_id;
    private int $template_id;
    private string $tag_name;
    
    public function __construct(int $tag_id, int $template_id, string $tag_name) {
        $this->tag_id = $tag_id;
        $this->template_id = $template_id;
        $this->tag_name = $tag_name;
    }
    
    // Getters
    public function getTagId(): int { return $this->tag_id; }
    public function getTemplateId(): int { return $this->template_id; }
    public function getTagName(): string { return $this->tag_name; }
    
    // Setters
    public function setTagId(int $tag_id): void { $this->tag_id = $tag_id; }
    public function setTemplateId(int $template_id): void { $this->template_id = $template_id; }
    public function setTagName(string $tag_name): void { $this->tag_name = $tag_name; }
}
