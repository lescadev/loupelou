function ajaxPost(data) {

    fetch("ajax-annuaire", {
        method: "POST",
        body: JSON.stringify(data)
    }).then(function(response){
        return response.text();
    })
        .then(function(data){
            let json = JSON.parse(data);
            annuaire.innerHTML = "";
            annuaire.insertAdjacentHTML('beforeend', json.card);
            displayMap(json);
            setEventModal();
        });
}

function ajaxModal(data) {
    fetch("ajax-modal", {
        method: "POST",
        body: JSON.stringify(data)
    }).then(function(response){
        return response.json();
    }).then(function(data){
        setModalContent(data);
    })
}
