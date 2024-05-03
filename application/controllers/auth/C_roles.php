<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_roles extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        
        $this->load->model('auth/table_roles');
        $this->load->model('auth/table_permissions');
        $this->load->model('auth/table_roles_has_permissions');
    }

    public function index()
    {
        $title  = "Daftar Role";
        $data   = $this->table_roles->all();

        $this->load->view(
            'auth/roles/index',
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
            'auth/roles/create',
            compact(
                'title'
            )
        );
    }

    
    public function add()
    {
        $data['title']  = $this->input->post('title');
        $check   = $this->table_roles->check($data);

        if($check == false)
        {
            $data['description'] = $this->input->post('description');
    
            $id = $this->table_roles->add($data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
            redirect("auth/roles/has_permissions/".$id);
        }
        else{
            $this->session->set_flashdata('error',"Gagal! Role Title sudah terpakai.");
            redirect("auth/roles/create");
        }

    }

    public function detail($id)
    {
        $title  = "Detail Role";
        $data   = $this->table_roles->get($id);

        $this->load->view(
            'auth/roles/edit',
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
        $data['title']  = $this->input->post('title');
        
        if($title != $data['title']){
            $check = $this->table_roles->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE){
            $data['description'] = $this->input->post('description');
    
            $this->table_roles->update($id, $data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/roles/detail/".$id['id']);
        }
        else{
            $this->session->set_flashdata('error',"Gagal! Role Title sudah terpakai.");
            redirect("auth/roles/detail/".$id['id']);
        }
    }

    public function permissions($id){

        $title          = "Roles has Permissions";
        $permissions    = $this->table_permissions->all();
        $data           = $this->table_roles->get($id);
        $has            = $this->table_roles_has_permissions->get_by_roles($id);

        $this->load->view(
            'auth/roles/has_permissions',
            compact(
                'title',
                'data',
                'permissions',
                'has'
            )
        );

    }

    public function permissions_update(){

        $permissions    = $this->table_permissions->all();
        $roles_id       = $this->input->post('roles_id');
        foreach ($permissions as $p) {
            if($this->input->post("checkbox".$p->id) == "on"){
                $data[$p->id]['roles_id']         = $this->input->post('roles_id');
                $data[$p->id]['permissions_id']   = $p->id;
            }
        }

        if($data == null){
            $this->session->set_flashdata('error',"Gagal! Permissions harus dipilih minimal 1.");
            redirect("auth/roles/has_permissions/".$roles_id);
        }else{
            $this->table_roles_has_permissions->delete_by_roles($roles_id);
            $this->table_roles_has_permissions->add_batch($data);

            $this->session->set_flashdata('success',"Berhasil! Permissions telah di update.");
            redirect("auth/roles/has_permissions/".$roles_id);
        }


    }

}
