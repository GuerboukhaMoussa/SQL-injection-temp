
# Temporelle SQL Injection: Setup and Exploitation Guide

This guide walks you through setting up a vulnerable Flask application, running it on your local machine, and exploiting the email body injection vulnerability to understand how such issues work in real-world scenarios. **Use this guide only in a controlled environment for educational purposes.**

---

## Prérequis

Avant de commencer, assurez-vous d'avoir les outils suivants installés sur votre machine :

- **Git** : Pour cloner le dépôt.
- **Docker** : Pour exécuter le conteneur.
- **Docker Compose** : Pour gérer les services du projet.

---

## Setting Up the Application
### Step 1 : Cloner le Dépôt

1. Ouvrez un terminal.
2. Clonez le dépôt Git en utilisant la commande suivante :

   ```bash
   git clone https://github.com/GuerboukhaMoussa/SQL-injection-temp.git
Accédez au répertoire du projet :

bash
Copy
cd SQL-injection-temporelle
### Step 2 : Lancer le Projet avec Docker Compose
  Dans le répertoire du projet, utilisez Docker Compose pour construire et lancer les services :
  
      docker compose up --build

Une fois les conteneurs en cours d'exécution, vous pouvez accéder à l'application via un navigateur web à l'adresse suivante :

      http://localhost:8080/login.php
### Step 3 : Comprendre l'Attaque par Injection SQL Temporelle
L'injection SQL temporelle est une technique qui exploite les délais dans les réponses du serveur pour extraire des données sensibles. Voici un exemple de payload utilisé pour cette attaque :

Payload Utilisé
      
     aa' OR IF(ASCII(SUBSTRING((SELECT username FROM users LIMIT 1), 1, 1)) > 64, SLEEP(5), 0); --

Explication du Payload
ASCII(SUBSTRING(...)) : Extrait le premier caractère du nom d'utilisateur et le convertit en valeur ASCII.

IF(...) : Vérifie si la valeur ASCII du caractère est supérieure à 64.

SLEEP(5) : Introduit un délai de 5 secondes dans la réponse du serveur si la condition est vraie.

-- : Commente la fin de la requête pour éviter les erreurs de syntaxe.

Ce payload permet de déterminer, caractère par caractère, le contenu des champs sensibles en mesurant les délais de réponse.

### Step 4 : Reproduire l'Attaque
-   Ouvrez l'application dans votre navigateur.

-   Identifiez un point d'entrée vulnérable à l'injection SQL (par exemple, un champ de formulaire).

-   Injectez le payload dans le champ vulnérable.

-   Observez le temps de réponse du serveur :

      Si la réponse est retardée de 5 secondes, cela signifie que la condition est vraie.
      Si la réponse est immédiate, la condition est fausse.

-   Répétez ce processus pour chaque caractère jusqu'à reconstruire entièrement le nom d'utilisateur.

Exemple de Résultat
  Après plusieurs requêtes, vous pourrez extraire le nom d'utilisateur de la table users. Par exemple :

    Nom d'utilisateur : Admin
