<?php

/**
 * Classe contenant les fonctions relatives aux 
 * abonnements ou désabonnements aux rapports
 *
 * @author yohann.porhel
 */
class Abonnement_Controller extends MY_Controller {
    
    /* Permet de créer une ligne d'abonnement à un rapport en BDD */

    public function insererAbonnementRapport() {        
        
        $donnees['fk_client'] = $this->session->utilisateur_connecte_id_client;
        $donnees['fk_rapport'] = $this->input->post('id_apobi_rapport');
        $donnees['fk_planification'] = NULL;
        $donnees['cc_date_activation'] = date("Y-m-d");
        $donnees['cc_date_desactivation'] = NULL;
        $donnees['cc_nb_jetons'] = $this->input->post('ra_tarif');

        $this->load->model('apobi_client_jeton_model');
        if (($this->apobi_client_jeton_model->obtenirTotalJetonsDisponibles($donnees['fk_client'])) < $donnees['cc_nb_jetons']) {
            return false;
        }

        $this->load->model('apobi_client_abonnement_model');
        if (!$this->apobi_client_abonnement_model->commit($donnees)) {
            return false;
        }
        return true;
    }

}
