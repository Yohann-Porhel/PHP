<?php

/* ----------------------------------------------------------------- */
/*                 Liste des logs d'info                             */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Moment';
$columns[2] = 'Utilisateur';
$columns[3] = 'Message';

/* Création de l'entête de table */
echo table_header($columns, '<span style="color: grey" class="glyphicon glyphicon-info-sign"></span> Liste des logs d\'information');

foreach ($logs as $log) {

    /* Prépation et insertion de la ligne dans le tableau */
    $line[1] = dateHeureVersChaine($log->moment);
    $line[2] = $log->fk_apobi_utilisateur;
    $line[3] = $log->log_message;
    echo table_line($line);
}

/* Finalisation du tableau */
echo table_footer();
?>


