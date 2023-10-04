<?php

//********************************
// Cette classe abstraite est appelée en fin
// de chaque fonction des controllers pour 
// afficher une view et/ou transmettre des données 
// d'une page à l'autre
//*******************************/
abstract class AbstractController
{
    protected string $template;
    protected array $data;

    public function render(string $view, array $values)
    {
        $this->template = $view;
        $this->data = $values;

        require 'views/layout.phtml';
    }
}