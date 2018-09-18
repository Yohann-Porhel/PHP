<?php

echo text(' - Jetons disponibles pour ' . $client->cl_nom . ' au ' . date('d-m-Y') . ' : ' . $jetonsDisponibles);
echo text(' - Jetons consommés par ' . $client->cl_nom . ' au ' . date('d-m-Y') . ' : ' . (($consommation !== NULL) ? $consommation : 0));

/* ----------------------------------------------------------------- */
/*                Liste des commandes de jetons                      */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Commentaire';
$columns[2] = 'Date de création';
$columns[3] = 'Date de début de validité';
$columns[4] = 'Quantité de jetons';

/* Création de l'entête de table */
echo table_header($columns, "Historique des commandes de jetons");

if ($commandes !== FALSE) {

    foreach ($commandes as $commande) {

        $line[1] = ($commande->cj_commentaire !== NULL) ? $commande->cj_commentaire : '-';
        $line[2] = date("d-m-Y", strtotime($commande->cj_date_creation));
        $line[3] = date("d-m-Y", strtotime($commande->cj_date_debut_validite));
        $line[4] = $commande->cj_quantite;
        echo table_line($line);
    }
} else {
    $line[1] = 'Aucune commande passée';
    echo table_line($line);
}
echo table_footer();


/* ----------------------------------------------------------------- */
/*                      Liste des abonnements                        */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Libellé du rapport';
$columns[2] = 'Date d\'activation';
$columns[3] = 'Date de désactivation';
$columns[4] = 'Coût en jetons';
$columns[5] = 'Actif';

/* Création de l'entête de table */
echo table_header($columns, "Historique des abonnements");

if ($abonnements !== FALSE) {

    foreach ($abonnements as $abonnement) {
        $line[1] = $abonnement->ra_libelle;
        $line[2] = date("d-m-Y",strtotime($abonnement->cc_date_activation));
        $line[3] = ($abonnement->cc_date_desactivation !== NULL) ? date("d-m-Y", strtotime($abonnement->cc_date_desactivation)) : '-';
        $line[4] = $abonnement->cc_nb_jetons;
        $line[5] = (($abonnement->cc_date_desactivation !== NULL) && ($abonnement->cc_date_desactivation < date('Y-m-01')) ) ? '' : glyphicon_actif(); 
        echo table_line($line);
    }
} else {
    $line[1] = 'Aucun abonnement souscrit';
    $line[2] = '';
    $line[3] = '';
    $line[4] = '';
    $line[5] = '';
    echo table_line($line);
}

echo table_footer();