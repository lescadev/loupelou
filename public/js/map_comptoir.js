function markerComptoir() {
    fetch("/api").then(response => response.json())
        .then(json => {
            for(let i = 0; i < json.comptoir.length; i++) {
                L.marker([
                    json.comptoir[i][0].coordonnees.lat,
                    json.comptoir[i][0].coordonnees.lng,
                ]).bindPopup(json.comptoir[i][0].name).addTo(mymap);
            }
        })
}

findAdress();
markerComptoir();