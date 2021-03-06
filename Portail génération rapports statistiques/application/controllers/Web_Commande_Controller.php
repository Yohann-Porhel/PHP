<?php

class Web_Commande_Controller extends MY_Controller {
    /* Permet d'insérer les paramètres d'une commande de rapport dans la table "web_commande_input" */

    public function inserer_commande_rapport_avec_invites() {

        $_params['ACTION'] = 'REPORT';
        $_params['ID_CLIENT'] = $this->session->utilisateur_connecte_id_client;

        $post = $this->input->post();

        /* On parcourt toutes les données POST et on les prépare pour insertion dans la table "web_commande_input" */
        foreach ($post as $k => $v) {
            $_params[$k] = $v;
        }

        $this->load->model('web_commande_model');
        $resultat['cmd_guid'] = $this->web_commande_model->insereCommande($this->session->utilisateur_connecte_id, $_params);

        $this->load->model('apobi_rapport_model');
        $resultat['rapport'] = $this->apobi_rapport_model->get($_params['ID_RAPPORT']);
        $this->layout->view('developpement/wait_view', $resultat);
    }

    public function inserer_commande_rapport_sans_invites($idRapport) {

        $_params['ACTION'] = 'REPORT';
        $_params['ID_CLIENT'] = $this->session->utilisateur_connecte_id_client;
        $_params['ID_RAPPORT'] = $idRapport;

        $this->load->model('web_commande_model');
        $resultat['cmd_guid'] = $this->web_commande_model->insereCommande($this->session->utilisateur_connecte_id, $_params);

        $this->load->model('apobi_rapport_model');
        $resultat['rapport'] = $this->apobi_rapport_model->get($idRapport);
        $this->layout->view('developpement/wait_view', $resultat);
    }

    public function afficher_resultat($cmd_guid) {

        $this->load->model('web_commande_model');

        $commande = $this->web_commande_model->getByGuid($cmd_guid);
        if (!isset($commande) || $commande === null || $commande->cmd_guid != $cmd_guid) {
            echo 'Impossible d\'afficher ce rapport';
            return;
        }

        sleep(2);

        // On extrait le fichier du mémo binaire et on l'affiche        

        $sql = "SELECT fic_contenu FROM apobi_web_commande_fichier_output WHERE cmd_guid = ?";
        $p[0] = $cmd_guid;

        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            echo "Fichier non trouvé";
            return false;
        }

        $result = $query->result();
        $file_content = $result[0]->fic_contenu;

        if (false) {
            // Si on souhaite un enregistrement dans un fichier physique sur le serveur :
            file_put_contents('pdfs/fichier_bytea_' . $cmd_guid . '.pdf', pg_unescape_bytea($file_content));
        } else {

            // Si on souhaite un affichage direct dans le navigateur
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="downloaded.pdf"');
            echo pg_unescape_bytea($file_content);
        }
    }

    public function get_url_rapport_genere($cmd_guid) {

// Evite que la requête ajax bloque le navigateur
        session_write_close();

// On va faire une boucle tant...que web_commande.cmd_traitee est faux, avec une attente
// d'une seconde entre chaque essai et dans une limite de 15 essais              
        $this->load->model('web_commande_model');
        $essai = 0;

        do {
            sleep(1);
            $commande = $this->web_commande_model->getByGuid($cmd_guid);
            if (isset($commande) && $commande != null && $commande->cmd_guid == $cmd_guid) {
                if (isset($commande->cmd_traitee) && $commande->cmd_traitee === 't') {
                    $url_resultat = base_url('resultat_commande/' . $cmd_guid);
                    echo $url_resultat;
                    return;
                }
            }
            $essai++;
        } while (($commande->cmd_traitee != true) || ($essai <= 15));

        echo base_url();
    }

}
