# Trajet à vide

## Description
L'application "Trajet à vide" est une plateforme permettant de connecter des transporteurs ayant des trajets à vide avec des passagers ou des industriels à la recherche de ces trajets. Elle vise à optimiser l'utilisation des ressources en transport et à réduire les trajets inutiles.

## Fonctionnalités principales
- **Création de comptes** : Deux types de comptes sont disponibles :
  - **Transporteurs** : pour ajouter des trajets à vide et gérer leurs véhicules.
  - **Passagers/Industriels** : pour rechercher et réserver des trajets disponibles.
- **Ajout de trajets** : Les transporteurs peuvent ajouter des trajets à vide avec des détails comme le point de départ, la destination, la date et l'heure.
- **Recherche de trajets** : Les utilisateurs peuvent rechercher des trajets à vide en fonction de critères comme la localisation, la date ou le type de véhicule.
- **Gestion des véhicules** : Les transporteurs peuvent ajouter, modifier ou supprimer leurs véhicules et leurs caractéristiques (taille, capacité, etc.).
- **Galerie de véhicules** : Possibilité d’ajouter plusieurs images pour chaque véhicule.

## Technologies utilisées
- **Backend** : Laravel (PHP)
- **Frontend** : Blade Templates (Laravel) ou un framework comme Vue.js/React.js
- **Base de données** : MySQL
- **Pipeline CI/CD** : Jenkins
- **Serveur** : VPS avec préproduction et production sur des URLs différentes

## Installation
### Prérequis
- PHP >= 8.1
- Composer
- MySQL
- Node.js (si un framework frontend est utilisé)

### Étapes d'installation
1. Clonez le dépôt :
   ```bash
   git clone <repository-url>
   ```
2. Accédez au répertoire :
   ```bash
   cd empty-trip-app
   ```
3. Installez les dépendances PHP :
   ```bash
   composer install
   ```
4. Installez les dépendances JavaScript (si applicable) :
   ```bash
   npm install && npm run dev
   ```
5. Configurez le fichier `.env` :
   - Dupliquez le fichier `.env.example` et renommez-le en `.env`.
   - Renseignez les informations de connexion à la base de données et les clés API.
6. Générez une clé d'application Laravel :
   ```bash
   php artisan key:generate
   ```
7. Exécutez les migrations et les seeders :
   ```bash
   php artisan migrate --seed
   ```
8. Lancez le serveur de développement :
   ```bash
   php artisan serve
   ```
9. Accédez à l'application via [http://localhost:8000](http://localhost:8000).

## Utilisation
- **Transporteurs** :
  - Connectez-vous à votre compte transporteur.
  - Ajoutez un trajet à vide avec tous les détails nécessaires.
  - Ajoutez des véhicules et leurs images.
- **Passagers/Industriels** :
  - Recherchez des trajets disponibles.
  - Réservez un trajet et contactez le transporteur.

## Tests
- Lancer les tests unitaires :
  ```bash
  php artisan test
  ```
- Mock des APIs des transporteurs pour les tests unitaires disponibles dans le dossier `tests/Mocks`.

## Contribution
Les contributions sont les bienvenues ! Pour contribuer :
1. Forkez le dépôt.
2. Créez une branche pour votre fonctionnalité ou correction de bug :
   ```bash
   git checkout -b feature/ma-fonctionnalite
   ```
3. Faites vos modifications et validez-les :
   ```bash
   git commit -m "Ajout d'une nouvelle fonctionnalité"
   ```
4. Poussez les modifications :
   ```bash
   git push origin feature/ma-fonctionnalite
   ```
5. Ouvrez une Pull Request.

## Roadmap
- Implémentation des notifications en temps réel.
- Ajout d’un système de notation des transporteurs et des passagers.
- Intégration de nouvelles API pour plus de transporteurs.

## Licence
Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus d’informations.


