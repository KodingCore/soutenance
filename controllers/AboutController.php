<?php
/* Contrôleur qui renvoie simplement sur la page about.phtml */
class AboutController extends AbstractController
{
    public function index()
    {
        $this->render("views/guest/about.phtml", []);
    }

}