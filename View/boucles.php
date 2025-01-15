<div id="fond_boucles">
    <div id="title">Toutes nos boucles d'oreilles</div>
</div>
<section id="earring-articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/boucle.js" type="module"></script>
<script src="./assets/js/components/boucle.js" type="module"></script>
<script type ="module">
    import { refreshEarringCard } from "./assets/js/components/boucle.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshEarringCard(currentPage)
    })
</script>