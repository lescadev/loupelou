let layerGroup = L.layerGroup().addTo(mymap);

let alimentation = L.icon({
    iconUrl: '../images/marker/alimentation.png',
    iconSize:     [25, 25]
});

let artisana = L.icon({
    iconUrl: '../images/marker/artisana.png',
    iconSize:     [25, 25]
});

let culture = L.icon({
    iconUrl: '../images/marker/culture.png',
    iconSize:     [25, 25]
});
let formation = L.icon({
    iconUrl: '../images/marker/formation.png',
    iconSize:     [25, 25]
});

let ahotellerie = L.icon({
    iconUrl: '../images/marker/hotellerie.png',
    iconSize:     [25, 25]
});

let magasin = L.icon({
    iconUrl: '../images/marker/magasin.png',
    iconSize:     [25, 25]
});

let resto = L.icon({
    iconUrl: '../images/marker/resto.png',
    iconSize:     [25, 25]
});

let sante = L.icon({
    iconUrl: '../images/marker/santébienetre.png',
    iconSize:     [25, 25]
});

let serv = L.icon({
    iconUrl: '../images/marker/service.png',
    iconSize:     [25, 25]
});
let social = L.icon({
    iconUrl: '../images/marker/social.png',
    iconSize:     [25, 25]
});


function displayMap(data) {
    layerGroup.clearLayers();
    for (let i = 0; i < data.length; i++) {
        L.marker([
            data[i][0].latitude,
            data[i][0].longitude,
        ], {icon: resto}).bindPopup(data[i].denomination).addTo(layerGroup);
    }
}
//findAdress();