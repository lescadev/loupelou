let layerGroup = L.layerGroup().addTo(mymap);

function displayMap(data) {
    layerGroup.clearLayers();
    for (let i = 0; i < data.length; i++) {
        L.marker([
            data[i].latitude,
            data[i].longitude,
        ]).bindPopup(data[i].nom).addTo(layerGroup);
    }
}
//findAdress();