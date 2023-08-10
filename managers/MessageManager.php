<?php

class MessageManager extends AbstractManager
{
    
    public function insertMessage(Message $message)
    {
        $query = $this->db->prepare("INSERT INTO messages (subject, content, user_id, send_date) VALUES(:subject, :content, :user_id, :send_date)");
        $parameters = [
            "subject" => $message->getSubject(),
            "content" => $message->getContent(),
            "user_id" => $message->getUserId(),
            "send_date" => $message->getSendDate()
        ];
        $query->execute($parameters);
    }
}