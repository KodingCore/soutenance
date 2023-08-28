<?php

class TemplateController extends AbstractController
{

    private TemplateManager $templateManager;
    private CategoryManager $categoryManager;


    public function __construct()
    {
        $this->templateManager = new TemplateManager();
        $this->categoryManager = new CategoryManager();

    }
   
    public function index()
    {
        $templates = $this->templateManager->getTemplates();
        $categories = $this->categoryManager->getCategories();

        $this->render("views/user/shop.phtml", ["templates" => $templates, "categories" => $categories]);
    }
    
}
