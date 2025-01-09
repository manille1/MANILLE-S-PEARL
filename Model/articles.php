<?php
    function getAllArticles (PDO $pdo){ 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare(`SELECT * FROM article INNER JOIN category ON article.category = category.id 
                ORDER BY category.id, article.name ASC;`);
    
        //try {
            $prep->execute();
        //} 
        //catch (PDOException $e) {
        //     return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        // }

        
    }
?>