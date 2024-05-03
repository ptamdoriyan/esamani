<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pegawai extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("main-pegawai",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        
        
        $this->load->model('auth/table_users');
        $this->load->model('table_pegawai');
        $this->load->model('table_jabatan');

    }

    public function index()
    {
        $title  = "Data Pegawai";
        $data   = $this->table_pegawai->full();
        
        $this->load->view('pegawai/index', compact('title','data'));
    }

    public function create()
    {
        $title      = "Tambah Pegawai";
        $jabatan    = $this->table_jabatan->all();

        
        $this->load->view('pegawai/create', compact('title','jabatan'));
    }

    public function add()
    {
        $data['nama']           = $this->input->post('nama');
        $data['nip']            = $this->input->post('nip');
        $data['jabatan_id']     = $this->input->post('jabatan_id');
        $data['gender']         = $this->input->post('gender');
        $data['active']         = $this->input->post('active');
        $data['finger']         = $this->input->post('finger');

        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->table_pegawai->add($data);
    
        $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
        redirect("pegawai");
    }

    public function detail($id)
    {
        $title      = "Detail Pegawai";
        $data       = $this->table_pegawai->get($id);
        $jabatan    = $this->table_jabatan->all();
        
        $this->load->view('pegawai/edit', compact('title','data','jabatan'));
    }

    public function update()
    {
        $id['id']               = $this->input->post('id');
        $data['nama']           = $this->input->post('nama');
        $data['nip']            = $this->input->post('nip');
        $data['jabatan_id']     = $this->input->post('jabatan_id');
        $data['gender']         = $this->input->post('gender');
        $data['active']         = $this->input->post('active');
        $data['finger']         = $this->input->post('finger');

        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->table_pegawai->update($id,$data);
    
        $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
        redirect("pegawai/detail/".$id['id']);
    }

    public function activate()
    {
        $id['id']               = $this->input->post('id2');
        $data['deactive']       = null;

        $this->table_pegawai->update($id,$data);
    
        $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
        redirect("pegawai/detail/".$id['id']);
    }

    public function deactivate()
    {
        $id['id']               = $this->input->post('id3');
        $data['deactive']       = date("Y-m-d");

        $this->table_pegawai->update($id,$data);
    
        $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
        redirect("pegawai/detail/".$id['id']);
    }



}

/* End of file Controllername.php */
