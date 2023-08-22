<?php

class APIFetchController extends AbstractController
{
   
    private $messageManager;
    private $userManager;
    private $infoManager;
    private $categoryManager;
    private $templateManager;
    private $reviewManager;
    private $appointmentManager;
    private $quotationManager;
    private $tagManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
        $this->infoManager = new InfoManager();
        $this->categoryManager = new CategoryManager();
        $this->templateManager = new TemplateManager();
        $this->reviewManager = new ReviewManager();
        $this->appointmentManager = new AppointmentManager();
        $this->quotationManager = new QuotationManager();
        $this->tagManager = new TagManager();
    }

    public function getCategoryById(int $category_id)
    {
        $category = $this->categoryManager->getCategoryByCategoryId($category_id);
        $categoryAttributs = $category->jsonSerialize();

        $arrayResponse = $categoryAttributs;

        $response = [
            "message" => $arrayResponse
        ];
        echo json_encode($response);
    }

    public function getReviewById(int $review_id)
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

    public function getMessageById(int $message_id)
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

    public function getUserAndInfoById(int $user_id)
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

    public function getTemplateById(int $template_id)
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

    public function changeRoleByUserId(int $user_id)
    {
        $user = $this->userManager->getUserByUserId($user_id);
        $basicRole = $user->getRole();

        if($basicRole === "user")
        {
            $this->userManager->replaceRoleByUserId($user_id, "admin");
        }
        else
        {
            $this->userManager->replaceRoleByUserId($user_id, "user");
        }
    }

    public function getAllUsers()
    {
        $users = $this->userManager->getUsers();
        $usersJsons = [];
        foreach($users as $user)
        {
            array_push($usersJsons, $user->jsonSerialize());
        }
        $response = [
            'users' => $usersJsons
        ];

        echo json_encode($response);
    }

    public function getAllInfos()
    {
        $infos = $this->infoManager->getInfos();
        $infosJsons = [];
        foreach($infos as $info)
        {
            array_push($infosJsons, $info->jsonSerialize());
        }
        $response = [
            'infos' => $infosJsons
        ];

        echo json_encode($response);
    }

    public function getAllMessages()
    {
        $messages = $this->messageManager->getMessages();
        $messagesJsons = [];
        foreach($messages as $message)
        {
            array_push($messagesJsons, $message->jsonSerialize());
        }
        $response = [
            'messages' => $messagesJsons
        ];

        echo json_encode($response);
    }

    public function getAllTemplates()
    {
        $templates = $this->templateManager->getTemplates();
        $templatesJsons = [];
        foreach($templates as $template)
        {
            array_push($templatesJsons, $template->jsonSerialize());
        }
        $response = [
            'templates' => $templatesJsons
        ];

        echo json_encode($response);
    }

    public function getAllCategories()
    {
        $categories = $this->categoryManager->getCategories();
        $categoriesJsons = [];
        foreach($categories as $category)
        {
            array_push($categoriesJsons, $category->jsonSerialize());
        }
        $response = [
            'categories' => $categoriesJsons
        ];

        echo json_encode($response);
    }

    public function getAllReviews()
    {
        $reviews = $this->reviewManager->getReviews();
        $reviewsJsons = [];
        foreach($reviews as $review)
        {
            array_push($reviewsJsons, $review->jsonSerialize());
        }
        $response = [
            'reviews' => $reviewsJsons
        ];
        
        echo json_encode($response);
    }

    public function getAllAppointments()
    {
        $appointments = $this->appointmentManager->getAppointments();
        $appointmentsJsons = [];
        foreach($appointments as $appointment)
        {
            array_push($appointmentsJsons, $appointment->jsonSerialize());
        }
        $response = [
            'appointments' => $appointmentsJsons
        ];

        echo json_encode($response);
    }

    public function getAllQuotations()
    {
        $quotations = $this->quotationManager->getQuotations();
        $quotationsJsons = [];
        foreach($quotations as $quotation)
        {
            array_push($quotationsJsons, $quotation->jsonSerialize());
        }
        $response = [
            'quotations' => $quotationsJsons
        ];

        echo json_encode($response);
    }

    public function getAllTags()
    {
        $tags = $this->tagManager->getTags();
        $tagsJsons = [];
        foreach($tags as $tag)
        {
            array_push($tagsJsons, $tag->jsonSerialize());
        }
        $response = [
            'tags' => $tagsJsons
        ];
        
        echo json_encode($response);
    }

    public function deleteUserById($id)
    {
        $this->infoManager->deleteInfoByUserId($id);
        $this->appointmentManager->deleteAppointmentByUserId($id);
        $this->messageManager->deleteMessageByUserId($id);
        $this->quotationManager->deleteQuotationByUserId($id);
        $this->reviewManager->deleteReviewByUserId($id);
        $this->tagManager->deleteTagByUserId($id);
        $this->userManager->deleteUserByUserId($id);
    }

    public function deleteInfoById($id)
    {
        $info = $this->infoManager->getInfoByInfoId($id);
        $user = $this->userManager->getUserByUserId($info->getUserId());
        $this->infoManager->deleteInfoByInfoId($id);
        $this->userManager->deleteUserByUserId($user->getUserId());
    }

    public function deleteMessageById($id)
    {
        $this->messageManager->deleteMessageByMessageId($id);
    }

    public function deleteTemplateById($id)
    {
        $this->quotationManager->deleteQuotationByTemplateId($id);
        $this->reviewManager->deleteReviewByTemplateId($id);
        $this->tagManager->deleteTagByTemplateId($id);
        $this->templateManager->deleteTemplateByTemplateId($id);
    }

    public function deleteCategoryById($id)
    {
        $this->templateManager->setCategoryIdToNullByCategoryId($id);
        $this->categoryManager->deleteCategoryByCategoryId($id);
    }

    public function deleteReviewById($id)
    {
        $this->reviewManager->deleteReviewByReviewId($id);
    }

    public function deleteAppointmentById($id)
    {
        $this->appointmentManager->deleteAppointmentByAppointmentId($id);
    }

    public function deleteQuotationById($id)
    {
        $this->quotationManager->deleteQuotationByQuotationId($id);
    }

    public function deleteTagById($id)
    {
        $this->tagManager->deleteTagByTagId($id);
    }
}
