<?php
/* ----------------------------------------------------------------- */
/*                 Liste des utilisateurs                            */
/* ----------------------------------------------------------------- */

/* Initialisation des noms de colonnes de la table */
$columns[1] = 'Email';
$columns[2] = 'Mot de passe';
$columns[3] = 'Modifier';
$columns[4] = 'Supprimer';

/* Création de l'entête de table */
echo table_header($columns, "Catalogue des utilisateurs");
echo bouton_ajouter(base_url('admin/utilisateur/gestion'), ' Ajouter utilisateur');
foreach ($utilisateurs as $utilisateur) {

    $line[1] = $utilisateur->ut_email;
    $line[2] = $utilisateur->ut_password;
    $line[3] = bouton_modifier(base_url('admin/utilisateur/' . $utilisateur->id_apobi_utilisateur));
    $line[4] = bouton_supprimer(base_url('admin_utilisateur_controller/supprimerUtilisateur/' . $utilisateur->id_apobi_utilisateur), 'Voulez-vous vraiment supprimer cet utilisateur : ' . $utilisateur->ut_email . ' ?');
    echo table_line($line);
}
echo table_footer();
?>


<div id="popupconfirmation" title="Confirmation de suppression" style="display: none"></div>