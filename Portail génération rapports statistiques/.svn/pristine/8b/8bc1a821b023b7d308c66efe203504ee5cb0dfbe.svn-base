<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Apobie_Controller extends MY_Controller {
    
    public function index($guid = 'default') {
        
        $this->load->model('web_commande_input_model');
        $this->load->model('web_commande_output_model');
        $this->load->model('web_commande_model');
        
        $var['res_exec'] = 'FAUX';
        $var['guid'] = $this->session->userdata('last_cmd_guid');
        
        $webCmd = $this->web_commande_model->getByGuid($var['guid']);
        if (isset($webCmd) && $webCmd != null) {            
            $var['res_exec'] = $webCmd->cmd_traitee ? 'VRAI' : 'FAUX';
        }        
        
        $var['in_params'] = $this->web_commande_input_model->getParametresLastExecution();
        $var['out_params'] = $this->web_commande_output_model->getParametresLastExecution();
        $this->layout->view('apobie/apobie_view', $var);
        
    }
    
}
