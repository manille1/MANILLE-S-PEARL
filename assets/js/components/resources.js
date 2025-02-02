import { getResourcesById, getResources, toggleEnabledResources, createResources, updateResources } from "../services/resources.js";
import { showToast } from "./shared/showToast.js";
import { getCategoryName } from "./shared/getCategoryName.js";

export const refreshList = async (resourcesType, page, search, actualUser, right) => {
    const tbodyElement = document.querySelector('tbody')
    const data = await getResources(resourcesType, page, search)

    let listContent = []
    
    if (data.error === "No resource with given identifier found") {
        showToast('Aucun résultat trouvé :/', 'bg-danger')

    } else {
        for(let i = 0; i < data.results.length; i++){
            listContent.push( getlistContentByType(resourcesType, data.results[i], actualUser, right) )
        }
        
        tbodyElement.innerHTML = listContent.join('')
        
        document.querySelector('.pagination').innerHTML = getPagination(data.count.total)
        

        handlePagination(page, resourcesType, search, actualUser, right)
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

        const modifyElement = document.getElementsByName("modify_button");
        modifyElement.forEach(modifyLink => {
           modifyLink.addEventListener('click', async (e) => {
                e.preventDefault()

                if(modifyLink===null){
                    $errors = 'Id de l\'article est null et donc invalide'
                } else {
                    const resourceId = modifyLink.getAttribute('data-id')
                    await getResourceFormModal('modify', resourcesType, resourceId)
                    
                    await modifyOrCreateResources('modify', resourcesType, resourceId)
                }
            
            })
        })

        const createBtn = document.querySelector("#createBtn");
        createBtn.addEventListener('click', async () => {
            await getResourceFormModal('create', resourcesType)

                await modifyOrCreateResources('create', resourcesType, '0')
        })
    }
}

const getResourcesModal = async (resourcesType, articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
    const data = await getResourcesById(resourcesType, articleId)
    
    
    if (resourcesType === 'article') {
        const categoryName = getCategoryName(data.results[0].category)

        modalElement.querySelector('.modal-title').innerHTML = data.results[0].name

        modalElement.querySelector('.modal-body').innerHTML = `
                        <img src="./uploads/${data.results[0].image_name}.jpg" alt="${data.results[0].image_name}">
                        <div class="text">
                            <p class="small">${categoryName}</p>
                            <h2>${data.results[0].name}</h2>
                            <p class="description">${data.results[0].description}</p>
                            <p class="description">ID : ${data.results[0].id}</p>
                            <div class="info">
                                <p>Prix : ${data.results[0].price} €</p>
                                <p>${data.results[0].stock === 0 ? 'Rupture de stock' : data.results[0].stock + ' en stock'} <i class="fa-solid fa-boxes-stacked"></i></p>
                            </div>
                        </div>`
        modalElement.querySelector('.modal-footer').innerHTML = `<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>`

    } else if (resourcesType === 'user') {
        modalElement.querySelector('.modal-title').innerHTML = data.results[0].username

        modalElement.querySelector('.modal-body').innerHTML = `
                            <h2>${data.results[0].username}</h2>
                            <p class="description">ID : ${data.results[0].id}</p>
                            <div class="info">
                                <p>Role : ${data.results[0].role === 1 ? 'admin <i class="fa-solid fa-user-tie"></i>' : 'user <i class="fa-solid fa-user"></i>'}</p>
                                <p>Activé : ${data.results[0].enabled === 1 ? 
                                    `<i class="fa-solid fa-square-check text-success"></i>` 
                                    : `<i class="fa-solid fa-square-xmark text-danger"></i>`}</p>
                            </div>`
        modalElement.querySelector('.modal-footer').innerHTML = `<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>`

    }

    modal.show()
}

