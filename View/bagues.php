<div class="fond_bijoux">
    <div id="title">Toutes nos bagues</div>
</div>
<section id="ring-articles">
    
</section>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>

<style>
    .fond_bijoux{
        background: url(IMG/bague_perles.jpg) no-repeat;
        background-attachment: fixed;
        padding: 250px 0;
        background-size: cover;
        text-align: center;
        margin: 0;
        height: auto;
        width: 100%;
    }

    #title{
        font-size: 135px;
        color: whitesmoke;
    }
</style>

<script src="./assets/js/services/bague.js" type="module"></script>
<script src="./assets/js/components/bague.js" type="module"></script>
<script type ="module">
    import { refreshRingCard } from "./assets/js/components/bague.js";

    document.addEventListener('DOMContentLoaded', async () => {
        let currentPage = 1

        refreshRingCard(currentPage)
    })
</script>