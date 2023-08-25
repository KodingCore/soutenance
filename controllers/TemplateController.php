<?php

class TemplateController extends AbstractController
{
   
    public function index()
    {
        $this->render("views/user/shop.phtml", []);
    }
    
}
