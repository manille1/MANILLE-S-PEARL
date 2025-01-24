<?php
    require "Model/specificCategory.php";
    const ITEM_PER_PAGE = 15;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){

        header('Content-Type: application/json');

        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


            switch ($_GET['category']) {
                case 'colliers':
                    [$necklaces, $count] = getAllNecklaces($pdo, ITEM_PER_PAGE, $page);
                
                    if (empty($necklaces)) {
                        http_response_code(404);
                        echo json_encode(['error' => 'No resource ring with given identifier found']);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['results' => $necklaces, 'count' => $count]);
                    }
                    break;
                
                case 'bracelets':
                    [$bracelets, $count] = getAllBracelets($pdo, ITEM_PER_PAGE, $page);
                
                    if (empty($bracelets)) {
                        http_response_code(404);
                        echo json_encode(['error' => 'No resource ring with given identifier found']);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['results' => $bracelets, 'count' => $count]);
                    }
                    break;
                    
                case 'boucles':
                    [$earrings, $count] = getAllEarrings($pdo, ITEM_PER_PAGE, $page);
                
                    if (empty($earrings)) {
                        http_response_code(404);
                        echo json_encode(['error' => 'No resource ring with given identifier found']);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['results' => $earrings, 'count' => $count]);
                    }
                    break;
                
                case 'bagues':
                    [$rings, $count] = getAllRings($pdo, ITEM_PER_PAGE, $page);
        
                    if (empty($rings)) {
                        http_response_code(404);
                        echo json_encode(['error' => 'No resource ring with given identifier found']);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['results' => $rings, 'count' => $count]);
                    }
                    break;
            }


        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
        
        exit();

    }
    
    require "View/specificCategory.php";
?>
?>