## Description
Cette API est construite avec Lumen et permet de gérer une liste de personnes, avec des
fonctionnalités de création, lecture, mise à jour et suppression (CRUD). Elle utilise une base de
données SQLite pour stocker les données, et cette base est incluse dans le dépôt.
Les tests de l'API sont effectués via Postman.

## Prérequis
Avant de commencer, assurez-vous d'avoir les outils suivants installés :
- PHP >= 7.3
- Composer
- SQLite
- Postman pour tester l'API

## Installation
1. **Clonez le dépôt sur votre machine :**
 ```bash
 git clone https://github.com/AyrtonFlam/Eonix_PHP.git
 cd ton_repertoire
 ```
2. **Installez les dépendances avec Composer :**
 ```bash
 composer install
 ```
3. **Configurez le fichier `.env` :**
 Copiez le contenu du fichier `.env.example` (si vous en avez un) ou créez un nouveau fichier
`.env` et configurez-le comme suit :

 ```env
 DB_CONNECTION=sqlite
 DB_DATABASE=../database/database.sqlite
 ```
4. **Vérifiez la présence de la base de données SQLite :**
 La base de données SQLite (`database.sqlite`) est incluse dans le dépôt, donc vous n'avez pas
besoin de la créer manuellement. Assurez-vous que le fichier existe à l'emplacement spécifié dans
le fichier `.env`.
5. **Exécutez les migrations (si nécessaire) :**
 ```bash
 php artisan migrate
 ```
6. **Démarrez le serveur de développement Lumen :**
 ```bash
 php -S localhost:8000 -t public
 ```
7. Votre API devrait maintenant être accessible à [http://localhost:8000](http://localhost:8000).

## Endpoints de l'API
Les tests de l'API se font en utilisant Postman. Pour tester l'API, importez les collections de
requêtes disponibles ou créez-les manuellement en suivant les exemples ci-dessous.
### 1. Récupérer toutes les personnes
- **URL** : `GET /persons`
- **Paramètres de requête (optionnels)** :
 - `search`: Permet de filtrer par prénom ou nom. Exemple : `persons?search=Sébastien`
**Exemple de requête :**
```bash
curl -X GET "http://localhost:8000/persons?search=Sébastien"
```
**Dans Postman :**
1. Créez une nouvelle requête GET.
2. Entrez l'URL `http://localhost:8000/persons?search=Sébastien`.
3. Cliquez sur "Send".
### 2. Récupérer une personne par ID
- **URL** : `GET /persons`
- **Paramètres de requête** :
 - `id`: L'ID de la personne à récupérer. Exemple : `persons/?id=1`
**Exemple de requête :**
```bash
curl -X GET "http://localhost:8000/persons?id=1"
```
**Dans Postman :**
1. Créez une nouvelle requête GET.
2. Entrez l'URL `http://localhost:8000/persons?id=1`.
3. Cliquez sur "Send".
### 3. Ajouter une nouvelle personne
- **URL** : `POST /persons`
- **Body** : Form-data (application/json)
 ```json
 {
 "firstname": "John",
 "lastname": "Doe"
 }
 ```
**Exemple de requête :**
```bash
curl -X POST "http://localhost:8000/persons" -H "Content-Type: application/json" -d '{"firstname":
"John", "lastname": "Doe"}'
```
**Dans Postman :**
1. Créez une nouvelle requête POST.
2. Entrez l'URL `http://localhost:8000/persons`.
3. Dans l'onglet "Body", sélectionnez "raw" et choisissez "JSON" dans le menu déroulant.
4. Entrez le JSON suivant dans le corps de la requête :
 ```json
 {
 "firstname": "John",
 "lastname": "Doe"
 }
 ```
5. Cliquez sur "Send".
### 4. Mettre à jour une personne
- **URL** : `PUT /persons`
- **Body** : Form-data (application/json)
 ```json
 {
 "id": 1,
 "firstname": "John",
 "lastname": "Doe"
 }
 ```
**Exemple de requête :**
```bash
curl -X PUT "http://localhost:8000/persons" -H "Content-Type: application/json" -d '{"id": 1,
"firstname": "John", "lastname": "Doe"}'
```
**Dans Postman :**
1. Créez une nouvelle requête PUT.
2. Entrez l'URL `http://localhost:8000/persons`.
3. Dans l'onglet "Body", sélectionnez "raw" et choisissez "JSON" dans le menu déroulant.
4. Entrez le JSON suivant dans le corps de la requête :
 ```json
 {
 "id": 1,
 "firstname": "John",
 "lastname": "Doe"
 }
 ```
5. Cliquez sur "Send".
### 5. Supprimer une personne
- **URL** : `DELETE /persons`
- **Paramètres** :
 - `id`: ID de la personne à supprimer. Exemple : `persons/?id=1`
**Exemple de requête :**
```bash
curl -X DELETE "http://localhost:8000/persons?id=1"
```
**Dans Postman :**
1. Créez une nouvelle requête DELETE.
2. Entrez l'URL `http://localhost:8000/persons?id=1`.
3. Cliquez sur "Send".
## Tester l'API avec Postman
1. Téléchargez et installez [Postman](https://www.postman.com/downloads/).
2. Créez une nouvelle collection dans Postman pour regrouper toutes les requêtes.
3. Ajoutez les requêtes décrites ci-dessus en fonction des actions que vous souhaitez tester.

## License
Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.
