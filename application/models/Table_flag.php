<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_flag extends CI_Model
{
    private $table="flag";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            flag.*,
            status.name as category_name,
            status.color as color,
            status.text as text
        ');
        $this->db->join('status','status.code = flag.category');
        $this->db->order_by('status.id','ASC');
        return $this->db->get($this->table)->result();
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
        $this->db->where($id);
        $this->db->delete($this->table);
    }
    
}