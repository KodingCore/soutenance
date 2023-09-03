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

        $reviews = $this->reviewManager->getReviewsOrderedByDate();
        $reviews = array_slice($reviews, 0, $nbr_reviews);

        $users_reviews = [];

        foreach($reviews as $review)
        {
            $user = $this->userManager->getUserByUserId($review->getUserId());
            array_push($users_reviews, $user);
        }


        $this->render("views/homepage.phtml", ["users_reviews" => $users_reviews, "templates" => $templates, "reviews" => $reviews]);
    }
    
}
