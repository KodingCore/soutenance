<?php

class InfoManager extends AbstractManager
{
    
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM infos");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $infosTab = [];
        foreach($results as $info)
        {
            $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["tel"]);
            $infoInstance->setInfoId($info["info_id"]);
        }
        return $infosTab;
    }

    public function insertInfo(Info $info)
    {
        $query = $this->db->prepare("INSERT INTO infos (user_id, first_name, last_name, tel) VALUES(:user_id, :first_name, :last_name, :tel)");
        $parameters = [
            "user_id" => $info->getUserId(),
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "tel" => $info->getTel()
        ];
        $query->execute($parameters);
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
            $infoInstance = new Info($info["user_id"], $info["first_name"], $info["last_name"], $info["tel"]);
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
        $query = $this->db->prepare("UPDATE infos SET first_name = :first_name, last_name = :last_name, tel = :tel WHERE user_id = :user_id");
        $parameters = [
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "tel" => $info->getTel(),
            "user_id" => $info->getUserId()
        ];
        $query->execute($parameters);
    }
}
?>