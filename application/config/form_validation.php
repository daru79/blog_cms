<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'users_create' => array(
        array(
            'field' => 'name',
            'label' => 'imię',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'e-mail',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'
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
    ),
//    
//    'users_edit' => array(
//        array(
//            'field' => 'name',
//            'label' => 'imię',
//            'rules' => 'trim|required'
//        ),
//        array(
//            'field' => 'email',
//            'label' => 'e-mail',
//            'rules' => 'trim|required|valid_email|callback__unique_email'
//        ),
//        array(
//            'field' => 'password',
//            'label' => 'hasło',
//            'rules' => 'trim|matches[passconf]'
//        ),
//        array(
//            'field' => 'passconf',
//            'label' => 'potwierdzenie hasła',
//            'rules' => 'trim'
//        )
//    )
    
    'panel_login' => array(
        array(
            'field' => 'email',
            'label' => 'e-mail',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'hasło',
            'rules' => 'trim|required'
        ),
    ),
    
    'pages_create' => array(
        array(
            'field' => 'title',
            'label' => 'tytuł',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'alias',
            'label' => 'alias',
            'rules' => 'trim|required|is_unique[pages.alias]'
        ),
        array(
            'field' => 'content',
            'label' => 'treść',
            'rules' => 'trim|required'
        ),
    ),
    
    'blog_create' => array(
        array(
            'field' => 'title',
            'label' => 'tytuł',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'alias',
            'label' => 'alias',
            'rules' => 'trim|required|is_unique[blog.alias]'
        ),
        array(
            'field' => 'date',
            'label' => 'data',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'content',
            'label' => 'treść',
            'rules' => 'trim|required'
        ),
    ),
    
    'comment_create' => array(
        array(
            'field' => 'name',
            'label' => 'imię',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email'
        ),
        array(
            'field' => 'content',
            'label' => 'treść',
            'rules' => 'trim|required'
        ),
    ),
);