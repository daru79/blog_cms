<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        // Zdefiniowanie ścieżki do katalogu uploadowego
        $this->gallery_path = BASEPATH.'../images/';
        $this->gallery_path_url = base_url().'images/';
        $this->watermark = BASEPATH.'../images/VW-Logo.png'; // Znak wodny
        
    }
    
    // Metody get(), create(), update(), delete(), unique() przeniesione do application/core/MY_Model.php
//    public function create($table, $data) {
//        // Wstawianie rekordu do BD
//        $this->db->insert($table, $data);
//        
//    }
    
//    public function get($table, $where = FALSE, $single = FALSE) { // FLASE czyli zmienna domyślnie niedostępna | $single -> czy chcemy tylko 1 rekord wydobyć z BD
//        if($where == TRUE) {
//            $this->db->where($where);
//            
//        }
//        
//        $query = $this->db->get($table);
//        
//        if($single == TRUE) {
//            return $query->row(); // RETURN powoduje natychmiastowe zakończenie funkcji
//            
//        }
//        
//        return $query->result();
//        
//    }
    
//    public function update($table, $where, $data) {
//        $this->db->where($where);
//        $this->db->update($table, $data);
//        
//    }

//    public function delete($table, $where) {
//        $this->db->where($where);
//        $this->db->delete($table);
//        
//    }
    
//    public function unique($id, $where) {
//        $this->db->where('email', $email);
//        !$id || $this->db->where('id !=', $id);
//        
//    }
    
    // Operacje na plikach w galerii
    public function do_upload() {
        $config['upload_path'] = $this->gallery_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']	= '2048';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()) {
            print $this->upload->display_errors();
                
        } else {
            // Wyświetlenie właściwości wgranego pliku
//            var_dump($this->upload->data());
            $image_data = $this->upload->data();
            $this->load->library('image_lib');
            
            // Tworzenie miniaturki
            $config['image_library'] = 'gd2';
            $config['source_image'] = $image_data['full_path'];
            $config['new_image'] = $this->gallery_path.'thumbs';
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 640;
            $config['height'] = 640;

            $this->image_lib->initialize($config); // Żeby ww. operacje były wykonywane jedna po drugiej
            $this->image_lib->resize();
            
            // Docięcie miniaturki
            $config['source_image'] = $this->gallery_path.'thumbs/'.$image_data['file_name'];
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 640;
            $config['height'] = 360;
            
            $this->image_lib->initialize($config); // Żeby ww. operacje były wykonywane jedna po drugiej
            $this->image_lib->crop();
            
            // Znak wodny
            $config['source_image'] = $this->gallery_path.'thumbs/'.$image_data['file_name'];
            $config['wm_type'] = 'overlay';
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'right';
            $config['wm_padding'] = '20';
            $config['wm_overlay_path'] = $this->watermark;
            
            $this->image_lib->initialize($config); // Żeby ww. operacje były wykonywane jedna po drugiej
            $this->image_lib->watermark();
            
        }

    }
    
    public function get_images() {
        // Skanowanie katalogu w poszukiwaniu plików
        $files = scandir($this->gallery_path);
        $diff = array('.', '..', 'thumbs'); // Wykluczenia, aby nie pokazywał '.', '..' i katalogu 'thumbs'
        $files = array_diff($files, $diff);
        
        return $files;
        
//        print '<pre>';
//        var_dump($files);
//        print '</pre>';
        
    }
    
}