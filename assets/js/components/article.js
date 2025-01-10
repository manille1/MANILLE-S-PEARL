import { getArticles } from "../services/article.js";

export const refreshList = async (page) => {
    const sectionArcticles = document.querySelector('#articles')
    const data = await getArticles(page)

    let listContent = []

    for(let i = 0; i < data.results.length; i++){

        let categoryType = ''
        switch (data.results[i].category){
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
        }

        listContent.push(`<div class="card">
                            <img src="./IMG/${data.results[i].image_name}.jpg" alt="${data.results[i].image_name}">
                            <div class="text">
                                <p class="small">${categoryType}</p>
                                <a href="#"><h2>${data.results[i].name}</h2></a>
                                <p class="description">${data.results[i].description.slice(0, 50)} ...</p>
                                <div class="info">
                                    <p>${data.results[i].price} €</p>
                                    <p>${data.results[i].stock} en stock <i class="fa-solid fa-boxes-stacked"></i></p>
                                    <a class="add_button" href="#"><i class="fa-solid fa-circle-plus"></i></a>
                                </div>
                            </div>
                        </div>`)
    }

    sectionArcticles.innerHTML = listContent.join('')

    document.querySelector('.pagination').innerHTML = getPagination(data.count.total)

    handlePagination(page)

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