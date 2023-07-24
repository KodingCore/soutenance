<?php

class Cotation
{

    private ?int $cotation_id;
    private int $user_id;
    private string $description;
    private int $amount;
    private DateTime $date_created;
   
    public function __construct(int $user_id, string $description, int $amount, DateTime $date_created)
    {
       $this->cotation_id = null;
       $this->user_id = $user_id;
       $this->description = $description;
       $this->amount = $amount;
       $this->date_created = $date_created;
    }
    
    public function getCotationId() : ?int{  return $this->cotation_id;  }
    public function setCotationId(int $cotation_id){   $this->cotation_id = $cotation_id;  }

    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getDescription() : string{  return $this->description;  }
    public function setDescription(string $description){   $this->description = $description;  }

    public function getAmount() : int{  return $this->amount;  }
    public function setAmount(int $amount){   $this->amount = $amount;  }

    public function getDateCreated() : DateTime{  return $this->date_created;  }
    public function setDateCreated(DateTime $date_created){   $this->date_created = $date_created;  }

}
?>