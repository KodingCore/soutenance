<?php

class DashboardController extends AbstractController
{

    private $templateManager;
    private $categoryManager;

    public function __construct()
    {
        $this->templateManager = new TemplateManager();
        $this->categoryManager = new CategoryManager();
    }

    public function index()
    {
        $this->render("views/admin/dashboard.phtml", []);
    }

    public function addTemplate()
    {
        if(!empty($_POST["name"]) && !empty($_POST["description"]) && !empty($_POST["image_path"]) && !empty($_POST["price"]))
        {
            //* Contre-mesures d'injection de code
            $name = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $image_path = htmlspecialchars($_POST["image_path"]);
            $price = htmlspecialchars($_POST["price"]);

            //* Mise en forme de la date actuelle
            $timezone = new DateTimeZone('Europe/Paris');
            $dateTime = new DateTime('now', $timezone);
            $sqlDateTime = $dateTime->format('Y-m-d H:i:s');

            //* Mise en forme du prix en float
            $price = (float) $price;

            $template = new Template($name, $description, $image_path, $price, $sqlDateTime);
            $this->templateManager->insertTemplate($template);
        }
        $this->render("views/admin/dashboard.phtml", []);
    }

    public function addCategory()
    {
        if(!empty($_POST["name"]) && !empty($_POST["description"]))
        {
            //* Contre-mesures d'injection de code
            $name = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);

            $category = new Category($name, $description);
            $this->categoryManager->insertCategory($category);
        }
        $this->render("views/admin/dashboard.phtml", []);
    }
}