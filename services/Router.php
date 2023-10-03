<?php

class Router
{
    private HomepageController $homepageController;
    private ShopController $shopController;
    private UserController $userController;
    private ContactController $contactController;
    private DashboardController $dashboardController;
    private APIFetchController $APIFetchController;
    private RequestController $requestController;
    private NotFound $notFound;
    private GnuController $gnuController;

    public function __construct()
    {
        $this->homepageController = new HomepageController();
        $this->shopController = new ShopController();
        $this->userController = new UserController();
        $this->contactController = new ContactController();
        $this->dashboardController = new DashboardController();
        $this->APIFetchController = new APIFetchController();
        $this->requestController = new RequestController();
        $this->notFound = new NotFound();
        $this->gnuController = new GnuController();
    }

    public function checkRoute($route) : void
    {
        
        //*GUEST--------------GUEST-----------GUEST--------
        if($route === "homepage")
        {
            $this->homepageController->index();
        }
        else if($route === "gnu")
        {
            $this->gnuController->index();
        }
        else if($route === "login")
        {
            $this->userController->login();
        }
        else if($route === "register")
        {
            $this->userController->register();
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
            $this->shopController->index();
        }
        
        else if(isset($_SESSION["role"]))
        {
            //*USER--------------USER-----------USER--------
            if($route === "homepage-review-send")
            {
                if(isset($_POST["content"]))
                {
                    $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
                    unset($_POST["content"]);
                    echo $_POST["content"];
                    $this->homepageController->sendReview($content);
                }
                else
                {
                    $this->homepageController->index();
                }
                
            }
            else if($route === "contact")
            {
                $this->contactController->sendMessage();
            }
            else if($route === "account")
            {
                $this->userController->account();
            }
            else if($route === "request")
            {
                $this->requestController->index();
            }
            else if($route === "add-request")
            {
                if(isset($_POST["description"]))
                {
                    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
                    unset($_POST["description"]);
                    $this->requestController->addRequest($description);
                }
                else
                {
                    $this->requestController->index();
                }
            }
        
            //*ADMIN--------------ADMIN-----------ADMIN--------
            if($_SESSION["role"] === "admin")
            {
                if($route === "dashboard")
                {
                    $this->dashboardController->index();
                }
                else if($route === "user-link")
                {
                    $this->APIFetchController->getAllUsers();
                }
                else if($route === "info-link")
                {
                    $this->APIFetchController->getAllInfos();
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
                else if($route === "request-link")
                {
                    $this->APIFetchController->getAllRequests();
                }
                else if($route === "delete-user")
                {
                    $this->APIFetchController->deleteUserById();
                }
                else if($route === "delete-info")
                {
                    $this->APIFetchController->deleteInfoById();
                }
                else if($route === "delete-message")
                {
                    $this->APIFetchController->deleteMessageById();
                }
                else if($route === "delete-template")
                {
                    $this->APIFetchController->deleteTemplateById();
                }
                else if($route === "delete-category")
                {
                    $this->APIFetchController->deleteCategoryById();
                }
                else if($route === "delete-review")
                {
                    $this->APIFetchController->deleteReviewById();
                }
                else if($route === "delete-appointment")
                {
                    $this->APIFetchController->deleteAppointmentById();
                }
                else if($route === "delete-quotation")
                {
                    $this->APIFetchController->deleteQuotationById();
                }
                else if($route === "delete-request")
                {
                    $this->APIFetchController->deleteRequestById();
                }
                else if($route === "add-category")
                {
                    $this->APIFetchController->addCategory();
                }
                else if($route === "add-template")
                {
                    $this->APIFetchController->addTemplate();
                }
                else if($route === "add-quotation")
                {
                    $this->APIFetchController->addQuotation();
                }
                else if($route === "add-appointment")
                {
                    $this->APIFetchController->addAppointment();
                }
                else if($route === "edit-category")
                {
                    $this->APIFetchController->editCategory();
                }
                else if($route === "edit-template")
                {
                    $this->APIFetchController->editTemplate();
                }
                else if($route === "edit-quotation")
                {
                    $this->APIFetchController->editQuotation();
                }
                else if($route === "edit-appointment")
                {
                    $this->APIFetchController->editAppointment();
                }
                else if($route === "edit-user")
                {
                    $this->APIFetchController->editUser();
                }
            }
            
        }
        else
        {
            $this->notFound->index();
        }
    }
}