<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login');
        
    }
    
    public function index() {
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['comments']
        $data['comments'] = $this->panel_m->get('comments', FALSE, FALSE, 'date', 'DESC');;
        
        $this->load->view('admin/comments/index', $data);
        
    }
    
    public function edit() {
        $id = $this->uri->segment(4);
        $where = array('id' => $id);
        $data['comment'] = $this->panel_m->get('comments', $where, TRUE);
        
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (nie działa callback)
            $config = array(
                array(
                    'field' => 'content',
                    'label' => 'treść',
                    'rules' => 'trim|required'
                ),
            );
            
            $this->form_validation->set_rules($config);
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run() == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'content' => $this->input->post('content'),
                    
                );

                $where = array('id' => $id);
                $this->panel_m->update('comments', $where, $data);
                
                // Przekierowanko
                redirect('admin/comments');
            }
            
        }
        
        $this->load->view('admin/comments/edit', $data);
        
    }
    
    public function delete() {
        $id = $this->uri->segment(4);
        $where = array('id' => $id);
        $this->panel_m->delete('comments', $where);
        
        // Przekierowanko
        redirect('admin/comments');
        
    }
    
}