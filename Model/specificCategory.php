<?php
    function getAllNecklaces (PDO $pdo, int $itemPerPage, string $search, int $page){ 
        $offset = (($page - 1) * $itemPerPage);
        $searchPart = !empty($search)? 'WHERE article.name LIKE :search' : '';

        $query = "SELECT * FROM article $searchPart WHERE category=1 ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

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

        $query = "SELECT COUNT(*) AS total FROM article $searchPart INNER JOIN category ON article.category=category.id
                WHERE category.id=1";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return $e->getCode() . '</br>' . $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        
        return [$res, $count];        
    }

    function getAllBracelets (PDO $pdo, int $itemPerPage, string $search, int $page){ 
        $offset = (($page - 1) * $itemPerPage);
        $searchPart = !empty($search)? 'WHERE article.name LIKE :search' : '';

        $query = "SELECT * FROM article $searchPart WHERE category=2 ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

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

        $query = "SELECT COUNT(*) AS total FROM article $searchPart INNER JOIN category ON article.category=category.id
                WHERE category.id=2";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return $e->getCode() . '</br>' . $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        
        return [$res, $count];        
    }

    function getAllEarrings (PDO $pdo, int $itemPerPage, string $search, int $page){ 
        $offset = (($page - 1) * $itemPerPage);
        $searchPart = !empty($search)? 'WHERE article.name LIKE :search' : '';

        $query = "SELECT * FROM article $searchPart WHERE category=4 ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

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

        $query = "SELECT COUNT(*) AS total FROM article $searchPart INNER JOIN category ON article.category=category.id
                WHERE category.id=3";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return $e->getCode() . '</br>' . $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        
        return [$res, $count];        
    }

    function getAllRings (PDO $pdo, int $itemPerPage, string $search, int $page){ 
        $offset = (($page - 1) * $itemPerPage);
        $searchPart = !empty($search)? 'WHERE article.name LIKE :search' : '';

        $query = "SELECT * FROM article $searchPart WHERE category=3 ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

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

        $query = "SELECT COUNT(*) AS total FROM article $searchPart INNER JOIN category ON article.category=category.id
                WHERE category.id=3";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return $e->getCode() . '</br>' . $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        
        return [$res, $count];        
    }

    function getArticle (PDO $pdo, int $id){
        $query="SELECT * FROM article WHERE article.id=$id;";
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