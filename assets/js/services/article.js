export const getArticles = async (currentPage = 1, search = '') => {
    try {
        const response = await fetch(`index.php?component=articles&page=${currentPage}&search=${search}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
    
        return await response.json();

    } catch (error) {
        throw error;
    }
}

export const getArticleById = async (articleId) => {
    try {
        const response = await fetch(`index.php?component=articles&id=${articleId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        return await response.json();

    } catch (error) {
        throw error;
    }
}