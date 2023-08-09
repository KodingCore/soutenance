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
            $userInstance = new Info($user["username"], $user["email"], $user["password"], $user["role"]);
            $userInstance->setUserId($user["user_id"]);
            return $userInstance;
        }
        else
        {
            return null;
        }
    }
}
?>