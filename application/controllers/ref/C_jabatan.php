<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jabatan extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("ref-jabatan",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        
        $this->load->model('table_jabatan');
    }

    public function index()
    {
        $title  = "Daftar Jabatan";
        $data   = $this->table_jabatan->all();

        $this->load->view(
            'jabatan/index',
            compact(
                'title',
                'data'
            )
        );
    }

    public function create()
    {
        $title  = "Tambah Jabatan";

        $this->load->view(
            'jabatan/create',
            compact(
                'title'
            )
        );
    }

    
    public function add()
    {
        $data['nama']       = $this->input->post('nama');
        $data['deskripsi'] = $this->input->post('deskripsi');
        
        $this->table_jabatan->add($data);

        $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
        redirect("ref/jabatan");
        
    }

    public function detail($id)
    {
        $title  = "Detail Jabatan";
        $data   = $this->table_jabatan->get($id);

        $this->load->view(
            'jabatan/edit',
            compact(
                'title',
                'data'
            )
        );
    }

    public function update()
    {
        $id['id']            = $this->input->post('id');
        $data['nama']       = $this->input->post('nama');
        $data['deskripsi'] = $this->input->post('deskripsi');

        $this->table_jabatan->update($id, $data);

        $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
        redirect("ref/jabatan/detail/".$id['id']);
    
    }

}
