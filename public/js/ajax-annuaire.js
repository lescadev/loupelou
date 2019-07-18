let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');

search.addEventListener("input", function(){
    ajaxPostList('prestataire');
    ajaxPostMap('prestataire');
});

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

ajaxPostList('prestataire');
ajaxPostMap('prestataire');