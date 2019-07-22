function getPosition() {
    return new Promise((res, rej) => {
        navigator.geolocation.getCurrentPosition(res, rej);
    });
}

function displayCurrentPos() {
    getPosition().then(value => {
        L.marker([value.coords.latitude, value.coords.longitude]).bindPopup("<p class='mainPopup'>Vous êtes ici !</p>").addTo(mymap).openPopup();
    }).catch(e =>{
        console.log(e.message);
    })
}

function getData(status, position = null){
    return new Promise(((resolve) => {

        let latitude = position === null ? null : position.coords.latitude;
        let longitude = position === null ? null : position.coords.longitude;

        let filter = selectFilter ? selectFilter.value : null;

        let distance;
        if(selectFilterRadius)
            if(selectFilterRadius.value === 'Toutes les distances')
                distance = 0;
            else
                distance = Number(selectFilterRadius.value.substring(0, 2));

        let data = {
            'search' : search.value,
            'status' : status,
            'filter': filter,
            'distance' : distance,
            'longitude' : longitude,
            'latitude' : latitude
        };

        resolve(data);
    }))
}

function sendData(status) {
    getPosition().then((value => {
            getData(status, value).then(data => {
                ajaxPost(data);
            });
        })).catch(() => {
        selectFilterRadius.disabled = true;
            getData(status).then(data => {
                ajaxPost(data);
            });
        })
}

displayCurrentPos();
