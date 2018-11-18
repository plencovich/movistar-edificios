<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Building_model extends CI_Model {

    public function __construct()
    {
        $this->filter_column = array('l.descrip','p.descrip','c.descrip');
        $this->order_column = array('id_solicitud', 'l.descrip', 'p.descrip', 'c.descrip', null, null, null, null, 'fecha_alta','ase_presentacion');
    }

    public function make_query($user_code)
    {
        $this->db->select('s.*, p.descrip as state, c.descrip as city, l.descrip as address');
        $this->db->from('solicitudes s');
        $this->db->join('provincias p', 'p.id_provincia = s.id_provincia', 'left');
        $this->db->join('ciudades c', 'c.id_ciudad = s.id_ciudad', 'left');
        $this->db->join('calles l', 'l.cd_calle = s.cd_calle', 'left');
        if (gnou() == 'managers') {
            $this->db->where('id_usuario_alta',$user_code);
        }
        if(isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like('id_solicitud', $_POST["search"]["value"]);
            foreach ($this->filter_column as $column) {
                $this->db->or_like($column, $_POST["search"]["value"]);
            }
            $this->db->group_end();
        }
        if(isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_solicitud', 'DESC');
        }
    }

    public function make_datatables($user_code)
    {
        $this->make_query($user_code);
        if(isset($_POST["length"]) AND $_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($user_code)
    {
        $this->make_query($user_code);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data($user_code)
    {
        $this->db->from('solicitudes s');
        $this->db->join('provincias p', 'p.id_provincia = s.id_provincia', 'left');
        $this->db->join('ciudades c', 'c.id_ciudad = s.id_ciudad', 'left');
        $this->db->join('calles l', 'l.cd_calle = s.cd_calle', 'left');
        if (gnou() == 'managers') {
            $this->db->where('id_usuario_alta',$user_code);
        }
        return $this->db->count_all_results();
    }

    public function save_data($info)
    {
        $this->db->insert('solicitudes',$info);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }

    public function get_info($id_solicitud, $user_code)
    {
        $this->db->select('s.*, u.*, l.descrip AS calle_name, p.descrip AS provincia_name, c.descrip AS ciudad_name, pc.descrip AS partido_name');
        $this->db->from('solicitudes s');
        $this->db->join('auth_users u', 'u.user_code = s.id_usuario_alta', 'inner');
        $this->db->join('provincias p', 'p.id_provincia = s.id_provincia', 'left');
        $this->db->join('ciudades c', 'c.id_ciudad = s.id_ciudad', 'left');
        $this->db->join('partidos pc', 'pc.id_partido = s.id_partido', 'left');
        $this->db->join('calles l', 'l.cd_calle = s.cd_calle', 'left');
        $this->db->where('s.id_solicitud', $id_solicitud);
        if (gnou() == 'managers') {
            $this->db->where('s.id_usuario_alta',$user_code);
        }
        $query = $this->db->get();
        return $query;
    }

    public function update_data($info, $item_id_decode)
    {
        $this->db->update('solicitudes',$info, 'id_solicitud = '.$item_id_decode);
        return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
    }
}
