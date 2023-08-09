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
        $query = $this->db->prepare("INSERT INTO infos (user_id, first_name, last_name, tel) VALUES(:user_id, :fkrst_name, :last_name, :tel)");
        $parameters = [
            "user_id" => $info->getUserID(),
            "first_name" => $info->getFirstName(),
            "last_name" => $info->getLastName(),
            "tel" => $info->getTel()
        ];
        $query->execute($parameters);
    }
}
?>