<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permissions extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("auth-permission",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        
        $this->load->model('auth/table_permissions');
    }

    public function index()
    {
        // echo "<pre>";
        // echo print_r($this->session->userdata('logged_in'));
        // echo "</pre>";
        // die();
        $title  = "Daftar permissions";
        $data   = $this->table_permissions->all();

        $this->load->view(
            'auth/permissions/index',
            compact(
                'title',
                'data'
            )
        );
    }

    public function create()
    {
        $title  = "Buat User";

        $this->load->view(
            'auth/permissions/create',
            compact(
                'title'
            )
        );
    }

    
    public function add()
    {
        $data['title']  = str_replace(" ","-",strtolower($this->input->post('title')));
        $check   = $this->table_permissions->check($data);

        if($check == false)
        {
            $data['description'] = $this->input->post('description');
    
            $this->table_permissions->add($data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
            redirect("auth/permissions");
        }
        else{
            $this->session->set_flashdata('error',"Gagal! Role Title sudah terpakai.");
            redirect("auth/permissions/create");
        }

    }

    public function detail($id)
    {
        $title  = "Detail permissions";
        $data   = $this->table_permissions->get($id);

        $this->load->view(
            'auth/permissions/edit',
            compact(
                'title',
                'data'
            )
        );
    }

    public function update()
    {
        $title = $this->input->post('title_before');
        $id['id'] = $this->input->post('id');
        $data['title']  = str_replace(" ","-",strtolower($this->input->post('title')));
        
        if($title != $data['title']){
            $check = $this->table_permissions->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE){
            $data['description'] = $this->input->post('description');
    
            $this->table_permissions->update($id, $data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/permissions/detail/".$id['id']);
        }
        else{
            $this->session->set_flashdata('error',"Gagal! Role Title sudah terpakai.");
            redirect("auth/permissions/detail/".$id['id']);
        }
    }

}
