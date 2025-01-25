<?php 
    require "Model/login.php";

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
    ){
        $errors = [];
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if(null === $username || null === $password) {
            $errors[] = "identifiant ou mot de passe vide";
        } else {
            $connexion = connect($pdo, $username);
    
            if (empty($connexion) || !password_verify($password, $connexion['password'])) {
                $errors[] = "Erreur d'identification, veuillez essayer à nouveau";
            } elseif(0 === $connexion['enabled']) {
                $errors[] = "Ce compte est désactivé";
            } else {
                echo 'Vous êtes connécté';
                $_SESSION["auth"] = true;
                $_SESSION["username"] = $connexion['username'];
                $_SESSION["role"] = $connexion['role'] === 1 ? 'admin' : 'worker';
                header("Content-Type: application/json");
                echo json_encode(['authentication' => true]);
                exit();
            }
        }

        if (!empty($errors)) {
            header("Content-Type: application/json");
            echo json_encode(['errors' => $errors]);
            exit();
        }
    }

    require "View/login.php";
?>