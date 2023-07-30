# Plan pour mon site de développeur web freelance

## Inscription
- Formulaire d'inscription pour les utilisateurs
- Système de gestion des comptes utilisateur

## Templates
- Galerie de mes templates de sites web
- Description et démonstration de chaque template

## Portfolio
- Présentation de mes projets antérieurs en tant que développeur web
- Liens vers les sites que j'ai créés

## Rendez-vous
- Calendrier pour la prise de rendez-vous
- Formulaire de demande de rendez-vous

## Avis
- Système de notation et de commentaires laissés par les clients
- Affichage des avis sur mon travail

## Devis
- Liste des templates disponibles à la vente
- Formulaire de demande de devis en fonction des choix des clients

- Inscription
- Templates
- Portfolio
- Rendez-vous
- Avis
- Devis


Merci de fournir les détails de votre base de données. D'après les informations que vous avez partagées, voici un aperçu des tables et de leurs colonnes :

1. Table "quotations": //*devis
   - quotation_id (int)
   - user_id (int)
   - description (text)
   - amount (int)
   - date_created (datetime)
   - expiration_date (datetime)

2. Table "user-infos": //*infos utilisateurs
   - info_id (int)
   - user_id (int, nullable)
   - first_name (varchar(50), nullable)
   - last_name (varchar(50), nullable)
   - phone_number (varchar(20), nullable)
   - address (varchar(200), nullable)
   - town (varchar(50), nullable)
   - zip (varchar(50), nullable)
   - country (varchar(50), nullable)

3. Table "orders": //commandes
   - order_id (int)
   - user_id (int)
   - order_date (datetime)
   - total_amount (int)
   - status (varchar(20))
   - payment_terms (datetime)

4. Table "folio-projects": //projets du porte folio
   - project_id (int)
   - project_name (varchar(100))
   - description (text)
   - technologies_used (varchar(200))

5. Table "shop-templates": //templates du shop
   - project_id (int)
   - project_name (varchar(100))
   - description (text)
   - technologies_used (varchar(200))

6. Table "quote_requests":
   - request_id (int)
   - project_id (int)
   - user_id (int)
   - request_date (datetime)
   - message (text)

7. Table "folio-reviews":
   - review_id (int)
   - user_id (int)
   - review_text (text)
   - rating (int)
   - date_created (datetime)

8. Table "users":
   - user_id (int)
   - username (varchar(50))
   - email (varchar(50))
   - password_hash (varchar(60))
   - role (tinyint(1))

9. Table "general-reviews":
   - review_id (int)
   - user_id (int)
   - review_text (text)
   - rating (int)
   - date_created (datetime)

10. Table "templates-reviews":
   - review_id (int)
   - user_id (int)
   - review_text (text)
   - rating (int)
   - date_created (datetime)


<!-- 
9. **Table "template"** : Si vous prévoyez de proposer des templates de sites web, vous pouvez envisager de créer une table dédiée pour stocker les informations relatives à chaque template, telles que le nom du template, la description, les technologies utilisées, etc.

10. **Table "appointments"** : Si vous souhaitez permettre aux clients de prendre rendez-vous, vous pouvez créer une table pour gérer les rendez-vous, en enregistrant les détails comme la date et l'heure du rendez-vous, le nom du client, etc.

11. **Table "template_reviews"** : Si vous souhaitez recueillir des avis spécifiques sur chaque template, vous pouvez créer une table pour stocker les avis et les notes des utilisateurs concernant chaque template. -->