<h3>Execution terminée !</h3>
<?php echo 'GUID : ' . $guid ; ?>
</p>
<?php echo 'Résultat exe : ' . $res_exec ; ?>

<h3>Paramètres envoyés aux moteur d'éxectuion :</h3>
<?php
//print_r($in_params);
foreach ($in_params as $ligne) {    
    echo '<li>' . $ligne->in_param . ' => ' . $ligne->in_valeur . '</li></p>';    
}
?>

<h3>Paramètres reçus du moteur d'éxecution :</h3>
<?php
//print_r($in_params);
foreach ($out_params as $ligne) {    
    $valeurLigne = $ligne->out_valeur;
    if ($ligne->out_param == 'FICHIER') {
        $valeurLigne = '<a target="blank" href="' . base_url('apobie_out/'.$ligne->out_valeur) . '">' . $ligne->out_valeur . '</a>';
    }
    echo '<li>' . $ligne->out_param . ' => ' . $valeurLigne . '</li></p>';    
}
?>