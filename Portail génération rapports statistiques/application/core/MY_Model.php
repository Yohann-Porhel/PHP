<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Model
 *
 * @author Sébastien Deschamps
 */
class MY_Model extends CI_Model {

    public function find($where = array()) {
        $req = $this->db->get_where($this->table, $where);
        return $req->result();
    }

    public function getAll($orderBy = null) {

        if ($orderBy != null) {
             $this->db->order_by($orderBy);
        }
        
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get($_id) {
        $this->db->where($this->id, $_id);
        $query = $this->db->get($this->table);
        $res = $query->result();

        if (!isset($res) || empty($res)) {
            $this->session->set_flashdata('error', 'Aucun enregistrement trouvé dans la table ' . $this->table . ' pour l\'id : ' . $_id);
            return null;
        }
        return $res[0];
    }

    public function commit($_data) {

        if (isset($_data[$this->id]) && $_data[$this->id] > 0) {
            // Mise à jour de l'enregistrement
            $this->db->where($this->id, $_data[$this->id]);
            $this->db->update($this->table, $_data);
            $this->id = $_data[$this->id];
        } else {
            unset($_data[$this->id]);
            // Insertion du nouvel enregistrement         
            $this->db->insert($this->table, $_data);
            $this->id = $this->db->insert_id();
        }
        
        if ($this->db->affected_rows() == '1') {
            $this->logging->logInfo('Ajout/Modification d\'un enregistrement dans la table : ' . $this->table);
        } else {
            $this->logging->logErreur('Erreur lors de l\'Ajout/Modification d\'un enregistrement dans la table : ' . $this->table);            
        }
        return true;
    }

    public function delete($_id) {
        $this->db->where($this->id, $_id);
        return $this->db->delete($this->table);
    }

}
