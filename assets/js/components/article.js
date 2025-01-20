import { getArticleById, getArticles } from "../services/article.js";
//import { getArticleById } from "../services/article.js";

export const refreshList = async (page) => {
    const sectionArcticles = document.querySelector('#articles')
    const data = await getArticles(page)

    let listContent = []

    for(let i = 0; i < data.results.length; i++){

        const categoryName = getCategoryName(data.results[i].category)

        listContent.push(`<div class="card">
                            <img src="./IMG/${data.results[i].image_name}.jpg" alt="${data.results[i].image_name}">
                                <div class="text">
                                    <p class="small">${categoryName}</p>
                                    <a href="#" class="card-click" data-id="${data.results[i].id}"><h2>${data.results[i].name}</h2></a>
                                    <p class="description">${data.results[i].description.slice(0, 50)} ...</p>
                                    <div class="info">
                                        <p>${data.results[i].price} €</p>
                                        <p>${data.results[i].stock} en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                                        <a href="#" class="add_button" data-id="${data.results[i].id}">${data.results[i].stock === 0 ? '' : '<i class="fa-solid fa-circle-plus"></i>'}</a>
                                    </div>
                                </div>
                        </div>`)
    }

    sectionArcticles.innerHTML = listContent.join('')

    document.querySelector('.pagination').innerHTML = getPagination(data.count.total)

    handlePagination(page)

    // Ajout des écouteurs sur les éléments "card-click"
    const cardClick = document.querySelectorAll('.card-click')
    

    cardClick.forEach(cardLink => {
        cardLink.addEventListener('click', async (e) => {
            e.preventDefault()

            if(cardLink===null){
                console.log('Id de l\'article est null et donc invalide')
            } else {
                const articleId = cardLink.getAttribute('data-id')
                console.log('articleID :', articleId)
                await getArticleModal(articleId)
                
            }
        })
    })
}

const getCategoryName = (article_category) => {
    let categoryType = ''
    switch (String(article_category)){
        case '1':
            categoryType = 'Collier'  
            break
    
        case '2':
            categoryType = 'Bracelets'  
            break
    
        case '3':
            categoryType = 'Bague'   
            break
    
        case '4':
            categoryType = 'Boucles d\'oreilles'
            break

        default:
            categoryType = 'blague'
            break
    }

    return categoryType
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

const handlePagination = (page) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async () => {
        if (page > 1 ){
            page--
            await refreshList(page)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(page)
    })

}

export const getArticleModal = async (articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
    const data = await getArticleById(articleId)
    console.log('actualArticle :', data.results[0])
    
    
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