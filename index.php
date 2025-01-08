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
?>



<!DOCTYPE html>
<html lang="en">
<!--data-bs-theme="dark"-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>MANILLE'S PEARL</title>
        <style>
            #logo{
                padding: 10px;
                width: 75px;
                height: 75px;
            }
        </style>
    </head>
    
    <body>
        <?php
            require "_partials/navbar.php";
            
            $componentName = !empty($_GET['component'])
            ? htmlspecialchars($_GET['component'], ENT_QUOTES, 'UTF-8')
            : 'home';

            if(file_exists("controller/$componentName.php")){
                require "Controller/$componentName.php";
            } else {
                throw new Exception("Component '$componentName' does not exist");
            }
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>