<?php

/**
 * Description of apobi_database_model
 *
 * @author yohann.porhel
 */
class apobi_database_model extends MY_Model {

    protected $id = 'id_apobi_utilisateur';
    protected $table = 'apobi_utilisateur';

    /* Permet d'obtenir les informations de configuration pour les connexions BDD */

    public function obtenir_configuration_connexion_databases() {

        $sql = 'SELECT * FROM ' . $this->table . ' au'
                . ' JOIN apobi_client_utilisateur acu ON au.id_apobi_utilisateur = acu.fk_apobi_utilisateur'
                . ' JOIN apobi_client ac ON acu.fk_apobi_client = ac.id_apobi_client'
                . ' JOIN apobi_database ad ON ac.id_apobi_client = ad.fk_apobi_client'
                . ' JOIN apobi_serveur ase ON ad.fk_apobi_serveur = ase.id_apobi_serveur'
                . ' JOIN apobi_type_database atd ON ad.fk_apobi_type_database = atd.id_apobi_type_database'
                . ' WHERE ' . $this->id . ' = ?';

        $p[0] = $this->session->utilisateur_connecte_id;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        }
        return $query->result();
    }

}
