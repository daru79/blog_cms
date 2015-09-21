<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('site_m');
        
    }
    
    // Wyświetlenie strony klikniętej w menu (trza dokonać przekierowania w 'application/config/routes.php'
    public function display_page($alias) {
        
        $where = array('alias' => $alias);
        $data['page'] = $this->site_m->get('pages', $where, TRUE);
        
        $this->load->view('site/page', $data);
        
    }
    
}