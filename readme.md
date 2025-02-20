🎯 Plateforme de Financement Participatif - Symfony

🚀 Plateforme web permettant aux utilisateurs de proposer et financer des projets grâce à des dons.

📌 Fonctionnalités

✅ Inscription et connexion des utilisateurs✅ Création, édition et suppression de projets✅ Participation aux projets via des dons✅ Gestion des projets et des dons via un tableau de bord admin✅ Sécurisation des accès et rôles (admin, utilisateur)✅ Filtrage et recherche de projets et utilisateurs

⚡️ Pré-requis

Avant d'installer le projet, assure-toi d'avoir :

PHP 8+

Composer

Symfony CLI

MySQL (MariaDB)

Node.js & npm (pour le front si nécessaire)

🚀 Installation

1️⃣ Cloner le dépôt GitHub

git clone https://github.com/ton-utilisateur/nom-du-projet.git
cd nom-du-projet

2️⃣ Installer les dépendances PHP

composer install

3️⃣ Créer un fichier .env.local et configurer la base de données

DATABASE_URL="mysql://root:@127.0.0.1:3306/crowdfunding_db?serverVersion=10.4"

4️⃣ Créer la base de données et exécuter les migrations

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5️⃣ Lancer le serveur Symfony

symfony server:start

🔹 Accès au site : http://127.0.0.1:8000

🔑 Gestion des utilisateurs

Création d'un administrateur

php bin/console fos:user:create admin --super-admin

Les administrateurs ont accès au /admin/dashboard

Les utilisateurs peuvent s'inscrire et gérer leur profil /profile

🎨 Styles et Interface

✅ Bootstrap intégré pour un design moderne✅ Fichier public/css/styles.css pour les personnalisations

🔧 Commandes utiles

📌 Nettoyer le cache Symfony

php bin/console cache:clear

📌 Vérifier les routes

php bin/console debug:router

📌 Lancer les fixtures pour tester

php bin/console doctrine:fixtures:load

🤝 Contribuer

💡 Toute aide est la bienvenue ! Voici comment contribuer :

Fork le repo

Crée une branche (git checkout -b feature-ma-feature)

Fais tes modifications

Commit tes changements (git commit -m 'Ajout d’une nouvelle fonctionnalité')

Push la branche (git push origin feature-ma-feature)

Ouvre une pull request

📝 À améliorer

📌 Ajout d'un système de paiements Stripe📌 Intégration d'une API pour récupérer des statistiques avancées📌 Ajout d'un système de notifications

📜 Licence

📄 Ce projet est sous licence MIT.

🎉 Merci d'avoir consulté ce projet ! N'hésite pas à laisser une ⭐ sur GitHub ! 🚀