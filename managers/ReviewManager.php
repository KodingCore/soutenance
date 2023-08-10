<?php

class ReviewManager extends AbstractManager
{
    
    public function getReviewsOrderedByDate() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM reviews ORDER BY send_date DESC");
        $query->execute();
        $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
        if($reviews)
        {
            $reviewsTab = [];
            foreach($reviews as $review)
            {
                $reviewInstance = new Review($review["content"], $review["user_id"], $review["send_date"], $review["template_id"]);
                $reviewInstance->setReviewId($review["review_id"]);
                array_push($reviewsTab, $reviewInstance);
            }
            return $reviewsTab;
        }
        else
        {
            return null;
        }
    }

    public function getReviewByUserId(int $user_id) : ? Review
    {
        $query = $this->db->prepare("SELECT * FROM reviews WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $review = $query->fetch(PDO::FETCH_ASSOC);
        if($review)
        {
            $reviewInstance = new Review($review["content"], $review["user_id"], $review["send_date"], $review["template_id"]);
            $reviewInstance->setReviewId($review["review_id"]);
            return $reviewInstance;
        }
        else
        {
            return null;
        }
    }

    public function insertReview(Review $review)
    {
        $query = $this->db->prepare("INSERT INTO reviews (content, user_id, send_date, template_id) VALUES(:content, :user_id, :send_date, :template_id)");
        $parameters = [
            "content" => $review->getContent(),
            "user_id" => $review->getUserId(),
            "send_date" => $review->getSendDate(),
            "template_id" => $review->getTemplateId()
        ];
        $query->execute($parameters);
    }

    public function deleteReviewByReviewId(int $review_id)
    {
        $query = $this->db->prepare("DELETE FROM reviews WHERE review_id = :review_id");
        $parameters = [
            "review_id" => $review_id
        ];
        $query->execute($parameters);
    }

    public function editReview(Review $review)
    {
        $query = $this->db->prepare("UPDATE reviews SET content = :content, user_id = :user_id, send_date = :send_date, template_id = :template_id WHERE review_id = :review_id");
        $parameters = [
            "content" => $review->getContent(),
            "user_id" => $review->getUserId(),
            "send_date" => $review->getSendDate(),
            "template_id" => $review->getTemplateId()
        ];
        $query->execute($parameters);
    }
}