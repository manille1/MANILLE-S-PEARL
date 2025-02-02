Un projet de boutique en ligne du nom de MANILLE'S PEARL. C'est une aucunement destiné à être un vrai site.

L'utilisateur l'ambda doit pouvoir naviguer dans le site pour choisir son article. Et il a accès à son panier d'article afin de les acheter. L'administarteur, lui, a accès à toute les données afin de gérer les article et les différents autre utilisateurs.

👑💎✨

**Pour l'installation :**

**1. Connexion à la BDD**
--> Dans Includes/database.php, mettez le nom de la base de données à la place de manilles_pearl (si vous l'appelez autrement).
Et changez éventuellement le host, le username et le password si vous avez des paramètres particuliers.

**2. Initialiser la BDD**
--> Dans phpMyAdmin, insérez le dump de manière à avoir 3 tables (article, category, user) et à avoir article et category liées entre elles. (Voir le MCD)

**3. Remplir la table de fake data**
--> Dans l'invite de commande, je vous invite à vous rendre dans le dossier scripts ('cd scripts/') et à exécuter fixtures ('php fixtures.php').

**4. Vérifier dans phpMyAdmin que toutes les tables ont été remplies**
--> Si ce n'est pas le cas, réessayez de générer la data.

**5. Avoir un compte admin**
--> De façon à pouvoir vous connecter plus tard au backoffice, vous devez modifier un utilisateur. Changez son mot de passe pour un mot de passe que vous aurez généré ici ==> "https://onlinephp.io/password-hash".
***Retenez le mot de passe !***

**6. Images**
--> Afin d'avoir un site illustré, installez/créez le dossier uploads avec dedans les images de base fournies.

**7. Et Voilà**
--> Vous êtes fin prêt pour explorer le site de e-commerce de MANILLE's PEARL ! Pour aller sur le site, l'URL est : "http://localhost/Manille's_pearl/index.php".
--> Si vous voulez accéder au backoffice, vous devez rajouter à "index.php" ceci "?component=gestionmarketingadmin" et vous connecter avec le compte administrateur.
