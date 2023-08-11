<?php

class CategoryManager extends AbstractManager
{
    
    public function getCategories() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM categories ORDER BY created_at DESC");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        if($categories)
        {
            $categoriesTab = [];
            foreach($categories as $category)
            {
                $categoryInstance = new Category($category["name"], $category["description"]);
                $categoryInstance->setCategoryId($category["category_id"]);
                array_push($categoriesTab, $categoryInstance);
            }
            return $categoriesTab;
        }
        else
        {
            return null;
        }
    }

    public function insertCategory(Category $category)
    {
        $query = $this->db->prepare("INSERT INTO categories (name, description) VALUES(:name, :description)");
        $parameters = [
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "category_id" => $category->getCategoryId()
        ];
        $query->execute($parameters);
    }

    public function deleteCategoryByCategoryId(int $category_id)
    {
        $query = $this->db->prepare("DELETE FROM categories WHERE category_id = :category_id");
        $parameters = [
            "category_id" => $category_id
        ];
        $query->execute($parameters);
    }

    public function editCategory(Category $category)
    {
        $query = $this->db->prepare("UPDATE categories SET name = :name, description = :description, category_id = :category_id, image_path = :image_path, price = :price, created_at = :created_at WHERE category_id = :category_id");
        $parameters = [
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "category_id" => $category->getCategoryId(),
            "image_path" => $category->getImagePath(),
            "created_at" => $category->getCreatedAt(),
            "category_id" => $category->getCategoryId()
        ];
        $query->execute($parameters);
    }
}