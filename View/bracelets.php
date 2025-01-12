<div class="fond_bijoux">
    <div id="title">Tous nos bracelets</div>
</div>
<section id="articles">
    <?php foreach($bracelets as $bracelet): ?>
        <div class="card">
            <img src="./IMG/<?php echo $bracelet['image_name']; ?>.jpg" alt="<?php echo $bracelet['image_name']; ?>">
            <div class="text">
                <p class="small"><Bracelet</p>
                <a href="#"><h2><?php echo mb_substr($bracelet['name'],0,11) ;?> ...</h2></a>
                <p class="description"><?php echo mb_substr($bracelet['description'], 0, 50)?> ...</p>
                <div class="info">
                    <p><?php echo $bracelet['price'] ?> €</p>
                    <p><?php echo $bracelet['stock'] ?> en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                    <a class="add_button" href="#"><i class="fa-solid fa-circle-plus"></i></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<style>
    .fond_bijoux{
        background: url(IMG/bracelet_or.jpg) no-repeat;
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