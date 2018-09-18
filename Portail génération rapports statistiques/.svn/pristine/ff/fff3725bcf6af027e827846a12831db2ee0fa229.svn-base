<?php

/**
 * Description of apobi_client_abonnement_model
 *
 * @author yohann.porhel
 */
class apobi_client_abonnement_model extends MY_Model {

    protected $id = 'id_apobi_client_abonnement';
    protected $table = 'apobi_client_abonnement';

    /* Permet d'obtenir la liste des abonnements d'un client */

    public function obtenirListeAbonnements($fk_client) {

        $sql = 'SELECT * FROM ' . $this->table . ' acp'
                . ' JOIN apobi_rapport ar ON ar.id_apobi_rapport = acp.fk_rapport'
                . ' WHERE fk_client = ?'
                . ' ORDER BY cc_date_activation';
        $p[0] = $fk_client;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        return $query->result();
    }

    /* Permet d'obtenir la consommation de jetons d'un client à date */

    public function obtenirConsommationJetonsADate($fk_client) {

        $sql = 'SELECT SUM(cc_nb_jetons) FROM ' . $this->table
                . ' WHERE fk_client = ?'
                . ' AND(cc_date_activation,coalesce(cc_date_desactivation,current_date))'
                . ' OVERLAPS(?,?)';
        $p[0] = $fk_client;
        $p[1] = date('Y-m-01');
        $p[2] = date('Y-m-t');
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        foreach ($query->result() as $row) {
            return $row->sum;
        }
    }

    public function insererDateDesabonnement($fk_rapport) {

        $sql = 'UPDATE ' . $this->table
                . ' SET cc_date_desactivation = date()'
                . ' WHERE fk_client = ? AND fk_rapport= ?';
        $p[0] = $this->session->utilisateur_connecte_id_client;
        $p[1] = $fk_rapport;
        $query = $this->db->query($sql, $p);

        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }
        return TRUE;
    }

}
