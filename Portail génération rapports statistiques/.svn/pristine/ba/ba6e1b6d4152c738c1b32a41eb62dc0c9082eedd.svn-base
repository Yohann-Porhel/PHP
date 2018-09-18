<?php
/* ----------------------------------------------------------------- */
/*                 Liste des rapports du client                      */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Nom du rapport';
$columns[2] = 'Date d\'activation';
$columns[3] = 'Lancer';
//$columns[3] = 'Dernière actualisation';

/* Création de l'entête de table */
echo table_header($columns, "Liste de vos rapports disponibles");

foreach ($rapports as $rapport) {
    
    $lienRapport = '';
    $line[1] = $rapport->ra_libelle;
    $line[2] = date("d-m-Y", strtotime($rapport->cc_date_activation));
    
    if (!isset($rapport->nb_invites) || $rapport->nb_invites == null || $rapport->nb_invites <= 0) {
        $lienRapport = 'href="' . base_url('Web_Commande_Controller/inserer_commande_rapport_sans_invites/' . $rapport->id_apobi_rapport) . '"';        
    } else {
        $lienRapport = 'onclick="ajaxLoadPopup(' . $rapport->id_apobi_rapport . ')" data-toggle="modal" data-target="#myModal"';        
    }
    
    $line[3] = '<a ' . $lienRapport . ' class="btn btn-info"><span class="glyphicon glyphicon-play"></span></a>';        
    
    echo table_line($line);
}

/* Finalisation du tableau */
echo table_footer();
echo bouton_redirection_accueil();
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Saisissez votre plage de données" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="contenu_popup">

        </div>
    </div>
</div>

<script>

    function ajaxLoadPopup(idRapport) {
        console.log('Chargement Ajax de : <?php echo base_url("rapport/"); ?>' + idRapport);
        $("#contenu_popup").load('<?php echo base_url("rapport/"); ?>' + idRapport);
    }

</script>