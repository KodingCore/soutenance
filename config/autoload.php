<?php

require "entities/Appointment.php";
require "entities/Category.php";
require "entities/Image.php";
require "entities/Info.php";
require "entities/Message.php";
require "entities/Quotation.php";
require "entities/Review.php";
require "entities/Tag.php";
require "entities/Template.php";
require "entities/User.php";

require "managers/AbstractManager.php";
require "managers/UserManager.php";
require "managers/InfoManager.php";
require "managers/MessageManager.php";
require "managers/TemplateManager.php";
require "managers/ReviewManager.php";

require "controllers/AbstractController.php";
require "controllers/HomepageController.php";
require "controllers/UserController.php";
require "controllers/DashboardController.php";
require "controllers/ContactController.php";

require "services/Router.php";