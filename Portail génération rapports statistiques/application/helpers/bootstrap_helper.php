<?php

function table_header($columns, $tableLabel = '') {
    $ret = '';
    $ret .= '<div class="panel panel-default">' . "\n";
    if (isset($tableLabel) && $tableLabel != '') {
        $ret .= '<div class="panel-heading">' . $tableLabel . '</div>' . "\n";
    }
    $ret .= '<div class="panel-body">' . "\n";
    $ret .= '<table class="table table-hover">' . "\n";
    $ret .= '<thead>' . "\n";
    $ret .= '<tr>' . "\n";
    foreach ($columns as $column) {
        $ret .= '<th>' . $column . '</th>' . "\n";
    }
    return $ret;
}

function table_line($values) {
    $ret = '';
    $ret .= '</tr>' . "\n";
    $ret .= '</thead>' . "\n";
    $ret .= '<tbody>' . "\n";
    $ret .= '<tr>' . "\n";
    $ret .= '<tr>' . "\n";
    foreach ($values as $value) {
        $ret .= '<td>' . "\n";
        $ret .= $value . "\n";
        $ret .= '</td>' . "\n";
    }
    $ret .= '</tr>' . "\n";
    return $ret;
}

function table_footer() {
    $ret = '';
    $ret .= '</tr>' . "\n";
    $ret .= '</tbody>' . "\n";
    $ret .= '</table>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function myform_header($label, $action = '', $panelParams = null) {
    $ret = '';
    $class = 'panel panel-default';
    $params = '';
    if (isset($panelParams) && !empty($panelParams)) {
        foreach ($panelParams as $param => $value) {
            if ($param == 'class') {
                $class .= ' ' . $value;
            } else {
                $params .= $param . '="' . $value . '" ';
            }
        }
    }

    $ret .= '<div class="' . $class . '" ' . $params . '>' . "\n";
    $ret .= '<div class="panel-heading">' . $label . '</div>' . "\n";
    $ret .= '<div id="formulaire">' . "\n";
    $url = '';
    if (isset($action) && $action != '') {
        $url = $action;
    }
    $ret .= '<form style="margin-right:10px" class="form-horizontal" action="' . $url . '" method="post" accept-charset="utf-8" enctype="multipart/form-data">' . "\n";
    return $ret;
}

function table_header_custom() {
    $ret = '';
    $ret .= '<div class="panel-body">' . "\n";
    $ret .= '<table class="table table-hover">' . "\n";
    $ret .= '<thead>' . "\n";
    $ret .= '<tr>' . "\n";
    return $ret;
}

