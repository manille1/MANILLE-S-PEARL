<?php
    function connect(PDO $pdo, string $username){

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query="SELECT * FROM user WHERE username = :username ";

        $prep = $pdo->prepare($query);
        $prep->bindValue(':username', $username, PDO::PARAM_STR);

        try {
            $prep->execute();
        } catch (PDOException $e) {
            $response = " erreur : ".$e->getCode() .' :</b> '. $e->getMessage();
        }

        
        $res = $prep->fetch();
        $prep->closeCursor();
        return $res;
    }
?>