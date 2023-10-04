-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : mer. 04 oct. 2023 à 21:18
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kevincorvaisier_kodingcore_bddpro`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `communication_preference` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `appointment_date`, `appointment_time`, `communication_preference`) VALUES
(2, 7, '2024-06-05', '00:10:00', 'Email'),
(4, 7, '2023-09-04', '00:45:00', 'Email'),
(18, 14, '2023-10-12', '00:30:00', 'Téléphone'),
(20, 731, '2023-10-20', '00:45:00', 'Téléphone'),
(21, 9, '2023-10-06', '00:10:00', 'Visioconférence');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `average_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `average_price`) VALUES
(3, 'Sites Web Simples', '-Sites web de type \"Page personnelle\" ou \"CV en ligne\".-Sites web de type \"Landing Page\" pour une entreprise ou un produit.-Sites web de blogs basiques.', 'entre 500 € et 2 000 €'),
(50, 'Sites Web de Petite à Moyenne Envergure', '-Sites web de petites entreprises ou de restaurants.\r\n-Sites web de portfolios pour artistes ou photographes.\r\n-Sites web de blogs avec des fonctionnalités avancées.', 'entre 2 000 € et 10 000 €'),
(51, 'Sites Web d\'Entreprise', '-Sites web de grandes entreprises avec de nombreuses pages et fonctionnalités.\r\n-Sites web de commerce électronique de taille moyenne.\r\n-Sites web intranet pour les entreprises.', 'entre 10 000 € et 50 000 €'),
(54, 'Sites Web Complexes et Applications Web', '-Sites web de commerce électronique de grande envergure avec des fonctionnalités avancées.\r\n-Plateformes sociales et réseaux sociaux.\r\n-Sites web de réservation en ligne (voyages, hôtels, etc.).\r\n-Systèmes de gestion de contenu (CMS) personnalisés.\r\n-Applications web personnalisées pour des entreprises ou des industries spécifiques.\r\n-Applications web de gestion de projet, de CRM, de RH, etc.\r\n-Plateformes de streaming vidéo en direct ou à la demande.', 'à partie de 50 000 €');

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `info_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`info_id`, `user_id`, `first_name`, `last_name`, `tel`, `address`, `zip`, `city`) VALUES
(5, 5, 'Francis', 'Smith', '0325089632', 'Place du Capitole', '31000', 'Toulouse'),
(6, 6, 'Kévin', 'Bert', '0420169031', 'Rue de la Paix', '06000', 'Nice'),
(9, 9, 'Pierre', 'Val', '0680909636', 'Rue de la Cathédrale', '67000', 'Strasbourg'),
(10, 10, 'Viriginie', 'Pavoit', '0625289632', 'Rue de la Grande Poste', '44000', 'Nantes'),
(11, 11, 'Toyö', 'Kokaï', '0621489668', 'Rue de la Plage', '13008', 'Marseille'),
(12, 12, 'Michel', 'Témoin', '0725409632', 'Rue de la Tour Eiffel', '75015', 'Paris'),
(13, 13, 'Adèle', 'Dos', '0615489654', 'Avenue de la Libération', '69003', 'Lyon'),
(14, 14, 'Maël', 'Troquet', '0922480600', 'Rue du Vieux Moulin', '31100', 'Toulouse'),
(15, 15, 'Hélene', 'Panzer', '0625489635', 'Place de la Mairie', '06300', 'Nice'),
(16, 16, 'Halley', 'Troquet', '0226489603', 'Rue des Lilas', '59800', 'Lille'),
(18, 18, 'Christophe', 'Dodin', '0685489632', 'Rue Saint-Jean', '67200', 'Strasbourg'),
(19, 19, 'Bob', 'Zen', '0725489652', 'Rue de la Mer', '44300', 'Nantes'),
(20, 20, 'Richard', 'Pluriel', '0699489130', 'Rue de la Montagne', '13012', 'Marseille'),
(127, 730, 'Kévi', 'Corvaisier', '0631318358', '1 Lotissement du Cèdre', '35420', 'Le ferré'),
(128, 731, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 732, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 733, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 747, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 748, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 749, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 750, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 751, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 752, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 753, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 761, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 762, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 763, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `content` text,
  `send_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `subject`, `content`, `send_date_time`) VALUES
