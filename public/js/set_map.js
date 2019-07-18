let mymap = L.map('map').setView([45.837325, 1.48935], 7);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiaGlkYXJpIiwiYSI6ImNqdzZldTY4bjF3eWU0N3Bsc2pvMnJrdzkifQ.XexB94TZjXyb2jjMzHLIiQ'
}).addTo(mymap);

//Token is passed
/**async function findAdress() {
    const ip = await fetch('http://api.ipify.org/?format=json')
        .then(response => response.json())
        .then(json => json.ip);


    await fetch('https://geo.ipify.org/api/v1?apiKey=at_1ZKO7mJQ1xRUUT98iJyhlPUaWN7dN&ipAddress=' + ip)
        .then(response => response.json())
        .then(json => {
            const longitude = json.location.lng;
            const latitude = json.location.lat;
            marker = L.marker([latitude, longitude]).addTo(mymap);
            marker.bindPopup("<p class='mainPopup'>Vous êtes ici ! <span class='herePopup'>(environ)</span>").openPopup();
        });
}**/
