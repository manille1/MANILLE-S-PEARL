<?php
    function getAllArticles (PDO $pdo, int $itemPerPage, int $page = 1){ 
        $offset = (($page - 1) * $itemPerPage);

        $query = "SELECT * FROM article ORDER BY article.name ASC LIMIT $itemPerPage OFFSET $offset";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
    
        try {
            $prep->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();


        $query="SELECT COUNT(*) AS total  FROM article";
        $prep = $pdo->prepare($query);
        try
        {
            $prep->execute();
        }
        catch (PDOException $e)
        {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();


        return [$res, $count];
    }
?>