let mymap = L.map('map').setView([45.837325, 1.48935], 9);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiaGlkYXJpIiwiYSI6ImNqdzZldTY4bjF3eWU0N3Bsc2pvMnJrdzkifQ.XexB94TZjXyb2jjMzHLIiQ'
}).addTo(mymap);

let layerGroup = L.layerGroup().addTo(mymap);

let Alimentation = L.icon({
    iconUrl: '../images/marker/alimentation.png',
    iconSize:     [25, 25]
});

let Artisanat = L.icon({
    iconUrl: '../images/marker/artisanat.png',
    iconSize:     [25, 25]
});

let Association = L.icon({
    iconUrl: '../images/marker/social.png',
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
    let markers = {};
    for (let i = 0; i < Object.keys( data ).length - 1; i++) {
        markers[data[i].userId] = L.marker([
            data[i].latitude,
            data[i].longitude,
        ], {icon: ifCategory(data, i)}).bindPopup(data[i].denomination).addTo(layerGroup);
    }
    for(let card of cards) {
        card.addEventListener("mouseover" , () => {
            markers[card.id].openPopup();
        });
        card.addEventListener('mouseleave', () => {
            mymap.closePopup();
        });
    }
}
