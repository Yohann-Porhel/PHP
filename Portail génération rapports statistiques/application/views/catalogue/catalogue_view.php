<?php
/* ----------------------------------------------------------------- */
/*                 Liste des rapports du catalogue                   */
/* ----------------------------------------------------------------- */

$procedure_js = '';

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Souscrire';
$columns[2] = 'Rapport';
$columns[3] = '<div align="center">Coût mensuel</div>';

/* Création de l'entête de table */
echo table_header($columns, "Catalogue des rapports | Nombre de jetons disponibles : " . $nombre_jetons_disponible);

/* Ajout des lignes de données dans la table */
if (isset($rapports)) {

    foreach ($rapports as $rapport) {

        $line[1] = '<input type="checkbox" id="' . $rapport->id_apobi_rapport . '" name="' . $rapport->ra_libelle . '" value="' . $rapport->ra_tarif . '" data-toggle="toggle" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger">';
        $line[2] = $rapport->ra_libelle;
        $line[3] = '<b><div align="center">' . $rapport->ra_tarif . (($rapport->ra_tarif > 1) ? ' jetons' : ' jeton') . "</div></b>";

        // Initialisation du checkbox à vrai si le client est abonné à ce rapport uniquement
        if (isset($id_rapports_abonnes) && $id_rapports_abonnes != NULL && !empty($id_rapports_abonnes)) {
            foreach ($id_rapports_abonnes as $id) {
                if ($id->id_apobi_rapport == $rapport->id_apobi_rapport) {
                    $procedure_js .= "$('#" . $rapport->id_apobi_rapport . "').bootstrapToggle('on');" . "\n";
                }
            }
        }
        // Réalisation du lien entre la checkbox et la procédure js 'afficheMessageConfirmation'
        $procedure_js .= "$('#" . $rapport->id_apobi_rapport . "') . change(function () {" . "\n";
        $procedure_js .= "afficheMessageConfirmation($(this).prop('id'), $(this).prop('name'), $(this).prop('value'));" . "\n";
        $procedure_js .= "});" . "\n";

        /* Ajout de la ligne dans le tableau */
        echo table_line($line);
    }
}
/* Fin de la table */
echo table_footer();
echo bouton_redirection_accueil();
?>
<div id="msg"></div>

<div id="popupconfirmation" title="Confirmation d'abonnement"></div>

<script>

    $(function () {

<?php echo $procedure_js; ?>


        function afficheMessageConfirmation(id_apobi_rapport, ra_libelle, ra_tarif) {

            js_dialogue_confirmer("Vous avez demandé l\'abonnement au rapport : " + ra_libelle + ", pour un cout de " + ra_tarif + ((ra_tarif > 1) ? ' jetons' : ' jeton') + ", confirmez-vous ceci ?", id_apobi_rapport, ra_tarif);
        }
        ;
    });</script>