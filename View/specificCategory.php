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
<section id="<?php echo $_GET['category']; ?>" class="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/specificCategory.js" type="module"></script>
<script src="./assets/js/components/specificCategory.js" type="module"></script>
<script type ="module">
    import { refreshNecklaceCard, refreshBraceletCard, refreshEarringCard, refreshRingCard, getArticleModal } from "./assets/js/components/specificCategory.js";

    document.addEventListener('DOMContentLoaded', async () => {
        const searchInput = document.querySelector('#search')
        const searchBtn = document.querySelector('#search-btn')

        let currentPage = 1
        let category = document.querySelector('section').id
        let search = searchInput.value

        
        refreshList(category, currentPage, search)

        searchBtn.addEventListener('click', async() => {
            search = searchInput.value
            refreshList(category, currentPage, search)
        })
    })


    const refreshList = async(category, currentPage, search) =>{
        switch (category) {
                case 'colliers':
                    await refreshNecklaceCard(currentPage, search)
                    break;
                case 'bracelets':
                    await refreshBraceletCard(currentPage, search)
                    break;
                case 'boucle':
                    await refreshEarringCard(currentPage, search)
                    break;
                case 'bague':
                    await refreshRingCard(currentPage, search)
                    break;
            }
    }
</script>