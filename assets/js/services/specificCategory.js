export const getNecklaceArticles = async (currentPage = 1, search) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=colliers&page=${currentPage}&search=${search}`, {
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

export const getBraceletArticles = async (currentPage = 1, search) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=bracelets&page=${currentPage}&search=${search}`, {
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

export const getEarringsArticles = async (currentPage = 1, search) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=boucles&page=${currentPage}&search=${search}`, {
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

export const getRingArticles = async (currentPage = 1, search) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=bagues&page=${currentPage}&search=${search}`, {
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

export const getArticleById = async (category, articleId) => {
    try {
        const response = await fetch(`index.php?component=specificCategory&category=${category}&id=${articleId}`, {
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