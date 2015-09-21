<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login');
        
    }
    
    public function index() {
        if($this->input->post('upload')) {
            $this->panel_m->do_upload();
            
        }
        
        $data['files'] = $this->panel_m->get_images();
        
        $this->load->view('admin/gallery/gallery', $data);
        
    }
    
    public function del_image() {
        if($_POST) {
            $file = $this->input->post('file_name');
            unlink(BASEPATH.'../images/'.$file);
            unlink(BASEPATH.'../images/thumbs/'.$file);
            
            redirect('admin/gallery');
            
        }
        
    }
    
}