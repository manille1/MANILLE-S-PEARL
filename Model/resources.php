<?php
    function getAllArticles (PDO $pdo, int $itemPerPage, string $search, int $page = 1){
        $offset = ($page - 1) * $itemPerPage;
        $searchPart = !empty($search)? 'WHERE article.name LIKE :search' : '';

        $query = "SELECT * FROM article $searchPart ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try {
            $prep->execute();

        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();


        $query="SELECT COUNT(*) AS total FROM article $searchPart";
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try{
            $prep->execute();

        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        return [$res, $count];
    }

    function getArticle (PDO $pdo, int $id){
        $query="SELECT * FROM article WHERE $id = article.id;";
        $prep = $pdo->prepare($query);
        try{
            $prep->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        
        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();


        return $res;
    }
?>