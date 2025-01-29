<?php if($_GET['resources'] === 'article'){ ?>
  <h1>CRUD article</h1>
<?php } elseif ($_GET['resources'] === 'category'){ ?>
  <h1>CRUD categorie</h1>
<?php } elseif ($_GET['resources'] === 'user' && $_SESSION['role'] === 1){ ?>
  <h1>CRUD user</h1>
<?php } ?>

<table id="<?php echo $_GET['resources']; ?>" class="table">
    <thead>
        <tr>
          <?php if($_GET['resources'] === 'article'){ ?>
            <th scope="col" class="center">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Categorie</th>
            <th scope="col">Prix</th>
            <th scope="col">Stock</th>
            <th scope="col" class="center">Disponibilité</th>
          <?php } elseif ($_GET['resources'] === 'category'){ ?>
            <th scope="col"class="center">ID</th>
            <th scope="col">Nom</th>
          <?php } elseif ($_GET['resources'] === 'user' && $_SESSION['role'] === 1){ ?>
            <th scope="col" class="center">ID</th>
            <th id ="username" scope="col" class="<?php echo $_SESSION['username']; ?>">Username</th>
            <th scope="col">Rôle</th>
            <th scope="col"class="center">Actif</th>
          <?php } ?>
          <th scope="col"class="center">Action</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    
  </ul>
</nav>


<script src="./assets/js/services/resources.js" type="module"></script>
<script src="./assets/js/components/resources.js" type="module"></script>
<script type ="module">
    import { refreshList } from "./assets/js/components/resources.js";

    document.addEventListener('DOMContentLoaded', async () => {
      const searchInput = document.querySelector('#search')
      const searchBtn = document.querySelector('#search-btn')
      const user = document.querySelector('#username')
      const actualUser = user ? user.getAttribute('class') : ''
      
      let currentPage = 1
      let search = searchInput.value
      let resourcesType = document.querySelector('table').id
      
      
      await refreshList(resourcesType, currentPage, search, actualUser)

      searchBtn.addEventListener('click', async() => {
        search = searchInput.value
        await refreshList(resourcesType, currentPage, search, actualUser)
        
      })

    })
</script>