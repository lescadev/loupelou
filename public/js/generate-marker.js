let layerGroup = L.layerGroup().addTo(mymap);

let Alimentation = L.icon({
    iconUrl: '../images/marker/alimentation.png',
    iconSize:     [25, 25]
});

let Artisanat = L.icon({
    iconUrl: '../images/marker/artisana.png',
    iconSize:     [25, 25]
});

let Culture = L.icon({
    iconUrl: '../images/marker/culture.png',
    iconSize:     [25, 25]
});
let Education = L.icon({
    iconUrl: '../images/marker/formation.png',
    iconSize:     [25, 25]
});

let Hotellerie = L.icon({
    iconUrl: '../images/marker/hotellerie.png',
    iconSize:     [25, 25]
});

let Magasin = L.icon({
    iconUrl: '../images/marker/magasin.png',
    iconSize:     [25, 25]
});

let Restauration = L.icon({
    iconUrl: '../images/marker/resto.png',
    iconSize:     [25, 25]
});

let Sante = L.icon({
    iconUrl: '../images/marker/santébienetre.png',
    iconSize:     [25, 25]
});

let Service = L.icon({
    iconUrl: '../images/marker/service.png',
    iconSize:     [25, 25]
});
let Social = L.icon({
    iconUrl: '../images/marker/social.png',
    iconSize:     [25, 25]
});

let Comptoir = L.icon({
    iconUrl: '../images/marker/comptoir.png',
    iconSize:     [25, 25]
});


function ifCategory(data, i) {
    if(data[i].nom)
        return eval(data[i].nom);
    else
        return eval("Comptoir")
}

function displayMap(data) {
    layerGroup.clearLayers();
    for (let i = 0; i < data.length; i++) {
            L.marker([
                data[i][0].latitude,
                data[i][0].longitude,
            ], {icon: ifCategory(data, i)}).bindPopup(data[i].denomination).addTo(layerGroup);
        }
}
//findAdress();