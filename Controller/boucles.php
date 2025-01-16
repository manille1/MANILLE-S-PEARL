<?php
    require "Model/boucles.php";
    
    const ITEM_PER_PAGE = 15;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){

        header('Content-Type: application/json');

        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            [$earrings, $count] = getAllEarrings($pdo, ITEM_PER_PAGE, $page);
        
            if (empty($earrings)) {
                http_response_code(404);
                echo json_encode(['error' => 'No resource ring with given identifier found']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['results' => $earrings, 'count' => $count]);
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
        
        exit();

    }

    require "View/boucles.php";
?>