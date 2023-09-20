<?php

class ShopController extends AbstractController
{

    private TemplateManager $templateManager;

    public function __construct()
    {
        $this->templateManager = new TemplateManager();
    }
   
    public function index()
    {
        $templates = $this->templateManager->getTemplatesOrderedByDate();

        $this->render("views/user/shop.phtml", ["templates" => $templates]);
    }
    
}
