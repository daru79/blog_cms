<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function count_views($alias) {
        $this->db->where('alias', $alias);
        $this->db->set('views', 'views+1', FALSE); // Dzieki ustawieniu jako 3 parametru 'FALSE' mamy pewność, że w BD będzie się zliczało a nie dodana zostanie wartość 'views+1'
        $this->db->update('blog');
        
    }
    
    // Liczymy wszystkie artykuły na blogu    
    public function count_records($table) {
        return $this->db->count_all_results($table);
        
    }
    
    // Limitowanie ilości wyświetlanych rekordów
    public function limit_records($count, $offset) {
        return $this->db->limit($count, $offset); // $count => od którego; $offset => co ile
        
    }
    
}