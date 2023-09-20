<?php

class QuoteRequestController extends AbstractController
{
    private $categoryManager;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
    }

    public function index() : void
    {
        $this->render("views/user/quote-request.phtml",["categories" => $this->categoryManager->getCategories()]);
    }
    
}
