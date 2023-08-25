-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 25 août 2023 à 06:26
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

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
CREATE DATABASE IF NOT EXISTS `kevincorvaisier_kodingcore_bddpro`;
USE `kevincorvaisier_kodingcore_bddpro`;

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `InsertAppointments`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertAppointments` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 10 DO
        INSERT INTO appointments (user_id, appointment_date, appointment_time, communication_preference)
        VALUES (
            FLOOR(1 + RAND() * 10), -- Remplacez par la plage d'ID d'utilisateurs
            DATE_ADD(CURRENT_DATE, INTERVAL (10 + i) DAY),
            TIME(NOW()) + INTERVAL i HOUR,
            'Email'
        );
        SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertAppointments
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertAppointments` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertInfos`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertInfos` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 20 DO
        INSERT INTO infos (info_id, user_id, first_name, last_name, tel, address, zip, city) 
        VALUES (
			i,
            i,
            CASE 
                WHEN i % 20 = 1 THEN CONCAT('Joe')
                WHEN i % 20 = 2 THEN CONCAT('Jane')
                WHEN i % 20 = 3 THEN CONCAT('Sarah')
                WHEN i % 20 = 4 THEN CONCAT('Claire')
                WHEN i % 20 = 5 THEN CONCAT('Francis')
                WHEN i % 20 = 6 THEN CONCAT('Kévin')
                WHEN i % 20 = 7 THEN CONCAT('Sophie')
                WHEN i % 20 = 8 THEN CONCAT('Alain')
                WHEN i % 20 = 9 THEN CONCAT('Pierre')
                WHEN i % 20 = 10 THEN CONCAT('Viriginie')
                WHEN i % 20 = 11 THEN CONCAT('Toyö')
                WHEN i % 20 = 12 THEN CONCAT('Michel')
                WHEN i % 20 = 13 THEN CONCAT('Adèle')
                WHEN i % 20 = 14 THEN CONCAT('Maël')
                WHEN i % 20 = 15 THEN CONCAT('Hélene')
                WHEN i % 20 = 16 THEN CONCAT('Halley')
                WHEN i % 20 = 16 THEN CONCAT('Kristine')
                WHEN i % 20 = 18 THEN CONCAT('Christophe')
                WHEN i % 20 = 19 THEN CONCAT('Bob')
                WHEN i % 20 = 0 THEN CONCAT('Richard')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('Joe', i)
            END,
                CASE
                WHEN i % 20 = 1 THEN CONCAT('Joe')
                WHEN i % 20 = 2 THEN CONCAT('Jane')
                WHEN i % 20 = 3 THEN CONCAT('Smith')
                WHEN i % 20 = 4 THEN CONCAT('Jane')
                WHEN i % 20 = 5 THEN CONCAT('Smith')
                WHEN i % 20 = 6 THEN CONCAT('Bert')
                WHEN i % 20 = 7 THEN CONCAT('Holly')
                WHEN i % 20 = 8 THEN CONCAT('Panzer')
                WHEN i % 20 = 9 THEN CONCAT('Val')
                WHEN i % 20 = 10 THEN CONCAT('Pavoit')
                WHEN i % 20 = 11 THEN CONCAT('Kokaï')
                WHEN i % 20 = 12 THEN CONCAT('Témoin')
                WHEN i % 20 = 13 THEN CONCAT('Dos')
                WHEN i % 20 = 14 THEN CONCAT('Troquet')
                WHEN i % 20 = 15 THEN CONCAT('Panzer')
                WHEN i % 20 = 16 THEN CONCAT('Troquet')
                WHEN i % 20 = 16 THEN CONCAT('Troquet')
                WHEN i % 20 = 18 THEN CONCAT('Dodin')
                WHEN i % 20 = 19 THEN CONCAT('Zen')
                WHEN i % 20 = 0 THEN CONCAT('Pluriel')
				WHEN i % 20 = 1 THEN CONCAT('Donney')
                    -- Ajoutez d'autres combinaisons ici
				ELSE CONCAT('Delamontre' + i)
			END,
			CASE 
				WHEN i % 20 = 1 THEN CONCAT('0621489631')
				WHEN i % 20 = 2 THEN CONCAT('0511480039')
				WHEN i % 20 = 3 THEN CONCAT('0605687639')
				WHEN i % 20 = 4 THEN CONCAT('0288889638')
				WHEN i % 20 = 5 THEN CONCAT('0325089632')
				WHEN i % 20 = 6 THEN CONCAT('0420169031')
				WHEN i % 20 = 7 THEN CONCAT('0683185633')
				WHEN i % 20 = 8 THEN CONCAT('0925489631')
				WHEN i % 20 = 9 THEN CONCAT('0680909636')
				WHEN i % 20 = 10 THEN CONCAT('0625289632')
				WHEN i % 20 = 11 THEN CONCAT('0621489668')
				WHEN i % 20 = 12 THEN CONCAT('0725409632')
				WHEN i % 20 = 13 THEN CONCAT('0615489654')
				WHEN i % 20 = 14 THEN CONCAT('0922480600')
				WHEN i % 20 = 15 THEN CONCAT('0625489635')
				WHEN i % 20 = 16 THEN CONCAT('0226489603')
                WHEN i % 20 = 17 THEN CONCAT('0226489603')
				WHEN i % 20 = 18 THEN CONCAT('0685489632')
				WHEN i % 20 = 19 THEN CONCAT('0725489652')
				WHEN i % 20 = 0 THEN CONCAT('0699489130')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('065879' + i)
            END,
            CASE 
                WHEN i % 20 = 1 THEN CONCAT('Rue de la Liberté')
                WHEN i % 20 = 2 THEN CONCAT('Avenue des Champs-Élysées Paris')
                WHEN i % 20 = 3 THEN CONCAT('Rue du Vieux Port, Marseile')
                WHEN i % 20 = 4 THEN CONCAT('Rue de la République')
                WHEN i % 20 = 5 THEN CONCAT('Place du Capitole')
                WHEN i % 20 = 6 THEN CONCAT('Rue de la Paix')
                WHEN i % 20 = 7 THEN CONCAT('Rue de la Gare')
                WHEN i % 20 = 8 THEN CONCAT('Rue Saint-Michel')
                WHEN i % 20 = 9 THEN CONCAT('Rue de la Cathédrale')
                WHEN i % 20 = 10 THEN CONCAT('Rue de la Grande Poste')
                WHEN i % 20 = 11 THEN CONCAT('Rue de la Plage')
                WHEN i % 20 = 12 THEN CONCAT('Rue de la Tour Eiffel')
                WHEN i % 20 = 13 THEN CONCAT('Avenue de la Libération')
                WHEN i % 20 = 14 THEN CONCAT('Rue du Vieux Moulin')
                WHEN i % 20 = 15 THEN CONCAT('Place de la Mairie')
                WHEN i % 20 = 16 THEN CONCAT('Rue des Lilas')
                WHEN i % 20 = 17 THEN CONCAT('Avenue Victor Hugo')
                WHEN i % 20 = 18 THEN CONCAT('Rue Saint-Jean')
                WHEN i % 20 = 19 THEN CONCAT('Rue de la Mer')
                WHEN i % 20 = 0 THEN CONCAT('Rue de la Montagne')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('Rue de la Liberté' + i)
            END,
            CASE 
				WHEN i % 20 = 1 THEN CONCAT('75001')
				WHEN i % 20 = 2 THEN CONCAT('75008')
				WHEN i % 20 = 3 THEN CONCAT('13001')
				WHEN i % 20 = 4 THEN CONCAT('69001')
				WHEN i % 20 = 5 THEN CONCAT('31000')
				WHEN i % 20 = 6 THEN CONCAT('06000')
				WHEN i % 20 = 7 THEN CONCAT('59000')
				WHEN i % 20 = 8 THEN CONCAT('33000')
				WHEN i % 20 = 9 THEN CONCAT('67000')
                WHEN i % 20 = 10 THEN CONCAT('44000')
				WHEN i % 20 = 11 THEN CONCAT('13008')
				WHEN i % 20 = 12 THEN CONCAT('75015')
				WHEN i % 20 = 13 THEN CONCAT('69003')
				WHEN i % 20 = 14 THEN CONCAT('31100')
				WHEN i % 20 = 15 THEN CONCAT('06300')
				WHEN i % 20 = 16 THEN CONCAT('59800')
				WHEN i % 20 = 17 THEN CONCAT('33100')
				WHEN i % 20 = 18 THEN CONCAT('67200')
				WHEN i % 20 = 19 THEN CONCAT('44300')
				WHEN i % 20 = 0 THEN CONCAT('13012')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('0658' + i)
            END, 
            CASE
                WHEN i % 20 = 1 THEN CONCAT('Paris')
				WHEN i % 20 = 2 THEN CONCAT('Paris')
				WHEN i % 20 = 3 THEN CONCAT('Marseille')
				WHEN i % 20 = 4 THEN CONCAT('Lyon')
				WHEN i % 20 = 5 THEN CONCAT('Toulouse')
				WHEN i % 20 = 6 THEN CONCAT('Nice')
				WHEN i % 20 = 7 THEN CONCAT('Lille')
				WHEN i % 20 = 8 THEN CONCAT('Bordeaux')
				WHEN i % 20 = 9 THEN CONCAT('Strasbourg')
				WHEN i % 20 = 10 THEN CONCAT('Nantes')
				WHEN i % 20 = 11 THEN CONCAT('Marseille')
				WHEN i % 20 = 12 THEN CONCAT('Paris')
				WHEN i % 20 = 13 THEN CONCAT('Lyon')
				WHEN i % 20 = 14 THEN CONCAT('Toulouse')
				WHEN i % 20 = 15 THEN CONCAT('Nice')
				WHEN i % 20 = 16 THEN CONCAT('Lille')
				WHEN i % 20 = 17 THEN CONCAT('Bordeaux')
				WHEN i % 20 = 18 THEN CONCAT('Strasbourg')
				WHEN i % 20 = 19 THEN CONCAT('Nantes')
                WHEN i % 20 = 0 THEN CONCAT('Marseille')
                
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('Marseille' + i)
            END
		);
		SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertInfos
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertInfos` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertMessages`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertMessages` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 11 DO
        INSERT INTO messages (message_id, user_id, subject, content, send_date_time) 
        VALUES (
			i,
            i,
            CASE 
                WHEN i % 11 = 1 THEN CONCAT('Help!')
                WHEN i % 11 = 2 THEN CONCAT('Mot de passe')
                WHEN i % 11 = 3 THEN CONCAT('Editer mes infos?')
                WHEN i % 11 = 4 THEN CONCAT('RDV')
                WHEN i % 11 = 5 THEN CONCAT('Rendez-Vous')
                WHEN i % 11 = 6 THEN CONCAT('Changement de plan!')
                WHEN i % 11 = 7 THEN CONCAT("besoin d'aide")
                WHEN i % 11 = 8 THEN CONCAT('RDV téléphonique')
                WHEN i % 11 = 9 THEN CONCAT('what?')
                WHEN i % 11 = 10 THEN CONCAT('Devis Janvier 2023')
                WHEN i % 11 = 0 THEN CONCAT('accord de mission')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('Help ', i)
            END,
                CASE
                WHEN i % 11 = 1 THEN CONCAT("Bonjour, je crois que j'ai égaré mon mot de passe. Comment puis-je le réinitialisé?")
                WHEN i % 11 = 2 THEN CONCAT("Bonjour, comment puis-je le réinitialisé?")
                WHEN i % 11 = 3 THEN CONCAT("Ou dois-je aller pour modifier mes infos? J'ai un message qui me dis de mettre à jour mes infos")
                WHEN i % 11 = 4 THEN CONCAT("Bonjour, je voudrais prendre un RDV avec vous. Quand seriez-vous disponible?")
                WHEN i % 11 = 5 THEN CONCAT("C'est ok pour le RDV dont nous avons parlé. Le 21 Octobre. Cordiallement")
                WHEN i % 11 = 6 THEN CONCAT("Stop! On change tout le projet! Je paierai les frais sup', j'tenvoie les news")
                WHEN i % 11 = 7 THEN CONCAT("Bonjour, comment changer mon username?")
                WHEN i % 11 = 8 THEN CONCAT("Je suis d'accord pour la date du RDV téléphonique, au sujet du projet de la gestions de nos graines")
                WHEN i % 11 = 9 THEN CONCAT('what?')
                WHEN i % 11 = 10 THEN CONCAT("Bonsoir, j'accepte votre dernier devis. Nous nous verront lors du rendez-vous. Bonne soirée à vous")
                WHEN i % 11 = 0 THEN CONCAT("C'est ok pour notre projet!")
                    -- Ajoutez d'autres combinaisons ici
				ELSE CONCAT('Delamontre' + i)
			END,
			CASE 
				WHEN i % 11 = 1 THEN CONCAT("2023-07-15 08:05:19")
                WHEN i % 11 = 2 THEN CONCAT("2023-07-26 08:30:34")
                WHEN i % 11 = 3 THEN CONCAT("2023-07-27 12:15:44")
                WHEN i % 11 = 4 THEN CONCAT("2023-07-27 12:30:25")
                WHEN i % 11 = 5 THEN CONCAT("2023-08-01 14:30:45")
                WHEN i % 11 = 6 THEN CONCAT("2023-08-02 16:00:45")
                WHEN i % 11 = 7 THEN CONCAT("2023-08-02 16:28:16")
                WHEN i % 11 = 8 THEN CONCAT("2023-08-06 16:30:17")
                WHEN i % 11 = 9 THEN CONCAT('2023-08-10 18:30:08')
                WHEN i % 11 = 10 THEN CONCAT("2023-08-12 19:18:50")
                WHEN i % 11 = 0 THEN CONCAT("2023-08-15 20:20:45")
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('2023-08-1' + i + ' 20:20:45')
            END
		);
		SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertMessages
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertMessages` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertQuotations`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertQuotations` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 10 DO
        INSERT INTO quotations (user_id, template_id, quotation_date, content, expiration_date)
        VALUES (
            FLOOR(1 + RAND() * 20), -- Remplacez par la plage d'ID d'utilisateurs
            FLOOR(1 + RAND() * 9), -- Remplacez par la plage d'ID de templates
            DATE_ADD(CURRENT_DATE, INTERVAL -i DAY),
            CONCAT('Contenu de la quotation ', i),
            DATE_ADD(CURRENT_DATE, INTERVAL (10 + i) DAY)
        );
        SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertQuotations
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertQuotations` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertRealisticUsers`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertRealisticUsers` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 20 DO
        INSERT INTO users (user_id, username, email, password, role) 
        VALUES (
			i,
            CASE 
                WHEN i % 20 = 1 THEN CONCAT('Joe')
                WHEN i % 20 = 2 THEN CONCAT('Jane')
                WHEN i % 20 = 3 THEN CONCAT('Sarah')
                WHEN i % 20 = 4 THEN CONCAT('Claire')
                WHEN i % 20 = 5 THEN CONCAT('Francis')
                WHEN i % 20 = 6 THEN CONCAT('Kévin')
                WHEN i % 20 = 7 THEN CONCAT('Sophie')
                WHEN i % 20 = 8 THEN CONCAT('Alain')
                WHEN i % 20 = 9 THEN CONCAT('Pierre')
                WHEN i % 20 = 10 THEN CONCAT('Viriginie')
                WHEN i % 20 = 11 THEN CONCAT('Toyö')
                WHEN i % 20 = 12 THEN CONCAT('Michel')
                WHEN i % 20 = 13 THEN CONCAT('Adèle')
                WHEN i % 20 = 14 THEN CONCAT('Maël')
                WHEN i % 20 = 15 THEN CONCAT('Hélene')
                WHEN i % 20 = 16 THEN CONCAT('Halley')
                WHEN i % 20 = 18 THEN CONCAT('Christophe')
                WHEN i % 20 = 19 THEN CONCAT('Bob')
                WHEN i % 20 = 0 THEN CONCAT('Richard')
                -- Ajoutez d'autres combinaisons ici
                ELSE CONCAT('DefaultName', i)
            END,
            CONCAT(
                CASE
                WHEN i % 20 = 2 THEN CONCAT('Jane')
                WHEN i % 20 = 3 THEN CONCAT('Sarah')
                WHEN i % 20 = 4 THEN CONCAT('Claire')
                WHEN i % 20 = 5 THEN CONCAT('Francis')
                WHEN i % 20 = 6 THEN CONCAT('Kévin')
                WHEN i % 20 = 7 THEN CONCAT('Sophie')
                WHEN i % 20 = 8 THEN CONCAT('Alain')
                WHEN i % 20 = 9 THEN CONCAT('Pierre')
                WHEN i % 20 = 10 THEN CONCAT('Viriginie')
                WHEN i % 20 = 11 THEN CONCAT('Toyö')
                WHEN i % 20 = 12 THEN CONCAT('Michel')
                WHEN i % 20 = 13 THEN CONCAT('Adèle')
                WHEN i % 20 = 14 THEN CONCAT('Maël')
                WHEN i % 20 = 15 THEN CONCAT('Hélene')
                WHEN i % 20 = 16 THEN CONCAT('Halley')
                WHEN i % 20 = 18 THEN CONCAT('Christophe')
                WHEN i % 20 = 19 THEN CONCAT('Bob')
                WHEN i % 20 = 0 THEN CONCAT('Richard')
				WHEN i % 20 = 1 THEN CONCAT('Joe')
                    -- Ajoutez d'autres combinaisons ici
                    ELSE CONCAT('default', i)
                END,
                '@example.com'
            ),
            UUID(),
            'user'
        );

        SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertRealisticUsers
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertRealisticUsers` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertReviews`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertReviews` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 10 DO
        INSERT INTO reviews (user_id, template_id, content, send_date)
        VALUES (
            FLOOR(1 + RAND() * 20), -- Remplacez par la plage d'ID d'utilisateurs
            FLOOR(1 + RAND() * 9), -- Remplacez par la plage d'ID de templates
            CONCAT('Contenu de la review ', i),
            DATE_ADD(CURRENT_DATE, INTERVAL -i DAY)
        );
        SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertReviews
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertReviews` TO 'kevincorvaisier'@'db.3wa.io';

DROP PROCEDURE IF EXISTS `InsertTags`$$
CREATE DEFINER=`kevincorvaisier`@`db.3wa.io` PROCEDURE `InsertTags` ()   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 10 DO
        INSERT INTO tags (user_id, template_id, tag_name)
        VALUES (
            FLOOR(1 + RAND() * 20), -- Remplacez par la plage d'ID d'utilisateurs
            FLOOR(1 + RAND() * 9), -- Remplacez par la plage d'ID de templates
            CONCAT('Tag ', i)
        );
        SET i = i + 1;
    END WHILE;
END$$

-- Accord de privilèges EXECUTE sur la procédure InsertTags
GRANT EXECUTE ON PROCEDURE `kevincorvaisier`.`InsertTags` TO 'kevincorvaisier'@'db.3wa.io';

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `communication_preference` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `appointment_date`, `appointment_time`, `communication_preference`) VALUES
(1, 1, '2023-09-01', '18:05:51', 'Email'),
(2, 7, '2023-09-02', '19:05:51', 'Email'),
(3, 4, '2023-09-03', '20:05:51', 'Email'),
(4, 7, '2023-09-04', '21:05:51', 'Email'),
(6, 10, '2023-09-06', '23:05:51', 'Email'),
(11, 18, '2023-08-31', '12:55:00', 'Téléphone');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(3, 'e-commerce', 'site de e-commerce vente en gros mageule'),
(4, 'e-commer', 'site de e-commerce vente en gros mageule'),
(5, 'e-commerce', 'site de e-commerce vente en gros mageule'),
(6, 'e-commerce', 'site de e-commerce vente en gros mageule'),
(7, 'test', 'ezezezezezezez'),
(8, 'reg', 'eloelfokerjvhbfdv,vfndsjkdkfckdovnfjksdkkvofenfj'),
(9, 'reg', 'eloelfokerjvhbfdv,vfndsjkdkfckdovnfjksdkkvofenfj'),
(10, 'reg', 'eloelfokerjvhbfdv,vfndsjkdkfckdovnfjksdkkvofenfj'),
(49, 'categNew', 'ceci est une categ');

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

DROP TABLE IF EXISTS `infos`;
CREATE TABLE IF NOT EXISTS `infos` (
  `info_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`info_id`, `user_id`, `first_name`, `last_name`, `tel`, `address`, `zip`, `city`) VALUES
