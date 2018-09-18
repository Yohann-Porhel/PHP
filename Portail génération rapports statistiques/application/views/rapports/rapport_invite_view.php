<?php

echo modal_header(base_url('Web_Commande_Controller/inserer_commande_rapport_avec_invites'));
foreach ($invites as $invite) {
    echo modal_line($invite->in_libelle, ($invite->fk_apobi_type_donnee != 3) ? 'text' : 'checkbox', $invite->in_param, $invite->in_param);
}
echo modal_footer($invite->fk_apobi_rapport);
