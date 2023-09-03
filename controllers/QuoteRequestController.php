<?php

class QuoteRequestController extends AbstractController
{
   private $templateManager;
   private $categoryManager;

   public function __construct()
   {
        $this->templateManager = new TemplateManager();
        $this->categoryManager = new CategoryManager();
   }

    public function index(int $template_id) : void
    {
        $template = $this->templateManager->getTemplateByTemplateId($template_id);
        $category = $this->categoryManager->getCategoryByCategoryId($template->getCategoryId());

        $this->render("views/user/quote-request.phtml", ["template" => $template, "category" => $category]);
    }
    
}
