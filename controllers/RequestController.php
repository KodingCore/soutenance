<?php

class RequestController extends AbstractController
{
    private $requestManager;
    private $categoryManager;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
        $this->categoryManager = new CategoryManager();
    }

    public function index() : void
    {

        if (!empty($_POST["description"]))
        {
            
            
            //* Variable de récolte d'erreur
            $error = null;
            
            $user_id = $_SESSION["user_id"];
            
            $category_id = (int)$_POST["category"];
            
            //* Contre-mesure d'injection de code
            $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
            $content_share = htmlspecialchars($_POST["content-transmition"], ENT_QUOTES, 'UTF-8');
            
            
            //* Transformation des inputs checkbox en chaine binaire
            $checkboxes_binaries = "";
            $checkboxTab = ["cms", "suscribing", "reviews", "research", 
                            "social", "localisation", "products", "kart", "paylink", 
                            "auto-quotation", "notation", "talking-forum", "messaging", 
                            "reservation", "calendar", "video-integration", "media-reviews", 
                            "admin-dashboard", "notification", "language", "responsive-design"];
            foreach($checkboxTab as $checkbox)
            {
                if(isset($_POST[$checkbox]))
                {
                    $checkboxes_binaries = $checkboxes_binaries."1";
                }
                else
                {
                    $checkboxes_binaries = $checkboxes_binaries."0";
                }
            }
            
            //* Validation regex
            if(!preg_match('/^[a-zA-Z0-9.,!&?;:()<>\'"\s]{10,2048}$/', $description))
            {
                $error = ["message" => "La description doit faire entre 10 et 2048 caractères", "field" => "description"];
            }
            else if(!preg_match('/^[A-ZÀ-ÿa-z-\s]{2,50}$/', $content_share))
            {
                $error = ["message" => "Cette option n'est pas dans la liste", "field" => "content-share"];
            }
            
            if(!$error)
            {
                $request = new Request($user_id, $category_id, $checkboxes_binaries, $content_share, $description);
                $this->requestManager->insertRequest($request);
                $this->render("views/user/request.phtml",["categories" => $this->categoryManager->getCategories(), "message" => "Demande envoyée avec succès!", "field" => "general"]);
            }
        }
        else
        {
            $this->render("views/user/request.phtml",["categories" => $this->categoryManager->getCategories()]);
        }
    }
}
