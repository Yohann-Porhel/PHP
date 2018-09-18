<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue_Controller extends MY_Controller {

    public function index() {

        $this->load->model('apobi_rapport_model');
        $this->load->model('apobi_client_jeton_model');

        $var['rapports'] = $this->apobi_rapport_model->getAllRapports();
        $var['id_rapports_abonnes'] = $this->apobi_rapport_model->get_liste_rapports_abonnement_client($this->session->utilisateur_connecte_id_client);
        $var['nombre_jetons_disponible'] = $this->apobi_client_jeton_model->obtenirTotalJetonsDisponibles($this->session->utilisateur_connecte_id_client);

        $this->layout->view('catalogue/catalogue_view', $var);
    }

}
