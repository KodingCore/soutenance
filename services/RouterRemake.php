<?php

class Router
{
    private HomepageController $homepageController;
    private UserController $userController;
    private ContactController $contactController;
    private DashboardController $dashboardController;
    private APIFetchController $APIFetchController;

    public function __construct()
    {
        $this->homepageController = new HomepageController();
        $this->userController = new UserController();
        $this->contactController = new ContactController();
        $this->dashboardController = new DashboardController();
        $this->APIFetchController = new APIFetchController();
    }

    public function checkRoute($route) : void
    {
        if($route === "login")
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
            if($route === "dashboardRemake")
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
        }
        else
        {
            $this->homepageController->index();
        }
    }
}