function getPosition() {
    return new Promise((res, rej) => {
        navigator.geolocation.getCurrentPosition(res, rej);
    });
}

async function main() {
    try{
        const position = await getPosition();
        L.marker([position.coords.latitude, position.coords.longitude]).bindPopup("<p class='mainPopup'>Vous êtes ici !</p>").addTo(mymap).openPopup();
    }catch(e){
        console.log(e.message);
    }
}

main();
