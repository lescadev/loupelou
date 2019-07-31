let setActiveLink = function (route) {
    const links = {
        'index': 'nav-index',
        'procurer': 'nav-procurer',
        'utiliser': 'nav-utiliser',
        'inscription_particulier': 'nav-rejoindre',
        'inscription_pro': 'nav-rejoindre',
        'evenements': 'nav-evenements',
        'blog': 'nav-blog',
        'blogArticle': 'nav-blog',
        'contacter': 'nav-contacter',
        'mentions': 'nav-mentions',
        'cgv': 'nav-cgv',
        'cgu': 'nav-cgu',
        'statuts': 'nav-statuts',
        'reglementInterieur': 'nav-reglement',
        'compteRenduAG': 'nav-rendu'
    }

    for (const index in links) {
        if (route === index) {
            let focusLink = document.getElementsByClassName(links[index])
            if (route === 'inscription_particulier' || route == 'inscription_pro') {
                focusLink[0].setAttribute('class', 'nav-item dropdown active ' + links[index])
            } else if (route === 'contacter') {
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
                focusLink[1].setAttribute('class', 'nav-link active ' + links[index])
            } else {
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
            }
        }
    }
}