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
        else if($route === "dashboardRemake" && isset($_SESSION["role"]))
        {
            if($_SESSION["role"] === "admin")
            {
                if(isset($_GET["add"]))
                {
                    if($_GET["add"] === "template")
                    {
                        $this->dashboardController->addTemplate();
                    }
                    else if($_GET["add"] === "category")
                    {
                        $this->dashboardController->addCategory();
                    }
                }
                else
                {
                    $this->dashboardController->index();
                }
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
        else if($route === "user" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->userAndInfoById($id);
            }
        }
        else if($route === "message" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->messageById($id);
            }
        }
        else if($route === "template" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->templateById($id);
            }
        }
        else if($route === "category" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->categoryById($id);
            }
        }
        else if($route === "review" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->reviewById($id);
            }
        }
        else if($route === "change_role" && isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
        {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $this->APIFetchController->changeRoleByUserId($id);
            }
        }
        else
        {
            $this->homepageController->index();
        }
    }
}