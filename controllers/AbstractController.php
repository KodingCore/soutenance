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
    
    public function controlStrlen(string $field, string $string, int $length) : ? string
    {
        if (strlen($string) > $length) 
        {
            return "Saisie du champ {$field} trop longue ({$length} caractères maximum)";
        }
        else
        {
            return null;
        }
    }

    public function controlSpeChar(string $field, string $string, array $exept = []) : ? string
    {
        $illegal = "#$%^&*()+=-[]';,./{}|:<>?~";
        $illegal = preg_replace($exept, "", $illegal);
        if (strpbrk($string, $illegal)) 
        {
            return "Saisie du champ {$field} invalide (pas de caractères spéciaux)";
        }
        else
        {
            return null;
        }
    }
}