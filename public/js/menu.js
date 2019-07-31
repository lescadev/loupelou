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
        'statut': 'nav-statut',
        'reglement': 'nav-reglement',
        'rendu': 'nav-rendu'
    }

    for (const index in links) {
        if (route === index) {
            if (route === 'inscription_particulier' || route == 'inscription_pro') {
                let focusLink = document.getElementsByClassName(links[index])
                focusLink[0].setAttribute('class', 'nav-item dropdown active ' + links[index])
            } else if (route === 'contacter') {
                let focusLink = document.getElementsByClassName(links[index])
                console.log(focusLink)
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
                focusLink[1].setAttribute('class', 'nav-link active ' + links[index])
            } else {
                let focusLink = document.getElementsByClassName(links[index])
                console.log(focusLink)
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
            }
        }
    }
}