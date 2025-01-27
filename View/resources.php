<h1>Vos CRUD</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Categorie</th>
            <th scope="col">Prix</th>
            <th scope="col">Stock</th>
            <th scope="col">Disponibilité</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<script src="./assets/js/services/resources.js" type="module"></script>
<script src="./assets/js/components/resources.js" type="module"></script>
<script type ="module">
    import { refreshList } from "./assets/js/components/resources.js";

    document.addEventListener('DOMContentLoaded', async () => {
      const searchInput = document.querySelector('#search')
      const searchBtn = document.querySelector('#search-btn')

      let currentPage = 1
      let search = searchInput.value
      
      console.log('avant refreshList');
      
      await refreshList(currentPage, search)  

      searchBtn.addEventListener('click', async() => {
        search = searchInput.value
        await refreshList(currentPage, search)
        
      })     
    })
</script>