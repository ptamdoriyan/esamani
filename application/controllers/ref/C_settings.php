<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_settings extends CI_Controller {

    function __construct(){
        parent::__construct();
        if(!($this->session->userdata('logged_in'))){
            redirect('login');
        }
        if(!in_array("ref-pengaturan-jam",$this->session->userdata('logged_in')['permissions'])){
            redirect('home');
        }
        
        $this->load->model('table_ref');
    }

    public function index()
    {
        $title  = "Pengaturan Jam Absensi";
        $data   = $this->table_ref->settings_all();

        $this->load->view(
            'ref/settings',
            compact(
                'title',
                'data'
            )
        );
    }

    public function update()
    {
        // $id[]['id']           = $this->input->post('id');
        // $data[]['value']      = $this->input->post('value');
        $id         = $this->input->post('id');
        $value       = $this->input->post('value');

        for ($i=0; $i < count($id); $i++) { 
            $ids['id'] = $id[$i];
            $data['value'] = $value[$i];
            $this->table_ref->settings_update($ids, $data);

        }
        // echo "<pre>";
        // echo print_r(compact('data'));
        // echo "</pre>";
        // die();

        $this->session->set_flashdata('success',"Berhasil! Data berhasil diubah.");
        redirect("ref/settings");
    
    }

}
