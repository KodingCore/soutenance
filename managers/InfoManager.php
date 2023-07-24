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
            "id" => $user_id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $info = $result;
        $infoInstance = new Info($info["user_id"], $info["full_name"], $info["phone_number"], $info["address"]);
        $infoInstance->setInfoId($info["id"]);
        return $infoInstance;
    }
    
}
?>