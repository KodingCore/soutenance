<?php
/* Contrôleur qui renvoie simplement sur la page dashboard.phtml */
class DashboardController extends AbstractController
{
    public function index()
    {
        $this->render("views/admin/dashboard.phtml", []);
    }
}