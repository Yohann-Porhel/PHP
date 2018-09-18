<?php

class Utilisateur_Connexion_Controller extends MY_Controller {

    //fonction testant la validité des données saisies par l'utilisateur
    private function testValiditeLoginEtMotDePasseSaisis() {

        $nomChampSaisieEmail = 'sa_ut_email';

        $ut_email_saisi = $this->input->post($nomChampSaisieEmail);
        $ut_mot_de_passe_saisi = $this->input->post('sa_ut_password');

        memoriseSaisieUtilisateur($nomChampSaisieEmail, $ut_email_saisi);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('sa_ut_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('sa_ut_password', 'Mot de passe', 'trim|required');

        $ut_mot_de_passe_crypte = $this->cryptageMotDePasse($ut_email_saisi, $ut_mot_de_passe_saisi);

        /* Premier test de validation du formulaire */
        if (!$this->form_validation->run()) {
            myform_set_flashdata_warning('Erreur de validation');
            return false;
        }

        /* Test de l'existence de l'utilisateur avec le mot de passe */
        $this->load->model('apobi_utilisateur_model');
        if (!$this->apobi_utilisateur_model->getByEmailAndPassword($ut_email_saisi, $ut_mot_de_passe_crypte)) {
            myform_set_flashdata_warning('Identifiant ou mot de passe invalide');
            return false;
        }
        $row = $this->apobi_utilisateur_model->getByEmailAndPassword($ut_email_saisi, $ut_mot_de_passe_crypte);
        $session_data = array('utilisateur_connecte_id' => $row->id_apobi_utilisateur,
                              'utilisateur_connecte_email' => $row->ut_email);
        $this->session->set_userdata($session_data);
        return true;
    }

    //fonction permettant la connexion d'un utilisateur
    public function connexion() {

        $login_saisi = $this->input->post('sa_ut_email');

        if (!isset($login_saisi) || $login_saisi == null) {

            /* Si premier affichage de la fenêtre de connexion */
            $this->layout->view('utilisateurs/utilisateur_connexion_view');
        } else {

            /* Si validation de la fenêtre de login avec des informations saisies */
            if ($this->testValiditeLoginEtMotDePasseSaisis()) {

                $this->load->model('apobi_client_utilisateur_model');
                $client = $this->apobi_client_utilisateur_model->obtenirRelationUtilisateurClient($this->session->utilisateur_connecte_id);
                $utilisateur_connecte_id_client = $client->fk_apobi_client;
                $session_data = array('utilisateur_connecte_id_client' => $utilisateur_connecte_id_client);
                $this->session->set_userdata($session_data);

                redirect('accueil');
            } else {

                redirect('connexion');
            }
        }
    }

    //fonction permettant la déconnexion d'un utilisateur
    public function deconnexion() {
        $this->session->sess_destroy();
        redirect(base_url() . 'connexion');
    }

}
