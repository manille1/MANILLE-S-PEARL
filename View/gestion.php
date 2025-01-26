<h1> Bienvenue <?php echo $_SESSION['username']; ?></h1>

<!--petit texte pour expliquer à l'utilisateur ce qu'il peut faire en fonction de sont rôle-->
<?php if ($_SESSION['role'] === 'worker') { ?>
    <div id="info-right">
        <p>Vous êtes un employé de niveau 2. Vous avez donc accés à tous les produits et toutes les catégories.
        </br>Vous ne pouvez que lire ces derniers.</p>
    </div>
<?php } elseif ($_SESSION['role'] === 'admin') { ?>
    <div id="info-right">
        <p>Vous êtes un administrateur de niveau 1. Vous avez donc accés à tous les produits, toutes les catégories et tous les utilisateurs.
        </br>Vous pouvez lire, modifier, supprimer et créer ces derniers.</p>
    </div>
<?php }; ?>

<!-- 3 cards avec image pour chaque CRUD toujours en fonction du role-->
<?php if ($_SESSION['role'] === 'worker') { ?>
    <div id="card-category">
        
    </div>
<?php } elseif ($_SESSION['role'] === 'admin') { ?>
    <div id="card-category">
        
    </div>
<?php }; ?>