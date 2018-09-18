<?php
echo myform_header('Portail Apologic BI | Espace API');
echo table_header_custom();
?>
<b>Actions disponibles sur les API :</b></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('api/v1/database') ?>"> API : liste des bases de données</a></p>
<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span><a href="<?php echo base_url('api/v1/database/5') ?>"> API : par identifiant client</a></p>

<?php
echo table_footer_custom();
echo bouton_redirection_accueil();