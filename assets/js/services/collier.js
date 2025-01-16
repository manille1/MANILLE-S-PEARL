export const getNecklaceArticles = async (currentPage = 1) => {
    try{
        const response = await fetch(`index.php?component=colliers&page=${currentPage}`, {
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