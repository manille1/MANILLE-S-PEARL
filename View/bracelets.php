<div class="fond_bracelet">
    <div id="title">Tous nos bracelets</div>
</div>
<section id="bracelet-articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/bracelet.js" type="module"></script>
<script src="./assets/js/components/bracelet.js" type="module"></script>
<script type ="module">
    import { refreshBraceletCard } from "./assets/js/components/bracelet.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshBraceletCard(currentPage)
    })
</script>