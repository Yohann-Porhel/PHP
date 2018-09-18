<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Apobie {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();        
    }

    public function old_ligneCommande($params) {

        $this->CI->layout->view('rapports/execute_rapport', null, true);
    }

    public function executeApobie($_idUtilisateur, $_params = array()) {

        $this->CI->session->set_userdata('last_cmd_guid', null);
        
        $this->CI->load->model('web_commande_model');
        $command_guid = $this->CI->web_commande_model->insereCommande($_idUtilisateur, $_params);

        if (!isset($command_guid) || $command_guid == '') {
            $this->logging->logErreur('GUID de la commande invalide');
            return null;
        }

        /* Lancement d'APOBIE.EXE en ligne de commande avec le GUID en paramètre */
        $var['command_guid'] = $command_guid;
        $var['apobie_exe'] = $this->CI->config->item('path_to_apobie');
        exec($var['apobie_exe'] . ' ' . $command_guid);

        /* Mémorisation du GUID de la dernière commande éxecutée */
        $this->CI->session->set_userdata('last_cmd_guid', $command_guid);

        return $command_guid;
    }

    public function finExecutionApobie($_guid) {
        redirect('/apobie/');
    }

}


