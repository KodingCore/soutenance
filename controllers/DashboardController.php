<?php

class DashboardController extends AbstractController
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $this->render("views/admin/dashboard.phtml", []);
    }
}