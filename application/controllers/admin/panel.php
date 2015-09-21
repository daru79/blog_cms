<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
    }
    
    public function index() {
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login'); // Myślę, że lepiej to dać do konstruktora tej klasy
        
//        $data['loggedin'] = $this->loggedin(); // Nie jest to już potrzebne, bo przekazujemy tą zmienną globalnie do wszystkich widoków z poziomu konstruktora MY_Controller
        $this->load->view('admin/panel/index'); // Usunięte przekazanie '$data', bo przekazujemy tą zmienną globalnie do wszystkich widoków z poziomu konstruktora MY_Controller
        
    }
    
    public function login() { // UWAGA! info o tworzonej sesji jest także zapisywane w BD. Włączenie tej opcji: application/config.php->$config['sess_use_database'] = TRUE
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == FALSE || redirect('admin/panel'); // Myślę, że lepiej to dać do konstruktora tej klasy
        
//        $data['loggedin'] = $this->loggedin(); // Nie jest to już potrzebne, bo przekazujemy tą zmienną globalnie do wszystkich widoków z poziomu konstruktora MY_Controller
        
        // Sprawdzenie czy formularz logowania został przesłany
        if($_POST) {
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run('panel_login') == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'email' => $this->input->post('email'),
                    'password' => hash_salt($this->input->post('password')), // Haszowanie hasła za pomocą helpera
                    
                );
                
                // Przkazanie danych z tabeli do modelu aby sprawdzić czy dany użytkownik istnieje (model ładowany w konstruktorze)
                $user = $this->panel_m->get('users', $data, TRUE);
                
                if(!empty($user)) {
                    $data = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'loggedin' => TRUE // zmienna utworzona aby szybko sprawdzić czy użytkownik jest zalogowany
                        
                    );
                    
                    // Przekazanie ww. danych do sesji
                    $this->session->set_userdata($data);
                    
                    // Przekierowanko
                    redirect('admin/panel');
                    
                } else {
                    print 'brak zgodności maila do hasła';
                    
                }
                
                // Przekierowanko
//                redirect('admin/users');
            }
            
        }
        
        $this->load->view('admin/panel/login');
        
    }
    
    
    // Metoda sprawdzająca czy jesteśmy zalogowani => przeniesione do application/core/MY_Controller.php
//    public function loggedin() {
//        return $this->session->userdata('loggedin');
//        
//    }
    
    // Metoda dla wylogowania => przeniesione do application/core/MY_Controller.php
//    public function logout() {
//        $this->session->sess_destroy();
//        redirect('admin/panel');
//        
//    }
    
}