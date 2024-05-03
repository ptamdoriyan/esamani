<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->model('table_data');
        $this->load->model('table_api');

    }

    public function push()
    {
        echo "haloo";
        // $data = $this->input->post('data');
        $data=$_POST['Row'];
        $date=$_POST['date'];
        // $data['Row'][0]['PIN'] = 16;
        // $data['Row'][0]['DateTime'] = 1471252812;
        // $data['Row'][1]['PIN'] = 161231231231231;
        // $data['Row'][1]['DateTime'] = 1471252812;
        $insert = 0;
        $ins = array();
        if ($data != null) {
            $i=0;
            foreach ($data as $d) {
                $ins[$i]['pin'] = $d['PIN'];
                $ins[$i]['time'] = strtotime($d['DateTime']);
                
                $check[$i] = $this->table_data->get($ins[$i]);
                if($check[$i] == 0){
                    $this->table_data->insert($ins[$i]);
                    $insert++;
                }
                $i++;
            }
            // echo "<pre>";
            // echo print_r(compact('check','ins'));
            // echo "</pre>";

            $sync['data']       = count($data);
            $sync['success']    = $insert;
            $sync['fail']       = count($data)-$insert;
        }else{
            $sync['data']       = 0;
            $sync['success']    = 0;
            $sync['fail']       = 0;
            
        }

        $sync['datetime']   = time();
        $sync['date']       = $date;
        

        $this->table_api->add($sync);
    }

}

/* End of file Controllername.php */
