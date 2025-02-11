<?php
/**
 * @var PDO $pdo
 */

    require '../vendor/autoload.php';
    require "../Includes/database.php";

    $faker = Faker\Factory::create('fr_FR');

    for($i = 1; $i<=4; $i++){
        $prep = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');

        if($i === 1){
            $prep->bindValue(':name', 'Collier');

        } else if($i === 2){
            $prep->bindValue(':name', 'Bracelets');

        } else if($i === 3){
            $prep->bindValue(':name', 'Bague');

        } else if($i === 4){
            $prep->bindValue(':name', 'Boucles d\'oreilles');
        }
        
        try {
            $prep->execute();

        } catch (Exception $e) {
            echo " erreur : ".$e->getCode() .':</b>'. $e->getMessage();
        }
        $prep->closeCursor();
    }

    for($i = 0; $i<60; $i++){
        $imageName = "fond_soie";

        $prep = $pdo->prepare('INSERT INTO article (name, category, description, image_name, price, stock, enabled) 
                            VALUES (:name, :category, :description, :image_name, :price, :stock, :enabled)');

        $prep->bindValue(':name', $faker->word());
        $prep->bindValue(':category', $faker->numberBetween(1, 4));
        $prep->bindValue(':description', $faker->sentences(5,true));
        $prep->bindValue(':image_name', $imageName);
        $prep->bindValue(':price', $faker->numberBetween(25, 500));
        $prep->bindValue(':stock', $faker->numberBetween(0, 200));
        $prep->bindValue(':enabled',  $faker->numberBetween(0, 1));

        try {
            $prep->execute();

        } catch (Exception $e) {
            echo " erreur : ".$e->getCode() .':</b>'. $e->getMessage();
        }
        $prep->closeCursor();
    }

    for($i = 0; $i<20; $i++){
        $prep = $pdo->prepare('INSERT INTO user (username, password, role, enabled) 
                            VALUES (:username, :password, :role, :enabled)');

        $prep->bindValue(':username', $faker->word());
        $prep->bindValue(':password', password_hash($faker->word(), PASSWORD_DEFAULT));
        $prep->bindValue(':role', $faker->numberBetween(1, 2), PDO::PARAM_INT);
        $prep->bindValue(':enabled', $faker->numberBetween(0, 1), PDO::PARAM_INT);

        try {
            $prep->execute();

        } catch (Exception $e) {
            echo " erreur : ".$e->getCode() .':</b>'. $e->getMessage();
        }
        $prep->closeCursor();
    }
?>