export const getResources = async (resourcesType, currentPage = 1, search) => {
    try {
        const response = await fetch(`index.php?component=resources&resources=${resourcesType}&page=${currentPage}&search=${search}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        return await response.json();

    } catch (error) {
        return { error: error.message };
    }
}

export const getResourcesById = async (resourcesType, articleId) => {
    try {
        const response = await fetch(`index.php?component=resources&resources=${resourcesType}&id=${articleId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        return await response.json();

    } catch (error) {
        return { error: error.message };
    }
}

export const toggleEnabledResources = async (resourcesType, id, currentPage, search) => {
    try {
        const response = await fetch(`index.php?component=resources&resources=${resourcesType}&action=toggle_enabled&id=${id}&page=${currentPage}&search=${search}`,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        return await response.json()

    } catch (error) {
        return { error: error.message };
    }
}

export const createResources = async (resourcesType, form) =>  {

    const data = new FormData(form)

    const response = await fetch(`index.php?component=resources&resources=${resourcesType}&action=create`, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'POST',
        body: data
    })

    return response.json()
}

export const updateResources = async (resourcesType, form, id) =>  {

    const data = new FormData(form)

    const response = await fetch(`index.php?component=resources&resources=${resourcesType}&action=update&id=${id}&page=${currentPage}&search=${search}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        method: 'POST',
        body: data
    })

    return response.json()
}