const getResourceFormModal = async (action, resourcesType, articleId) => {
    const modalElement = document.querySelector('#staticBackdrop')
    const modal = new bootstrap.Modal(modalElement)
        
        if (resourcesType === 'article') {
            modalElement.querySelector('.modal-body').innerHTML = `
                            <form method="post" id="resources-form" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Photo d'article</label>
                                    <input class="form-control" type="file" id="image" name="image" required>
                                </div>
                                <!-- img existe que si il y a id dans url donc que qd modif -->
                                <div class="mb-3 d-flex align-items-end" id="resources-image"> 
                                    <img class="img-thumbnail d-none" src="" width="100"></i>
                                    <a href="#" class="x-mark d-none" ><i class="fa fa-times text-danger ms-3" id="remove-image-btn" data-id=""></i></a>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="int" class="form-control" id="category" name="category" required>
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description de l'article</label>
                                    <input type="textarea" class="form-control" id="description" name="description">
                                </div>
                                <div class="row g-3">
                                    <div class="col">
                                        <label for="prix" class="form-label">Prix en €</label>
                                        <input type="text" class="form-control" id="prix" name="price" required>
                                    </div>
                                    <div class="col">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock">
                                    </div>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="enabled" name="enabled">
                                    <label class="form-check-label" for="enabled">Disponible</label>
                                </div>
                            </form>`
            modalElement.querySelector('.modal-footer').innerHTML = `<button id="close-btn" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                        <button id="saveBtn" type="submit" class="btn btn-primary">Enregistrer</button>`
            
            if (resourcesType === 'article') {
                const imgInput = document.querySelector('#image')
                const imgPreview = document.querySelector('.img-thumbnail')
                const xmarkImg = document.querySelector('.x-mark')
                
                imgInput.addEventListener('change', () => {
                    if (imgInput.files.length > 0) {
                        imgPreview.classList.remove('d-none')
                        xmarkImg.classList.remove('d-none')

                    } else {
                        imgPreview.setAttribute('class', 'img-thumbnail d-none')
                        xmarkImg.setAttribute('class', 'x-mark d-none')
                        
                    }
                })

                xmarkImg.addEventListener('click', () => {
                    imgInput.value = ''
                    imgPreview.src = ''
                    imgPreview.setAttribute('class', 'img-thumbnail d-none')
                    xmarkImg.setAttribute('class', 'x-mark d-none')
                })
            }
    
        } else if (resourcesType === 'category') {
            modalElement.querySelector('.modal-body').innerHTML = `
                            <form method="post" id="resources-form" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                            </form>`
            modalElement.querySelector('.modal-footer').innerHTML = `<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button id="saveBtn" type="submit" class="btn btn-primary">Enregistrer</button>`

        } else if (resourcesType === 'user') {
            modalElement.querySelector('.modal-body').innerHTML = `
                        <form method="post" id="resources-form" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select id ="role" class="form-select" aria-label="Default select example">
                                    <option id="default" selected>Sélectionnez le rôle</option>
                                    <option id="admin" value="1">Administrateur</option>
                                    <option id="user" value="2">Utilisateur</option>
                                </select>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="enabled">
                                <label class="form-check-label" for="enabled">Disponible</label>
                            </div>
                        </form>`
            modalElement.querySelector('.modal-footer').innerHTML = `<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            <button id="saveBtn" type="submit" class="btn btn-primary">Enregistrer</button>`
        }
        modal.show()

    if (action === 'modify') {
        const data = await getResourcesById(resourcesType, articleId)

        if (resourcesType === 'article') {
            modalElement.querySelector('.modal-title').innerHTML = data.results[0].name

            document.getElementById("name").value = data.results[0].name
            
            const imgPreview = document.querySelector('.img-thumbnail')
            imgPreview.src = `./uploads/${data.results[0].image_name}.jpg`

            if (imgPreview.src.length > 0) {
                imgPreview.classList.remove('d-none')
                document.querySelector('.x-mark').classList.remove('d-none')
            }

            document.getElementById('category').value = data.results[0].category
            document.getElementById('description').value = data.results[0].description
            document.getElementById('prix').value = data.results[0].price
            document.getElementById('stock').value = data.results[0].stock
            document.getElementById('enabled').checked = data.results[0].enabled === 1 ? true : false

        } else if (resourcesType === 'category') {
            modalElement.querySelector('.modal-title').innerHTML = data.results[0].name
            document.getElementById("name").value = data.results[0].name
        } else if (resourcesType === 'user') {
            modalElement.querySelector('.modal-title').innerHTML = data.results[0].username
            document.getElementById("name").value = data.results[0].username

            if(data.results[0].role === 1){
                document.getElementById("role").children.selected = false
                document.getElementById("role").querySelector('#admin').selected = true
                

            } else if (data.results[0].role === 2) {
                document.getElementById("role").children.selected = false
                document.getElementById("role").querySelector('#user').selected = true
            }

            document.getElementById("enabled").checked = data.results[0].enabled === 1 ? true : false

        }

    }
        
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

const handlePagination = (page, resourcesType, search, actualUser, right) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')
    

    previousLink.addEventListener('click', async () => {
        if (page > 1 ){
            page--
            await refreshList(resourcesType, page, search, actualUser, right)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(resourcesType, pageNumber, search, actualUser, right)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(resourcesType, page, search, actualUser, right)
    })
}

const getlistContentByType = (resourcesType, i, actualUser, right) => {
    const listContentByType = []

    if (resourcesType === 'article') {
        const categoryName = getCategoryName(i.category)
        listContentByType.push(`<tr>
                            <th scope="row" class="center">${i.id}</th>
                            <td>${i.name}<a href='#' class="resource-click" data-id="${i.id}">
                                <i class="fa-solid fa-circle-info"></i></a></td>
                            <td>${categoryName}</td>
                            <td>${i.price}</td>
                            <td>${i.stock}</td>
                            ${right === "1" ? 
                                `<td class="center">
                                    <a href="#"class="enabled-icon-a" data-id="${i.id}">
                                        ${i.enabled === 1 ? 
                                            `<i class="fa-solid fa-square-check text-success"></i>` 
                                            : `<i class="fa-solid fa-square-xmark text-danger"></i>`}
                                    </a>
                                </td>
                                <td class="center">
                                    <a href='index.php?component=resources&resources=article&action=delete&id=${i.id}' class="delete">
                                        <i class="fa-solid fa-trash-can text-danger"></i></a> 
                                    <a href='index.php?component=resources&resources=article&action=modify&id=${i.id}' 
                                    class="modify" name="modify_button" data-id="${i.id}">
                                        <i class="fa-solid fa-pen-nib text-primary"></i></a>
                                </td>` 
                            : '' }
                        </tr>`)
    } else if (resourcesType === 'category') {
        listContentByType.push(`<tr>
                            <th scope="row" class="center">${i.id}</th>
                            <td>${i.name}</td>
                            ${right === "1" ? 
                                `<td class="center">
                                    <a href='index.php?component=resources&resources=article&action=delete&id=${i.id}' class="delete">
                                        <i class="fa-solid fa-trash-can text-danger"></i></a> 
                                </td>` 
                            : ''}
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
                            ${right === "1" ?
                                `${i.username !== actualUser ? 
                                    `<td class="center">
                                        <a href="#" class="enabled-icon-a" data-id="${i.id}">
                                            ${i.enabled === 1 ? 
                                                `<i class="fa-solid fa-square-check text-success"></i>` 
                                                : `<i class="fa-solid fa-square-xmark text-danger"></i>`}
                                        </a>
                                    </td>` 
                                    : `<td class="center"><i class="fa-solid fa-square-check" style="color: #75b798;"></i></td>`} 
                                <td class="center">
                                    <a href='index.php?component=resources&resources=article&action=delete&id=${i.id}' class="delete">
                                        <i class="fa-solid fa-trash-can text-danger"></i></a> 
                                </td>` 
                            : ''}
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
            
            const result = await toggleEnabledResources(resourcesType, resourcesId, currentPage, search)
            
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

const modifyOrCreateResources = async (action, resourcesType, resourcesId) => {
    const saveBtn = document.querySelector('#saveBtn')

    saveBtn.addEventListener('click', async(e) => {
        let result = ''
        let message = ''
        const form = document.querySelector('#resources-form')
        

        if (!form.checkValidity()) {
            form.reportValidity()
            return false
        }

        if (action === 'create') {
            result = await createResources(resourcesType, form)
            message = 'La céation a été efféctuée avec succès'
        } else if(action === 'modify') {
            result = await updateResources(resourcesType, form, resourcesId)
            message = 'La modification a été efféctuée avec succès'
        }


        if (result.hasOwnProperty('success')) {
            showToast(message, 'bg-success')
            (e.target.name  === 'saveBtn') ? form.reset() :null

        } else if(result.hasOwnProperty('error')) {
            showToast(`Une erreur a été rencontrée: ${result.error}`, 'bg-danger')
        }
    })
}
