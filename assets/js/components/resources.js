import { getResourcesById, getResources, toggleEnabledresources} from "../services/resources.js";
import { showToast } from "./shared/showToast.js";
import { getCategoryName } from "./shared/getCategoryName.js";

export const refreshList = async (resourcesType, page, search, actualUser) => {
    const tbodyElement = document.querySelector('tbody')
    const data = await getResources(resourcesType, page, search)
    //console.log('data :', data);
    

    let listContent = []
    
    if (data.error === "No resource with given identifier found") {
        showToast('Aucun résultat trouvé :/', 'bg-danger')
        

    } else {
        
        for(let i = 0; i < data.results.length; i++){
            listContent.push( getlistContentByType(resourcesType, data.results[i], actualUser) )
        }
        
        tbodyElement.innerHTML = listContent.join('')
        
        document.querySelector('.pagination').innerHTML = getPagination(data.count.total)
        
        
        handlePagination(page, resourcesType, search, actualUser)
        await handleEnabledClick(resourcesType, page, search)

        const resourceClick = document.querySelectorAll('.resource-click')

        resourceClick.forEach(resourceLink => {
            resourceLink.addEventListener('click', async (e) => {
                e.preventDefault()

                if(resourceLink===null){
                    $errors = 'Id de l\'article est null et donc invalide'
                } else {
                    const articleId = resourceLink.getAttribute('data-id')
                    await getResourcesModal(resourcesType, articleId)
                        
                }
            })
        })
    }
}

const getResourcesModal = async (resourcesType, articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
    const data = await getResourcesById(resourcesType, articleId)
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

const handlePagination = (page, resourcesType, search, actualUser) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')
    

    previousLink.addEventListener('click', async () => {
        if (page > 1 ){
            page--
            await refreshList(resourcesType, page, search, actualUser)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(resourcesType, pageNumber, search, actualUser)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(resourcesType, page, search, actualUser)
    })
}

const getlistContentByType = (resourcesType, i, actualUser) => {
    const listContentByType = []

    if (resourcesType === 'article') {
        const categoryName = getCategoryName(i.category)
        listContentByType.push(`<tr>
                            <th scope="row" class="center">${i.id}</th>
                            <td>${i.name}
                                <a href='#' class="resource-click" data-id="${i.id}">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </td>
                            <td>${categoryName}</td>
                            <td>${i.price}</td>
                            <td>${i.stock}</td>
                            <td class="center">
                                <a href="#"class="enabled-icon-a" data-id="${i.id}">
                                    ${i.enabled === 1 ? 
                                        `<i class="fa-solid fa-square-check text-success"></i>` 
                                        : `<i class="fa-solid fa-square-xmark text-danger"></i>`}
                                </a>
                            </td>
                        </tr>`)
    } else if (resourcesType === 'category') {
        listContentByType.push(`<tr>
                            <th scope="row" class="center">${i.id}</th>
                            <td>${i.name}
                                <a href='#' class="resource-click" data-id="${i.id}">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </td>
                        </tr>`)
    } else if (resourcesType === 'user') {
        listContentByType.push(`<tr>
                            <th scope="row" class="center">${i.id}</th>
                            <td>${i.username}
                                <a href='#' class="resource-click" data-id="${i.id}">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </td>
                            <td>${i.role === 1 ? 'admin <i class="fa-solid fa-user-tie"></i>' : 'user <i class="fa-solid fa-user"></i>'}</td>
                            ${i.username !== actualUser ? 
                                `<td class="center">
                                    <a href="#" class="enabled-icon-a" data-id="${i.id}">
                                        ${i.enabled === 1 ? 
                                            `<i class="fa-solid fa-square-check text-success"></i>` 
                                            : `<i class="fa-solid fa-square-xmark text-danger"></i>`}
                                    </a>
                                </td>` 
                                : `<td class="center"> 
                                    <i class="fa-solid fa-square-check" style="color: #75b798;"></i>
                                </td>`}
                        </tr>`)
    }

    return listContentByType.join('');
}

const handleEnabledClick = async (resourcesType, currentPage, search) => {
    const enabledIcons = document.querySelectorAll(".enabled-icon-a")
    //console.log(enabledIcons);
    
    enabledIcons.forEach(enabledIcon => {
        enabledIcon.addEventListener('click', async (e) => {
            const resourcesId = e.target.closest('.enabled-icon-a').getAttribute('data-id')
            
            const result = await toggleEnabledresources(resourcesType, resourcesId, currentPage, search)
            
            if (result.hasOwnProperty('error')) {
                showToast(result.error, 'bg-danger')
            } else {
                if (e.target.classList.contains('fa-square-check')) {
                    e.target.classList.remove('fa-square-check', 'text-success')
                    e.target.classList.add('fa-square-xmark', 'text-danger')
                } else {
                    e.target.classList.add('fa-square-check', 'text-success')
                    e.target.classList.remove('fa-square-xmark', 'text-danger')
                }
                showToast('Le statut a été modifé avec succès', 'bg-success')
            }
        })
    })
}