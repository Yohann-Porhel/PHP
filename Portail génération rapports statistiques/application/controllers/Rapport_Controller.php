<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rapport_controller
 *
 * @author sebastien.deschamps
 */
class Rapport_Controller extends MY_Controller {

    public function index() {

        $this->load->model('apobi_rapport_model');
        $var['rapports'] = $this->apobi_rapport_model->get_liste_rapports_abonnement_client($this->session->utilisateur_connecte_id_client);
        if ($var['rapports'] === FALSE) {
            myform_set_flashdata_warning('Vous n\'êtes actuellement abonné à aucun rapport. Dirigez-vous vers l\'espace "Abonnement"');
            redirect('accueil');
        }
        $this->layout->view('rapports/liste_rapports_view', $var);
    }
    
    /* Permet de récupérer les informations relatives aux invites d'un rapport */
    
    public function obtenir_invite_par_rapport($id_rapport) {

        $this->load->model('apobi_rapport_invite_model');
        $var['invites'] = $this->apobi_rapport_invite_model->obtenir_informations_invite_par_rapport($id_rapport);
        $this->load->view('rapports/rapport_invite_view', $var);
    }

    /*public function genere_rapport() {
        $params = array(
            'ACTION' => 'ACTUALISATION_RAPPORT',
            'ID_RAPPORT' => 1,
            'FORMAT' => 'PDF',
            'P1' => 'Valeur 1',
            'P2' => 'Valeur 2',
            'DATE' => dateHeureVersChaine(current_datetime())
        );

        $guid = $this->apobie->executeApobie(1, $params);
        $this->apobie->finExecutionApobie($guid);
    }

    public function genere_rapport_old() {

        $this->load->model('web_commande_model');
        $command_guid = $this->web_commande_model->insereCommande(1, array('P1' => 'Valeur 1', 'P2' => 'Valeur 2'));

        if (!isset($command_guid) || $command_guid == '') {
            $this->logging->logErreur('GUID de la commande invalide');
            return false;
        }

        // Lancement d'APOBIE.EXE en ligne de commande avec le GUID en paramètre
        $var['command_guid'] = $command_guid;
        $var['apobie_exe'] = $this->config->item('path_to_apobie');
        exec($var['apobie_exe'] . ' ' . $command_guid);

        $this->layout->view('apobie/resultat_execution_view');

        return true;
    }
        
    public function afficher_rapport_genere($_guid) {                
        echo $_guid;
    }*/

}
