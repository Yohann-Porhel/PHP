<?php

/**
 * Description of admin_client_controller
 *
 * @author yohann.porhel
 */
class Admin_Client_Controller extends MY_Controller_Administrateur {

    public function index() {
        $this->load->model('apobi_client_model');
        $this->load->model('apobi_utilisateur_model');
        $var['clients'] = $this->apobi_client_model->getAll();
        $this->layout->view('clients/liste_clients_view', $var);
    }

    /* Permet l'affichage du formulaire de création d'une commande de jetons */

    public function afficheCommandeJetonsView() {

        $this->load->model('apobi_client_model');
        $var['clients'] = $this->apobi_client_model->getAll();
        $this->layout->view('commande/commande_jetons_view', $var);
    }

    /* Permet d'insérer une ligne de commande de jeton dans la table apobi_client_jeton */

    public function insererCommandeJetons() {

        $donnees['fk_client'] = $this->input->post('id_apobi_client');
        $donnees['fk_utilisateur_creation'] = $this->session->utilisateur_connecte_id;
        $donnees['cj_date_creation'] = date("Y-m-d");
        $donnees['cj_date_debut_validite'] = $this->input->post('cj_date_debut_validite');
        $donnees['cj_commentaire'] = $this->input->post('cj_commentaire');
        $donnees['cj_quantite'] = $this->input->post('cj_quantite');

        $this->load->model('apobi_client_jeton_model');
        if (!$this->apobi_client_jeton_model->commit($donnees)) {
            myform_set_flashdata_warning('Impossible de créer la commande');
            redirect('admin/commande');
            return false;
        }
        myform_set_flashdata_info('La commande est enregistrée');
        redirect('admin/commande');
    }
    
    /* Permet de récupérer les informations du dossier d'un client */

    public function afficherInformationsDossierClient($fk_client) {

        $this->load->model('apobi_client_model');
        $this->load->model('apobi_client_jeton_model');
        $this->load->model('apobi_client_abonnement_model');        
        
        $var['client'] = $this->apobi_client_model->get($fk_client);
        $var['commandes'] = $this->apobi_client_jeton_model->obtenirListeCommandesJetons($fk_client);
        $var['abonnements'] = $this->apobi_client_abonnement_model->obtenirListeAbonnements($fk_client); 
        $var['consommation'] = $this->apobi_client_abonnement_model->obtenirConsommationJetonsADate($fk_client);        
        $var['jetonsDisponibles'] = $this->apobi_client_jeton_model->obtenirTotalJetonsDisponibles($fk_client);        
        
        $this->layout->view('clients/dossier_client_view',$var);
    }

}
