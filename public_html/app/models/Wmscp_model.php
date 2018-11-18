<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wmscp_model extends CI_Model {

    public function __construct()
    {
        $this->table = 'wmscp_options';
    }

    public function get_data($wmscp_name)
    {
        $query = $this->db->where('wmscp_name',$wmscp_name)
                            ->get($this->table);
        return $query;
    }
}
