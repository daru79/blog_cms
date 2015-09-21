<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
    public function __construct() {
        parent::__construct();
        // Załadowanie modelu 'site_m'
        $this->load->model('site_m');
        
    }
    
    public function index() {
        // Poniższa linijka wycięta i wklejona do MY_Controller
//        $data['pages'] = $this->site_m->get('pages', FALSE, FALSE, 'order', 'ASC');
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'blog/index';
        $config['total_rows'] = $this->site_m->count_records('blog');
        $config['per_page'] = 2;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $offset = $this->uri->segment(3);
        $this->site_m->limit_records($config['per_page'], $offset);
        
        // Pobranie artykułów z BD, ważne żeby pobieranie danych z BD było zawsze na końcu, aby można było skorzystać z ww. 'limit_records'
        $data['blog'] = $this->site_m->get('blog', FALSE, FALSE, 'date', 'DESC');
                
        $this->load->view('site/blog', $data);
        
    }
    
}