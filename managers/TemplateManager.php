<?php

class TemplateManager extends AbstractManager
{
    
    public function getTemplatesOrderedByCreationDate() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM templates ORDER BY created_at DESC");
        $query->execute();
        $templates = $query->fetchAll(PDO::FETCH_ASSOC);
        if($templates)
        {
            $templatesTab = [];
            foreach($templates as $template)
            {
                $templateInstance = new Template($template["name"], $template["description"], $template["category_id"], $template["image_path"], $template["price"], $template["created_at"], $template["updated_at"]);
                $templateInstance->setTemplateId($template["template_id"]);
                array_push($templatesTab, $templateInstance);
            }
            return $templatesTab;
        }
        else
        {
            return null;
        }
    }

    public function insertTemplate(Template $template)
    {
        $query = $this->db->prepare("INSERT INTO templates (name, description, category_id, image_path, price, created_at) VALUES(:name, :description, :category_id, :image_path, :price, :created_at)");
        $parameters = [
            "name" => $template->getName(),
            "description" => $template->getDescription(),
            "category_id" => $template->getCategoryId(),
            "image_path" => $template->getImagePath(),
            "created_at" => $template->getCreatedAt()
        ];
        $query->execute($parameters);
    }

    public function deleteTemplateByTemplateId(int $template_id)
    {
        $query = $this->db->prepare("DELETE FROM templates WHERE template_id = :template_id");
        $parameters = [
            "template_id" => $template_id
        ];
        $query->execute($parameters);
    }

    public function editTemplate(Template $template)
    {
        $query = $this->db->prepare("UPDATE templates SET name = :name, description = :description, category_id = :category_id, image_path = :image_path, price = :price, created_at = :created_at WHERE template_id = :template_id");
        $parameters = [
            "name" => $template->getName(),
            "description" => $template->getDescription(),
            "category_id" => $template->getCategoryId(),
            "image_path" => $template->getImagePath(),
            "created_at" => $template->getCreatedAt(),
            "template_id" => $template->getTemplateId()
        ];
        $query->execute($parameters);
    }
}