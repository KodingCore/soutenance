<?php

class Info
{

    private ?int $info_id;
    private int $user_id;
    private string $full_name;
    private string $phone_number;
    private string $adress;
   
    public function __construct(int $user_id, string $full_name, string $phone_number, string $adress)
    {
       $this->info_id = null;
       $this->user_id = $user_id;
       $this->full_name = $full_name;
       $this->phone_number = $phone_number;
       $this->adress = $adress;
    }

    public function getInfoId() : ?int{  return $this->info_id;  }
    public function setInfoId(int $info_id){   $this->info_id = $info_id;  }
    
    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getFullName() : string{  return $this->full_name;  }
    public function setFullName(string $full_name){   $this->full_name = $full_name;  }

    public function getPhoneNumber() : string{  return $this->phone_number;  }
    public function setPhoneNumber(string $phone_number){   $this->phone_number = $phone_number;  }

    public function getAdress() : string{  return $this->adress;  }
    public function setAdress(string $adress){   $this->adress = $adress;  }

}
?>