function table_footer_custom() {
    $ret = '';
    $ret .= '</tr>' . "\n";
    $ret .= '</thead>' . "\n";
    $ret .= '</table>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function myform_header_invisible($label, $action = '', $panelParams = null) {
    $ret = '';
    $ret .= '<div style="display:none">' . "\n";
    $class = 'panel panel-default';
    $params = '';
    if (isset($panelParams) && !empty($panelParams)) {
        foreach ($panelParams as $param => $value) {
            if ($param == 'class') {
                $class .= ' ' . $value;
            } else {
                $params .= $param . '="' . $value . '" ';
            }
        }
    }

    $ret .= '<div class="' . $class . '" ' . $params . '>' . "\n";
    $ret .= '<div class="panel-heading">' . $label . '</div>' . "\n";
    $ret .= '<div id="formulaire">' . "\n";
    $url = '';
    if (isset($action) && $action != '') {
        $url = $action;
    }
    $ret .= '<form style="margin-right:10px" class="form-horizontal" action="' . $url . '" method="post" accept-charset="utf-8" enctype="multipart/form-data">' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function myform_footer($btnLabel = 'Valider', $info = '') {
    $ret = '';

    /* Ajout du bouton */
    $ret .= '<div class="form-group">' . "\n";
    $ret .= '<div class="col-xs-12 text-center">' . "\n";
    $ret .= '<button type = "submit" class = "btn" alt=' . $info . ' title=' . $info . '>' . $btnLabel . '</button>' . "\n";
    $ret .= '</div>';
    $ret .= '</div>';

    /* Fermeture des divs du formulaire */
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";

    return $ret;
}

function myform_footer_double($lien = '#', $btnLabel1 = '', $btnLabel2 = '') {

    $ret = '';
    /* Ajout des boutons */
    $ret .= '<div class="form-group">' . "\n";
    $ret .= '<div class="col-xs-offset-5 col-xs-2 text-center">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="Annuler" title="Annuler" button type = "submit" class="btn btn-default btn-block">' . $btnLabel1 . '</a>';
    $ret .= '<button type = "submit" alt="Valider" title="Valider" class = "btn btn-default btn-block">' . $btnLabel2 . '</button>' . "\n";
    $ret .= myform_print_flashdata($btnLabel2) . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";

    /* Fermeture des divs du formulaire */
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";

    return $ret;
}

function myform_input($name, $value = '', $label = '', $type = '', $txtDefaut = '') {

    if (estNullOuVide($value)) {
        $value = recupereSaisieUtilisateur($name);
    }

    $ret = '';

    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<!-- ' . $label . ' -->' . "\n";
    $ret .= '<div>';
    //$ret .= '<div class="form-group">' . "\n";
    $ret .= '<label for="' . $name . '" class="control-label text-center">' . $label . '</label>' . "\n";
    $ret .= '<input type="' . $type . '" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" placeholder="' . $txtDefaut . '">' . "\n";
    $ret .= myform_print_flashdata($name) . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= "\n";

    return $ret;
}

function myform_input_nombre_ou_date($name, $value = '', $label = '', $type = '', $min = '', $txtDefaut = '') {

    if (estNullOuVide($value)) {
        $value = recupereSaisieUtilisateur($name);
    }

    $ret = '';

    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<!-- ' . $label . ' -->' . "\n";
    $ret .= '<div>';
    $ret .= '<label for="' . $name . '" class="control-label text-center">' . $label . '</label>' . "\n";
    $ret .= '<input type="' . $type . '" min="' . $min . '" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '" placeholder="' . $txtDefaut . '">' . "\n";
    $ret .= myform_print_flashdata($name) . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= "\n";

    return $ret;
}

function myform_input_disabled($name, $value = '', $label = '', $type = '') {

    if (estNullOuVide($value)) {
        $value = recupereSaisieUtilisateur($name);
    }

    $ret = '';

    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<!-- ' . $label . ' -->' . "\n";
    $ret .= '<div>';
    $ret .= '<label for="' . $name . '" class="control-label text-center">' . $label . '</label>' . "\n";
    $ret .= '<input type="' . $type . '" disabled="disabled" name="' . $name . '" class="form-control" id="' . $name . '" value="' . $value . '">' . "\n";
    $ret .= myform_print_flashdata($name) . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= "\n";

    return $ret;
}

function myform_input_invisible($name, $value) {

    $ret = '';
    $ret .= '<div style="display:none">' . "\n";
    $ret .= '<input name="' . $name . '" id="' . $name . '" value="' . $value . '">' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= "\n";

    return $ret;
}

function myform_input_liste_header($name, $label) {

    $ret = '';
    $ret .= '<div>' . "\n";
    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<!-- ' . $label . ' -->' . "\n";
    $ret .= '<label for="' . $name . '" class="control-label text-center">' . $label . '</label>' . "\n";
    $ret .= '<div>' . "\n";
    $ret .= '<FORM>' . "\n";
    $ret .= '<SELECT class=form-control name="' . $name . '">' . "\n";
    return $ret;
}

function myform_input_liste_footer() {

    $ret = '';
    $ret .= '</SELECT>' . "\n";
    $ret .= '</FORM>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function bouton_ajouter($lien = '#', $libelle = '') {
    $ret = '';
    $ret .= '<div class="col-xs-12 text-center">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="Ajouter" title="Ajouter" class="btn btn-primary btn-lg">' . $libelle . '</a>';
    $ret .= '</div>' . "\n";
    return $ret;
}

function bouton_redirection_accueil($lien = 'accueil', $libelle = 'Retour à l\'accueil') {
    $ret = '';
    $ret .= '<div class="col-xs-12 text-center">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="retourner à l\'accueil" title="Retourner à l\'accueil" class="btn btn-info">' . $libelle . '</a>';
    $ret .= '</div>' . "\n";
    return $ret;
}

function bouton_rapport_annuler($lien = '#', $libelle = 'Annuler le rapport') {
    $ret = '';
    $ret .= '<div class="col-xs-12 text-center">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="Annuler le rapport" title="Annuler le rapport" id="annulerRapport" class="btn btn-danger btn-lg">' . $libelle . '</a>' . "\n";
    $ret .= '<br>' . "\n";
    $ret .= '<br>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function bouton_rapport_disponible($lien = '#', $libelle = 'OK') {
    $ret = '';
    $ret .= '<div class="col-xs-12 text-center">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="OK" title="OK" class="btn btn-info btn-sm">' . $libelle . '</a>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function bouton_modifier($lien = '#') {
    $ret = '';
    $ret .= '<a href="' . $lien . '" alt="Modifier" title="Modifier" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span></a>';
    return $ret;
}

function bouton_supprimer($lien = '#', $messageConfirmation = 'Confirmez-vous la suppression de cet enregistrement') {
    $ret = '';
    $ret .= '<a href="#" onclick="js_dialogue_supprimer(\'' . echappeChainePourJavascript($messageConfirmation) . '\',\'' . $lien . '\');" alt="Supprimer"  title="Supprimer" id="bouton_supprimer" class="btn btn-danger bouton_supprimer"><span class="glyphicon glyphicon-trash"></span></a>';
    $ret .= '<div id="popupconfirmation" title="Confirmation de suppression"></div>' . "\n";
    return $ret;
}

function bouton_consulter($lien = '#') {
    $ret = '';
    $ret .= '<a href="' . $lien . '" alt="Consulter" title="Consulter" class="btn btn-success"><span class="glyphicon glyphicon-folder-open"></span></a>';
    return $ret;
}

function bouton_radio($label, $name, $value, $checked, $libelle, $value2, $checked2, $libelle2) {
    $ret = '';
    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<b>' . $label . ' : </b><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked . ' > ' . $libelle . "\n";
    $ret .= '<input type="radio" name="' . $name . '" value="' . $value2 . '"' . $checked2 . ' > ' . $libelle2 . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function checkbox($name, $value) {
    $ret = '';
    $ret .= '<div class="col-xs-offset-1">' . "\n";
    $ret .= '<input type="checkbox" value="' . $value . '">' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function checkbox_label($name, $label, $value) {
    $ret = '';
    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<div class="text-center">' . "\n";
    $ret .= '<input type="checkbox" name="' . $name . '" value="' . $value . '">' . ' ' . $label . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function label($label, $value) {
    $ret = '';
    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<div align="center">' . "\n";
    $ret .= '<b>' . $label . ' : </b>' . $value . '' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function text($texte) {
    $ret = '';
    $ret .= '<div class="panel-body text-center">' . "\n";
    $ret .= '<div align="center"><b>' . $texte . '</b>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function glyphicon_actif() {
    $ret = '';
    $ret .= '<span style="color: green" class="glyphicon glyphicon-ok"></span>';
    return $ret;
}

function modal_header($lien) {
    $ret = '';
    $ret .= '<div class="modal-header">' . "\n";
    $ret .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' . "\n";
    $ret .= '<span aria-hidden="true">&times;</span>' . "\n";
    $ret .= '</button>';
    $ret .= '<h5 class="modal-title">Paramètres d\'actualisation du rapport</h5>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '<div class="modal-body">' . "\n";
    $ret .= '<form id="myForm" method="post" action="' . $lien . '" class="form-horizontal">' . "\n";
    return $ret;
}

function modal_line($label, $type, $name, $id) {

    $ret = '';
    $ret .= '<div class="form-group">' . "\n";
    $ret .= '<label class="col-xs-3 control-label">' . $label . '</label>' . "\n";
    $ret .= '<div class="col-xs-5">' . "\n";
    $ret .= '<input type="' . $type . '" class="form-control" name="' . $name . '" id="' . $id . '" placeholder="AAAA" />' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

function modal_footer($id_rapport) {

    $ret = '';
    $ret .= '<div style="display:none" class="form-group">' . "\n";
    $ret .= '<input type="text" class="form-control" name="ID_RAPPORT" value="' . $id_rapport . '" />' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '<div class="form-group">' . "\n";
    $ret .= '<div class="col-xs-5 col-xs-offset-3">' . "\n";
    $ret .= '<button type="submit" id="#inputrapport" class="btn btn-primary">Valider</button>' . "\n";
    $ret .= '<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</form>' . "\n";
    $ret .= '</div>' . "\n";
    return $ret;
}

/* -------------------------------------------------------------------------- */
/*                         Gestion des Flashdatas                             */
/* -------------------------------------------------------------------------- */

function myform_set_flashdata_error($alert, $champ_saisie = '') {
    $CI = get_instance();
    if ($champ_saisie == '') {
        $champ_saisie = 'page';
    }

    $CI->session->set_flashdata('error_' . $champ_saisie, $alert);
}

function myform_set_flashdata_warning($warning, $champ_saisie = '') {
    $CI = get_instance();
    if ($champ_saisie == '') {
        $champ_saisie = 'page';
    }

    $CI->session->set_flashdata('warning_' . $champ_saisie, $warning);
}

function myform_set_flashdata_info($info, $champ_saisie = '') {
    $CI = get_instance();
    if ($champ_saisie == '') {
        $champ_saisie = 'page';
    }

    $CI->session->set_flashdata('info_' . $champ_saisie, $info);
}

function myform_print_flashdata($champ_saisie = '') {

    $CI = get_instance();
    if ($champ_saisie == '') {
        $champ_saisie = 'page';
    }

    $flashdata = $CI->session->flashdata();

    if (!isset($flashdata) || empty($flashdata)) {
        return '';
    }

    $class = '';
    $message = '';
    if (!isset($flashdata) || empty($flashdata)) {
        return '';
    }

    /* Test des flashdatas de type info */
    if (isset($flashdata['info_' . $champ_saisie]) && $flashdata['info_' . $champ_saisie] != null) {
        $class = 'alert-info';
        $message = $flashdata['info_' . $champ_saisie];
    }

    /* Test des flashdatas de type warning */
    if (isset($flashdata['warning_' . $champ_saisie]) && $flashdata['warning_' . $champ_saisie] != null) {
        $class = 'alert-warning';
        $message = $flashdata['warning_' . $champ_saisie];
    }


    /* Test des flashdatas de type alerte */
    if (isset($flashdata['error_' . $champ_saisie]) && $flashdata['error_' . $champ_saisie] != null) {
        $class = 'alert-danger';
        $message = $flashdata['error_' . $champ_saisie];
    }

    if ($message == null || $message == '') {
        return '';
    }

    $ret = '<div class="alert ' . $class . ' text-center">' . "\n";
    $ret .= $message . "\n";
    $ret .= '</div>' . "\n";

    return $ret;
}

/* -------------------------------------------------------------------------- */
/*                     Boutons tests (à supprimer)                            */
/* -------------------------------------------------------------------------- */

/* Pas utilisé */

function myform_input_rechercher($name, $value = '', $label = '', $type = '', $txtDefaut = '', $lien = '#', $nameInput = '') {

    if (estNullOuVide($value)) {
        $value = recupereSaisieUtilisateur($name);
    }

    $ret = '';

    $ret .= '<div class="panel-body col-xs-offset-4 col-xs-4">' . "\n";
    $ret .= '<!-- ' . $label . ' -->' . "\n";
    $ret .= '<label for="' . $name . '" class="control-label text-center">' . $label . '</label>' . "\n";
    $ret .= '<div>' . "\n";
    $ret .= '<input type="' . $type . '" name="' . $name . '" class="form_ajouter" value="' . $value . '" placeholder="' . $txtDefaut . '">' . "\n";
    $ret .= '<a href="' . $lien . '" alt="Rechercher" title="Rechercher" name="' . $nameInput . '" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></a>' . "\n";
    $ret .= myform_print_flashdata($name) . "\n";
    $ret .= '</div>' . "\n";
    $ret .= '</div>' . "\n";
    $ret .= "\n";

    return $ret;
}

/* function bouton_lancer_rapport($lien = '#') {
  $ret = '';
  $ret .= '<a href="' . $lien . '" alt="Lancer" title="Générer le rapport" class="btn btn-info"><span class="glyphicon glyphicon-play"></span></a>';
  return $ret;
  }

  function bouton_lancer_rapport_old() {
  $ret = '';
  $ret .= '<a data-toggle="modal" data-target="#myModal" alt="Lancer" title="Générer le rapport" class="btn btn-info"><span class="glyphicon glyphicon-play"></span></a>';
  return $ret;
  } */