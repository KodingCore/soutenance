<?php

class Router
{
    private HomepageController $homepageController;
    private ShopController $shopController;
    private UserController $userController;
    private ContactController $contactController;
    private DashboardController $dashboardController;
    private APIFetchController $APIFetchController;
    private QuoteRequestController $quoteRequestController;
    private NotFound $notFound;

    public function __construct()
    {
        $this->homepageController = new HomepageController();
        $this->shopController = new ShopController();
        $this->userController = new UserController();
        $this->contactController = new ContactController();
        $this->dashboardController = new DashboardController();
        $this->APIFetchController = new APIFetchController();
        $this->quoteRequestController = new QuoteRequestController();

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
            $this->shopController->index();
        }
        else if($route === "quote-request")
        {
            if(isset($_GET["template_id"]))
            {
                $template_id = $_GET["template_id"];
                $this->quoteRequestController->index($template_id);
            }
            
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
            else if($route === "tag-link")
            {
                $this->APIFetchController->getAllTags();
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
            else if($route === "delete-tag")
            {
                $this->APIFetchController->deleteTagById();
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
        else
        {
            $this->notFound->index();
        }
    }
}