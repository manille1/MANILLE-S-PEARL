<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=manilles_pearl','root', '');
    } catch (Exception $e) {
        $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
    }
?>