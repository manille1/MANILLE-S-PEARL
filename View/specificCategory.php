<div id="fond_<?php echo $_GET['category']; ?>">
    <?php switch ($_GET['category']) {
        case '1' : ?>
            <div class="title">Tous nos colliers</div>
            <?php break;
        case '2' : ?>
            <div class="title">Tous nos bracelets</div>
            <?php break;
        case '4' : ?>
            <div class="title">Toutes nos boucles d'oreilles</div>
            <?php break;
        case '3' : ?>
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
    import { refreshArticlesCard, getArticleModal } from "./assets/js/components/specificCategory.js";

    document.addEventListener('DOMContentLoaded', async () => {
        const searchInput = document.querySelector('#search')
        const searchBtn = document.querySelector('#search-btn')

        let category = document.querySelector('section').id
        let currentPage = 1
        let search = searchInput.value

        
        await refreshArticlesCard(category, currentPage, search)  

        searchBtn.addEventListener('click', async() => {
            search = searchInput.value
            await refreshArticlesCard(category, currentPage, search)
            
        })  
    })

</script>