(5, 5, 'Rendez-Vous', 'C\'est ok pour le RDV dont nous avons parlé. Le 21 Octobre. Cordiallement', '2023-08-01 14:30:45'),
(6, 6, 'Changement de plan!', 'Stop! On change tout le projet! Je paierai les frais sup\', j\'tenvoie les news', '2023-08-02 16:00:45'),
(7, 7, 'besoin d\'aide', 'Bonjour, comment changer mon username?', '2023-08-02 16:28:16'),
(10, 10, 'Devis Janvier 2023', 'Bonsoir, j\'accepte votre dernier devis. Nous nous verront lors du rendez-vous. Bonne soirée à vous', '2023-08-12 19:18:50'),
(46, 5, 'Changement Radical', 'Urgent : Changement radical dans le projet ! Prêt à couvrir les frais supplémentaires. Je t\'envoie les détails dès maintenant.', '2023-10-04 11:57:09'),
(47, 731, 'Nouvelle Direction, Nouvel Élan', 'Nouvelle direction en vue ! Je paierai les frais supplémentaires, et je t\'envoie les dernières nouvelles. Prépare-toi pour un nouvel élan créatif.', '2023-10-04 11:57:09'),
(48, 15, 'Rénovation Projet', 'Halte! On rénove complètement le projet. Je couvre les coûts supplémentaires. Attends-toi à recevoir les mises à jour très bientôt.', '2023-10-04 11:57:09'),
(49, 747, 'Revirement Créatif Imminent', 'Attention : Revirement créatif imminent ! Je m\'engage à couvrir les frais supplémentaires. Les détails arrivent rapidement.', '2023-10-04 11:57:09'),
(50, 730, 'fbhhgfhfh', 'frdgfhgfhftgjhjghgj', '2023-10-04 15:48:38'),
(51, 730, 'fbhhgfhfh', 'ujhghhkgugyhyuuyh', '2023-10-04 15:58:58'),
(52, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:15:15'),
(53, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:15:36'),
(54, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:15:42'),
(55, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:15:51'),
(56, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:15:58'),
(57, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:16:05'),
(58, 730, 'fbhhgfhfh', 'fgdhfhfghfghfghdf', '2023-10-04 17:16:14');

-- --------------------------------------------------------

--
-- Structure de la table `quotations`
--

CREATE TABLE `quotations` (
  `quotation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quotation_date` date DEFAULT NULL,
  `content` text,
  `expiration_date` date DEFAULT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quotations`
--

INSERT INTO `quotations` (`quotation_id`, `user_id`, `category_id`, `quotation_date`, `content`, `expiration_date`, `price`) VALUES
(19, 10, 50, '2023-09-06', 'Type: Site web d\'entreprise de moyenne taillePseudo: AdèleMail: adele@exemple.comPrénom: AdèleNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-06', 1200),
(20, 5, 51, '2023-10-02', 'Type: Site web d\'entreprise de moyenne taillePseudo: FrancisMail: francis@exemple.comPrénom: FrancisNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Gestion de contenu facile- Géolocalisation', '2023-10-31', 1400),
(21, 19, 50, '2023-10-02', 'Type: Site web de petite entreprisePseudo: BobMail: bob@exemple.comPrénom: BobNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-31', 500),
(22, 14, 54, '2023-10-02', 'Type: Site web complexes et application webPseudo: MaëlMail: maël@exemple.comPrénom: MaëlNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche- Forum de discussion', '2023-10-31', 10000),
(23, 9, 50, '2023-10-02', 'Type: Site web d\'entreprise de moyenne taillePseudo: PierreMail: pierre@exemple.comPrénom: PierreNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Panier d\'achat- Achat en ligne', '2023-10-31', 1100),
(24, 18, 3, '2023-10-02', 'Type: Site web simple\r\nPseudo: ChristopheMail: christophe@exemple.comPrénom: ChristopheNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- simple CMS', '2023-10-31', 600),
(25, 12, 50, '2023-10-02', 'Type: Site web d\'entreprise de moyenne taillePseudo: MichelMail: michel@exemple.comPrénom: MichelNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-31', 1100),
(26, 20, 50, '2023-10-02', 'Type: Site web d\'entreprise de moyenne taillePseudo: RichardMail: richard@exemple.comPrénom: RichardNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-31', 1100),
(27, 731, 51, '2023-10-02', 'Type: Site web de grande entreprisePseudo: JoeyMail: joey@exemple.comPrénom: JoeyNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-31', 16000),
(28, 7, 50, '2023-10-02', 'Type: Site web d\'entreprise de moyenne taillePseudo: SophieMail: sophie@exemple.comPrénom: SophieNom: DosTel: 0615489654Détails du Devis :- Conception d\'un site web professionnel- Intégration de fonctionnalités avancées- Design personnalisé et adaptatif- Gestion de contenu facile- Optimisation pour les moteurs de recherche', '2023-10-31', 2500);

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `checkboxes_binaries` varchar(21) NOT NULL,
  `content_share` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `requests`
--

INSERT INTO `requests` (`request_id`, `user_id`, `category_id`, `checkboxes_binaries`, `content_share`, `description`, `created_at`, `updated_at`) VALUES
(1, 13, 51, '110000110000011000011', 'global', 'Le site web pour \"Algo M.G Technology\" sera une présence en ligne pour mon entreprise. Il permettra aux clients potentiels de découvrir qui nous sommes, ce que l\'on faits et comment ils peuvent nous contacter.', '2023-09-21', '2023-09-29'),
(2, 19, 50, '000000000000000000000', 'global', 'Notre site web sera la vitrine numérique de notre restaurant, offrant aux clients un aperçu alléchant de notre menu, de nos promotions et de l\'ambiance unique de notre établissement.', '2023-09-15', NULL),
(3, 730, 3, '000000000000000000000', 'no', 'Le nouveau site de notre boutique de mode en ligne offrira une expérience shopping immersive, mettant en valeur nos dernières collections, offres spéciales et garantissant une navigation fluide pour nos clients.', '2023-09-08', '2023-09-15'),
(4, 730, 50, '100011000100100000000', 'partial', 'Pour notre cabinet de conseil, le site web sera une plateforme informative, fournissant des ressources précieuses, des études de cas et permettant aux clients potentiels de comprendre comment notre expertise peut bénéficier à leur entreprise.', '2023-10-02', '2023-10-03'),
(5, 12, 3, '111000001100011101001', 'partial', 'Le site web de notre studio créatif sera une galerie virtuelle, exposant notre portefolio diversifié, nos projets en cours et invitant les visiteurs à découvrir comment notre créativité peut donner vie à leurs idées.', '2023-10-03', NULL),
(10, 18, 54, '000110000010001000100', 'complete', 'En tant que professionnel indépendant, mon site web sera une carte de visite en ligne, mettant en avant mes compétences, expériences passées et facilitant la prise de contact pour de nouvelles opportunités professionnelles.', '2023-10-03', NULL),
(49, 730, 50, '111000001000000100000', 'no', 'Notre site web institutionnel sera une ressource complète pour les membres de notre association, fournissant des informations sur nos missions, événements à venir et offrant une plateforme d\'adhésion simplifiée.', '2023-10-04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  `send_date` date DEFAULT NULL,
  `notation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `content`, `send_date`, `notation`) VALUES
(2, 18, 'Je tiens à exprimer ma grande satisfaction concernant la livraison de mon site internet. Cela a été une expérience exceptionnelle du début à la fin. L\'équipe de développement a surpassé toutes mes attentes et a parfaitement compris mes besoins.\r\n\r\nTout d\'abord, le respect des délais a été exemplaire. Mon site a été livré exactement dans les temps, ce qui était essentiel pour mon projet. La communication avec l\'équipe a été fluide et professionnelle tout au long du processus, ce qui m\'a permis de rester informé de l\'avancement du projet à chaque étape.\r\n\r\nEn ce qui concerne le résultat final, je suis tout simplement ravi. Mon site correspond parfaitement à mes attentes et à ma vision initiale. La qualité du design, la convivialité de l\'interface et les fonctionnalités intégrées sont toutes remarquables. De plus, le site est parfaitement réactif et s\'adapte à toutes les tailles d\'écran, ce qui est essentiel de nos jours.\r\n\r\nEnfin, je tiens à souligner la grande attention portée aux détails. Chaque élément du site a été soigneusement examiné et testé pour assurer son bon fonctionnement. Cela montre le professionnalisme de l\'équipe et son engagement envers la qualité.\r\n\r\nEn résumé, je ne pourrais pas être plus satisfait de la livraison de mon site internet. C\'est une équipe hautement compétente et professionnelle qui a fait un travail exceptionnel. Je recommande vivement leurs services à quiconque recherche une livraison de site internet de haute qualité, conforme à ses attentes. Merci encore pour cette expérience exceptionnelle !', '2023-08-19', 4),
(67, 730, 'Très agréablement surpris! Une livraison dans les temps, avec un design plutôt élégant. Je recommande.', '2023-10-04', 4),
(68, 16, 'Je suis extrêmement satisfait de la qualité et de la créativité du site web que KodingCore Developpment a conçu pour mon entreprise. Leur équipe a su capturer parfaitement notre vision et la mettre en œuvre de manière professionnelle. Bravo pour un travail exceptionnel !', '2023-10-03', 3),
(69, 15, 'La collaboration avec KodingCore Developpment a été une expérience exceptionnelle. Leur équipe a été à l\'écoute de nos besoins, a répondu rapidement à nos demandes et a apporté des idées innovantes. La livraison du site a été rapide et le résultat final dépasse nos attentes.', '2023-09-21', 3),
(70, 747, 'Je tiens à exprimer ma gratitude envers KodingCore Developpment pour leur réactivité et leur professionnalisme. Le processus de livraison a été transparent, et ils ont été rapides à résoudre les éventuels problèmes. Notre nouveau site web est exactement ce dont nous avions besoin.', '2023-09-13', 3),
(71, 7, 'KodingCore Developpment ne se contente pas de créer des sites web, ils créent des œuvres d\'art numériques. La conception visuelle de notre site est à couper le souffle, et leur attention aux détails est évidente à chaque page. Merci pour une expérience de création unique.', '2023-09-16', 3),
(72, 731, 'La performance du site web que nous avons reçu de KodingCore Developpment est exceptionnelle. Les temps de chargement sont rapides, la navigation est fluide, et nous avons déjà reçu des commentaires positifs de nos visiteurs. Merci pour un site web qui se démarque.', '2023-09-10', 4),
(73, 5, 'KodingCore Developpment a mis l\'expérience utilisateur au premier plan dans la conception de notre site web. La navigation est intuitive, et chaque fonctionnalité est pensée pour rendre la visite du site agréable. Nous sommes ravis du résultat.', '2023-09-27', 3);

-- --------------------------------------------------------

--
-- Structure de la table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_description` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `templates`
--

INSERT INTO `templates` (`template_id`, `category_id`, `name`, `description`, `image_path`, `image_description`, `created_at`, `updated_at`) VALUES
(42, 3, 'e-commerce produits audio', 'Site créer pour une grande entreprise, dans la vente de produits audios. ', 'assets\\images\\templates\\sites-vente-e-commerce\\e-commerce_audiovisual.jpg', 'Template avec une bannière dans les montagne au crépuscule avec du brouillard vue du ciel, dans la partie inférieur des enceintes et des casques audios', '2023-08-28', NULL),
(54, 3, 'Site artisanat cuir', 'Site créer pour une entreprise, dans la vente de divers objets d\'artisanat du cuir', 'assets\\images\\templates\\sites-vente-e-commerce\\e-commerce_cuir.jpg', 'Template avec un fond qui comporte des présentoirs de bracelets de montres en cuir. Au premier plan il y a une présentation de chaussures en cuir, vestes, et sacs en cuir', '2023-08-28', NULL),
(55, 3, 'Sacs et accessoires', 'Site e-commerce de vente de divers sacs et accessoires féminins.', 'assets\\images\\templates\\sites-vente-e-commerce\\e-commerce_lunettes-sacs.jpg', 'Template sur un fond blanc, orange fondu, devant lequel se trouve au premier plan, une présentation de produits, sacs, lunettes féminin', '2023-08-28', NULL),
(56, 3, 'Mode et divers', 'Site de vente e-commerce de vêtements et accessoires en tout genre', 'assets\\images\\templates\\sites-vente-e-commerce\\e-commerce_multi-mode.jpg', 'Template avec une bannière avec une rue flouté et orangé en image de fond, au premier plan il y a un sac et un homme barbue qui porte la marque, en dessous il y a une variété de produits de la marque, comme des chaussures, une veste', '2023-08-28', NULL),
(57, 3, 'E-commerce sport', 'Un site e-commerce créer pour un magasin de sport', 'assets\\images\\templates\\sites-vente-e-commerce\\e-commerce_sport-chaussures.jpg', 'Template avec une bannière floutée noir sur laquelle il ya une chaussure rouge de la marque, en dessous il y a une liste des chaussures de la marque ', '2023-08-28', NULL),
(58, 51, 'Artiste musicien', 'Un site vitrine pour un artiste musicien et son groupe', 'assets\\images\\templates\\sites-vitrine\\vitrine_artiste.jpg', 'Template avec une moitié vertical en bannière et l\'autre avec des articles sur un fond sombre, la bannière représente l\'artiste chantant dans une explosion de couleurs', '2023-08-28', NULL),
(59, 51, 'Parc nature', 'Un site pour un parc d\'atraction nature', 'assets\\images\\templates\\sites-vitrine\\vitrine_park.jpg', 'Template avec un fond qui représente le parc vue du ciel, dans la partie inférieur, on retrouve des articles sur les différentes activités', '2023-08-28', NULL),
(60, 51, 'Bien-être et plantes', 'Un site e-commerce de vente de produit de soins à base de plantes', 'assets\\images\\templates\\sites-vitrine\\vitrine_plantes.jpg', 'Template avec une bannière qui représente des pots de fleurs sur des étagères, au centre de cette bannière se trouve le logo de l\'entreprise, et en dessous, des articles sur les différents services', '2023-08-28', NULL),
(61, 51, 'Agence de voyage', 'Un site internet pour une agence de voyage au États-Unis', 'assets\\images\\templates\\sites-vitrine\\vitrine_promote.jpg', 'Template avec une bannière qui représente des avions qui volent autour de formes géométriques sur un fond coloré, et des articles sur les prestations disponibles', '2023-08-28', NULL),
(62, 50, 'Agence immobilière', 'Un site internet pour une agence immobilière a Manathan', 'assets\\images\\templates\\sites-artisants-services\\agencement-immobilier.jpg', 'Template avec une bannière qui représente la ville vue de du ciel la nuit, en dessous il y a des articles de services de l\'agence ', '2023-08-28', NULL),
(63, 50, 'Artisant boulanger', 'Site pour un petit artisan boulanger', 'assets\\images\\templates\\sites-artisants-services\\artisant-boulang.jpg', NULL, '2023-08-28', NULL),
(64, 50, 'Artisant maçon', 'Site pour un petit artisan maçon', 'assets\\images\\templates\\sites-artisants-services\\artisant-maconery.jpg', NULL, '2023-08-28', NULL),
(65, 50, 'Entreprise techno', 'Site pour entreprise dans le domaine de la technologie électronique', 'assets\\images\\templates\\sites-artisants-services\\electronic.jpg', NULL, '2023-08-28', NULL),
(66, 50, 'Therapie, médical', 'Site pour un centre thérapeutique, de bien-être et de soins', 'assets\\images\\templates\\sites-artisants-services\\medical-therapy.jpg', NULL, '2023-08-28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(5, 'Francis', 'Francis@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(6, 'Kévin', 'Kévin@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(7, 'Sophie', 'Sophie@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(9, 'Pierre', 'Pierre@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(10, 'Viriginie', 'Viriginie@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(11, 'Toyö', 'Toyö@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(12, 'Michel', 'Michel@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(13, 'Adèle', 'Adèle@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(14, 'Maël', 'Maël@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(15, 'Hélene', 'Hélene@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(16, 'Halley', 'Halley@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(18, 'Christophe', 'Christophe@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(19, 'Bob', 'Bob@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(20, 'Richard', 'Richard@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(730, 'Lightway', 'kcorvais@gmail.com', '$2y$10$rOlQkHdU6yHXQNyYCFteU.8TmdWhMrYuJ8voDhL3N8yTW2r3RooXu', 'admin'),
(731, 'Joey', 'joey@gmail.com', '$2y$10$IW8zFneUzKtuhKS5qhnYVuv5z67D/8MVWu0eSInCH9ORpcSZPdwM2', 'user'),
(732, 'moi', 'moi@moi.moi', '$2y$10$dU29nTAJ8bF0fb94vj/DF.3NZr5VpGHJ2cxuGyYylv2l8UZUstcqu', 'user'),
(733, 'rachel', 'rachel.cailliere@gmx.fr', '$2y$10$dKbiLxVdmtuODvEgGg5V7OeKZXbe8JuZuyew6WZtycrl/QBR4dzFG', 'user'),
(747, 'Joris', 'joris@gmail.com', '$2y$10$G40Pk/94rvJlwYhcpKd4fuXeqtlGbfl71fs66VGXY233zRHBTYLMe', 'user'),
(748, 'Mikael', 'mikael@exemple.com', '$2y$10$SULEk5b1/P4jYxK/2tNNM.6YQAsQU388j8PhEDLGXKFzRxXSsXRBO', 'user'),
(749, 'joe', 'joe@exemple.com', '$2y$10$0rWEWBNKQFzDjFx4v3JVG.ejDuC39WmBxxuwu/HZ5j6OkATucFRvK', 'user'),
(750, 'greg', 'greg@exemple.com', '$2y$10$brK8JVcxGbXphrymc/9Pb.Jjv9Rla9mOYMlFkY6pfYod4AdomwuOq', 'user'),
(751, 'franck', 'franck@exemple.com', '$2y$10$2sE4hqyTlhjk5Wxd7Xjite5keNX/pjUXs07hSzD.W0FCNfdtu/lXO', 'user'),
(752, 'francky', 'francky@exemple.com', '$2y$10$gY2ioWjRQh.ULVGXeW8FTuWcEpMpNUyB/rqmZ0yuOBwqWzLp4MP7i', 'user'),
(753, 'marcel', 'marcel@exemple.com', '$2y$10$xIhpmHI49s3iNea3qjKb0.nu.KhVfqapB.s0KUDhv16lm20jTobHO', 'user'),
(761, 'kodingcore', 'kodingcore@gmail.com', '$2y$10$qaFv0wUwnSfJ1NYuTVm4ie00dyBrSHKmY.JmNdzcFO2ODxbVSecAq', 'user'),
(762, 'admin', 'admintest@test.com', '$2y$10$J5.VgbQILSvig8AQQXjGIefipOYuBBLbcWz9xuSOABYMLBr9bhtpe', 'user'),
(763, 'user', 'usertest@test.com', '$2y$10$atXB9D4jN30mhdOtT4w9T.hdBAAR8oOGLXR5G73IlRAA7Iq1B/H9a', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`quotation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Index pour la table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=764;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `infos`
--
ALTER TABLE `infos`
  ADD CONSTRAINT `infos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `quotations_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Contraintes pour la table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
