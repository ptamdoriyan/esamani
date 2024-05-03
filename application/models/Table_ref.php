<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_ref extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function settings()
    {
        $data = $this->db->get('settings')->result();
        foreach ($data as $d) {
            $setting[$d->name] = $d->value;
        }

        return $setting;
    }

    public function settings_all()
    {
        return $this->db->get('settings')->result();

    }

    public function settings_update($id, $data)
    {
        $this->db->where($id);
        $this->db->update('settings',$data);
    }

    public function status()
    {
        $data = $this->db->get('status')->result_array();
        foreach ($data as $d) {
            $status[$d['code']] = $d;
        }

        return $status;
    }

    public function puasa($time)
    {
        $this->db->where('date_from <=', date("Y-m-d",$time));
        $this->db->where('date_to >=', date("Y-m-d",$time));
        return $this->db->get('ref_puasa')->row();
    }

    
    public function puasa_get($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('ref_puasa')->row();
    }

    
    public function puasa_all()
    {
        $this->db->order_by('year','DESC');
        return $this->db->get('ref_puasa')->result();
    }

    
    public function puasa_add($data)
    {
        $this->db->insert('ref_puasa',$data);
    }

    
    public function puasa_delete($id)
    {
        $this->db->delete('ref_puasa',$id);
    }

    
    public function libur($date)
    {
        $this->db->where('date', $date);
        $data = $this->db->get('ref_libur')->row();
        
        if($data != null){
            return $data;
        }else{
            return null;
        }
    }

    
    public function libur_get($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('ref_libur')->row();
    }

    
    public function libur_all()
    {
        $this->db->order_by('date','DESC');
        return $this->db->get('ref_libur')->result();
    }

    
    public function libur_add($data)
    {
        $this->db->insert('ref_libur',$data);
    }

    
    public function libur_delete($id)
    {
        $this->db->delete('ref_libur',$id);
    }

    
    public function kegiatan($date)
    {
        $this->db->where('date', $date);
        $data = $this->db->get('ref_kegiatan')->row();
        
        if($data != null){
            return $data;
        }else{
            return null;
        }
    }

    
    public function kegiatan_get($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('ref_kegiatan')->row();
    }

    
    public function kegiatan_all()
    {
        $this->db->order_by('date','DESC');
        return $this->db->get('ref_kegiatan')->result();
    }

    
    public function kegiatan_add($data)
    {
        $this->db->insert('ref_kegiatan',$data);
    }

    
    public function kegiatan_delete($id)
    {
        $this->db->delete('ref_kegiatan',$id);
    }
}