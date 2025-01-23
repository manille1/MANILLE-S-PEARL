<?php
    session_start();
    require __DIR__.'/vendor/autoload.php';
    require "Includes/database.php";
    require "Includes/functions.php";

    if(isset($_GET['deconnect'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        
            $componentName = !empty($_GET['component'])
                ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
                : 'home';

            $searchContent = !empty($_GET['search'])
                ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8')
                : null;

            $actionName = !empty($_GET['action'])
                ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8')
                : null;

            if (file_exists("Controller/$componentName.php")) {
                require "Controller/$componentName.php";
            } else {
                throw new Exception("Component '$componentName' does not exist");
            }
      
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<!--data-bs-theme="dark"-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Inconsolata:wght@200..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Limelight&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ysabeau+SC:wght@1..1000&display=swap" rel="stylesheet">
    
        <title>MANILLE'S PEARL</title>
        <style>
            #logo{
                padding: 10px;
                width: 75px;
                height: 75px;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/articles.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/bagues.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/boucles.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/bracelets.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/colliers.css">
        <link rel="stylesheet" type="text/css" href="./assets/css/home.css">
    </head>
    
    <body>
        <?php
            
            $componentName = !empty($_GET['component'])
            ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
            : 'home';

            $searchContent = !empty($_GET['search'])
            ? htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8')
            : null;

            $actionName = !empty($_GET['action'])
                ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8')
                : null;

            if(file_exists("controller/$componentName.php")){
                require "_partials/navbar.php";
                require "Controller/$componentName.php";
            } elseif ($componentName === 'gestionmarketingadmin'){
                require "Controller/login.php";
                /*--Connexion admin : ?component=gestionmarketingadmin--*/
            
            }else {
                require "Controller/articles.php";
                throw new Exception("Component '$componentName' does not exist");
            }
            
        require "_partials/modal.php";
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>