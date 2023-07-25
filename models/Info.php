<?php

class Info
{

    private ?int $info_id;
    private int $user_id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $phone_number;
    private ?string $address;
    private ?string $town;
    private ?string $zip;
    private ?string $country;
   
    public function __construct(int $user_id, string $first_name = null, string $last_name = null, string $phone_number = null, string $address = null, string $town = null, string $zip = null, string $country = null)
    {
       $this->info_id = null;
       $this->user_id = $user_id;
       $this->first_name = $first_name;
       $this->last_name = $last_name;
       $this->phone_number = $phone_number;
       $this->address = $address;
       $this->town = $town;
       $this->zip = $zip;
       $this->country = $country;
    }

    public function getInfoId() : ?int{  return $this->info_id;  }
    public function setInfoId(int $info_id){   $this->info_id = $info_id;  }
    
    public function getUserId() : int{  return $this->user_id;  }
    public function setUserId(int $user_id){   $this->user_id = $user_id;  }

    public function getFirstName() : ?string{  return $this->first_name;  }
    public function setFirstName(string $first_name){   $this->first_name = $first_name;  }

    public function getLastName() : ?string{  return $this->last_name;  }
    public function setLastName(string $last_name){   $this->last_name = $last_name;  }

    public function getPhoneNumber() : ?string{  return $this->phone_number;  }
    public function setPhoneNumber(string $phone_number){   $this->phone_number = $phone_number;  }

    public function getAddress() : ?string{  return $this->address;  }
    public function setAddress(string $address){   $this->address = $address;  }

    public function getTown() : ?string{  return $this->town;  }
    public function setTown(string $town){   $this->town = $town;  }

    public function getZip() : ?string{  return $this->zip;  }
    public function setZip(string $zip){   $this->zip = $zip;  }

    public function getCountry() : ?string{  return $this->country;  }
    public function setCountry(string $country){   $this->country = $country;  }

}
?>