<?php

class MessageManager extends AbstractManager
{
    
    public function getMessagesOrderedByDate() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM messages ORDER BY send_date DESC");
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        if($messages)
        {
            $messagesTab = [];
            foreach($messages as $message)
            {
                $messageInstance = new Message($message["subject"], $message["content"], $message["user_id"], $message["send_date"]);
                $messageInstance->setMessageId($message["message_id"]);
                array_push($messagesTab, $messageInstance);
            }
            return $messagesTab;
        }
        else
        {
            return null;
        }
    }

    public function getMessageByUserId(int $user_id) : ? Message
    {
        $query = $this->db->prepare("SELECT * FROM messages WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $message = $query->fetch(PDO::FETCH_ASSOC);
        if($message)
        {
            $messageInstance = new Message($message["subject"], $message["content"], $message["user_id"], $message["send_date"]);
            $messageInstance->setMessageId($message["message_id"]);
            return $messageInstance;
        }
        else
        {
            return null;
        }
    }

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

    public function deleteMessageByMessageId(int $message_id)
    {
        $query = $this->db->prepare("DELETE FROM messages WHERE message_id = :message_id");
        $parameters = [
            "message_id" => $message_id
        ];
        $query->execute($parameters);
    }

    public function editMessage(Message $message)
    {
        $query = $this->db->prepare("UPDATE messages SET username = :username, email = :email, password = :password WHERE user_id = :user_id");
        $parameters = [
            "subject" => $message->getSubject(),
            "content" => $message->getContent(),
            "user_id" => $message->getUserId(),
            "send_date" => $message->getSendDate()
        ];
        $query->execute($parameters);
    }
}