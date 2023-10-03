<?php

class RequestController extends AbstractController
{
    private $requestManager;
    private $categoryManager;
    private $makeRedirection;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
        $this->categoryManager = new CategoryManager();
        $this->makeRedirection = false;
    }


    public function index()
    {
        if($this->makeRedirection)
        {
            header("Location: index.php?route=homepage&message=Demande envoyée avec succes&field=general");
            exit;
        }
        else if(isset($_GET["message"], $_GET["field"]))
        {
            $message = $_GET["message"];
            $field = $_GET["field"];
            $this->render("views/user/request.phtml",["message" => $message, "field" => $field, "categories" => $this->categoryManager->getCategories()]);
            
        }
        else
        {
            $this->render("views/user/request.phtml",["categories" => $this->categoryManager->getCategories()]);
        }
        
    }
    
    public function addRequest(?string $description) : void
    {
        echo $description;
        if($description !== "")
        {
                
            
            //* Variable de récolte d'erreur
            $error = null;
            
            $user_id = $_SESSION["user_id"];
            
            $category_id = (int)$_POST["category"];
            
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
                $timezone = new DateTimeZone('Europe/Paris');
                $dateTime = new DateTime('now', $timezone);
                $sqlDate = $dateTime->format('Y-m-d');
                $request = new Request($user_id, $category_id, $checkboxes_binaries, $content_share, $description, $sqlDate);
                $this->requestManager->insertRequest($request);
                $this->makeRedirection = true;
            }
        }
        $this->index();
    }
}
