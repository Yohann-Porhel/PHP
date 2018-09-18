<?php

/**
 * Description of web_api_controller
 *
 * @author yohann.porhel
 */
class Web_Api_Controller_V1 extends MY_Controller_API {

    public function index() {

        $this->load->model('web_api_model');
        $data = $this->web_api_model->obtenirListeBasesDeDonnees();

        if (!empty($data)) {
            foreach ($data as $row) {
                $result[] = array("serveur port" => $row->se_port,
                    "serveur hote" => $row->se_hote,
                    "database name" => $row->db_name,
                    "type db code" => $row->tdb_code,
                    "type db libelle" => $row->tdb_libelle,
                    "client code" => $row->cl_code,
                    "client nom" => $row->cl_nom);
            }
            echo json_encode($result);
        } else {
            header("http://127.0.0.1:8080 204");
            echo json_encode('Erreur 204 : pas de valeur en base de donnees');
        }
    }
    
    public function indexParId($id_apobi_utilisateur){
        
        $this->load->model('web_api_model');
        $data = $this->web_api_model->obtenirBaseDeDonneesParIdClient($id_apobi_utilisateur);

        if (!empty($data)) {
            foreach ($data as $row) {
                $result[] = array("serveur port" => $row->se_port,
                    "serveur hote" => $row->se_hote,
                    "database name" => $row->db_name,
                    "type db code" => $row->tdb_code,
                    "type db libelle" => $row->tdb_libelle,
                    "client code" => $row->cl_code,
                    "client nom" => $row->cl_nom);
            }
            echo json_encode($result);
        } else {
            header("http://127.0.0.1:8080 204");
            echo json_encode('Erreur 204 : pas de valeur en base de donnees');
        }
        
    }  
    
    public function afficheApiView(){
        $this->layout->view('api/api_view');
    }
    

}
