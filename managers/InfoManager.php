<?php

class InfoManager extends AbstractManager
{
    
    public function index() : array
    {
       return [];
    }

    public function getInfoByUserId(int $user_id) : Info
    {
        $query = $this->db->prepare("SELECT * FROM infos WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $info = $query->fetch(PDO::FETCH_ASSOC);
        if($info)
        {
            $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["phone_number"], $info["address"], $info["town"], $info["zip"], $info["country"]);
            $infoInstance->setInfoId($info["id"]);
            return $infoInstance;
        }
        else
        {
            $infoInstance = new Info($_SESSION["user_id"]);
            return $infoInstance;
        }
        
    }


    public function insertInfo(Info $info)
    {
        $query = $this->db->prepare("INSERT INTO infos(user_id, first_name, last_name, phone_number, address, town, zip, country)
                                    VALUES(:user_id, :first_name, :last_name, :phone_number, :address, :town, :zip, :country)");
        $parameters = [
            "user_id" => $_SESSION["user_id"],
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "phone_number" => $info->getPhoneNumber(),
            "address" => $info->getAddress(),
            "town" => $info->getTown(),
            "zip" => $info->getZip(),
            "country" => $info->getCountry()
        ];
        $query->execute($parameters);
    }

    public function editInfo(Info $info)
    {
        $query = $this->db->prepare("UPDATE infos SET first_name = :first_name, last_name = :last_name, phone_number = :phone_number, address = :address, town = :town, zip = :zip, country = :country WHERE user_id = :user_id");
        $parameters = [
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "phone_number" => $info->getPhoneNumber(),
            "address" => $info->getAddress(),
            "town" => $info->getTown(),
            "zip" => $info->getZip(),
            "country" => $info->getCountry(),
            "user_id" => $_SESSION["user_id"]
        ];
        $query->execute($parameters);
    }
    
}
?>