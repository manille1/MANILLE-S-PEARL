<section id="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/article.js" type="module"></script>
<script src="./assets/js/components/article.js" type="module"></script>
<script type ="module">
    import { refreshList } from "./assets/js/components/article.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshList(currentPage)
    })
</script>