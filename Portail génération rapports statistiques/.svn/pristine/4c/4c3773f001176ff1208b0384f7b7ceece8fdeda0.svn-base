<?php

echo myform_header('Portail Apologic BI | Envoi des identifiants utilisateur', base_url('admin_utilisateur_controller/envoiEmailChangementMotDePasse'));
echo text('Le mot de passe de l\'utilisateur '.$ut_email.' a changé :');
echo label('E-Mail',(!empty($ut_email)) ? $ut_email : NULL);
echo label('Mot de passe',(!empty($ut_password_en_clair)) ? $ut_password_en_clair : NULL);
echo checkbox_label('envoi_email','Copie mail à l\'utilisateur', TRUE);

echo myform_input_invisible('ut_email',(!empty($ut_email) ? $ut_email : NULL));
echo myform_input_invisible('ut_password', (!empty($ut_password) ? $ut_password : NULL));
echo myform_input_invisible('ut_password_en_clair',(!empty($ut_password_en_clair) ? $ut_password_en_clair : NULL));

echo myform_footer('Envoyer e-mail');

?>
