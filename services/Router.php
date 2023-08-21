<?php

class Router
{
    private HomepageController $homepageController;
    private UserController $userController;
    private ContactController $contactController;
    private DashboardController $dashboardController;
    private APIFetchController $APIFetchController;
    private NotFound $notFound;

    public function __construct()
    {
        $this->homepageController = new HomepageController();
        $this->userController = new UserController();
        $this->contactController = new ContactController();
        $this->dashboardController = new DashboardController();
        $this->APIFetchController = new APIFetchController();
        $this->notFound = new NotFound();

    }

    public function checkRoute($route) : void
    {
        if($route === "homepage")
        {
            $this->homepageController->index();
        }
        else if($route === "login")
        {
            $this->userController->login();
        }
        else if($route === "register")
        {
            $this->userController->register();
        }
        else if($route === "account")
        {
            $this->userController->account();
        }
        else if($route === "contact")
        {
            $this->contactController->sendMessage();
        }
        else if($route === "disconnect")
        {
            unset($_SESSION["user_id"]);
            unset($_SESSION["role"]);
            session_destroy();
            $this->homepageController->index();
        }
        else if($route === "shop")
        {

        }
        else if($route === "quote")
        {

        }
        else if(isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if($route === "dashboard")
            {
                $this->dashboardController->index();
            }
            else if($route === "user-link")
            {
                $this->APIFetchController->getAllUsers();
            }
            else if($route === "message-link")
            {
                $this->APIFetchController->getAllMessages();
            }
            else if($route === "template-link")
            {
                $this->APIFetchController->getAllTemplates();
            }
            else if($route === "category-link")
            {
                $this->APIFetchController->getAllCategories();
            }
            else if($route === "review-link")
            {
                $this->APIFetchController->getAllReviews();
            }
            else if($route === "appointment-link")
            {
                $this->APIFetchController->getAllAppointments();
            }
            else if($route === "quotation-link")
            {
                $this->APIFetchController->getAllQuotations();
            }
            else if($route === "tag-link")
            {
                $this->APIFetchController->getAlltags();
            }
            else if($route === "add-category")
            {
                $this->APIFetchController->getAllReviews();
            }
            else if($route === "add-template")
            {
                $this->APIFetchController->getAllReviews();
            }
            else if($route === "add-quotation")
            {
                $this->APIFetchController->getAllReviews();
            }
            else if($route === "add-appointment")
            {
                $this->APIFetchController->getAllReviews();
            }
        }
        else
        {
            $this->notFound->index();
        }
    }
}