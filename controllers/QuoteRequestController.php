<?php

class QuoteRequestController extends AbstractController
{
   
    public function index()
    {
        $this->render("views/user/quote-request.phtml", []);
    }
    
}
