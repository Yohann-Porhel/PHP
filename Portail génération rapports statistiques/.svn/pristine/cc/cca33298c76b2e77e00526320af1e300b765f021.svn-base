<?php

class apobi_client_jeton_model extends MY_Model {

    protected $id = 'id_apobi_client_jeton';
    protected $table = 'apobi_client_jeton';

    public function obtenirListeCommandesJetons($fk_client) {

        $sql = 'SELECT * FROM ' . $this->table . ' WHERE fk_client = ?';
        $p[0] = $fk_client;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        return $query->result();
    }

    public function obtenirTotalCommandesJetons($fk_client) {

        $sql = 'SELECT SUM(cj_quantite) FROM ' . $this->table . ' WHERE fk_client = ?'
               . ' AND cj_date_debut_validite <= current_date';
        $p[0] = $fk_client;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        foreach ($query->result() as $row) {
            return $row->sum;
        }
    }

    public function obtenirTotalJetonsDisponibles($fk_client) {

        $this->load->model('apobi_client_jeton_model');
        $this->load->model('apobi_client_abonnement_model');

        $totalJetonsCommandes = $this->apobi_client_jeton_model->obtenirTotalCommandesJetons($fk_client);
        $totalJetonsConsommes = $this->apobi_client_abonnement_model->obtenirConsommationJetonsADate($fk_client);

        return $totalJetonsDisponibles = $totalJetonsCommandes - $totalJetonsConsommes;
    }

}
