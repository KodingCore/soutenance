<?php

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