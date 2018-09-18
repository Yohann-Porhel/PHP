<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe représentant les fonctions 
 * afin d'obtenir les API
 *
 * @author yohann.porhel
 */
class web_api_model extends MY_Model {

    protected $table = 'apobi_serveur';

    /* Permet d'obtenir la liste des informations relatives aux bases de données */
    public function obtenirListeBasesDeDonnees() {

        $sql = 'SELECT se_port, se_hote, db_name, tdb_code, tdb_libelle, cl_code, cl_nom FROM ' . $this->table . ' ' .
                'JOIN apobi_database on apobi_database.fk_apobi_serveur = ' . $this->table . '.id_apobi_serveur ' .
                'JOIN apobi_type_database on apobi_database.fk_apobi_type_database = apobi_type_database.id_apobi_type_database ' .
                'JOIN apobi_client on apobi_database.fk_apobi_client = apobi_client.id_apobi_client';


        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /* Permet d'obtenir les informations relatives à une base de données en fonction d'un id client */
    public function obtenirBaseDeDonneesParIdClient($id_apobi_utilisateur) {

        $sql = 'SELECT cl_code, cl_nom, se_port, se_hote, db_name, tdb_code, tdb_libelle FROM apobi_client '.
                'JOIN apobi_database on apobi_client.id_apobi_client = apobi_database.fk_apobi_client '.
                'JOIN apobi_serveur on apobi_database.fk_apobi_serveur = apobi_serveur.id_apobi_serveur '.
                'JOIN apobi_type_database on apobi_database.fk_apobi_type_database = apobi_type_database.id_apobi_type_database '.
                'WHERE id_apobi_client = '.$id_apobi_utilisateur.'';
        
        $query = $this->db->query($sql);
        return $query->result();
    }

}
