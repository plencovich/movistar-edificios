<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

    public function state_list()
    {
        $query = $this->db->order_by('descrip','asc')->get('provincias');
        return $query;
    }

    public function city_list($state_id)
    {
        $query = $this->db->where('id_provincia',$state_id)->order_by('descrip','asc')->get('ciudades');
        return $query;
    }

    public function region_list($state_id)
    {
        $query = $this->db->where('id_provincia',$state_id)->order_by('descrip','asc')->get('partidos');
        return $query;
    }

    public function street_list($city_id)
    {
        $query = $this->db->where('cd_localidad',$city_id)->order_by('descrip','asc')->get('calles');
        return $query;
    }

    public function street_info($street_id)
    {
        $query = $this->db->where('cd_calle',$street_id)->get('calles');
        return $query;
    }

    public function categoria_info($cat_id)
    {
        $query = $this->db->where('edificios_cate_codi',$cat_id)->get('edificios_cate');
        return $query;
    }

    public function building_cat_list()
    {
        $query = $this->db->order_by('descri','asc')->get('edificios_cate');
        return $query;
    }

    public function get_last_user_code()
    {
        $query = $this->db->select_max('user_code')->get('auth_users');
        return $query->row();
    }
}
