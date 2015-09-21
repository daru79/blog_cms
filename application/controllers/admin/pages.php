<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login');
        
    }
    
    public function index() {
        // Dodanie kolejnej kolumny do tabeli 'pages'
//        $field = array(
//            'order' => array(
//                'type' => 'INT',
//                'constraint' => 10
//            )
//        );
//        $this->load->dbforge();
//        $this->dbforge->add_column('pages', $field);
        
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['pages']
        $order = 'order';
        $sort = 'ASC';
        $data['pages'] = $this->panel_m->get('pages', FALSE, FALSE, $order, $sort);
        
        $this->load->view('admin/pages/index', $data);
        
    }
    
    // Metoda tworzenia użytkowników
    public function create() {
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (przeniesiony do zbiorczego pliku walidacji application/config/form_validation.php)
            
            if($this->input->post('alias') == '') {
                $_POST['alias'] = alias($this->input->post('title'));

            }
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run('pages_create') == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'title' => $this->input->post('title'),
                    'alias' => alias($this->input->post('alias')),
                    'content' => $this->input->post('content'), // Haszowanie hasła za pomocą helpera
                    
                );
                
                // Przkazanie danych z tabeli do modelu (model ładowany w konstruktorze)
                $this->panel_m->create('pages', $data);
                
                // Przekierowanko
                redirect('admin/pages');
            }
            
        }
        
        // Widok formularza tworzenia użytkowników
        $this->load->view('admin/pages/create');
        
    }
    
    // Metoda edycji użytkowników (nie działa :/)
    public function edit() {
        // Pobieranie konkretnego segmentu z paska adresowego
        $id = $this->uri->segment(4);
        
        // Konstrukcja zapytania WHERE (pole tabeli -> wartość)
        $where = array('id' => $id);
        
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['page']
        $data['page'] = $this->panel_m->get('pages', $where, TRUE);
        
        $id = $data['page']->id;
        
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (nie działa callback)
            $config = array(
                array(
                    'field' => 'title',
                    'label' => 'tytuł',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'alias',
                    'label' => 'alias',
                    'rules' => 'trim|required|callback__unique_alias'
                ),
                array(
                    'field' => 'content',
                    'label' => 'treść',
                    'rules' => 'trim|required'
                ),
            );
            
            $this->form_validation->set_rules($config);
            
            // Nadpisanie komunikatów o błędach walidacji
            $config = array(
                'is_unique' => 'Taki użytkownik już istnieje.'
                
            );
            
            $this->form_validation->set_message($config);
            
            if($this->input->post('alias') == '') {
                $_POST['alias'] = alias($this->input->post('title'));

            }
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run() == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'title' => $this->input->post('title'),
                    'alias' => alias($this->input->post('alias')),
                    'content' => $this->input->post('content'),
                    
                );

                $where = array('id' => $id);
                $this->panel_m->update('pages', $where, $data);
                
                // Przekierowanko
                redirect('admin/pages');
            }
            
        }
        
        $this->load->view('admin/pages/edit', $data);
        
    }
    
    public function delete() {
        // Pobranie ID edytowanego elementu
        $id = $this->uri->segment(4);
        
        // Usuwamy użytkownika
        $where = array('id' => $id);
        $this->panel_m->delete('pages', $where);
        
        // Przekierowanko
        redirect('admin/pages');
        
    }
    
    // Metoda dla 'callback' w walidacji formularza w metodzie edit()
    function _unique_alias() {
        // Pobranie ID edytowanego elementu
	$id = $this->uri->segment(4);
        
	$alias = $this->input->post('alias');

        // Sprawdzamy czy e-mail edytowanego użytkownika istnieje w BD
        $where = array(
            'alias' => $alias
            
        );
        
	$this->panel_m->unique($id, $where);

        // Sprawdzanie czy użytkownik o podanym ID ma już podany e-mail (?)
        if( $this->panel_m->get('pages') ) {
            $this->form_validation->set_message('_unique_alias', 'Alias jest już w użyciu');
            return FALSE;
                
        }

        return TRUE;
        
    }
    
    public function ajax() {
        // Odbieranie danych z AJAXa
        $items = $this->input->post('items');
        
        // Rozbicie tablicy '$items'
        foreach($items as $order => $id) {
//            echo $id.' jest '.$order.' | '; // Wyświetlenie danych z pętli dla potrzeb test
            
            // Kryterium updatu
            $where = array('id' => $id);
            
            // Co będziemy update'ować
            $data = array('order' => $order);
            
            $this->panel_m->update('pages', $where, $data);
            
        }
        
    }
    
}