<?php

class InfoManager extends AbstractManager
{
    
    
    public function getInfos() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM infos");
        $query->execute();
        $infos = $query->fetchAll(PDO::FETCH_ASSOC);
        if($infos)
        {
            $infosTab = [];
            foreach($infos as $info)
            {
                $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["tel"], $info["address"], $info["zip"], $info["city"]);
                $infoInstance->setInfoId($info["info_id"]);
                array_push($infosTab, $infoInstance);
            }
            return $infosTab;
        }
        else
        {
            return null;
        }
    }

    public function insertInfo(Info $info)
    {
        $query = $this->db->prepare("INSERT INTO infos (user_id, first_name, last_name, tel, address, zip, city) VALUES(:user_id, :first_name, :last_name, :tel, :address, :zip, :city)");
        $parameters = [
            "user_id" => $info->getUserId(),
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "tel" => $info->getTel(),
            "address" => $info->getAddress(),
            "zip" => $info->getZip(),
            "city" => $info->getCity()
        ];
        $query->execute($parameters);
    }

    public function getInfoByInfoId(int $info_id) : ? Info
    {
        $query = $this->db->prepare("SELECT * FROM infos WHERE info_id = :info_id");
        $parameters = [
            "info_id" => $info_id
        ];
        $query->execute($parameters);
        $info = $query->fetch(PDO::FETCH_ASSOC);
        if($info)
        {
            $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["tel"], $info["address"], $info["zip"], $info["city"]);
            $infoInstance->setInfoId($info["info_id"]);
            return $infoInstance;
        }
        else
        {
            return null;
        }
    }

    public function getInfoByUserId(int $user_id) : ? Info
    {
        $query = $this->db->prepare("SELECT * FROM infos WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $info = $query->fetch(PDO::FETCH_ASSOC);
        if($info)
        {
            $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["tel"], $info["address"], $info["zip"], $info["city"]);
            $infoInstance->setInfoId($info["info_id"]);
            return $infoInstance;
        }
        else
        {
            return null;
        }
    }

    public function editInfo(Info $info)
    {
        $query = $this->db->prepare("UPDATE infos SET first_name = :first_name, last_name = :last_name, tel = :tel, address = :address, zip = :zip, city = :city WHERE user_id = :user_id");
        $parameters = [
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "tel" => $info->getTel(),
            "address" => $info->getAddress(),
            "zip" => $info->getZip(),
            "city" => $info->getCity(),
            "user_id" => $info->getUserId()
        ];
        $query->execute($parameters);
    }

    public function deleteInfoByInfoId(int $info_id)
    {
        $query = $this->db->prepare("DELETE FROM infos WHERE info_id = :info_id");
        $parameters = [
            "info_id" => $info_id
        ];
        $query->execute($parameters);
    }

    public function deleteInfoByUserId(int $user_id)
    {
        $query = $this->db->prepare("DELETE FROM infos WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
    }
}
?>