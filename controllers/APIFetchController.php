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
        if(!empty($_GET["name"]) && !empty($_GET["description"]))
        {
            $name = $_GET["name"];
            $description = $_GET["description"];
            $category = new Category($name, $description);
            $this->categoryManager->insertCategory($category);
        }
    }

    public function addTemplate()
    {
        if(!empty($_GET["category_id"]))
        {
            $category_id = $_GET["category_id"];
        }
        if(!empty($_GET["price"]))
        {
            $price = $_GET["price"];
        }
        if(!empty($_GET["updated_at"]))
        {
            $updated_at = $_GET["updated_at"];
        }
        if(!empty($_GET["name"]) && !empty($_GET["description"]) && !empty($_GET["image_path"]) && !empty($_GET["created_at"]))
        {
            $name = $_GET["name"];
            $description = $_GET["description"];
            $image_path = $_GET["image_path"];
            $created_at = $_GET["created_at"];
            $template = new Template($category_id, $name, $description, $image_path, $price, $created_at, $updated_at);
            $this->templateManager->insertTemplate($template);
        }
    }

    public function addQuotation()
    {
        if(!empty($_GET["user_id"]) && !empty($_GET["template_id"]) && !empty($_GET["quotation_date"]) && !empty($_GET["content"]) && !empty($_GET["expiration_date"]))
        {
            $user_id = $_GET["user_id"];
            $template_id = $_GET["template_id"];
            $quotation_date = $_GET["quotation_date"];
            $content = $_GET["content"];
            $expiration_date = $_GET["expiration_date"];
            $quotation = new Quotation($user_id, $template_id, $quotation_date, $content, $expiration_date);
            $this->quotationManager->insertQuotation($quotation);
        }
    }

    public function addAppointment()
    {
        if(!empty($_GET["user_id"]) && !empty($_GET["appointment_date"]) && !empty($_GET["appointment_time"]) && !empty($_GET["communication_preference"]))
        {
            $user_id = $_GET["user_id"];
            $appointment_date = $_GET["appointment_date"];
            $appointment_time = $_GET["appointment_time"];
            $communication_preference = $_GET["communication_preference"];
            $appointment = new Appointment($user_id, $appointment_date, $appointment_time, $communication_preference);
            $this->appointmentManager->insertAppointment($appointment);
        }
    }

    public function editCategory()
    {
        if(!empty($_GET["id"] && !empty($_GET["name"]) && !empty($_GET["description"])))
        {
            $id = $_GET["id"];
            $name = $_GET["name"];
            $description = $_GET["description"];
            $category = new Category($name, $description);
            $category->setCategoryId($id);
            $this->categoryManager->editCategory($category);
        }
    }

    public function editTemplate()
    {
        if(!empty($_GET["category_id"]))
        {
            $category_id = $_GET["category_id"];
        }
        if(!empty($_GET["price"]))
        {
            $price = $_GET["price"];
        }
        if(!empty($_GET["updated_at"]))
        {
            $updated_at = $_GET["updated_at"];
        }
        if(!empty($_GET["id"]) && !empty($_GET["name"]) && !empty($_GET["description"]) && !empty($_GET["image_path"]) && !empty($_GET["created_at"]))
        {
            $id = $_GET["id"];
            $name = $_GET["name"];
            $description = $_GET["description"];
            $image_path = $_GET["image_path"];
            $created_at = $_GET["created_at"];
            $template = new Template($category_id, $name, $description, $image_path, $price, $created_at, $updated_at);
            $template->setTemplateId($id);
            $this->templateManager->editTemplate($template);
        }
    }

    public function editQuotation()
    {
        if(!empty($_GET["id"]) && !empty($_GET["user_id"]) && !empty($_GET["template_id"]) && !empty($_GET["quotation_date"]) && !empty($_GET["content"]) && !empty($_GET["expiration_date"]))
        {
            $id = $_GET["id"];
            $user_id = $_GET["user_id"];
            $template_id = $_GET["template_id"];
            $quotation_date = $_GET["quotation_date"];
            $content = $_GET["content"];
            $expiration_date = $_GET["expiration_date"];
            $quotation = new Quotation($user_id, $template_id, $quotation_date, $content, $expiration_date);
            $quotation->setQuotationId($id);
            $this->quotationManager->editQuotation($quotation);
        }
    }

    public function editAppointment()
    {
        if(!empty($_GET["id"]) && !empty($_GET["user_id"]) && !empty($_GET["appointment_date"]) && !empty($_GET["appointment_time"]) && !empty($_GET["communication_preference"]))
        {
            $id = $_GET["id"];
            $user_id = $_GET["user_id"];
            $appointment_date = $_GET["appointment_date"];
            $appointment_time = $_GET["appointment_time"];
            $communication_preference = $_GET["communication_preference"];
            $appointment = new Appointment($user_id, $appointment_date, $appointment_time, $communication_preference);
            $appointment->setAppointmentId($id);
            $this->appointmentManager->editAppointment($appointment);
        }
    }

    public function editUser()
    {
        if(!empty($_GET["id"]) && !empty($_GET["role"]))
        {
            $id = $_GET["id"];
            $role = $_GET["role"];
            $this->userManager->editUserRoleById($id, $role);
        }
    }

}
