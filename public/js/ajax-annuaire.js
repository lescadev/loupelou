let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');
let selectFilter = document.getElementById('sel1');
let selectFilterRadius = document.getElementById('sel2');

function ajaxPostList(status) {

    let filter;
    if(selectFilter)
        filter = selectFilter.value;
    else
        filter = null;

    let distance;
    if(selectFilterRadius)
        if(selectFilterRadius.value === 'Toutes les distances')
            distance = 0;
        else
            distance = Number(selectFilterRadius.value.substring(0, 2));


getPosition().finally(function() {
    let data = {
        'search' : search.value,
        'display': 'list',
        'status' : status,
        'filter': filter,
        'distance' : distance,
        'longitude' : 1.4966784,
        'latitude' : 45.846528000000006
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
});

}

function ajaxPostMap(status) {

    let filter;
    if(selectFilter)
        filter = selectFilter.value;
    else
        filter = null;

    let distance;
    if(selectFilterRadius)
        if(selectFilterRadius.value === 'Toutes les distances')
            distance = 0;
        else
            distance = Number(selectFilterRadius.value.substring(0, 2));

    let data = {
        'search' : search.value,
        'display' : 'map',
        'status': status,
        'filter': filter,
        'distance' : distance,
        'longitude' : 1.4966784,
        'latitude' : 45.846528000000006
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

