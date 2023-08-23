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

    public function deleteUserById()
    {
        $id = $_GET["id"];
        $this->infoManager->deleteInfoByUserId($id);
        $this->appointmentManager->deleteAppointmentByUserId($id);
        $this->messageManager->deleteMessageByUserId($id);
        $this->quotationManager->deleteQuotationByUserId($id);
        $this->reviewManager->deleteReviewByUserId($id);
        $this->tagManager->deleteTagByUserId($id);
        $this->userManager->deleteUserByUserId($id);
    }

    public function deleteInfoById()
    {
        $id = $_GET["id"];
        $info = $this->infoManager->getInfoByInfoId($id);
        $user = $this->userManager->getUserByUserId($info->getUserId());
        $this->infoManager->deleteInfoByInfoId($id);
        $this->userManager->deleteUserByUserId($user->getUserId());
    }

    public function deleteMessageById()
    {
        $id = $_GET["id"];
        $this->messageManager->deleteMessageByMessageId($id);
    }

    public function deleteTemplateById()
    {
        $id = $_GET["id"];
        $this->quotationManager->deleteQuotationByTemplateId($id);
        $this->reviewManager->deleteReviewByTemplateId($id);
        $this->tagManager->deleteTagByTemplateId($id);
        $this->templateManager->deleteTemplateByTemplateId($id);
    }

    public function deleteCategoryById()
    {
        $id = $_GET["id"];
        $this->templateManager->setCategoryIdToNullByCategoryId($id);
        $this->categoryManager->deleteCategoryByCategoryId($id);
    }

    public function deleteReviewById()
    {
        $id = $_GET["id"];
        $this->reviewManager->deleteReviewByReviewId($id);
    }

    public function deleteAppointmentById()
    {
        $id = $_GET["id"];
        $this->appointmentManager->deleteAppointmentByAppointmentId($id);
    }

    public function deleteQuotationById()
    {
        $id = $_GET["id"];
        $this->quotationManager->deleteQuotationByQuotationId($id);
    }

    public function deleteTagById()
    {
        $id = $_GET["id"];
        $this->tagManager->deleteTagByTagId($id);
    }

    public function addCategory()
    {
        if(!empty($_GET["0"]) && !empty($_GET["1"]))
        {
            $name = $_GET["0"];
            $description = $_GET["1"];
            $category = new Category($name, $description);
            $this->categoryManager->insertCategory($category);
        }
    }

    public function addTemplate()
    {
        if(!empty($_GET["0"]))
        {
            $category_id = $_GET["0"];
        }
        if(!empty($_GET["4"]))
        {
            $price = $_GET["4"];
        }
        if(!empty($_GET["6"]))
        {
            $updated_at = $_GET["6"];
        }
        if(!empty($_GET["1"]) && !empty($_GET["2"]) && !empty($_GET["3"]) && !empty($_GET["5"]))
        {
            $name = $_GET["1"];
            $description = $_GET["2"];
            $image_path = $_GET["3"];
            $created_at = $_GET["5"];
            $template = new Template($category_id, $name, $description, $image_path, $price, $created_at, $updated_at);
            $this->templateManager->insertTemplate($template);
        }
    }

    public function addQuotation()
    {
        if(!empty($_GET["0"]) && !empty($_GET["1"]) && !empty($_GET["2"]) && !empty($_GET["3"]) && !empty($_GET["4"]))
        {
            $user_id = $_GET["0"];
            $template_id = $_GET["1"];
            $quotation_date = $_GET["2"];
            $content = $_GET["3"];
            $expiration_date = $_GET["4"];
            $quotation = new Quotation($user_id, $template_id, $quotation_date, $content, $expiration_date);
            $this->quotationManager->insertQuotation($quotation);
        }
    }

    public function addAppointment()
    {
        if(!empty($_GET["0"]) && !empty($_GET["1"]) && !empty($_GET["2"]) && !empty($_GET["3"]))
        {
            $user_id = $_GET["0"];
            $appointment_date = $_GET["1"];
            $appointment_time = $_GET["2"];
            $communication_preference = $_GET["3"];
            $appointment = new Appointment($user_id, $appointment_date, $appointment_time, $communication_preference);
            $this->appointmentManager->insertAppointment($appointment);
        }
    }

}
