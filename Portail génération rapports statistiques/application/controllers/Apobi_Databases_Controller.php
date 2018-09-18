<?php

class Apobi_Databases_Controller extends MY_Controller {
    
    /* Permet de charger la configuration d'une BDD en fonction de son nom */

    public function chargerConfigurationBaseDeDonnees($database_nom) {

        $CI = &get_instance();
        $this->db = $CI->load->database($database_nom, TRUE);
    }

}
