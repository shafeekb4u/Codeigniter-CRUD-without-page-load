<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Source http://www.codexworld.com/multi-language-implementation-in-codeigniter/

class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switchLang($language = "") {
        
        $all_lang = array('en','ar');

        $language = ($language != "" && in_array($language, $all_lang)) ? $language : "en";
        $this->session->set_userdata('site_lang', $language);
        
        redirect($_SERVER['HTTP_REFERER']);
        
    }
}
