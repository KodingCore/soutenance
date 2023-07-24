<?php

class Review
{

    private ?int $review_id;
    private int $user_id;
    private string $review_text;
    private int $rating;
    private DateTime $date_created;
   
    public function __construct(int $user_id, string $review_text, int $rating, DateTime $date_created)
    {
       $this->review_id = null;
       $this->user_id = $user_id;
       $this->review_text = $review_text;
       $this->rating = $rating;
       $this->date_created = $date_created;
    }

    public function getReviewId() : ?int{  return $this->review_id;  }
    public function setReviewId(int $review_id){   $this->review_id = $review_id;  }

    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getUsername() : string{  return $this->review_text;  }
    public function setUsername(string $review_text){   $this->review_text = $review_text;  }

    public function getEmail() : int{  return $this->rating;  }
    public function setEmail(int $rating){   $this->rating = $rating;  }

    public function getPasswordHash() : DateTime{  return $this->date_created;  }
    public function setPasswordHash(DateTime $date_created){   $this->date_created = $date_created;  }

}
?>