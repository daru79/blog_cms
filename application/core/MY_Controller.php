<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('site_m');
        
        // Nijako globalne przekazanie zmiennych do widoku - nie trzeba przekazywać każdorazowo zmiennych do poszczególnych widoków
        $data['loggedin'] = $this->loggedin();
        $data['pages'] = $this->site_m->get('pages', FALSE, FALSE, 'order', 'ASC');
        $this->load->vars($data);
        
    }

    // Metoda sprawdzająca czy jesteśmy zalogowani
    public function loggedin() {
        return $this->session->userdata('loggedin');
        
    }
    
    // Metoda dla wylogowania 
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/panel');
        
    }
    
}