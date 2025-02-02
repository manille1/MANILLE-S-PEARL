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
            $prep->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }

        try {
            $prep->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        $res = $prep->fetchAll(PDO::FETCH_ASSOC);
        $prep->closeCursor();



        $query = "SELECT COUNT(*) AS total FROM $resourcesType $searchPart";
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

    function getResource (PDO $pdo, string $resourcesType, int $id){
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
        if (!in_array($resourcesType, $correctTable)) {
            $errors = "Erreur : table non autorisée ou non existante";
            return $errors;
        }

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
    }
    
    function deleteResources (PDO $pdo, string $resourcesType, int $id): string | bool{
        $correctTable = ['article', 'category', 'user'];
        if (!in_array($resourcesType, $correctTable)) {
            $errors = "Erreur : table non autorisée ou non existante";
            return $errors;
        }

        $res = $pdo->prepare("DELETE FROM $resourcesType WHERE id = :id");
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        try{
            $res->execute();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' '. $e->getMessage();
        }

        return true;
    }

    function createResources (PDO $pdo, string $name, string $category, string $description, 
        string $price,  string $stock, int $enabled, string | null  $imageName = null){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query="INSERT INTO article (name, category, description, image_name, price, stock, enabled) VALUES 
                (:name, :category, :description, :image_name, :price, :stock, :enabled)";

        $prep = $pdo->prepare($query);
        $prep->bindValue(':name', $name,);
        $prep->bindValue(':category', $category,);
        $prep->bindValue(':description', $description);
        $prep->bindValue(':image_name', $imageName);
        $prep->bindValue(':price', $price, PDO::PARAM_INT);
        $prep->bindValue(':stock', $stock, PDO::PARAM_INT);
        $prep->bindValue(':enabled', $enabled, PDO::PARAM_INT);

        try{
            $prep->execute();
            $id = (int)$pdo->lastInsertId();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
    
        return $id;
    }

    function updateResources (PDO $pdo, int $id, string $name, string $category, string $description, 
        string $price,  string $stock, int $enabled, string | null  $imageName = null){
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query="UPDATE article SET name = :name, category = :category, description = :description, 
                image_name = :image_name, price = :price, stock = :stock, enabled = :enabled WHERE id = :id";

        $prep = $pdo->prepare($query);
        $prep->bindValue(':name', $name,);
        $prep->bindValue(':category', $category,);
        $prep->bindValue(':description', $description);
        $prep->bindValue(':image_name', $imageName);
        $prep->bindValue(':price', $price, PDO::PARAM_INT);
        $prep->bindValue(':stock', $stock, PDO::PARAM_INT);
        $prep->bindValue(':enabled', $enabled, PDO::PARAM_INT);
        $prep->bindValue(':id', $id, PDO::PARAM_INT);

        try{
            $prep->execute();
            $id = (int)$pdo->lastInsertId();
        } catch (PDOException $e) {
            return " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }
        $prep->closeCursor();
    
        return true;
    }
?>