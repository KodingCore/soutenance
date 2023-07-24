<?php

class ProjectManager extends AbstractManager
{
    
    public function index() : array
    {
        $query = $this->db->prepare("SELECT * FROM projects");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $projectsTab = [];
        foreach($results as $project)
        {
            $projectInstance = new Project($project["user_id"], $project["project_name"], $project["description"], $project["completion_date"], $project["technologies_used"], $project["request_quote"]);
            $projectInstance->setProjectId($project["id"]);
        }
        return $projectsTab;
    }
}
?>