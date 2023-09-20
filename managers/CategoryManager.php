<?php

class CategoryManager extends AbstractManager
{
    
    public function getCategories() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
        if($categories)
        {
            $categoriesTab = [];
            foreach($categories as $category)
            {
                $categoryInstance = new Category($category["name"], $category["description"], $category["average_price"]);
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
        $query = $this->db->prepare("INSERT INTO categories (name, description, average_price) VALUES(:name, :description, :average_price)");
        $parameters = [
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "average_price" => $category->getAveragePrice()
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
        $query = $this->db->prepare("UPDATE categories SET name = :name, description = :description, average_price = :average_price WHERE category_id = :category_id");
        $parameters = [
            "name" => $category->getName(),
            "description" => $category->getDescription(),
            "average_price" => $category->getAveragePrice(),
            "category_id" => $category->getCategoryId()
        ];
        $query->execute($parameters);
    }

    public function getCategoryByCategoryId(int $category_id) : ? Category
    {
        $query = $this->db->prepare("SELECT * FROM categories WHERE category_id = :category_id");
        $parameters = [
            "category_id" => $category_id
        ];
        $query->execute($parameters);
        $category = $query->fetch(PDO::FETCH_ASSOC);
        if($category)
        {
            $categoryInstance = new Category($category["name"], $category["description"], $category["average_price"]);
            $categoryInstance->setCategoryId($category["category_id"]);
            return $categoryInstance;
        }
        else
        {
            return null;
        }
    }
}