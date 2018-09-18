<?php

/**
 * Classe contenant les fonctions CRUD
 * pour la table apobi_client_utilisateur
 *
 * @author yohann.porhel
 */
class apobi_client_utilisateur_model extends MY_Model {

    protected $id = 'id_apobi_client_utilisateur';
    protected $table = 'apobi_client_utilisateur';

    /* Permet d'obtenir le nom du client rattaché à un utilisateur */

    public function obtenirRelationUtilisateurClient($id_utilisateur) {

        $sql = 'SELECT * FROM apobi_client ac '
                . 'JOIN apobi_client_utilisateur acu ON acu.fk_apobi_client = ac.id_apobi_client '
                . 'WHERE fk_apobi_utilisateur = ?';
        $p[0] = $id_utilisateur;
        $query = $this->db->query($sql, $p);

        if ($query->num_rows() == 0) {
            return false;
        } else {
            foreach ($query->result() as $row) {
                return $row;
            }
        }
    }

    /* Permet de supprimer la relation dans la table apobi_client_utilisateur */

    public function supprimerRelationUtilisateurClient($id_utilisateur) {

        $sql = 'DELETE FROM ' . $this->table . ' WHERE fk_apobi_utilisateur = ?';
        $p[0] = $id_utilisateur;
        $query = $this->db->query($sql, $p);

        if ($query == true) {
            return false;
        }
        return true;
    }

}
