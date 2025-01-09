<?php
    require "Model/bracelets.php";
    $bracelets = getAllBracelets($pdo);

    require "View/bracelets.php";
?>