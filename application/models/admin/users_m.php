<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    // Metody get(), create(), update(), delete() przeniesione do application/core/MY_Model.php
//    public function create($table, $data) {
//        // Wstawianie rekordu do BD
//        $this->db->insert($table, $data);
//        
//    }
    
//    public function get($table, $where = FALSE, $single = FALSE) { // FLASE czyli zmienna domyślnie niedostępna | $single -> czy chcemy tylko 1 rekord wydobyć z BD
//        if($where == TRUE) {
//            $this->db->where($where);
//            
//        }
//        
//        $query = $this->db->get($table);
//        
//        if($single == TRUE) {
//            return $query->row(); // RETURN powoduje natychmiastowe zakończenie funkcji
//            
//        }
//        
//        return $query->result();
//        
//    }
    
//    public function update($table, $where, $data) {
//        $this->db->where($where);
//        $this->db->update($table, $data);
//        
//    }

//    public function delete($table, $where) {
//        $this->db->where($where);
//        $this->db->delete($table);
//        
//    }
    
    public function unique($id, $where) {
        $this->db->where('email', $item);
        !$id || $this->db->where('id !=', $id);
        
    }
    
}