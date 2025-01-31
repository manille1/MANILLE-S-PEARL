<?php
    require "Model/resources.php";

    //var_dump('debut controller');
    const LIST_ARTICLES_ITEMS_PER_PAGE = 15;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
        
        header('Content-Type: application/json');

        try{             
            if(isset($_GET['id'])){
                $resourcesType = isset($_GET['resources']) ? cleanString($_GET['resources']) : '';
                $article = getResource($pdo, $resourcesType, $_GET['id']);
        
                if (empty($article)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'No resource for specic article with given identifier found']);

                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['results' => $article]);
                }

            } else {
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $search = isset($_GET['search']) ? cleanString($_GET['search']) : '';
                $resourcesType = isset($_GET['resources']) ? cleanString($_GET['resources']) : '';

                [$resources, $count] = getAllResources($pdo, LIST_ARTICLES_ITEMS_PER_PAGE, $resourcesType, $search, $page);

                if (empty($resources)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'No resource with given identifier found']);

                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['results' => $resources, 'count' => $count]);
                }
            } 

            if ($actionName === 'toggle_enabled') {
                $id = cleanString($_GET['id']);
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $search = isset($_GET['search']) ? cleanString($_GET['search']) : '';
                $resourcesType = isset($_GET['resources']) ? cleanString($_GET['resources']) : '';

                $res = toggleEnabled($pdo, $resourcesType, $id, $search);

                header('Content-Type: application/json');

                if (!is_bool($res)) {
                    echo json_encode(['error' => $res]);
                }
                exit();

            } else if ($actionName === 'create') {
                $name = !empty($_POST['name']) ? cleanString($_POST['name']) : null;
                $category = !empty($_POST['category']) ? cleanString($_POST['category']) : null;
                $description = !empty($_POST['description']) ? cleanString($_POST['description']) : null;
                $price = !empty($_POST['price']) ? cleanString($_POST['price']) : false;
                $stock = !empty($_POST['stock']) ? cleanString($_POST['stock']) : false;
                $enabled = !empty($_POST['enabled']) ? cleanString($_POST['enabled']) : false;
        
        
                if(empty($name) || empty($category) || empty($price) || empty($stock) || empty($enabled)) {
                    //$updatedUser = createResources($pdo, $name,$category, $description, $price, $stock, $enabled);
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'No resource with given identifier found']);
                    exit();
                }

                $fileName = null;

                var_dump('files :',$_FILES);
                if(!empty($_FILES['image']['name'])){

                }
                
                
                // if (!is_bool($updatedUser)) {
                //         $errors[] = $updatedUser;
                //     } else {
                //         $user = getUser($pdo, $_GET['id']);
                //     }
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
        
        exit();
    }

    if ($actionName === 'delete') {
        $id = cleanString($_GET['id']);
        $resourcesType = isset($_GET['resources']) ? cleanString($_GET['resources']) : '';

        $res = deleteResources($pdo, $resourcesType, $id);
        if (!is_bool($res)) {
            return ['error' => $res];
        }

        exit();
    }

    require "View/resources.php";
?>