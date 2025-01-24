export const getCategoryName = (article_category) => {
    let categoryType = ''
    switch (String(article_category)){
        case '1':
            categoryType = 'colliers'  
            break
    
        case '2':
            categoryType = 'bracelets'  
            break
    
        case '3':
            categoryType = 'bagues'   
            break
    
        case '4':
            categoryType = 'boucles'
            break

        default:
            categoryType = 'Category non trouvé'
            break
    }

    return categoryType
}