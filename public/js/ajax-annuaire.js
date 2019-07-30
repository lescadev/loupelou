function ajaxPost(data) {

    fetch("/ajax-annuaire", {
        method: "POST",
        body: JSON.stringify(data)
    }).then(function(response){
        return response.text();
    })
        .then(function(data){
            console.log(data);
            let json = JSON.parse(data);

            annuaire.innerHTML = "";
            annuaire.insertAdjacentHTML('beforeend', json.card);
            displayMap(json);
        });
}
