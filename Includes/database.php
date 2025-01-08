<?php
    try {                   //se connecte à la base de donnée
        $pdo = new PDO('mysql:host=localhost;dbname=manilles_pearl','root');
    } catch (Exception $e) {
        $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
    }
?>