<?php
    //var_dump($_GET['search']);
    require "Model/articles.php";

    // var_dump('On est au début du controller 👍');
    const LIST_ARTICLES_ITEMS_PER_PAGE = 15;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
            

        header('Content-Type: application/json');

        try{             
            if(isset($_GET['id'])){
                $article = getArticle($pdo, $_GET['id']);
        
                if (empty($article)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'No resource for specic article with given identifier found']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['results' => $article]);
                }
            } else {
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $search = $_GET['search'] . 'est votre recherche';
                //var_dump($search);

                [$articles, $count] = getAllArticles($pdo, LIST_ARTICLES_ITEMS_PER_PAGE, $search,$page);
                
                if (empty($articles)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'No resource with given identifier found']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['results' => $articles, 'count' => $count]);
                }
            } 
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
        
        exit;
    }

    require "View/articles.php";
?>