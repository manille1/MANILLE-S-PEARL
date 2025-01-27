import { getArticleById, getArticles } from "../services/resources.js";
import { showToast } from "./shared/showToast.js";
import { getCategoryName } from "./shared/getCategoryName.js";

export const refreshList = async (page, search) => {
    const tbodyElement = document.querySelector('tbody')
    console.log('page :', page, 'search :', search);
    
    const data = await getArticles(page, search)
    console.log('data :', data);
    

    let listContent = []
    
    if (data.error === "No resource with given identifier found") {
        showToast('Aucun résultat trouvé :/', 'bg-danger')

    } else {
        for(let i = 0; i < data.results.length; i++){
            const categoryName = getCategoryName(data.results[i].category)

            listContent.push(`<tr>
                                <th scope="row">${data.results[i].id}</th>
                                <td>${data.results[i].name}
                                    <a href=# class="resource-click" data-id="${data.results[i].id}>
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                                <td>${categoryName}</td>
                                <td>${data.results[i].price}</td>
                                <td>${data.results[i].stock}</td>
                                <td>${data.results[i].enabled}</td>
                            </tr>`)
        }

        tbodyElement.innerHTML = listContent.join('')

        document.querySelector('.pagination').innerHTML = getPagination(data.count.total)

        handlePagination(page, search)


        const resourceClick = document.querySelectorAll('.resource-click')

        resourceClick.forEach(resourceLink => {
            resourceLink.addEventListener('click', async (e) => {
                e.preventDefault()

                if(resourceLink===null){
                    $errors = 'Id de l\'article est null et donc invalide'
                } else {
                    const articleId = resourceLink.getAttribute('data-id')
                    await getResourcesModal(articleId)
                        
                }
            })
        })
    }
}

export const getResourcesModal = async (articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
    const data = await getArticleById(articleId)
    console.log('actualArticle :', data)
    
    
    modalElement.querySelector('.modal-title').innerHTML = data.results[0].name

    const categoryName = getCategoryName(data.results[0].category)

    modalElement.querySelector('.modal-body').innerHTML = `
                        <img src="./IMG/${data.results[0].image_name}.jpg" alt="${data.results[0].image_name}">
                        <div class="text">
                            <p class="small">${categoryName}</p>
                            <a href="#"><h2>${data.results[0].name}</h2></a>
                            <p class="description">${data.results[0].description}</p>
                            <div class="info">
                                <p>Prix : ${data.results[0].price} €</p>
                                <p>${data.results[0].stock === 0 ? 'Rupture de stock' : data.results[0].stock + ' en stock'} <i class="fa-solid fa-boxes-stacked"></i></p>
                            </div>
                        </div>`
    modalElement.querySelector('.modal-footer').innerHTML = `
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        ${data.results[0].stock === 0 ? '' : 
                            '<button type="button" class="btn btn-dark add_button">Ajouter au panier <i class="fa-solid fa-circle-plus"></i></button>'}
                        `
    modal.show()
}

const getPagination = (total) => {
    const countPages =  Math.ceil(total / 15)
    let paginationButton = []
    paginationButton.push(` <li class="page-item"><a class="page-link text-dark-emphasis" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++){
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn text-dark-emphasis" href="#">${i}</a></li>`)
    }

    paginationButton.push(` <li class="page-item"><a class="page-link text-dark-emphasis" href="#" id="next-link">Suivant</a></li>`)

    return paginationButton.join('')
}

const handlePagination = (page, search) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async () => {
        if (page > 1 ){
            page--
            await refreshList(page, search)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber, search)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(page, search)
    })
}