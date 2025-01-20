const autoCompleteJS = new autoComplete({
    selector: '#search',
    threshold: 2,  
    
    data: {
        src: async () => {
            const response = await fetch(`index.php`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            const data = await response.json()
            
            return data.results
         },
         keys: ['name']
    },

    resultItem: {
        highlight: true,
    }

})


autoCompleteJS.input.addEventListener('selection', async (e) => {
    //Créer la fonction getArticleModal et l'implémenter dans tt les mvc
    await getArticleModal(e.detail.selection.value.id)
    document.querySelector('#search').value = e.detail.selection.match
})