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
        $category = $this->categoryManager->getCategoryByCategoryId($category_id);
        $categoryAttributs = $category->jsonSerialize();

        $arrayResponse = $categoryAttributs;

        $response = [
            "message" => $arrayResponse
        ];
        echo json_encode($response);
    }

    public function reviewById(int $review_id)
    {
        $review = $this->reviewManager->getReviewByReviewId($review_id);
        $user = $this->userManager->getUserByUserId($review->getUserId());
        $template = $this->templateManager->getTemplateByTemplateId($review->getTemplateId());
        $reviewAttributs = $review->jsonSerialize();
        $userAttributs = $user->jsonSerialize();
        $templateAttributs = $template->jsonSerialize();

        $arrayResponse = array_replace($reviewAttributs, $userAttributs, $templateAttributs);

        $response = [
            "message" => $arrayResponse
        ];
        echo json_encode($response);
    }

    public function messageById(int $message_id)
    {
        $message = $this->messageManager->getMessageByMessageId($message_id);
        $user = $this->userManager->getUserByUserId($message->getUserId());
        $messageAttributs = $message->jsonSerialize();
        $userAttributs = $user->jsonSerialize();

        $arrayResponse = array_replace($messageAttributs, $userAttributs);

        $response = [
            "message" => $arrayResponse
        ];
        echo json_encode($response);
    }

    public function userAndInfoById(int $user_id)
    {
        $user = $this->userManager->getUserByUserId($user_id);
        $info = $this->infoManager->getInfoByUserId($user_id);
        $userAttributs = $user->jsonSerialize();
        $infoAttributs = $info->jsonSerialize();
        
        $arrayResponse = array_replace($userAttributs, $infoAttributs);

        $response = [
            'user' => $arrayResponse
        ];
    
        echo json_encode($response);
    }


    public function templateById(int $template_id)
    {
        $template = $this->templateManager->getTemplateByTemplateId($template_id);
        $templateAttributs = $template->jsonSerialize();
        $arrayResponse = null;
        if($template->getCategoryId())
        {
            $category = $this->categoryManager->getCategoryByCategoryId($template->getCategoryId());
            $categoryAttributs = $category->jsonSerialize();
            $arrayResponse = array_replace($templateAttributs, $categoryAttributs);
        }
        else
        {
            $arrayResponse = $templateAttributs;
        }
        
        $response = [
            'user' => $arrayResponse
        ];
    
        echo json_encode($response);
    }
}
