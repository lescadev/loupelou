function markerPresta() {
    fetch("/api?statut=prestataire").then(response => response.json())
        .then(json => {
            for(let i = 0; i < json.prestataire.length; i++) {
                if (json.prestataire[i][0].coordonnees.lat !== null && json.prestataire[i][0].coordonnees.lat !== null) {
                    L.marker([
                        json.prestataire[i][0].coordonnees.lat,
                        json.prestataire[i][0].coordonnees.lng,
                    ]).bindPopup(json.prestataire[i][0].name).addTo(mymap);
                }
            }
        })
}

findAdress();
markerPresta();