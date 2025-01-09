<?php
    function getAllEarrings (PDO $pdo){ 
        $query = "SELECT * FROM article INNER JOIN category ON article.category=category.id 
                  WHERE category.id=4 ORDER BY article.name ASC";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
    
        try {
            $prep->execute();
        } catch (PDOException $e) {
             return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll();
        $prep->closeCursor();

        return $res;
    }
?>