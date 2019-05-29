function markerComptoir() {
    fetch("/api?statut=comptoir").then(response => response.json())
        .then(json => {
            for(let i = 0; i < json.comptoir.length; i++) {
                if (json.comptoir[i][0].coordonnees.lat !== null && json.comptoir[i][0].coordonnees.lat !== null) {
                    L.marker([
                        json.comptoir[i][0].coordonnees.lat,
                        json.comptoir[i][0].coordonnees.lng,
                    ]).bindPopup(json.comptoir[i][0].name).addTo(mymap);
                }
            }
        })
}

findAdress();
markerComptoir();