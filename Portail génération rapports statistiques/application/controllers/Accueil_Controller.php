<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accueil_controller
 *
 * @author sebastien.deschamps
 */
class Accueil_Controller extends MY_Controller {

    public function index() {
        $this->layout->view("accueil/accueil_view");
    }

}
