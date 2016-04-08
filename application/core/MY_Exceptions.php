<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// application/core/MY_Exceptions.php
class MY_Exceptions extends CI_Exceptions {
	public function __construct()
    {
        parent::__construct();
    }
    
    public function show_404()
    {
        $CI =& get_instance();
        $CI->load->view('error');
        echo $CI->output->get_output();
        
        exit;
    }
}