let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');
let selectFilter = document.getElementById('sel1');
let selectFilterRadius = document.getElementById('sel2');

function setEvent(status) {
    if(search) {
        search.addEventListener("input", function(){
            sendData(status)
        });
    }
    if(selectFilter) {
        selectFilter.addEventListener("change", function() {
            sendData(status)
        });
    }
    if(selectFilterRadius) {
        selectFilterRadius.addEventListener("change", function() {
            sendData(status)
        });
    }
    sendData(status)
}

