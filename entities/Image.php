<?php

class Image {
    private int $image_id;
    private int $template_id;
    private string $image_path;
    
    public function __construct(int $image_id, int $template_id, string $image_path) {
        $this->image_id = $image_id;
        $this->template_id = $template_id;
        $this->image_path = $image_path;
    }
    
    // Getters
    public function getImageId(): int { return $this->image_id; }
    public function getTemplateId(): int { return $this->template_id; }
    public function getImagePath(): string { return $this->image_path; }
    
    // Setters
    public function setImageId(int $image_id): void { $this->image_id = $image_id; }
    public function setTemplateId(int $template_id): void { $this->template_id = $template_id; }
    public function setImagePath(string $image_path): void { $this->image_path = $image_path; }
}
