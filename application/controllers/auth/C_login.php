<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles_has_permissions');
    }

    public function index()
    {
        if(($this->session->userdata('logged_in'))){
            redirect('home');
		}
        $this->load->view('auth/login');
    }

    public function validate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => md5($password)
        );

		$validate = $this->table_users->login($data);
        if ($validate == TRUE)
        {
            $permissions    = $this->table_roles_has_permissions->get_by_id($validate->id);
            $session_data = array(
                'id' 	        => $validate->id,
                'fullname'	    => $validate->fullname,
                'roles_id'	    => $validate->roles_id,
                'permissions'   => $permissions
            );
            $this->session->set_userdata('logged_in',$session_data);
            $this->session->set_flashdata('success', "Selamat Datang!");
            redirect('home', $session_data);
        }
        else

        {
            $this->session->set_flashdata('error', "Masuk Gagal! anda belum terdaftar atau email/kata sandi anda salah");
            redirect('login');
        }

    }
    

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mb-2" role="alert" id="flash_message">Logged out!</div>'
		);
    	redirect('login');
	}

}

/* End of file Controllername.php */
