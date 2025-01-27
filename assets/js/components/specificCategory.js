import { getArticles, getArticleById } from "../services/specificCategory.js";
import { showToast } from "./shared/showToast.js";
import { getCategoryName } from "./shared/getCategoryName.js";

export const refreshArticlesCard = async (category, page, search) => {
    const sectionArticles = document.querySelector('.articles')
    const categoryName = getCategoryName(category)
    const data = await getArticles(category, page, search)
    console.log(data);
    
    
    let cardContent = []

    if (data.error === "No resource with given identifier found") {
            showToast('Aucun résultat trouvé :/', 'bg-danger')
    
    } else if (data.count.total === 1 && (search !== null && search !== undefined && search !== '')) {
        cardContent.push(`<div class="card">
                             <img src="./IMG/${data.results[0].image_name}.jpg" alt="${data.results[0].image_name}">
                                 <div class="text">
                                     <p class="small">${categoryName}</p>
                                     <a href="#" class="card-click" data-id="${data.results[0].id}"><h2>${data.results[0].name}</h2></a>
                                     <p class="description">${data.results[0].description.slice(0, 50)} ...</p>
                                     <div class="info">
                                         <p>${data.results[0].price} €</p>
                                         <p>${data.results[0].stock} en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                                         <a href="#" class="add_button" data-id="${data.results[0].id}">${data.results[0].stock === 0 ? '' : '<i class="fa-solid fa-circle-plus"></i>'}</a>
                                     </div>
                                 </div>
                         </div>`)
 
        sectionArticles.innerHTML = cardContent.join('')
         
        const articleId = data.results[0].id
        await getArticleModal(category, articleId)
 
    } else {
        for(let i = 0; i < data.results.length; i++){
            cardContent.push(`<div class="card">
                                <img src="./IMG/${data.results[i].image_name}.jpg" alt="${data.results[i].image_name}">
                                <div class="text">
                                    <p class="small">${categoryName}</p>
                                    <a href="#" class="card-click" data-id="${data.results[i].id}"><h2>${data.results[i].name}</h2></a>
                                    <p class="description">${data.results[i].description.slice(0, 50)} ...</p>
                                    <div class="info">
                                        <p>${data.results[i].price} €</p>
                                        <p>${data.results[i].stock} en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                                        <a class="add_button" href="#">${data.results[i].stock === 0 ? '' : '<i class="fa-solid fa-circle-plus"></i>'}</a>
                                    </div>
                                </div>
                            </div>`)
        }

        sectionArticles.innerHTML = cardContent.join('');
        
        if(data.count > 15){
            document.querySelector('.pagination').innerHTML = getPagination(data.count.total)
            handlePagination(page, search)
        }

        const cardClick = document.querySelectorAll('.card-click')
        
        cardClick.forEach(cardLink => {
            cardLink.addEventListener('click', async (e) => {
                e.preventDefault()

                if(cardLink===null){
                    $errors = 'Id de l\'article est null et donc invalide'
                } else {
                    const articleId = cardLink.getAttribute('data-id')
                    //console.log('En attente de la moddal :', articleId)
                    await getArticleModal(1, articleId)
                    
                }
            })
        })
    }
}


export const getArticleModal = async (categoryNumber, articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
    const categoryName = getCategoryName(categoryNumber)
    
    
    console.log('articleID :', articleId, 'categoryNumber :', categoryNumber, 'categoryName :', categoryName)
    const data = await getArticleById(articleId)
    console.log('actualArticle :', data)
    
    modalElement.querySelector('.modal-title').innerHTML = data.results[0].name


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
    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++){
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`)

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