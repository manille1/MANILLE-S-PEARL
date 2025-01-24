<div id="fond_<?php echo $_GET['category']; ?>">
    <?php switch ($_GET['category']) {
        case 'colliers' : ?>
            <div class="title">Tous nos colliers</div>
            <?php break;
        case 'bracelets' : ?>
            <div class="title">Tous nos bracelets</div>
            <?php break;
        case 'boucles' : ?>
            <div class="title">Toutes nos boucles d'oreilles</div>
            <?php break;
        case 'bagues' : ?>
            <div class="title">Toutes nos bagues</div>
            <?php break;
    } ?>
</div>
<section id="<?php echo $_GET['category']; ?>-articles" class="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/specificCategory.js" type="module"></script>
<script src="./assets/js/components/specificCategory.js" type="module"></script>
<script type ="module">
    import { refreshNecklaceCard, refreshBraceletCard, refreshEarringCard, refreshRingCard } from "./assets/js/components/specificCategory.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1
        let category = document.querySelector('section').id
        console.log(category);
        

        switch (category) {
            case 'colliers-articles':
                refreshNecklaceCard(currentPage)
                break;
        
            case 'bracelets-articles':
                refreshBraceletCard(currentPage)
                break;
        
            case 'boucles-articles':
                refreshEarringCard(currentPage)
                break;
        
            case 'bagues-articles':
                refreshRingCard(currentPage)
                break;
        }
    })
</script>