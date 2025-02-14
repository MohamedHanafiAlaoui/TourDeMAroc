# Tour de Maroc - Plateforme Digitale 🚴‍♂️

## Contexte du Projet

La fédération marocaine de cyclisme souhaite créer une plateforme digitale pour promouvoir le **Tour de Maroc**.

L'objectif est de permettre :
- Aux **fans** de suivre les étapes en direct.
- Aux **cyclistes** de partager leurs parcours et performances.
- Aux **organisateurs** de gérer efficacement l'événement.

## User Stories

### Visiteurs 🏁
- 👀 Visualiser les étapes de la course avec détails (lieux, horaires, distances).
- 🔍 Rechercher un cycliste, une équipe ou une étape via une barre de recherche avancée.
- 🎥 Regarder les vidéos des moments forts des étapes passées.
- 📜 Accéder à une section dédiée à l’histoire du Tour du Maroc.

### Fans 🏅
- 📝 S'inscrire et créer un profil utilisateur.
- 🔔 S'inscrire pour recevoir des notifications sur les étapes préférées.
- 🔑 Réinitialiser leur mot de passe.
- 📋 Créer une liste personnalisée de cyclistes à suivre (équipe virtuelle).
- 💬 Commenter les étapes et poser des questions aux cyclistes.
- ❤️ "Liker" une étape ou soutenir un cycliste pour gagner des badges.
- 🎛️ Filtrer les étapes par région, difficulté ou date.
- 🚨 Signaler une donnée incorrecte pour vérification.
- 🥇 Voir une page affichant le podium des trois premiers cyclistes.

### Cyclistes 🚵
- 🚴 S'inscrire et mettre à jour leurs informations personnelles.
- 📸 Ajouter leurs performances et photos.
- 📊 Consulter une analyse détaillée de leurs performances :
  - ⚡ Vitesse moyenne par étape.
  - 🔄 Comparaison avec d’autres cyclistes.
  - 🏆 Points et classements.

### Administrateurs 📌
- ➕ Ajouter des étapes, catégories et défis spéciaux.
- ✅ Valider les commentaires et gérer les contenus.
- 📧 Valider les données partagées par les cyclistes.
- 📈 Consulter les statistiques détaillées sur les interactions et suivis.
- 🌟 Ajouter une section de classement des fans basée sur l'activité (likes, commentaires, etc.).

### Fonctionnalités Avancées 🔥
- ⏱️ Calcul des temps cumulés et classements :
  - 🏆 Classement général.
  - ⛰️ Meilleur grimpeur.
  - 🚀 Meilleur sprinteur.
- ⏳ Gestion des écarts de temps entre cyclistes.
- 🔄 Détection des égalités (priorisation par ordre d'arrivée à la dernière étape).

## Technologies Utilisées 🛠️

### Backend
- **PHP MVC & PostgreSQL**
- **PHP 8.x** – Gestion du backend.
- **PostgreSQL** – Base de données relationnelle.
- **PDO** – Sécurisation des requêtes SQL.
- **Composer** – Gestionnaire de dépendances PHP.

### Frontend
- **HTML5, CSS3, JavaScript (ES6)** – Interface utilisateur.
- **Bootstrap 5** ou **TailwindCSS** – Design responsive.
- **AJAX (Fetch API & jQuery)** – Chargement dynamique.

### Sécurité & Outils
- **.htaccess** – Sécurisation et réécriture d’URL.
- **Session Based Authentication** – Authentification sécurisée.
- **Classes Validator & Security** – Protection contre XSS, CSRF, SQL Injection.
- **Gestion des sessions sécurisées** (Class Session).

---