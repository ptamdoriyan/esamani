<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_users extends CI_Model
{
    private $table="users";

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $this->db->select('
            users.*,
            roles.title as roles_title
        ');
        $this->db->join('roles','users.roles_id = roles.id');
        return $this->db->get($this->table)->result();
    }
    public function login($data)
    {
        return $this->db->get_where($this->table,$data)->row();
        
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
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

    public function check($data)
    {
        $this->db->where($data);
        $data = $this->db->get($this->table)->row();

        if($data){
            return true;
        } else{
            return false;
        }
    }
    
}