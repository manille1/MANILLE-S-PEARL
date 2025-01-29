<?php
    function getAllResources (PDO $pdo, int $itemPerPage, string $resourcesType, string $search, int $page = 1){
        $correctTable = ['article', 'category', 'user'];
        if (!in_array($resourcesType, $correctTable)) {
            $errors = "Erreur : table non autorisée ou non existante";
            return $errors;
        }
        
        $searchPart = !empty($search)? "WHERE $resourcesType.name LIKE :search" : '';
        $offset = ($page - 1) * $itemPerPage;

        $query = "SELECT * FROM $resourcesType $searchPart ORDER BY $resourcesType.id ASC LIMIT $itemPerPage OFFSET $offset";

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



        $query="SELECT COUNT(*) AS total FROM $resourcesType $searchPart";
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

    function getResources (PDO $pdo, string $resourcesType, int $id){
        $correctTable = ['article', 'category', 'user'];
        if (!in_array($resourcesType, $correctTable)) {
            $errors = "Erreur : table non autorisée ou non existante";
            return $errors;
        }

        $query="SELECT * FROM $resourcesType WHERE $id = $resourcesType.id;";
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

    function toggleEnabled (PDO $pdo, string $resourcesType, int $id, string $search): string | bool{
        $correctTable = ['article', 'category', 'user'];
        if (in_array($resourcesType, $correctTable)) {

            $searchPart = !empty($search)? "AND $resourcesType.name LIKE :search" : '';

            $res = $pdo->prepare("UPDATE $resourcesType SET enabled = NOT enabled WHERE id = :id  $searchPart");
            $res->bindParam(':id', $id, PDO::PARAM_INT);
            if (!empty($searchPart)){
                $res->bindValue(':search', '%' . $search . '%');
            }
            
            try{
                $res->execute();
            } catch (PDOException $e) {
                return " erreur : ".$e->getCode() .' '. $e->getMessage();
            }

            return true;
        } else {
            $errors = "Erreur : table non autorisée ou non existante";
            return $errors;
        }
    }
?>