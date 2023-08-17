<?php

class APIFetchController extends AbstractController
{
   
    private $messageManager;
    private $userManager;
    private $infoManager;
    private $categoryManager;
    private $templateManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
        $this->categoryManager = new CategoryManager();
        $this->templateManager = new TemplateManager();
    }

    public function messageById(string $message_id)
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

    public function userAndInfoById(string $user_id)
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

    public function templateById(string $template_id)
    {
        $template = $this->templateManager->getTemplateByTemplateId($template_id);
        $category = $this->categoryManager->getCategoryByCategoryId($template->getCategoryId());
        $response = [
            "category_name" => $category->getName(), 
            "name" => $template->getName(), 
            "description" => $template->getDescription(), 
            "image_path" => $template->getImagePath(), 
            "price" => $template->getPrice(), 
            "created_at" => $template->getCreatedAt(), 
            "updated_at" => $template->getUpdatedAt()
        ];
        echo json_encode($response);
    }

    public function templateKeys()
    {
        $keys = $this->templateManager->getTemplateKeys();
        echo json_encode($keys);
    }
}
