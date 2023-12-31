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
                $reviewInstance = new Review($review["user_id"], $review["content"], $review["send_date"], $review["notation"]);
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
    
    public function getReviewsOrderedByNotation() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM reviews ORDER BY notation DESC");
        $query->execute();
        $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
        if($reviews)
        {
            $reviewsTab = [];
            foreach($reviews as $review)
            {
                $reviewInstance = new Review($review["user_id"], $review["content"], $review["send_date"], $review["notation"]);
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

    public function getReviewByReviewId(int $review_id) : ? Review
    {
        $query = $this->db->prepare("SELECT * FROM reviews WHERE review_id = :review_id");
        $parameters = [
            "review_id" => $review_id
        ];
        $query->execute($parameters);
        $review = $query->fetch(PDO::FETCH_ASSOC);
        if($review)
        {
            $reviewInstance = new Review($review["user_id"], $review["content"], $review["send_date"], $review["notation"]);
            $reviewInstance->setReviewId($review["review_id"]);
            return $reviewInstance;
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
            $reviewInstance = new Review($review["user_id"], $review["content"], $review["send_date"], $review["notation"]);
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
        $query = $this->db->prepare("INSERT INTO reviews (user_id, content, send_date, notation) VALUES(:user_id, :content, :send_date, :notation)");
        $parameters = [
            "user_id" => $review->getUserId(),
            "content" => $review->getContent(),
            "send_date" => $review->getSendDate(),
            "notation" => $review->getNotation()
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

    public function deleteReviewByUserId(int $user_id)
    {
        $query = $this->db->prepare("DELETE FROM reviews WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
    }


    public function editReview(Review $review)
    {
        $query = $this->db->prepare("UPDATE reviews SET user_id = :user_id, content = :content, send_date = :send_date, notation = :notation WHERE review_id = :review_id");
        $parameters = [
            "user_id" => $review->getUserId(),
            "content" => $review->getContent(),
            "send_date" => $review->getSendDate(),
            "notation" => $review->getNotation()
        ];
        $query->execute($parameters);
    }
}