Documentation : Injection SQL Temporelle
Ce projet vise à démontrer une attaque par injection SQL temporelle, une technique utilisée pour extraire des données en exploitant des délais artificiels dans les réponses du serveur. Cette documentation explique comment configurer l'environnement, lancer le projet, et reproduire l'attaque.

Prérequis
Avant de commencer, assurez-vous d'avoir les outils suivants installés sur votre machine :

Git : Pour cloner le dépôt.

Docker : Pour exécuter le conteneur.

Docker Compose : Pour gérer les services du projet.

Étape 1 : Cloner le Dépôt
Ouvrez un terminal.

Clonez le dépôt Git en utilisant la commande suivante :

bash
Copy
git clone https://github.com/votre-utilisateur/SQL-injection-temporelle.git
Accédez au répertoire du projet :

bash
Copy
cd SQL-injection-temporelle
Étape 2 : Lancer le Projet avec Docker Compose
Dans le répertoire du projet, utilisez Docker Compose pour construire et lancer les services :

bash
Copy
docker-compose up --build
Une fois les conteneurs en cours d'exécution, vous pouvez accéder à l'application via un navigateur web à l'adresse suivante :

Copy
http://localhost:8080
Étape 3 : Comprendre l'Attaque par Injection SQL Temporelle
L'injection SQL temporelle est une technique qui exploite les délais dans les réponses du serveur pour extraire des données sensibles. Voici un exemple de payload utilisé pour cette attaque :

Payload Utilisé
sql
Copy
' AND IF(ASCII(SUBSTRING((SELECT username FROM users LIMIT 1), 1, 1)) > 100, SLEEP(5), 0) --
Explication du Payload
ASCII(SUBSTRING(...)) : Extrait le premier caractère du nom d'utilisateur et le convertit en valeur ASCII.

IF(...) : Vérifie si la valeur ASCII du caractère est supérieure à 100.

SLEEP(5) : Introduit un délai de 5 secondes dans la réponse du serveur si la condition est vraie.

-- : Commente la fin de la requête pour éviter les erreurs de syntaxe.

Ce payload permet de déterminer, caractère par caractère, le contenu des champs sensibles en mesurant les délais de réponse.

Étape 4 : Reproduire l'Attaque
Ouvrez l'application dans votre navigateur.

Identifiez un point d'entrée vulnérable à l'injection SQL (par exemple, un champ de formulaire).

Injectez le payload dans le champ vulnérable.

Observez le temps de réponse du serveur :

Si la réponse est retardée de 5 secondes, cela signifie que la condition est vraie.

Si la réponse est immédiate, la condition est fausse.

Répétez ce processus pour chaque caractère jusqu'à reconstruire entièrement le nom d'utilisateur.

Exemple de Résultat
Après plusieurs requêtes, vous pourrez extraire le nom d'utilisateur de la table users. Par exemple :

Copy
Nom d'utilisateur : Admin
Étape 5 : Sécuriser l'Application
Pour éviter ce type d'attaque, il est essentiel de :

Utiliser des requêtes préparées (prepared statements).

Valider et assainir les entrées utilisateur.

Limiter les privilèges de la base de données.

Conclusion
Ce projet illustre l'importance de la sécurité des applications web et montre comment une injection SQL temporelle peut être exploitée pour extraire des données sensibles. En suivant cette documentation, vous pouvez reproduire l'attaque et comprendre les mesures de sécurité nécessaires pour protéger vos applications.

Licence
Ce projet est sous licence MIT. N'hésitez pas à l'utiliser et à le modifier selon vos besoins.

Contributions
Les contributions sont les bienvenues ! Si vous souhaitez améliorer ce projet, ouvrez une issue ou soumettez une pull request.

Cette documentation est prête à être ajoutée à votre dépôt Git. Vous pouvez la sauvegarder dans un fichier README.md ou dans un fichier séparé comme DOCUMENTATION.md. Les utilisateurs pourront ainsi cloner le dépôt, lancer le projet, et reproduire l'attaque en suivant les étapes décrites.
