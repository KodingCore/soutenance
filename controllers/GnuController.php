<?php
/* Contrôleur qui renvoie simplement sur la page gnu.phtml */
class GnuController extends AbstractController
{
    public function index()
    {
        $this->render("views/guest/gnu.phtml", []);
    }

}