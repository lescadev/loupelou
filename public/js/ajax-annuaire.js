let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');

function ajaxPostList(status) {

    let data = {
        'search' : search.value,
        'display': 'list',
        'status' : status
    };

    fetch("/ajax-annuaire", {
        method: "POST",
        body: JSON.stringify(data)
    })
        .then(function(response){

            return response.text();
        })
        .then(function(data){
            annuaire.innerHTML = "";
            annuaire.insertAdjacentHTML('beforeend', data);
        });
}

function ajaxPostMap(status) {
    let data = {
        'search' : search.value,
        'display' : 'map',
        'status': status
    };
    fetch("/ajax-annuaire", {
        method: "POST",
        body: JSON.stringify(data)
    })
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            displayMap(data)
        });
}

