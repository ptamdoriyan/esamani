<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_libur extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("ref-pengaturan-libur",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        $this->load->model('table_ref');

    }

    public function index()
    {
        $title  = "Hari Libur";
        $data   = $this->table_ref->libur_all();
        
        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->load->view('ref/libur', compact('title','data'));
    }

    public function add()
    {
        $data['name']           = $this->input->post('name');
        $data['date']           = $this->input->post('date');

        $check = $this->table_ref->libur($data['date']);

        if($check == 0){
            $this->table_ref->libur_add($data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
            redirect("ref/libur");
        }else{
            $this->session->set_flashdata('error',"Gaga! Data tanggal sudah ada.");
            redirect("ref/libur");
        }
        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        
    }

    public function get($id)
    {

        $data = $this->table_ref->libur_get($id);

        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        echo json_encode($data);

    }

    public function delete()
    {
        $id['date'] = $this->input->post('date2');

        $this->table_ref->libur_delete($id);

        $this->session->set_flashdata('warning',"Berhasil! Data berhasil dihapus.");
        redirect("ref/libur");

        
    }



}

/* End of file Controllername.php */
