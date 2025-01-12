<div class="fond_bijoux">
    <div id="title">Tous nos colliers</div>
</div>
<section id="articles">
    <?php foreach($necklaces as $necklace): ?>
        <div class="card">
            <img src="./IMG/<?php echo $necklace['image_name']; ?>.jpg" alt="<?php echo $necklace['image_name']; ?>">
            <div class="text">
                <p class="small">Collier</p>
                <a href="#"><h2><?php echo $necklace['name'] ;?></h2></a>
                <p class="description"><?php echo mb_substr($necklace['description'], 0, 50)?> ...</p>
                <div class="info">
                    <p><?php echo $necklace['price'] ?> €</p>
                    <p><?php echo $necklace['stock'] ?> en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                    <a class="add_button" href="#"><i class="fa-solid fa-circle-plus"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<style>
    .fond_bijoux{
        background: url(IMG/fond_perles.jpg) no-repeat;
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