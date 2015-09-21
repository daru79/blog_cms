<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function create($table, $data) {
        // Wstawianie rekordu do BD
        $this->db->insert($table, $data);
        
    }
    
    public function get($table, $where = FALSE, $single = FALSE, $order = FALSE, $sort = FALSE) { // FLASE czyli zmienna domyślnie niedostępna | $single -> czy chcemy tylko 1 rekord wydobyć z BD
        if($where == TRUE) {
            $this->db->where($where);
            
        }
        
        if($order == TRUE) {
            $this->db->order_by($order, $sort);
            
        }
        
        $query = $this->db->get($table);
        
        if($single == TRUE) {
            return $query->row(); // RETURN powoduje natychmiastowe zakończenie funkcji
            
        }
        
        return $query->result();
        
    }
    
    public function update($table, $where, $data) {
        $this->db->where($where);
        $this->db->update($table, $data);
        
    }
    
    public function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
        
    }
    
    public function unique($id, $where) {
        $this->db->where($where);
        !$id || $this->db->where('id !=', $id);
        
    }
    
}