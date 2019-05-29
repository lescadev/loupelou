function markerPresta() {
    fetch("/api").then(response => response.json())
        .then(json => {
            for(let i = 0; i < json.prestataire.length; i++) {
                L.marker([
                    json.prestataire[i][0].coordonnees.lat,
                    json.prestataire[i][0].coordonnees.lng,
                ]).bindPopup(json.prestataire[i][0].name).addTo(mymap);
            }
        })
}

findAdress();
markerPresta();