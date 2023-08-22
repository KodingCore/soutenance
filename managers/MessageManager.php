<?php

class MessageManager extends AbstractManager
{

    public function getMessageByMessageId(int $message_id) : ? Message
    {
        $query = $this->db->prepare("SELECT * FROM messages WHERE message_id = :message_id");
        $parameters = [
            "message_id" => $message_id
        ];
        $query->execute($parameters);
        $message = $query->fetch(PDO::FETCH_ASSOC);
        if($message)
        {
            $messageInstance = new Message($message["user_id"], $message["subject"], $message["content"], $message["send_date_time"]);
            $messageInstance->setUserId($message["message_id"]);
            return $messageInstance;
        }
        else
        {
            return null;
        }
    }
    
    public function getMessages() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM messages ORDER BY send_date_time DESC");
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        if($messages)
        {
            $messagesTab = [];
            foreach($messages as $message)
            {
                $messageInstance = new Message($message["user_id"], $message["subject"], $message["content"], $message["send_date_time"]);
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

    public function getMessagesByUserId(int $user_id) : ? Message
    {
        $query = $this->db->prepare("SELECT * FROM messages WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);
        if($messages)
        {
            $messagesTab = [];
            foreach($messages as $message)
            {
                $messageInstance = new Message($message["user_id"], $message["subject"], $message["content"], $message["send_date_time"]);
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

    public function insertMessage(Message $message)
    {
        $query = $this->db->prepare("INSERT INTO messages (user_id, subject, content, send_date_time) VALUES(:user_id, :subject, :content, :send_date_time)");
        $parameters = [
            "user_id" => $message->getUserId(),
            "subject" => $message->getSubject(),
            "content" => $message->getContent(),
            "send_date_time" => $message->getSendDateTime()
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

    public function deleteMessageByUserId(int $user_id)
    {
        $query = $this->db->prepare("DELETE FROM messages WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
    }

    public function editMessage(Message $message)
    {
        $query = $this->db->prepare("UPDATE messages SET user_id = :user_id, subject = :subject, content = :content, send_date_time = :send_date_time WHERE message_id = :message_id");
        $parameters = [
            "user_id" => $message->getUserId(),
            "subject" => $message->getSubject(),
            "content" => $message->getContent(),
            "send_date_time" => $message->getSendDateTime()
        ];
        $query->execute($parameters);
    }
}