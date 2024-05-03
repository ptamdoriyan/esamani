<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        
        $this->load->model('auth/table_users');
        $this->load->model('table_pegawai');
        $this->load->model('table_data');
        $this->load->model('table_ref');
        $this->load->model('table_api');

    }

    public function index()
    {
        $title      = "Beranda";
        // $date       = "2019-08-17";
        $date       = date("Y-m-d");
        $pegawai    = $this->table_pegawai->count();
        $kegiatan   = $this->table_ref->kegiatan($date);
        $hadir      = $this->table_data->count_date($date);
        $last       = $this->table_api->last_update();
        // echo "<pre>";
        // echo print_r(compact('kegiatan'));
        // echo "</pre>";
        // die();


        $this->load->view('dash/home', compact('title','pegawai','hadir','kegiatan','last'));
    }

}

/* End of file Controllername.php */
