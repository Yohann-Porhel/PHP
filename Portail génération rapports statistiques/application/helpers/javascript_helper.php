<?php

function js_get_script_dialogue_supprimer() {

    $scriptRetour = '';

    $scriptRetour .= 'function js_dialogue_supprimer(libelleDialogue) {' . "\n";


    $scriptRetour .= '$("#popupconfirmation").text(libelleDialogue);' . "\n";

    // cette ligne est très importante pour empêcher les liens ou les boutons de rediriger
    // vers une autre page avant que l'usager ait cliqué dans le popup
    $scriptRetour .= 'event.preventDefault();' . "\n";
    // retrouve l'attribut href du lien sur lequel on a cliqué
    $scriptRetour .= 'var targetUrl = $(this).attr("href");' . "\n";

// on définit les boutons ici plutôt que plus haut puisqu'on a besoin de connaître l'URL de la page, qui n'était pas encore disponible sur le document.ready.
    $scriptRetour .= '$("#popupconfirmation").dialog({' . "\n";

    $scriptRetour .= 'buttons: [' . "\n";
    $scriptRetour .= '{' . "\n";
    $scriptRetour .= 'text: "Oui",' . "\n";
    $scriptRetour .= 'click: function () {' . "\n";
    $scriptRetour .= 'window.location.href = targetUrl;' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= '},' . "\n";
    $scriptRetour .= '{' . "\n";
    $scriptRetour .= 'text: "Non",' . "\n";
    $scriptRetour .= 'click: function () {' . "\n";
    $scriptRetour .= '$(this).dialog("close");' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= ']' . "\n";
    $scriptRetour .= '});' . "\n";

    // affichage du popup
    $scriptRetour .= '$("#popupconfirmation").dialog("open");' . "\n";

    $scriptRetour .= '}' . "\n";


    return $scriptRetour;
}

function js_get_script_dialogue_confirmer() {

    $scriptRetour = '';
    $scriptRetour .= 'function js_dialogue_confirmer(libelleDialogue) {' . "\n";
    $scriptRetour .= '$("#popupconfirmation").text(libelleDialogue);' . "\n";    
    $scriptRetour .= 'event.preventDefault();' . "\n";  
    $scriptRetour .= 'var targetUrl = $(this).attr("href");' . "\n";
    $scriptRetour .= '$("#popupconfirmation").dialog({' . "\n";
    $scriptRetour .= 'buttons: [' . "\n";
    $scriptRetour .= '{' . "\n";
    $scriptRetour .= 'text: "Confirmer l\'abonnement au rapport",' . "\n";
    $scriptRetour .= 'click: function () {' . "\n";
    $scriptRetour .= 'window.location.href = targetUrl;' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= '},' . "\n";
    $scriptRetour .= '{' . "\n";
    $scriptRetour .= 'text: "Annuler",' . "\n";
    $scriptRetour .= 'click: function () {' . "\n";
    $scriptRetour .= '$(this).dialog("close");' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= '}' . "\n";
    $scriptRetour .= ']' . "\n";
    $scriptRetour .= '});' . "\n";
    $scriptRetour .= '$("#popupconfirmation").dialog("open");' . "\n";
    $scriptRetour .= '}' . "\n";
    
    return $scriptRetour;
}
