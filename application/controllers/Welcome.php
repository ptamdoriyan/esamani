<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
        
        
    }

	public function index()
	{
		if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }else{
            redirect('home');
		}
	}
}
