<?php

class ContactController extends AbstractController
{
   
    private $messageManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
    }

    public function sendMessage()
    {
        if(!empty($_POST["subject"]) && !empty($_POST["content"]))
        {
            //* Contre mesure d'injection de code
            $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8');
            $content = htmlspecialchars($_POST["content"], ENT_QUOTES, 'UTF-8');
    
            //* Validation des longueur de chaines
            $error = $this->controlStrlen("Message", $content, 2048);
            $error = $this->controlStrlen("Objet", $subject, 50);

            if ($error) //* Si il y a une erreur
            { 
                //* Afficher l'erreur et rediriger vers le formulaire d'inscription
                $this->render("views/guest/register.phtml", ["message" => $error]);
            } 
            else //* Les champs sont valides
            {   
                //* Mise en forme de la date actuelle
                $timezone = new DateTimeZone('Europe/Paris');
                $dateTime = new DateTime('now', $timezone);
                $sqlDateTime = $dateTime->format('Y-m-d H:i:s');

                //* Instantiation d'un objet Message
                $message = new Message($subject, $content, $_SESSION["user_id"], $sqlDateTime);

                $this->messageManager->insertMessage($message); //* On insert le message dans la BDD

                $this->render("views/user/contact.phtml", []); //* Retour à la page de contact
            }
        }
        else
        {
            $this->render("views/user/contact.phtml", []);
        }
    }
}
