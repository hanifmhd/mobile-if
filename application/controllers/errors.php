<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        //$this->output->set_status_header('404'); 
        $this->load->view('error');
    } 
} 

/* End of file errors.php */
/* Location: ./application/controllers/errors.php */