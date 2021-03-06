let setActiveLink = function (route) {
    const links = {
        'index': 'nav-index',
        'procurer': 'nav-procurer',
        'utiliser': 'nav-utiliser',
        'user.inscriptionParticulier': 'nav-rejoindre',
        'user.inscriptionProfessionnel': 'nav-rejoindre',
        'evenements': 'nav-evenements',
        'blog': 'nav-blog',
        'blogArticle': 'nav-blog',
        'contact': 'nav-contacter',
        'mentions': 'nav-mentions',
        'cgv': 'nav-cgv',
        'cgu': 'nav-cgu',
        'statuts': 'nav-statuts',
        'reglementInterieur': 'nav-reglement',
        'compteRenduAG': 'nav-rendu',
        'login': 'nav-login',
        'profil': 'nav-profil',
        'profil.informations': 'nav-profil',
        'profil.email': 'nav-profil',
        'profil.password': 'nav-profil'
    }

    for (const index in links) {
        if (route === index) {
            let focusLink = document.getElementsByClassName(links[index])
            if (route === 'user.inscriptionParticulier' || route === 'user.inscriptionProfessionnel') {
                focusLink[0].setAttribute('class', 'nav-item dropdown active ' + links[index])
            } else if (route === 'contact') {
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
                focusLink[1].setAttribute('class', 'nav-link active ' + links[index])
            } else if (route === 'profil' || route === 'profil.informations' || route === 'profil.email' || route === 'profil.password') {
                focusLink[0].setAttribute('class', 'nav-link d-md-none d-lg-none d-xl-none active ' + links[index])
            } else {
                focusLink[0].setAttribute('class', 'nav-link active ' + links[index])
            }
        }
    }
}