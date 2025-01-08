<?php
/**
 * @var PDO $pdo
 */

    require '../vendor/autoload.php';
    require "../Includes/database.php";

    $faker = Faker\Factory::create('fr_FR');

    for($i = 0; $i<50; $i++){
        $prep = $pdo->prepare('INSERT INTO article (title, category, description, image_name, price, stock, enabled) 
                            VALUES (:title, :category, :description, :image_name, :price, :stock, :enabled)');

        $prep->bindValue(':title', $faker->word());
        $prep->bindValue(':category', $faker->numberBetween(1, 4));
        $prep->bindValue(':description', $faker->sentences(5,true));
        $prep->bindValue(':image_name', $faker->word());
        $prep->bindValue(':price', $faker->numberBetween(25, 500));
        $prep->bindValue(':stock', $faker->numberBetween(0, 200));
        $prep->bindValue(':enabled', $faker->numberBetween(1, 2), PDO::PARAM_INT);

        try {
            $prep->execute();

        } catch (Exception $e) {
            echo " erreur : ".$e->getCode() .':</b>'. $e->getMessage();
        }
        $prep->closeCursor();
    }
?>