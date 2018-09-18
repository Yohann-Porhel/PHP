<?php

// exec('C:/MESPRO~1/ABIE/Exe/ABIE.exe') 
echo myform_header('Sélection de la base de données', base_url('apobi_databases_controller/afficheContenuTable'));

if (isset($bases)) {
    echo myform_input_liste_header('database_nom', 'Choisissez votre base de données :');
    foreach ($bases as $base) {
        $line = '<OPTION value="' . $base->database_nom . '">' . $base->database_nom;
        echo $line;
    }
    echo myform_input_liste_footer();
}
echo myform_footer('Valider');
