let options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

function success(pos) {
    let crd = pos.coords;

    L.marker([crd.latitude,
        crd.longitude]).bindPopup("<p class='mainPopup'>Vous êtes ici !</p>").addTo(mymap).openPopup();

}

function error(err) {
    console.warn(`ERREUR (${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error, options);
