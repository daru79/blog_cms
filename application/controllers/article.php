<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('site_m');
        
    }
    
    // Wyświetlenie strony klikniętej w menu (trza dokonać przekierowania w 'application/config/routes.php'
    public function display_article($alias) {
        // Zliczanie odwiedzin artykułów
        $this->site_m->count_views($alias);
        
        $where = array('alias' => $alias);
        $data['article'] = $this->site_m->get('blog', $where, TRUE);
        
        // Pobieranie komentarzy z BD
        $article_id = $data['article']->id;
        $where = array('article_id' => $article_id);
        $data['comments'] = $this->site_m->get('comments', $where, FALSE);
        
        $this->load->view('site/article', $data);
        
        if($_POST) {
            $this->_add_comment($alias);
            
        }
        
    }
    
    function _add_comment($alias) {
        // Jeśli formularz zostanie przesłany
        if(!empty($_POST)) {
            // Ładujemy bibliotekę walidacji formularza (jest już w autoloaderze)
//            $this->load->library('form_validation');
            
            // Określenie i ustanowienie reguł walidacji (przeniesiony do zbiorczego pliku walidacji application/config/form_validation.php)
                        
            // Sprawdzanie walidacji (okrojona wersja w stos. do dokumentacji -> bez bloku 'else')
            // ### Walidacja w tym przypadku nie działa ###
            if ($this->form_validation->run('comment_create') == TRUE) { // Jeśli walidacja zadziałała (var_dump($_POST); -> można wykorzystać do przetestowania co zawiera zmienna '$_POST')
                // Pobranie wypełnionych pól formularza
                $data = array(
                    'article_id' => $this->input->post('article_id'),
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'date' => $this->input->post('date'),
                    'content' => $this->input->post('content'),
                    
                );
                
                // Przkazanie danych z tabeli do modelu (model ładowany w konstruktorze)
                $this->site_m->create('comments', $data);
                
                // Po dodaniu komentarza odświeżamy stronę
                redirect('article/'.$alias, 'refresh');
                
            }
            
        }
        
    }
    
}