(1, 1, 'Joe', 'Joe', '0621489631', 'Rue de la Liberté', '75001', 'Paris'),
(4, 4, 'Claire', 'Jane', '0288889638', 'Rue de la République', '69001', 'Lyon'),
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
(17, 17, 'Joe17', '17', '0226489603', 'Avenue Victor Hugo', '33100', 'Bordeaux'),
(18, 18, 'Christophe', 'Dodin', '0685489632', 'Rue Saint-Jean', '67200', 'Strasbourg'),
(19, 19, 'Bob', 'Zen', '0725489652', 'Rue de la Mer', '44300', 'Nantes'),
(20, 20, 'Richard', 'Pluriel', '0699489130', 'Rue de la Montagne', '13012', 'Marseille'),
(114, 716, 'Kévin', 'Corvaisier', NULL, NULL, NULL, 'la motte 8'),
(115, 717, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 718, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `subject` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `send_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `subject`, `content`, `send_date_time`) VALUES
(5, 5, 'Rendez-Vous', 'C\'est ok pour le RDV dont nous avons parlé. Le 21 Octobre. Cordiallement', '2023-08-01 14:30:45'),
(6, 6, 'Changement de plan!', 'Stop! On change tout le projet! Je paierai les frais sup\', j\'tenvoie les news', '2023-08-02 16:00:45'),
(7, 7, 'besoin d\'aide', 'Bonjour, comment changer mon username?', '2023-08-02 16:28:16'),
(9, 9, 'what?', 'what?', '2023-08-10 18:30:08'),
(10, 10, 'Devis Janvier 2023', 'Bonsoir, j\'accepte votre dernier devis. Nous nous verront lors du rendez-vous. Bonne soirée à vous', '2023-08-12 19:18:50'),
(11, 11, 'accord de mission', 'C\'est ok pour notre projet!', '2023-08-15 20:20:45');

-- --------------------------------------------------------

--
-- Structure de la table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
CREATE TABLE IF NOT EXISTS `quotations` (
  `quotation_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `template_id` int DEFAULT NULL,
  `quotation_date` date DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`quotation_id`),
  KEY `user_id` (`user_id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quotations`
--

INSERT INTO `quotations` (`quotation_id`, `user_id`, `template_id`, `quotation_date`, `content`, `expiration_date`) VALUES
(11, 1, 50, '2023-08-10', 'hah', '2023-09-07');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `template_id` int DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `send_date` date DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `template_id`, `content`, `send_date`) VALUES
(1, 12, 5, 'Contenu de la review 1', '2023-08-20'),
(2, 18, 7, 'Contenu de la review 2', '2023-08-19');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `template_id` int DEFAULT NULL,
  `tag_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `user_id` (`user_id`),
  KEY `template_id` (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`tag_id`, `user_id`, `template_id`, `tag_name`) VALUES
(3, 11, 9, 'Tag 3'),
(8, 5, 2, 'Tag 8');

-- --------------------------------------------------------

--
-- Structure de la table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `template_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`template_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `templates`
--

INSERT INTO `templates` (`template_id`, `category_id`, `name`, `description`, `image_path`, `price`, `created_at`, `updated_at`) VALUES
(42, 3, 'qsddgxf', 'gdfhggfjg', 'gfdhjghk', '333.12', '2023-08-24', NULL),
(45, NULL, 'gfhfgh', 'hdfghdgd', 'gfhdgf', '333.00', '2023-08-23', NULL),
(46, 3, 'fsdegffdgf', 'gfdhfsh', 'hdfjyufk', '555.00', '2023-08-16', '2023-08-24'),
(47, NULL, 'dfsqfs', 'fsqfsq', 'fqsfq', '555.00', '2023-08-22', NULL),
(48, NULL, 'gdgfd', 'gfdgfdh', 'fdhfdh', '11.00', '2023-08-23', NULL),
(50, 3, 'gdgfd', 'Je change la description et edite le template', 'fdhfdh', '11.00', '2023-08-23', NULL),
(51, NULL, 'gdgfd', 'gfdgfdh', 'fdhfdh', '11.00', '2023-08-23', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=720 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Joe', 'Joe@example.com', 'd7e918a53b9111ee98827fa7c9fb8ed4', 'user'),
(4, 'Claire', 'Claire@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
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
(17, 'DefaultName17', 'default17@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(18, 'Christophe', 'Christophe@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(19, 'Bob', 'Bob@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(20, 'Richard', 'Richard@example.com', 'd7e9b0e33b9111ee98827fa7c9fb8ed4', 'user'),
(716, 'lightway', 'kcorvais@gmail.com', '$2y$10$GQ5quHskUFS/.2ej1aDfe.PIeavLr4su8WnWtsPYggoMugLAnAwXO', 'admin'),
(717, 'test', 'test@test.test', '$2y$10$n3mwb2g/lEy8s/iZfofolu0Jb181Ax9BWevgoPHAHZoJ51YwKshOG', 'user'),
(718, 'light', 'kevin.c_du_35@gmail.com', '$2y$10$im3RXN8IrT4TaPl7sKDhy.SXreQbVL1ZVQqS.xS6cUioBRsgaZU3i', 'admin');

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
  ADD CONSTRAINT `quotations_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`);

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`);

--
-- Contraintes pour la table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`);

--
-- Contraintes pour la table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
