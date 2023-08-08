<?php

class HomepageController extends AbstractController
{
   
    // private $manager;

    // public function __construct()
    // {
       
    // }

    public function index()
    {
        $this->render("views/homepage.phtml", []);
    }
    
}
