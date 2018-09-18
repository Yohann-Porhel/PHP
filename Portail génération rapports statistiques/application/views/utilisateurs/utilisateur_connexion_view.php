<?php

/* ----------------------------------------------------------------- */
/*                 Affichage du formulaire de connexion              */
/* ----------------------------------------------------------------- */
if (!isset($this->session->utilisateur_connecte_email)) {

    echo myform_header('Connexion au portail Apologic BI', base_url('connexion'));

    echo myform_input('sa_ut_email', '', 'E-mail :', 'email', 'Veuillez saisir votre e-mail');
    echo myform_input('sa_ut_password', '', 'Mot de passe :', 'password', 'Veuillez saisir votre mot de passe');
    echo myform_footer('Connexion', 'Connexion');
} else {
    redirect('accueil');
}