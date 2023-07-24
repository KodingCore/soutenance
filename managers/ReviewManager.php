<?php

class ReviewManager extends AbstractManager
{
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM reviews");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $reviewsTab = [];
        foreach($results as $review)
        {
            $reviewInstance = new Review($review["review_id"], $review["user_id"], $review["review_text"], $review["rating"], $review["date_created"]);
            $reviewInstance->setReviewId($review["id"]);
        }
        return $reviewsTab;
    }
    
    public function getReviewsByUserId(int $user_id) : array
    {
        $query = $this->db->prepare("SELECT * FROM reviews WHERE user_id = :user_id");
        $parameters = [
            "id" => $user_id
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $reviewsTab = [];
        foreach($results as $review)
        {
            $reviewInstance = new Info($review["user_id"], $review["review_text"], $review["rating"], $review["date_created"]);
            $reviewInstance->setInfoId($review["id"]);
            array_push($reviewsTab, $reviewInstance);
        }
        return $reviewsTab;
    }
}
?>