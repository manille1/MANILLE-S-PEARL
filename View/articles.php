<section id="articles">
    <?php foreach($articles as $article): ?>
        <div class="card">
            <img src="./IMG/<?php echo $article['image_name']; ?>.jpg" alt="<?php echo $article['image_name']; ?>">
            <div class="text">
                <p class="small">
                    <?php switch($article['category']) {
                        case 1 :
                            echo 'Collier';
                            break;
                        case 2 :
                            echo 'Bracelets';
                            break;
                        case 3 :
                            echo 'Bague';
                            break;
                        case 4 :
                            echo 'Boucles d\'oreilles';
                            break;
                    }?>
                </p>
                <a href="#"><h2><?php echo $article['name'] ;?></h2></a>
                <p class="description"><?php echo mb_substr($article['description'], 0, 50)?> ...</p>
                <div class="info">
                    <p><?php echo $article['price'] ?> €</p>
                    <p><?php echo $article['stock'] ?> en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                    <a class="add_button" href="#"><i class="fa-solid fa-circle-plus"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>