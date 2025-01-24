export const getNecklaceArticles = async (currentPage = 1) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=colliers&page=${currentPage}`, {
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

export const getBraceletArticles = async (currentPage = 1) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=bracelets&page=${currentPage}`, {
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

export const getEarringsArticles = async (currentPage = 1) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=boucles&page=${currentPage}`, {
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

export const getRingArticles = async (currentPage = 1) => {
    try{
        const response = await fetch(`index.php?component=specificCategory&category=bagues&page=${currentPage}`, {
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