<?php

class ContactController extends AbstractController
{
   
    private $messageManager;
    private $makeRedirection;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->makeRedirection = false;
    }

    public function sendMessage()
    {
        if(!empty($_POST["subject"]) && !empty($_POST["content"]))
        {
            $error = null;

            //* Contre mesure d'injection de code
            $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8');
            $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
    
            //* Validation regex
            if(!preg_match('/^[a-zA-Z0-9.,!&?;:()<>\'"\s]{2,50}$/', $subject))
            {
                $error = ["message" => "Le sujet doit faire entre 2 et 50 caractères", "field" => "subject"];
            }
            if(!preg_match('/^[a-zA-Z0-9.,!&?;:()<>\'"\s]{10,2048}$/', $content))
            {
                $error = ["message" => "Le message doit faire entre 10 et 2048 caractères", "field" => "content"];
            }

            if ($error) //* Si il y a une erreur
            { 
                //* Afficher l'erreur et rediriger vers le formulaire de contact
                $this->render("views/user/contact.phtml", $error);

            } 
            else //* Les champs sont valides
            {   
                //* Mise en forme de la date actuelle
                $timezone = new DateTimeZone('Europe/Paris');
                $dateTime = new DateTime('now', $timezone);
                $sqlDateTime = $dateTime->format('Y-m-d H:i:s');

                //* Instantiation d'un objet Message
                $message = new Message($_SESSION["user_id"], $subject, $content, $sqlDateTime);

                $this->messageManager->insertMessage($message); //* On insert le message dans la BDD

                $this->render("views/user/contact.phtml", ["message" => "Message envoyé avec succès", "field" => "general"]); //* Retour à la page de contact
            }
        }
        else
        {
            $this->render("views/user/contact.phtml", []);
        }
    }
}
