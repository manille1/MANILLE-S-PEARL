<?php
    require "Model/colliers.php";

    const ITEM_PER_PAGE = 15;
    

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){

        header('Content-Type: application/json');

        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            [$necklaces, $count] = getAllNecklaces($pdo, ITEM_PER_PAGE, $page);
        
            if (empty($necklaces)) {
                http_response_code(404);
                echo json_encode(['error' => 'No resource ring with given identifier found']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['results' => $necklaces, 'count' => $count]);
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
        
        exit();
    }
    require "View/colliers.php"
;?>