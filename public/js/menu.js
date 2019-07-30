let setActiveLink = function (route) {
    let links = document.getElementsByClassName('nav-link')
    let linksDropdown = document.getElementsByClassName('dropdown')
    let routesArray = ['login', 'index', 'procurer', 'utiliser', 'inscription_particulier', 'evenements', 'blog', 'contacter', 'mentions', 'cgv', 'cgu', 'statut', 'reglement', 'rendu', 'inscription_pro', 'blogArticle', 'contacter']

    for (let i = 0; i < routesArray.length - 1; i++) {
        const element = routesArray[i];
        
        if (element === route) {
            if (element === 'inscription_pro') {
                let o = findIndex('inscription_particulier')
                console.log(`---------${o}`)
                links[o].setAttribute('class', 'nav-link secondaire active')
            } else {
            links[i].setAttribute('class', 'nav-link secondaire active')
        }
    }


    // if (route === 'login') {
    //     links[0].setAttribute('class', 'nav-link secondaire active')
    // } else if (route === 'index') {
    //     links[1].setAttribute('class', 'nav-link secondaire active')
    // } else if (route === 'procurer') {
    //     links[2].setAttribute('class', 'nav-link active')
    // } else if (route === 'utiliser') {
    //     links[3].setAttribute('class', 'nav-link active')
    // } else if (route === 'inscription_particulier') {
    //     linksDropdown[0].setAttribute('class', 'nav-item dropdown active')
    // } else if (route === 'inscription_pro') {
    //     linksDropdown[0].setAttribute('class', 'nav-item dropdown active')
    // } else if (route === 'evenements') {
    //     links[5].setAttribute('class', 'nav-link active')
    // } else if (route === 'blog') {
    //     links[6].setAttribute('class', 'nav-link active')
    // } else if (route === 'blogArticle') {
    //     links[6].setAttribute('class', 'nav-link active')
    // } else if (route === 'contacter') {
    //     links[7].setAttribute('class', 'nav-link active')
    // } else if (route === 'mentions') {
    //     links[8].setAttribute('class', 'nav-link active')
    // } else if (route === 'cgv') {
    //     links[9].setAttribute('class', 'nav-link active')
    // } else if (route === 'cgu') {
    //     links[10].setAttribute('class', 'nav-link active')
    // } else if (route === 'statut') {
    //     links[11].setAttribute('class', 'nav-link active')
    // } else if (route === 'reglement') {
    //     links[12].setAttribute('class', 'nav-link active')
    // } else if (route === 'rendu') {
    //     links[13].setAttribute('class', 'nav-link active')
    // }
}




// let setActiveLink = function (route) {
//     let links = document.getElementsByClassName('nav-link')
//     let linksDropdown = document.getElementsByClassName('dropdown')

//     if (route === 'login') {
//         links[0].setAttribute('class', 'nav-link secondaire active')
//     } else if (route === 'index') {
//         links[1].setAttribute('class', 'nav-link secondaire active')
//     } else if (route === 'procurer') {
//         links[2].setAttribute('class', 'nav-link active')
//     } else if (route === 'utiliser') {
//         links[3].setAttribute('class', 'nav-link active')
//     } else if (route === 'inscription_particulier') {
//         linksDropdown[0].setAttribute('class', 'nav-item dropdown active')
//     } else if (route === 'inscription_pro') {
//         linksDropdown[0].setAttribute('class', 'nav-item dropdown active')
//     } else if (route === 'evenements') {
//         links[5].setAttribute('class', 'nav-link active')
//     } else if (route === 'blog') {
//         links[6].setAttribute('class', 'nav-link active')
//     } else if (route === 'blogArticle') {
//         links[6].setAttribute('class', 'nav-link active')
//     } else if (route === 'contacter') {
//         links[7].setAttribute('class', 'nav-link active')
//     } else if (route === 'mentions') {
//         links[8].setAttribute('class', 'nav-link active')
//     } else if (route === 'cgv') {
//         links[9].setAttribute('class', 'nav-link active')
//     } else if (route === 'cgu') {
//         links[10].setAttribute('class', 'nav-link active')
//     } else if (route === 'statut') {
//         links[11].setAttribute('class', 'nav-link active')
//     } else if (route === 'reglement') {
//         links[12].setAttribute('class', 'nav-link active')
//     } else if (route === 'rendu') {
//         links[13].setAttribute('class', 'nav-link active')
//     }
// }
// setActiveLink(route)