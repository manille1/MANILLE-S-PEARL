<?php
    require "Model/colliers.php";
    $necklaces = getAllNecklaces($pdo);

    require "View/colliers.php"
;?>