<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_users extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        
        $this->load->model('auth/table_users');
        $this->load->model('auth/table_roles');
    }

    public function index()
    {
        $title  = "Daftar User";
        $data   = $this->table_users->all();

        $this->load->view(
            'auth/users/index',
            compact(
                'title',
                'data'
            )
        );
    }

    

    public function add()
    {
        $data['username']  = $this->input->post('username');
        $check   = $this->table_users->check($data);

        if($check == false)
        {
            $data['fullname'] = $this->input->post('fullname');
            $data['password'] = md5($this->input->post('password'));
            $data['roles_id'] = $this->input->post('role');
    
            $this->table_users->add($data);
    
            $this->session->set_flashdata('success',"Berhasil! Data berhasil ditambahkan.");
            redirect("auth/users");
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/create");
        }

    }

    public function create()
    {
        $title  = "Buat User";
        $roles  = $this->table_roles->all();

        $this->load->view(
            'auth/users/create',
            compact(
                'title',
                'roles'
            )
        );
    }

    public function detail($id)
    {
        $title  = "Detail User";
        $roles  = $this->table_roles->all();
        $data   = $this->table_users->get($id);

        $this->load->view(
            'auth/users/edit',
            compact(
                'title',
                'roles',
                'data'
            )
        );
    }

    public function update()
    {
        $username         = $this->input->post('username_before');
        $id['id']         = $this->input->post('id');
        $data['username'] = $this->input->post('username');

        
        if($username != $data['username'])
        {
            $check = $this->table_users->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE)
        {
            $data['fullname'] = $this->input->post('fullname');
            $data['roles_id'] = $this->input->post('role');
    
            $this->table_users->update($id,$data);

            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/users/detail/".$id['id']);
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/detail/".$id['id']);
        }
    }

    

    public function profile()
    {
        $title  = "Ubah Profil";
        $id     = $this->session->userdata['logged_in']['id'];
        $roles  = $this->table_roles->all();
        $data   = $this->table_users->get($id);

        $this->load->view(
            'auth/users/profile',
            compact(
                'title',
                'roles',
                'data'
            )
        );
    }

    

    public function update_profile()
    {
        $username         = $this->input->post('username_before');
        $id['id']         = $this->session->userdata['logged_in']['id'];
        $data['username'] = $this->input->post('username');

        
        if($username != $data['username'])
        {
            $check = $this->table_users->check($data);
        }
        else {
            $check = FALSE;
        }

        if($check == FALSE)
        {
            $data['fullname'] = $this->input->post('fullname');
    
            $this->table_users->update($id,$data);

            $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
            redirect("auth/users/profile");
        }
        else{
            $this->session->set_flashdata('error',"Gagal! username sudah terpakai.");
            redirect("auth/users/profile");
        }
    }

    public function update_password()
    {
        $id         = $this->session->userdata['logged_in']['id'];
        $old_pass   = $this->input->post('password_before');

        $data = array(
			'id' => $id,
			'password' => md5($old_pass)
        );

        $validate = $this->table_users->login($data);
        if ($validate == TRUE)
        {
            $i['id']        = $id;
            $p['password']  = md5($this->input->post('password'));
            $this->table_users->update($i,$p);

            $this->session->set_flashdata('success',"Berhasil! Password berhasil diubah.");
            redirect("auth/users/profile");
        }
        else
        {
            $this->session->set_flashdata('error',"Gagal! password lama anda salah.");
            redirect("auth/users/profile");
        }

    }

}
