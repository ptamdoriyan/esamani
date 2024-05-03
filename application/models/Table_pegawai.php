<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_pegawai extends CI_Model
{
    private $table="pegawai";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
                            pegawai.*,
                            jabatan.nama as jabatan
                    ');
        $this->db->join('jabatan','pegawai.jabatan_id = jabatan.id');
        $this->db->order_by('jabatan.id');
        $this->db->order_by('pegawai.nama');
        $this->db->where('deactive', NULL);
        return $this->db->get($this->table)->result();
    }

    public function full()
    {
        $this->db->select('
                            pegawai.*,
                            jabatan.nama as jabatan
                    ');
        $this->db->join('jabatan','pegawai.jabatan_id = jabatan.id');
        $this->db->order_by('jabatan.id');
        $this->db->order_by('pegawai.nama');
        return $this->db->get($this->table)->result();
    }

    public function count()
    {
        $this->db->select('
                            pegawai.*,
                            jabatan.nama as jabatan
                    ');
        $this->db->join('jabatan','pegawai.jabatan_id = jabatan.id');
        $this->db->order_by('jabatan.id');
        $this->db->where('deactive', NULL);
        return $this->db->get($this->table)->num_rows();
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

    public function get_finger($id)
    {
        $this->db->select('
                            pegawai.*,
                            jabatan.nama as jabatan
                    ');
        $this->db->join('jabatan','pegawai.jabatan_id = jabatan.id');
        $this->db->order_by('jabatan.id');
        $this->db->where('finger', $id);
        return $this->db->get($this->table)->row();
    }

    public function update($id, $data)
    {
        $this->db->where($id);
        $this->db->update($this->table,$data);
    }

    public function delete($id)
    {
        $this->db->where($id);
        $this->db->delete($this->table);
    }
    
}