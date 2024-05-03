<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_flag_data extends CI_Model
{
    private $table="data_flag";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            data_flag.*,
            flag.*,
            status.name as category_name,
            status.color as color,
            status.text as text
        ');
        $this->db->join('flag','flag.code = data_flag.status');
        $this->db->join('status','status.code = flag.category');
        $this->db->order_by('data_flag.time','DESC');
        return $this->db->get($this->table)->result();
    }

    public function filter($date,$pegawai)
    {
        $this->db->select('
            data_flag.*,
            flag.category as category,
            flag.code as code,
            flag.name as name,
            status.name as category_name,
            status.color as color,
            status.text as text
        ');
        $this->db->join('flag','flag.code = data_flag.status');
        $this->db->join('status','status.code = flag.category');
        $this->db->where('data_flag.tanggal',$date);
        $this->db->where('data_flag.pegawai',$pegawai);
        $this->db->order_by('data_flag.time','DESC');
        return $this->db->get($this->table)->result();
    }

    public function filter_month($date,$pid)
    {
        $this->db->select('
            data_flag.*,
            flag.category as category,
            flag.code as code,
            flag.name as name,
            flag.potongan as potongan,
            status.name as category_name,
            status.color as color,
            status.text as text
        ');
        $this->db->join('flag','flag.code = data_flag.status');
        $this->db->join('status','status.code = flag.category');
        $this->db->where('data_flag.tanggal',$date);
        $this->db->where('data_flag.pegawai',$pid);
        $this->db->order_by('data_flag.time','DESC');
        return $this->db->get($this->table)->row();

    }

    public function get_last($date,$pegawai)
    {
        $this->db->select('
            data_flag.*,
            flag.category as category,
            flag.code as code,
            flag.name as name,
            status.name as category_name,
            status.color as color,
            status.text as text
        ');
        $this->db->join('flag','flag.code = data_flag.status');
        $this->db->join('status','status.code = flag.category');
        $this->db->where('data_flag.tanggal',$date);
        $this->db->where('data_flag.pegawai',$pegawai);
        $this->db->order_by('data_flag.time','DESC');
        return $this->db->get($this->table)->row();
    }

    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();;
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function update($id, $data)
    {
        $this->db->where($id);
        $this->db->update($this->table,$data);
    }

    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->table);
    }
    
}