<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Haszowanie i solenie hasła
// URL: http://randomkeygen.com/
function hash_salt($string) {
    return hash('sha512', $string . ':' . config_item('encryption_key'));
}

// Zamiana tytułu strony na alias przyjazny dla wyszukiwarek
function alias($string) {
    // Zamiana polskich znaków na angielskie
    $string = convert_accented_characters($string);
    
    // Utworzenie przyjaznego URLa
    $string = url_title($string);
    
    return $string;
    
}

// Przycinanie zdań
function excerpt($string, $quantity) {
    $string = word_limiter($string, $quantity);
    
    return $string;
    
}