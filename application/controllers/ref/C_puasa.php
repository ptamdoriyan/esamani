<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_puasa extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("ref-pengaturan-puasa",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        
        $this->load->model('table_ref');

    }

    public function index()
    {
        $title  = "Hari Puasa";
        $data   = $this->table_ref->puasa_all();
        
        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->load->view('ref/puasa', compact('title','data'));
    }

    public function add()
    {
        $date               = explode(" - ",$this->input->post('date'));
        $data['date_from']  = $date[0];
        $data['date_to']    = $date[1];
        $data['year']       = substr($date[0],0,4);

        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->table_ref->puasa_add($data);

        $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
        redirect("ref/puasa");

        
    }

    public function get($id)
    {

        $data = $this->table_ref->puasa_get($id);

        echo json_encode($data);

    }

    public function delete()
    {
        $id['id'] = $this->input->post('id');

        $this->table_ref->puasa_delete($id);

        $this->session->set_flashdata('warning',"Berhasil! Data berhasil dihapus.");
        redirect("ref/puasa");

        
    }



}

/* End of file Controllername.php */
