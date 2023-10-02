<?php

class HomepageController extends AbstractController
{

    private $reviewManager;
    private $templateManager;
    private $userManager;


    public function __construct()
    {
        $this->reviewManager = new ReviewManager();
        $this->templateManager = new TemplateManager();
        $this->userManager = new UserManager();
    }
   
    public function index()
    {
        $nbr_templates = 3;
        $nbr_reviews = 9;

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


        $this->render("views/homepage.phtml", ["users" => $users, "templates" => $templates, "reviews" => $reviews]);
    }
    
    public function sendReview()
    {
        if(!empty($_POST["content"]))
        {
            $user_id = (int)$_SESSION["user_id"];
            $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
            $timezone = new DateTimeZone('Europe/Paris');
            $dateTime = new DateTime('now', $timezone);
            $sqlDateTime = $dateTime->format('Y-m-d');
            $notation = (int)5;
            $review = new Review($user_id, $content, $sqlDateTime, $notation);
            $this->reviewManager->insertReview($review);
        }
        $this->index();
    }
    
    
}
