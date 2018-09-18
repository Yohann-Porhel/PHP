<?php

class apobi_rapport_invite_model extends MY_Model {

    protected $id = 'id_apobi_rapport_invite';
    protected $table = 'apobi_rapport_invite';

    public function obtenir_informations_invite_par_rapport($id_rapport) {

        $sql = "SELECT in_code, in_libelle, id_apobi_rapport_invite, fk_apobi_rapport, fk_apobi_type_donnee," .
                "concat('VALEUR_RAPPORT_INVITE_',id_apobi_rapport_invite) AS in_param " .
                "FROM apobi_rapport_invite ari " .
                "JOIN apobi_invite ai ON ari.fk_apobi_invite = ai.id_apobi_invite " .
                "WHERE fk_apobi_rapport = ?";

        $p[0] = $id_rapport;

        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        return $query->result();
    }

}
