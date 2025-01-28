<?php
    function getAllResources (PDO $pdo, int $itemPerPage, string $resourcesType, string $search, int $page = 1){
        $searchPart = !empty($search)? 'WHERE $resourcesType.name LIKE :search' : '';
        $offset = ($page - 1) * $itemPerPage;

        $query = "SELECT * FROM $resourcesType $searchPart ORDER BY $resourcesType.id ASC LIMIT $itemPerPage OFFSET $offset";
        //var_dump($query);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prep = $pdo->prepare($query);
        //var_dump($resourcesType);
        //$prep->bindValue(':resourcesType', $resourcesType, PDO::PARAM_STR);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }
        //var_dump($prep);

        try {
            $prep->execute();

        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();



        $query="SELECT COUNT(*) AS total FROM $resourcesType $searchPart";
        $prep = $pdo->prepare($query);
        //$prep->bindValue(':resourcesType', $resourcesType);
        if (!empty($searchPart)){
            $prep->bindValue(':search', '%' . $search . '%');
        }

        try{
            //var_dump($prep);
            $prep->execute();

        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $count = $prep->fetch(PDO::FETCH_ASSOC);
        $prep->closeCursor();

        return [$res, $count];
    }

    function getResources (PDO $pdo, string $resourcesType, int $id){
        $query="SELECT * FROM :resourcesType WHERE $id = :resourcesType.id;";
        $prep = $pdo->prepare($query);
        $prep->bindValue(':resourcesType', $resourcesType);

        try{
            $prep->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        
        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();


        return $res;
    }

    function toggleEnabled (PDO $pdo, string $resourcesType, int $id): string | bool{
        $res = $pdo->prepare('UPDATE :resourcesType SET enabled = NOT enabled WHERE id = :id');
        $res->bindParam(':resourcesType', $resourcesType, PDO::PARAM_STR);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        try{
            $res->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' '. $e->getMessage();
        }

        return true;
    }
?>