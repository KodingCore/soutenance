<?php

class NotFoundController extends AbstractController
{

    public function index()
    {
        $this->render("views/page404.phtml", []);
    }
    
}
