<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login');
        
    }
    
    public function index() {
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['users']
        $data['users'] = $this->panel_m->get('users');
        
        $this->load->view('admin/users/index', $data);
        
    }
    
    // Metoda tworzenia użytkowników
    public function create() {
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (przeniesiony do zbiorczego pliku walidacji application/config/form_validation.php)
//            $config = array(
//                array(
//                    'field' => 'name',
//                    'label' => 'imię',
//                    'rules' => 'trim|required'
//                ),
//                array(
//                    'field' => 'email',
//                    'label' => 'e-mail',
//                    'rules' => 'trim|required|valid_email|is_unique[users.email]'
//                ),
//                array(
//                    'field' => 'password',
//                    'label' => 'hasło',
//                    'rules' => 'trim|required|matches[passconf]'
//                ),
//                array(
//                    'field' => 'passconf',
//                    'label' => 'potwierdzenie hasła',
//                    'rules' => 'trim|required'
//                )
//            );
//            
//            $this->form_validation->set_rules($config);
//            
//            // Nadpisanie komunikatów o błędach walidacji
//            $config = array(
//                'is_unique' => 'Taki użytkownik już istnieje.'
//                
//            );
//            
//            $this->form_validation->set_message($config);
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run('panel_create') == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => hash_salt($this->input->post('password')), // Haszowanie hasła za pomocą helpera
                    
                );
                
                // Przkazanie danych z tabeli do modelu (model ładowany w konstruktorze)
                $this->panel_m->create('users', $data);
                
                // Przekierowanko
                redirect('admin/users');
            }
            
        }
        
        // Widok formularza tworzenia użytkowników
        $this->load->view('admin/users/create');
        
    }
    
    // Metoda edycji użytkowników (nie działa :/)
    public function edit() {
        // Pobieranie konkretnego segmentu z paska adresowego
        $id = $this->uri->segment(4);
        
        // Konstrukcja zapytania WHERE (pole tabeli -> wartość)
        $where = array('id' => $id);
        
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['user']
        $data['user'] = $this->panel_m->get('users', $where, TRUE);
        
        $id = $data['user']->id;
        
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (nie działa callback)
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'imię',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'e-mail',
                    'rules' => 'trim|required|valid_email|callback__unique_email'
                ),
                array(
                    'field' => 'password',
                    'label' => 'hasło',
                    'rules' => 'trim|matches[passconf]'
                ),
                array(
                    'field' => 'passconf',
                    'label' => 'potwierdzenie hasła',
                    'rules' => 'trim'
                )
            );
            
            $this->form_validation->set_rules($config);
            
            // Nadpisanie komunikatów o błędach walidacji
            $config = array(
                'is_unique' => 'Taki użytkownik już istnieje.'
                
            );
            
            $this->form_validation->set_message($config);
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run() == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => hash_salt($this->input->post('password')), // Haszowanie hasła za pomocą helpera
                    
                );

                // Gdyby użytkownik nie chciał zmianiać hasła
                if($this->input->post('password') == '') {
                    // Zostawiamy to hasło, które jest w BD
                    $data['password'] = $data['user']->password;
                    
                }
                
                $where = array('id' => $id);
                $this->panel_m->update('users', $where, $data);
                
                // Przekierowanko
                redirect('admin/users');
            }
            
        }
        
        $this->load->view('admin/users/edit', $data);
        
    }
    
    public function delete() {
        // Pobranie ID edytowanego elementu
        $id = $this->uri->segment(4);
        
        // Usuwamy użytkownika
        $where = array('id' => $id);
        $this->panel_m->delete('users', $where);
        
        // Przekierowanko
        redirect('admin/users');
        
    }
    
    // Metoda dla 'callback' w walidacji formularza w metodzie edit()
    function _unique_email() {
        // Pobranie ID edytowanego elementu
	$id = $this->uri->segment(4);
        
	$email = $this->input->post('email');

        // Sprawdzamy czy e-mail edytowanego użytkownika istnieje w BD
        $where = array(
            'email' => $email
            
        );
        
	$this->panel_m->unique($id, $where);

        // Sprawdzanie czy użytkownik o podanym ID ma już podany e-mail (?)
        if( $this->panel_m->get('users') ) {
            $this->form_validation->set_message('_unique_email', 'Inny użytkownik ma już taki adres e-mail');
            return FALSE;
                
        }

        return TRUE;
        
    }
    
}