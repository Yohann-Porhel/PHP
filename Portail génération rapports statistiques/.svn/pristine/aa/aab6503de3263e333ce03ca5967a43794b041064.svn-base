<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of web_commande_model
 *
 * @author sebastien.deschamps
 */
class web_commande_model extends MY_Model {

    protected $id = 'cmd_guid';
    protected $table = 'web_commande';

    public function getByGuid($_guid) {

        $this->db->where('cmd_guid', $_guid);
        $query = $this->db->get($this->table);
        $res = $query->result();

        if (!isset($res) || empty($res)) {
            return null;
        }
        return $res[0];
    }

    public function insereCommande($_idUtilisateur, $_params = array()) {

        /* On génère un GUID pour la nouvelle commande envoyée au serveur */
        $guid = getGUID();
        $datas = array(
            'fk_apobi_utilisateur' => $_idUtilisateur,
            'cmd_guid' => $guid,
            'cmd_moment' => date('Y-m-d H:i:s'),
            'cmd_traitee' => false
        );

        /* On enregistre en base la commande */
        $this->db->insert('web_commande', $datas);

        /* On récupère la commande que l'on viens de créer */
        $cmd = $this->db->select('*')
                ->from('web_commande')
                ->where('cmd_guid', $guid)
                ->get()
                ->result();
        // $cmd = $this->db->get_where('web_commande', array('cmd_guid' => $guid));

        /* Si plus d'une commande est trouvée avec le GUID, alors c'est qu'il y à un souci quelque part... */
        if (sizeof($cmd) != 1) {
            $this->logging->logErreur("Nombre de commandes trouvées invalide : " . sizeof($cmd) . " pour le GUID : " . $guid, $_idUtilisateur);
            return null;
        } else {

            foreach ($cmd as $c) {
                $this->logging->logInfo("Id Web Commande : " . print_r($cmd, true));
                // On insère les paramètres 
                if (isset($_params) && !empty($_params)) {

                    $this->load->model('web_commande_input_model');
                    foreach ($_params as $p => $v) {
                        // $datas_in['fk_web_commande'] = $c->id_web_commande;
                        // $datas_in['fk_utilisateur'] = $_idUtilisateur;
                        $datas_in['in_param'] = $p;
                        $datas_in['in_valeur'] = $v;
                        $datas_in['cmd_guid'] = $guid;
                        $this->web_commande_input_model->commit($datas_in);
                    }
                } else {
                    $this->logging->logErreur("Aucun paramètre passé à la commande : " . $guid, $_idUtilisateur);
                }
            }
        }


        return $guid;
    }

}
