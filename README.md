# WenzeSchool — gestion scolaire multi-établissements

Application web responsive en français construite avec PHP orienté objet, MySQL, Bootstrap, jQuery et JavaScript. Chaque fiche métier appartient à un établissement, et les requêtes ne peuvent lire ou modifier que les données de l'établissement du compte connecté.

## Fonctionnalités

- Authentification par e-mail et mot de passe haché ; rôles administrateur, personnel et enseignant.
- Gestion des apprenants, inscriptions/réinscriptions, classes, enseignants, parents, cours, notes, frais/paiements et publications.
- Ajout, consultation, modification et suppression des fiches depuis une interface adaptative.
- Stockage local IndexedDB et file de synchronisation automatique après le retour de la connexion. Les fiches en attente sont marquées « En local ».
- API JSON sécurisée par sessions, jeton CSRF, requêtes préparées et liste blanche des tables.

## Installation locale

1. Installer PHP 8.1+ avec PDO MySQL et MySQL 8+.
2. Importer le schéma : `mysql -u root -p < backend/schema.sql`.
3. Configurer `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` dans l'environnement du serveur (valeurs locales par défaut : `127.0.0.1`, `wenzeschool`, `root`, mot de passe vide).
4. Servir le dossier du projet depuis un serveur PHP/Apache/Nginx. Pour un essai local, depuis la racine : `php -S 127.0.0.1:8000`.
5. Ouvrir `http://127.0.0.1:8000/backend/setup.php`, puis créer le premier établissement et son administrateur (mot de passe de 10 caractères minimum).
6. Après l'installation, supprimer `backend/setup.php` ou en bloquer l'accès, puis visiter l'accueil et se connecter.

Bootstrap et jQuery sont chargés depuis des CDN : pour disposer de ces bibliothèques sans réseau dès la première visite, hébergez leurs fichiers localement. HTTPS est nécessaire pour l'usage PWA hors localhost.

## Organisation

- `config/database.php` : connexion PDO.
- `backend/` : API, classes PHP métier, installation et schéma SQL.
- `frontend/` : interface et styles.
- `frontend/assets/app.js` : navigation, CRUD et stockage/synchronisation hors ligne.
- `sw.js` : cache de l'interface pour les visites suivantes.

## Notes importantes

L'authentification initiale et une première ouverture de l'application nécessitent Internet/serveur. Le mode hors ligne protège les ajouts, modifications et suppressions faits sur l'appareil après une session ouverte ; les données personnelles en attente restent dans le stockage local du navigateur jusqu'à leur synchronisation. Les notes et paiements ne remplacent pas une validation comptable ou scolaire officielle. Mettre en place HTTPS, sauvegardes régulières et politique de conservation avant toute mise en production.
