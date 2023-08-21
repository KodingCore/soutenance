<?php

class NotFound extends AbstractController
{

    public function index()
    {
        $this->render("views/NotFound.phtml", []);
    }
    
}
