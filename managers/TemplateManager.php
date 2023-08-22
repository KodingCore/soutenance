<?php

class TemplateManager extends AbstractManager
{
    
    public function getTemplates() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM templates ORDER BY created_at DESC");
        $query->execute();
        $templates = $query->fetchAll(PDO::FETCH_ASSOC);
        if($templates)
        {
            $templatesTab = [];
            foreach($templates as $template)
            {
                $templateInstance = new Template($template["name"], $template["description"], $template["image_path"], $template["price"], $template["created_at"]);
                $templateInstance->setTemplateId($template["template_id"]);
                $templateInstance->setCategoryId($template["category_id"]);
                $templateInstance->setUpdatedAt($template["updated_at"]);
                array_push($templatesTab, $templateInstance);
            }
            return $templatesTab;
        }
        else
        {
            return null;
        }
    }

    public function getTemplateByTemplateId(int $template_id) : ? Template
    {
        $query = $this->db->prepare("SELECT * FROM templates WHERE template_id = :template_id");
        $parameters = [
            "template_id" => $template_id
        ];
        $query->execute($parameters);
        $template = $query->fetch(PDO::FETCH_ASSOC);
        if($template)
        {
            $templateInstance = new Template($template["name"], $template["description"], $template["image_path"], $template["price"], $template["created_at"]);
            $templateInstance->setTemplateId($template["template_id"]);
            $templateInstance->setCategoryId($template["category_id"]);
            $templateInstance->setUpdatedAt($template["updated_at"]);
            return $templateInstance;
        }
        else
        {
            return null;
        }
    }

    public function setCategoryIdToNullByCategoryId($category_id) : void
    {
        $query = $this->db->prepare("UPDATE templates SET category_id = null WHERE category_id = :category_id");
        $parameters = [
            "category_id" => $category_id
        ];
        $query->execute($parameters);
    }

    public function insertTemplate(Template $template) : void
    {
        $query = $this->db->prepare("INSERT INTO templates (name, description, image_path, price, created_at) VALUES(:name, :description, :image_path, :price, :created_at)");
        $parameters = [
            "name" => $template->getName(),
            "description" => $template->getDescription(),
            "image_path" => $template->getImagePath(),
            "price" => $template->getPrice(),
            "created_at" => $template->getCreatedAt()
        ];
        $query->execute($parameters);
    }

    public function deleteTemplateByTemplateId(int $template_id) : void
    {
        $query = $this->db->prepare("DELETE FROM templates WHERE template_id = :template_id");
        $parameters = [
            "template_id" => $template_id
        ];
        $query->execute($parameters);
    }

    public function editTemplate(Template $template)
    {
        $query = $this->db->prepare("UPDATE templates SET category_id = :category_id, name = :name, description = :description, image_path = :image_path, price = :price, created_at = :created_at WHERE template_id = :template_id");
        $parameters = [
            "category_id" => $template->getCategoryId(),
            "name" => $template->getName(),
            "description" => $template->getDescription(),
            "image_path" => $template->getImagePath(),
            "price" => $template->getPrice(),
            "created_at" => $template->getCreatedAt(),
            "template_id" => $template->getTemplateId()
        ];
        $query->execute($parameters);
    }
}