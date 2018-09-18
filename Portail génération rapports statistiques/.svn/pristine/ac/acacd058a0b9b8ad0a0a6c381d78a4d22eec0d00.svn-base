<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rapports_model
 *
 * @author sebastien.deschamps
 */
class apobi_rapport_model extends MY_Model {

    protected $id = 'id_apobi_rapport';
    protected $table = 'apobi_rapport';

    public function getAllRapports() {

        $query = $this->db->get($this->table);
        return $query->result();
    }

    /* Permet d'obtenir la liste des abonnements en cours en fonction de l'id client */

    public function get_liste_rapports_abonnement_client($id_client) {

        $sql = 'SELECT ar.id_apobi_rapport, ar.ra_libelle, aca.cc_date_activation, COUNT(ari.id_apobi_rapport_invite) AS nb_invites FROM ' . $this->table . ' ar '
                . 'JOIN apobi_client_abonnement aca ON aca.fk_rapport = ar.id_apobi_rapport '
                . 'LEFT OUTER JOIN apobi_rapport_invite ari ON ar.id_apobi_rapport = ari.fk_apobi_rapport '                
                . 'WHERE fk_client = ? '
                . 'AND cc_date_activation <= current_date '
                . 'AND (cc_date_desactivation IS NULL OR cc_date_desactivation > current_date)'
                . 'GROUP BY 1, 2, 3';

        $p[0] = $id_client;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        return $query->result();
    }

}
