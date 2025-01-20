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
        let currentPage = 1
        await refreshList(currentPage)
        
        // const card = document.querySelectorAll('.card')
        // const card = []
        // for(let i = 0; i < cardCount; i++){
        //   card.push(document.querySelector('.card'))
        // }
        
        // console.log(`Voici card : ${card}`)

        // const actualCard = document.querySelector('.card-click')

        // array.forEach(element => {
        //   cardCount.addEventListener('click', async () => {
        //         console.log('Le click passe dans l\'écoute')  
        //         e.preventDefault()
        //         const articleId = e.target.getAttribute('data-id')
        //         console.log('articleId :', articleId)
        //         await getArticleModal(articleId)
        //     })
        // });
            
    })
</script>