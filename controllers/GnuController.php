<?php

class GnuController extends AbstractController
{
    public function index()
    {
        $this->render("views/guest/gnu.phtml", []);
    }

}