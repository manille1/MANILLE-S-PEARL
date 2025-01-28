<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="nav-link active" aria-current="page" href="index.php">
            <img id="logo" src="./IMG/logo MANILLE'S PEARL.png" alt="logo MANILLE'S PEARL">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php?component=articles">Voir tout les articles</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Voir les catégories</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php?component=colliers">Colliers</a></li>
                    <li><a class="dropdown-item" href="index.php?component=bracelets">Bracelets</a></li>
                    <li><a class="dropdown-item" href="index.php?component=bagues">Bagues</a></li>
                    <li><a class="dropdown-item" href="index.php?component=boucles">Boucles d'oreilles</a></li>
                    <?php if (empty($_SESSION)) { ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="index.php?component=cart">Panier</a></li>
                    <?php }; ?>
                </ul>
            </li>
            <?php if(!empty($_SESSION['auth'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?component=users">Voir tout les utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bs-danger-text-emphasis" href="index.php?deconnect">Deconnexion</a>
                </li>
            <?php }; ?>
        </ul>
        <form class="d-flex" role="search">
            <input name="component" value="articles" type="hidden">
            <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                   name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                   style="<?php echo (strpos($_SERVER['REQUEST_URI'], 'component') === false) ? 'display: none;' : ''; ?>">
            <button id="search-btn" class="btn btn-outline-dark" type="button"
                style="<?php echo (strpos($_SERVER['REQUEST_URI'], 'component') === false) ? 'display: none;' : ''; ?>">
                Search</button>
        </form>
        </div>
    </div>
</nav> 
