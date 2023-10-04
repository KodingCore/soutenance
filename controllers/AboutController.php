<?php

class AboutController extends AbstractController
{
    public function index()
    {
        $this->render("views/guest/about.phtml", []);
    }

}