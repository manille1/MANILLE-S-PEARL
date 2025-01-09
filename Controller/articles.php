<?php
    require "Model/articles.php";
    $articles = getAllArticles($pdo);

    require "View/articles.php";
?>