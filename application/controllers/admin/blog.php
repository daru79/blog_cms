<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_m');
        
        // Sprawdzenie czy użytkownik już jest zalogowany
        $this->loggedin() == TRUE || redirect('admin/panel/login');
        
    }
    
    public function index() {
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['blog']
        $data['blog'] = $this->panel_m->get('blog', FALSE, FALSE, 'date', 'DESC');;
        
        $this->load->view('admin/blog/index', $data);
        
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
            
            if($this->input->post('date') == '') {
                $_POST['date'] = date('Y-m-d');

            }
            
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            if ($this->form_validation->run('blog_create') == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'title' => $this->input->post('title'),
                    'alias' => alias($this->input->post('alias')),
                    'date' => $this->input->post('date'),
                    'content' => $this->input->post('content'),
                    
                );
                
                // Przkazanie danych z tabeli do modelu (model ładowany w konstruktorze)
                $this->panel_m->create('blog', $data);
                
                // Przekierowanko
                redirect('admin/blog');
            }
            
        }
        
        // Widok formularza tworzenia użytkowników
        $this->load->view('admin/blog/create');
        
    }
    
    // Metoda edycji użytkowników (nie działa :/)
    public function edit() {
        // Pobieranie konkretnego segmentu z paska adresowego
        $id = $this->uri->segment(4);
        
        // Konstrukcja zapytania WHERE (pole tabeli -> wartość)
        $where = array('id' => $id);
        
        // Pobranie użytkowników z BD i przypisanie ich do tablicy $data['article']
        $data['article'] = $this->panel_m->get('blog', $where, TRUE);
        
        $id = $data['article']->id;
        
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
                    'date' => $this->input->post('date'),
                    'content' => $this->input->post('content'),
                    
                );

                $where = array('id' => $id);
                $this->panel_m->update('blog', $where, $data);
                
                // Przekierowanko
                redirect('admin/blog');
            }
            
        }
        
        $this->load->view('admin/blog/edit', $data);
        
    }
    
    public function delete() {
        // Pobranie ID edytowanego elementu
        $id = $this->uri->segment(4);
        
        // Usuwamy użytkownika
        $where = array('id' => $id);
        $this->panel_m->delete('blog', $where);
        
        // Przekierowanko
        redirect('admin/blog');
        
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
        if( $this->panel_m->get('blog') ) {
            $this->form_validation->set_message('_unique_alias', 'Alias jest już w użyciu');
            return FALSE;
                
        }

        return TRUE;
        
    }
    
}