<?php
    require "Model/boucles.php";
    $earrings = getAllEarrings($pdo);

    require "View/boucles.php";
?>