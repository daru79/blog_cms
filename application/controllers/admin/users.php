<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index() {
        print 'users';
        
    }
    
    // Metoda tworzenia użytkowników
    public function create() {
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza
            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'imię',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'e-mail',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'password',
                    'label' => 'hasło',
                    'rules' => 'trim|required|matches[passconf]'
                ),
                array(
                    'field' => 'passconf',
                    'label' => 'potwierdzenie hasła',
                    'rules' => 'trim|required'
                )
            );
            
            $this->form_validation->set_rules($config);
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run() == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    
                );
                
            }
            
        }
        
        // Widok formularza tworzenia użytkowników
        $this->load->view('admin/users/create');
        
    }
    
}