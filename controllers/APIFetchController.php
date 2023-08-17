<?php

class APIFetchController extends AbstractController
{
   
    private $messageManager;
    private $userManager;
    private $infoManager;
    private $categoryManager;
    private $templateManager;
    private $reviewManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
        $this->categoryManager = new CategoryManager();
        $this->templateManager = new TemplateManager();
        $this->reviewManager = new ReviewManager();
    }

    public function categoryById(int $category_id)
    {
        $message = $this->categoryManager->getCategoryByCategoryId($category_id);

        $response = [
            "name" => $message->getName(), 
            "description" => $message->getDescription()
        ];
        echo json_encode($response);
    }

    public function reviewById(int $review_id)
    {
        $review = $this->reviewManager->getReviewByReviewId($review_id);
        $user = $this->userManager->getUserByUserId($review->getUserId());
        $template = $this->templateManager->getTemplateByTemplateId($review->getTemplateId());
        $response = [
            "username" => $user->getUsername(), 
            "template" => $template->getName(),
            "content" => $review->getContent(), 
            "send_date" => $review->getSendDate()
        ];
        echo json_encode($response);
    }

    public function messageById(int $message_id)
    {
        $message = $this->messageManager->getMessageByMessageId($message_id);
        $user = $this->userManager->getUserByUserId($message->getUserId());

        $response = [
            "username" => $user->getUsername(), 
            "email" => $user->getEmail(),
            "subject" => $message->getSubject(), 
            "content" => $message->getContent(), 
            "send_date_time" => $message->getSendDateTime()
        ];
        echo json_encode($response);
    }

    public function userAndInfoById(int $user_id)
    {
        $user = $this->userManager->getUserByUserId($user_id);
        $info = $this->infoManager->getInfoByUserId($user_id);
        $userAttributs = $user->jsonSerialize();
        $infoAttributs = $info->jsonSerialize();

        $response = [];

        foreach ($userAttributs as $attribut) {
            array_push($response, $attribut);
        }
        foreach ($infoAttributs as $attribut) {
            array_push($response, $attribut);
        }
        echo json_encode($response);
    }

    public function templateById(int $template_id)
    {
        $template = $this->templateManager->getTemplateByTemplateId($template_id);
        if($template->getCategoryId())
        {
            $category = $this->categoryManager->getCategoryByCategoryId($template->getCategoryId());
        }
        
        $categoryName = null;
        if(isset($category))
        {
            $categoryName = $category->getName();
        }
        $price = strval($template->getPrice());

        $response = [
            "category_id" => $categoryName, 
            "name" => $template->getName(), 
            "description" => $template->getDescription(), 
            "image_path" => $template->getImagePath(), 
            "price" => $price, 
            "created_at" => $template->getCreatedAt(),
            "updated_at" => $template->getUpdatedAt()
        ];
        echo json_encode($response);  
    }
}
