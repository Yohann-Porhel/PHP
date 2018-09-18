<?php

/* ----------------------------------------------------------------- */
/*                      Liste des clients                            */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */

$columns[1] = 'Identifiant';
$columns[2] = 'Code du client';
$columns[3] = 'Nom du client';
$columns[4] = 'Consulter dossier';

/* Création de l'entête de table */

echo table_header($columns, "Catalogue des clients");

foreach ($clients as $client) {

    $line[1] = $client->id_apobi_client;
    $line[2] = $client->cl_code;
    $line[3] = $client->cl_nom;
    $line[4] = bouton_consulter(base_url('admin/client/' . $client->id_apobi_client));

    echo table_line($line);
}
echo table_footer();