<?php
echo myform_header('Portail Apologic BI | Espace administrateur');
echo table_header_custom('Liste des actions disponibles');
?>

<b>Actions disponibles sur les utilisateurs :</b></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('admin/utilisateurs') ?>"> Liste des utilisateurs</a></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('admin/utilisateur/gestion') ?>"> Fiche de création d'un utilisateur</a></p> 
<b>Actions disponibles sur les clients :</b></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('admin/clients') ?>"> Liste des clients</a></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('admin/commande') ?>"> Fiche de création d'une commande de jetons</a></p>

<?php
echo table_footer_custom();
echo bouton_redirection_accueil();


