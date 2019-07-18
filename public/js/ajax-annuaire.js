let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');
let selectFilter = document.getElementById('sel1');

function ajaxPostList(status) {

    let filter;
    if(selectFilter)
        filter = selectFilter.value;
    else
        filter = null;

    let data = {
        'search' : search.value,
        'display': 'list',
        'status' : status,
        'filter': filter
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

    let filter;
    if(selectFilter)
        filter = selectFilter.value;
    else
        filter = null;

    let data = {
        'search' : search.value,
        'display' : 'map',
        'status': status,
        'filter': filter
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

