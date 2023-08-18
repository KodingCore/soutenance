USE kodingcore_bddpro;
DROP PROCEDURE IF EXISTS InsertMessages;

DELIMITER //
CREATE PROCEDURE InsertMessages()
BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 11 DO
        INSERT INTO messages (message_id, user_id, subject, content, send_date_time) 
        VALUES (
			i,
            i,
            CASE 
                WHEN i % 11 = 1 THEN 'Help!'
                WHEN i % 11 = 2 THEN 'Mot de passe'
                WHEN i % 11 = 3 THEN 'Editer mes infos?'
                WHEN i % 11 = 4 THEN 'RDV'
                WHEN i % 11 = 5 THEN 'Rendez-Vous'
                WHEN i % 11 = 6 THEN 'Changement de plan!'
                WHEN i % 11 = 7 THEN "besoin d'aide"
                WHEN i % 11 = 8 THEN 'RDV téléphonique'
                WHEN i % 11 = 9 THEN 'what?'
                WHEN i % 11 = 10 THEN 'Devis Janvier 2023'
                WHEN i % 11 = 0 THEN 'accord de mission'
                ELSE CONCAT('Help ', i)
            END,
            CASE
                WHEN i % 11 = 1 THEN "Bonjour, je crois que j'ai égaré mon mot de passe. Comment puis-je le réinitialiser? Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, velit eget feugiat gravida, elit risus congue velit."
                WHEN i % 11 = 2 THEN "Bonjour, comment puis-je réinitialiser mon mot de passe? Ut commodo odio sed arcu ultricies, ac convallis sapien iaculis. Fusce quis feugiat elit."
                WHEN i % 11 = 3 THEN "Où dois-je aller pour modifier mes informations? J'ai reçu un message me demandant de mettre à jour mes infos. Quisque sed nunc non nisl ullamcorper volutpat."
                WHEN i % 11 = 4 THEN "Bonjour, je voudrais prendre un rendez-vous avec vous. Quand seriez-vous disponible? Suspendisse eget quam id nulla efficitur tristique."
                WHEN i % 11 = 5 THEN "C'est d'accord pour le rendez-vous dont nous avons parlé. Le 21 Octobre à 14h. Cordialement, votre nom."
                WHEN i % 11 = 6 THEN "Arrêtez tout! Nous changeons complètement le projet! Je prends en charge les frais supplémentaires. Je vous enverrai les nouvelles informations sous peu."
                WHEN i % 11 = 7 THEN "Bonjour, comment puis-je changer mon nom d'utilisateur? Donec hendrerit tortor id mi dignissim, ac placerat eros varius."
                WHEN i % 11 = 8 THEN "Je suis d'accord pour la date du rendez-vous téléphonique concernant le projet de gestion de nos graines. Vivamus lacinia bibendum eros nec imperdiet."
                WHEN i % 11 = 9 THEN 'Quoi? Maecenas cursus ante nec dui fringilla, in tristique nisi feugiat.'
                WHEN i % 11 = 10 THEN "Bonsoir, j'accepte votre dernier devis. Nous nous verrons lors du rendez-vous prévu. Bonne soirée à vous!"
                WHEN i % 11 = 0 THEN "C'est parfait pour notre projet! On se tient au courant. Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                ELSE CONCAT('Contenu du message ', i)
            END,
            CASE 
                WHEN i % 11 = 1 THEN '2023-07-15 08:05:19'
                WHEN i % 11 = 2 THEN '2023-07-26 08:30:34'
                WHEN i % 11 = 3 THEN '2023-07-27 12:15:44'
                WHEN i % 11 = 4 THEN '2023-07-27 12:30:25'
                WHEN i % 11 = 5 THEN '2023-08-01 14:30:45'
                WHEN i % 11 = 6 THEN '2023-08-02 16:00:45'
                WHEN i % 11 = 7 THEN '2023-08-02 16:28:16'
                WHEN i % 11 = 8 THEN '2023-08-06 16:30:17'
                WHEN i % 11 = 9 THEN '2023-08-10 18:30:08'
                WHEN i % 11 = 10 THEN '2023-08-12 19:18:50'
                WHEN i % 11 = 0 THEN '2023-08-15 20:20:45'
                ELSE CONCAT('2023-08-1', i, ' 20:20:45')
            END
		);
		SET i = i + 1;
    END WHILE;
END //
DELIMITER ;

-- Appel de la procédure pour insérer les utilisateurs réalistes
CALL InsertMessages();
