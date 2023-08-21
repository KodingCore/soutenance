<?php

class HomepageController extends AbstractController
{
   
    public function index()
    {
        $this->render("views/homepage.phtml", []);
    }
    
}
