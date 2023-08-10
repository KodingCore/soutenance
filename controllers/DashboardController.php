<?php

class DashboardController extends AbstractController
{
   
    private $userManager;
    private $messageManager;
    private $reviewManager;
    private $infoManager;
    private $templateManager;
    private $quotationManager;
    private $imageManager;
    private $categoryManager;
    private $appointmentManager;

    public function __construct()
    {
        $this->userManager = new UserManager();

    }

    public function index()
    {

        $this->render("views/admin/dashboard.phtml", []);
    }
    
}
