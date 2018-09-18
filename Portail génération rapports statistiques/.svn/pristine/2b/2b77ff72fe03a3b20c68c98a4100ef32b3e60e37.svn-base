<?php

/* ----------------------------------------------------------------------------- */
/*    Classe MY_Controller (utilisé par défaut pour les utilisateurs simples)    */
/* ----------------------------------------------------------------------------- */

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /* permet de crypter un mot de passe en SHA1 + grain de sel en BDD */
    public function cryptageMotDePasse($email, $mot_de_passe) {

        $grain_de_sel = $email;
        $grain_de_sel = sha1($grain_de_sel);
        $password = $mot_de_passe . $grain_de_sel;
        $password = sha1($password);

        return $password;
    }
    

}

/* ----------------------------------------------------------------------------- */
/*                  Classe MY_Controller_Administrateur                          */
/* ----------------------------------------------------------------------------- */

class MY_Controller_Administrateur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkEstAdministrateur();
    }

    /* Permet de contrôler qu'un utilisateur a accès aux pages administrateur */
    public function checkEstAdministrateur() {
        
        $ut_email = $this->session->utilisateur_connecte_email;

        $this->load->model('apobi_utilisateur_model');
        $resultat = $this->apobi_utilisateur_model->controleEstAdministrateur($ut_email);

        if ($resultat === 'f') {
            myform_set_flashdata_warning('Accès réservé aux administrateurs');
            redirect('accueil');
        }
    }
    
    /* Permet de crypter un mot de passe en SHA1 + garin de sel en BDD */
    public function cryptageMotDePasse($email, $mot_de_passe) {

        $grain_de_sel = $email;
        $grain_de_sel = sha1($grain_de_sel);
        $password = $mot_de_passe . $grain_de_sel;
        $password = sha1($password);

        return $password;
    }

}

/* ----------------------------------------------------------------------------- */
/*                     Classe MY_Controller_API                                  */
/* ----------------------------------------------------------------------------- */

class MY_Controller_API extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->checkDroitsAPI();
    }

    /* Permet de contrôler qu'un utilisateur a accès aux API */
    public function checkDroitsAPI() {

        $ut_email = $this->session->utilisateur_connecte_email;
        
        $this->load->model('apobi_utilisateur_model');
        $resultat = $this->apobi_utilisateur_model->controleDroitsAPI($ut_email);
        
        if ($resultat === 'f') {
            myform_set_flashdata_warning('Accès réservé aux personnes autorisées API');
            redirect('accueil');
        }
    }

}

?>
