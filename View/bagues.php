<div id="fond_bagues">
    <div class="title">Toutes nos bagues</div>
</div>
<section id="ring-articles" class="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/bague.js" type="module"></script>
<script src="./assets/js/components/bague.js" type="module"></script>
<script type ="module">
    import { refreshRingCard } from "./assets/js/components/bague.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshRingCard(currentPage)
    })
</script>