<div class="fond_collier">
    <div class="title">Tous nos colliers</div>
</div>
<section id="necklace-articles" class="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/collier.js" type="module"></script>
<script src="./assets/js/components/collier.js" type="module"></script>
<script type ="module">
    import { refreshNecklaceCard } from "./assets/js/components/collier.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshNecklaceCard(currentPage)
    })
</script>