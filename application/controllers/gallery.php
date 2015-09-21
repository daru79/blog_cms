<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        $this->load->model('admin/panel_m');
        $data['files'] = $this->panel_m->get_images();
        
        $this->load->view('site/gallery', $data);
        
    }
    
}