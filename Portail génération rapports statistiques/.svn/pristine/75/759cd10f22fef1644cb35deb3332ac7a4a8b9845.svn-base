<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of web_commande_output_model
 *
 * @author sebastien.deschamps
 */
class web_commande_output_model extends MY_Model {

    protected $id = null;
    protected $table = 'web_commande_output';

    public function getParametresLastExecution() {
        $last_guid = $this->session->userdata('last_cmd_guid');
        $sql = 'SELECT cmd_in.* FROM ' . $this->table . ' cmd_in JOIN web_commande cmd ON cmd.cmd_guid = cmd_in.cmd_guid WHERE cmd.cmd_guid = ?';
        $query = $this->db->query($sql, array($last_guid));
        return $query->result();
    }

}
