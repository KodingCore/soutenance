<?php

class APIFetchController extends AbstractController
{
   
    private $messageManager;
    private $userManager;
    private $infoManager;
    private $reviewManager;
    private $templateManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
        $this->reviewManager = new ReviewManager();
        $this->templateManager = new TemplateManager();
    }

    public function messageById($message_id)
    {
        $message = $this->messageManager->getMessageByMessageId($message_id);
        $user = $this->userManager->getUserByUserId($message->getUserId());

        $response = [
            "username" => $username = $user->getUsername(), 
            "email" => $email = $user->getEmail(),
            "subject" => $message->getSubject(), 
            "content" => $message->getContent(), 
            "send_date_time" => $message->getSendDateTime()
        ];
        echo json_encode($response);
    }

    public function userById($user_id)
    {
        $user = $this->userManager->getUserByUserId($user_id);
        $info = $this->infoManager->getInfoByUserId($user_id);
        $response = [
            "username" => $user->getUsername(), 
            "email" => $user->getEmail(), 
            "first_name" => $info->getFirstName(), 
            "last_name" => $info->getLastName(), 
            "tel" => $info->getTel(), 
            "address" => $info->getAddress(), 
            "zip" => $info->getZip(), 
            "city" => $info->getCity(),
            "role" => $user->getRole()
        ];
        echo json_encode($response);
    }

}
