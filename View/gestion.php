<h1 id="intro-admin"> Bienvenue <?php echo $_SESSION['username']; ?></h1>

<?php if ($_SESSION['role'] === 2) { ?>
    <div id="info-right">
        <p>Vous êtes un user. Vous avez donc accés à tous les produits et toutes les catégories.
        </br>Vous ne pouvez que lire ces derniers.</p>
    </div>
<?php } elseif ($_SESSION['role'] === 1) { ?>
    <div id="info-right">
        <p>Vous êtes un administrateur. Vous avez donc accés à tous les produits, toutes les catégories et tous les utilisateurs.
        </br>Vous pouvez lire, modifier, supprimer et créer ces derniers.</p>
    </div>
<?php }; ?>

<div id="category-choice">
    <h2>Que voulez vous faire ?</h2>
    <div class="card-choice">
        <div><img src="./IMG/article.jpg" alt="boîte empiler"></div>
        <h3>Articles</h3>
        <p>Tous les articles à la ventes ou non sont visible ici.</p>
        <a href="index.php?component=resources&resources=article">Tous nos articles</a>
    </div>
    
    <div class="card-choice">
        <div><img src="./IMG/post-it.jpg" alt="post-it d'organisation"></div>
        <h3>Catégories</h3>
        <p>Toutes les catégories disponibles ou non sont visible ici.</p>
        <a href="index.php?component=resources&resources=category">Toutes nos categories</a>
    </div>

    <?php if($_SESSION['role'] === 1) { ?>
        <div class="card-choice">
            <div><img src="./IMG/users.jpg" alt="users"></div>
            <h3>Utilisateurs</h3>
            <p>Tous les utilisateurs sont visible ici.</p>
            <a href="index.php?component=resources&resources=user">Tous nos utilisateurs</a>
        </div>
    <?php }; ?>
</div>