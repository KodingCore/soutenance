<?php

require "entities/Appointment.php";
require "entities/Category.php";
require "entities/Info.php";
require "entities/Message.php";
require "entities/Quotation.php";
require "entities/Review.php";
require "entities/Template.php";
require "entities/User.php";

require "managers/AbstractManager.php";
require "managers/UserManager.php";
require "managers/InfoManager.php";
require "managers/MessageManager.php";
require "managers/TemplateManager.php";
require "managers/ReviewManager.php";
require "managers/CategoryManager.php";
require "managers/AppointmentManager.php";
require "managers/QuotationManager.php";

require "controllers/AbstractController.php";
require "controllers/HomepageController.php";
require "controllers/ShopController.php";
require "controllers/UserController.php";
require "controllers/DashboardController.php";
require "controllers/ContactController.php";
require "controllers/APIFetchController.php";
require "controllers/QuoteRequestController.php";
require "controllers/NotFound.php";
require "controllers/GnuController.php";

require "services/Router.php";