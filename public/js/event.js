let search = document.getElementById("search");
let annuaire = document.getElementById('annuaire');
let selectFilter = document.getElementById('sel1');
let selectFilterRadius = document.getElementById('sel2');
let cards = document.getElementsByClassName('card');

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

function setEventModal() {

    let modalPresta = document.getElementById('modal_presta');

    if (cards && modalPresta) {
        for (let card of cards) {
            card.addEventListener("click", function () {
                $("#modal_presta").modal('show');
                ajaxModal(card.id);
            })
        }
    }
}

function setModalContent(data) {

    let denomination = $('#presta_denomination');
    let categorie = $('#categorie');
    let description = $('#description');
    let site = $('#site');
    let adresse = $('#adresse');
    let pref = $('#pref');

    denomination.html(data.nom);
    categorie.empty();
    description.empty();
    site.empty();
    adresse.empty();

    if(data.categorie){
        pref.replaceWith('Catégorie: ');
        for(c of data.categorie) {
            categorie.append(c.nom + ' ');
        }
    } else {
        pref.empty();
    }

    description.html(data.description);
    site.html(data.site_internet);
    adresse.html(data.rue + " " + data.code_postal + " " + data.ville);
}

