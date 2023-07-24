# Description de la base de donnée soutenance


## Table "users"
***(pour stocker les informations sur les utilisateurs de votre site) :***

1. user_id(PK, clé primaire) : INT
2. username : VARCHAR(50)
3. email : VARCHAR(100)
4. password_hash : VARCHAR(100)
5. role : VARCHAR(20)


## Table "infos"
***(pour stocker des informations complémentaires sur le profil de l'utilisateur) :***

1. info_id (PK, clé primaire) : INT
2. user_id (FK, clé étrangère faisant référence à la table "users") : INT
3. full_name : VARCHAR(100)
4. phone_number : VARCHAR(20)
5. address : VARCHAR(200)
6. bio : TEXT
7. website : VARCHAR(100)


## Table "orders"
***(pour stocker les informations sur les commandes passées par les clients) :***

1. order_id (PK, clé primaire) : INT
2. user_id (FK, clé étrangère faisant référence à la table "users") : INT
3. order_date : DATE
4. total_amount : DECIMAL(10, 2)
5. status : VARCHAR(20)


## Table "cotations"
***(pour stocker les devis envoyés aux clients) :***

1. cotation_id (PK, clé primaire) : INT
2. user_id (FK, clé étrangère faisant référence à la table "users") : INT
3. description : TEXT
4. amount : DECIMAL(10, 2)
5. date_created : DATETIME


## Table "reviews"
***(pour recueillir les avis et commentaires des clients) :***

1. review_id (PK, clé primaire) : INT
2. user_id (FK, clé étrangère faisant référence à la table "users") : INT
3. review_text : TEXT
4. rating : INT
5. date_created : DATETIME


## Table "projects"
***(pour présenter votre portefeuille de projets) :***

1. project_id (PK, clé primaire) : INT
2. user_id (FK, clé étrangère faisant référence à la table "users") : INT
3. project_name : VARCHAR(100)
4. description : TEXT
5. completion_date : DATE
6. technologies_used : VARCHAR(200)
7. request_quote : BOOLEAN (ou TINYINT si la base de données ne prend pas en charge le type BOOLEAN)


## "Table "quote_requests"
***(pour stocker les demandes de devis associées à des projets) :***
1. request_id (PK, clé primaire) : INT
2. project_id (FK, clé étrangère faisant référence à la table "projects") : INT
3. user_id (FK, clé étrangère faisant référence à la table "users") : INT
4. request_date : DATETIME
5. message : TEXT
