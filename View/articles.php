<section id="articles" class="articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<script src="./assets/js/services/article.js" type="module"></script>
<script src="./assets/js/components/article.js" type="module"></script>
<script type ="module">
    import { refreshList, getArticleModal } from "./assets/js/components/article.js";

    document.addEventListener('DOMContentLoaded', async () => {
      const searchInput = document.querySelector('#search')
      const searchBtn = document.querySelector('#search-btn')

      let currentPage = 1
      let search = searchInput.value
      
      
      await refreshList(currentPage, search)  

      searchBtn.addEventListener('click', async() => {
        search = searchInput.value
        await refreshList(currentPage, search)
        
      })     
    })
</script>