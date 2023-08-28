<?php

class TemplateController extends AbstractController
{

    private TemplateManager $templateManager;

    public function __construct()
    {
        $this->templateManager = new TemplateManager();
    }
   
    public function index()
    {
        $templates = $this->templateManager->getTemplates();

        $this->render("views/user/shop.phtml", ["templates" => $templates]);
    }
    
}
