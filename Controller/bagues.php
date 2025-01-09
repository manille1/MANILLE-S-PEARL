<?php
    require "Model/bagues.php";
    $rings = getAllRings($pdo);

    require "View/bagues.php";
?>