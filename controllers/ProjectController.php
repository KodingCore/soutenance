<?php

class ProjectController extends AbstractController
{
   
    private ProjectManager $projectManager;

    public function __construct()
    {
       $this->projectManager = new ProjectManager();
    }
    
    public function index()//S : array
    {
//ISSUE $tabProjects = $this->projectManager->getAllProjects();
        //return $tabProjects;
    }
}
?>



?>