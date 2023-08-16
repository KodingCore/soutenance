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
        $route = explode("\\", $route)[0];

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
        else if($route === "dashboard" && isset($_SESSION["role"]))
        {
            if($_SESSION["role"] === "admin")
            {
                $this->dashboardController->index();
            }
            else
            {
                $this->homepageController->index();
            }
            
        }
        else if($route === "shop")
        {

        }
        else if($route === "quote")
        {

        }
        else if($route === "users")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->userById($id);
            }
        }
        else if($route === "messages")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->messageById($id);
            }
        }
        else
        {
            $this->homepageController->index();
        }
    }
}