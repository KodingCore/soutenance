<?php

class SendQuoteController
{
    public function sendEmailAction() {
        // Récupérer les données du formulaire ou d'une autre source
        $to = $_POST['email'];
        $subject = "Sujet de l'e-mail";
        $message = "Contenu de l'e-mail.";

        $headers = "From: expéditeur@example.com\r\n";
        $headers .= "Reply-To: expéditeur@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        // Envoi de l'e-mail
        if (mail($to, $subject, $message, $headers)) {
            // Rediriger ou afficher un message de succès
            echo "E-mail envoyé avec succès !";
        } else {
            // Rediriger ou afficher un message d'échec
            echo "Échec de l'envoi de l'e-mail.";
        }
    }
}
