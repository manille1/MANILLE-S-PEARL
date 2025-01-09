<div class="fond_bijoux">
    <div id="title">Toutes nos boucles d'oreilles</div>
</div>
<section id="articles">
    <?php foreach($earrings as $earring): ?>
        <div class="card">
            <img src="./IMG/<?php echo $earring['image_name']; ?>.jpg" alt="<?php echo $earring['image_name']; ?>">
            <div class="text">
                <p class="small"><?php echo 'Boucles d\'oreilles';?></p>
                <a href="#"><h2><?php echo $earring['name'] ;?></h2></a>
                <p class="description"><?php echo mb_substr($earring['description'], 0, 50)?> ...</p>
                <div class="info">
                    <p><?php echo $earring['price'] ?> €</p>
                    <p><?php echo $earring['stock'] ?> en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                    <a class="add_button" href="#"><i class="fa-solid fa-circle-plus"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<style>
    .fond_bijoux{
        background: url(IMG/boucles_soleil.jpg) no-repeat;
        background-attachment: fixed;
        padding: 250px 0;
        background-size: cover;
        text-align: center;
        margin: 0;
        height: auto;
        width: 100%;
    }

    #title{
        font-size: 135px;
        color: whitesmoke;
    }
</style>