<?php

class HomepageController extends AbstractController
{

    private $reviewManager;
    private $templateManager;
    private $userManager;
    private $makeRedirection;


    public function __construct()
    {
        $this->reviewManager = new ReviewManager();
        $this->templateManager = new TemplateManager();
        $this->userManager = new UserManager();
        $this->makeRedirection = false;
    }
   
    public function index()
    {
        
        
        $nbr_templates = 4;
        $nbr_reviews = 6;

        $templates = $this->templateManager->getTemplatesOrderedByDate();
        $templates = array_slice($templates, 0, $nbr_templates);

        $reviews = $this->reviewManager->getReviewsOrderedByNotation();
        $reviews = array_slice($reviews, 0, $nbr_reviews);

        $users = [];

        foreach($reviews as $review)
        {
            $user = $this->userManager->getUserByUserId($review->getUserId());
            array_push($users, $user);
        }
        if($this->makeRedirection)
        {
            header("Location: index.php?route=homepage&message=Avis enregistre avec succes&field=general");
            exit;
        }
        if(isset($_GET["message"], $_GET["field"]))
        {
            $message = $_GET["message"];
            $field = $_GET["field"];
            $this->render("views/homepage.phtml", ["message" => $message, "field" => $field, "users" => $users, "templates" => $templates, "reviews" => $reviews]);
        }
        else
        {
            $this->render("views/homepage.phtml", ["users" => $users, "templates" => $templates, "reviews" => $reviews]);
        }
        
    }
    
    public function sendReview()
    {
        if(isset($_POST["content"]))
        {
            $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
            $user_id = (int)$_SESSION["user_id"];
            $timezone = new DateTimeZone('Europe/Paris');
            $dateTime = new DateTime('now', $timezone);
            $sqlDateTime = $dateTime->format('Y-m-d');
            $notation = (int)$_POST["rating"];
            $review = new Review($user_id, $content, $sqlDateTime, $notation);
            $this->reviewManager->insertReview($review);
            $this->makeRedirection = true;
        }
        $this->index();
    }
}
