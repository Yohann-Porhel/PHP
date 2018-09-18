<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of logs_controller
 *
 * @author sebastien.deschamps
 */
class Log_Controller extends MY_Controller {

    public function infos() {
        $this->load->model('web_log_info');
        $datas['logs'] = $this->web_log_info->getAll('moment DESC');
        $this->layout->view('logs/liste_logs_info_view', $datas);
    }

    public function erreurs() {
        $this->load->model('web_log_erreur');
        $datas['logs'] = $this->web_log_erreur->getAll('moment DESC');
        $this->layout->view('logs/liste_logs_erreur_view', $datas);
    }

}
