<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Content Manager Option Library
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

class Wmscp
{
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function __construct()
    {
        $this->load->model('Wmscp_model', 'wmscpm');
    }

    public function get_cms_option($wmscp_name)
    {
        return $this->wmscpm->get_data($wmscp_name)->row()->wmscp_value;
    }

    public function check_maintenance()
    {
        $is_maintenance = $this->wmscpm->get_data('is_maintenance_status')->row()->wmscp_value;

        if ((bool)$is_maintenance AND !$this->ion_auth->logged_in()) {
            $this->load->view('maintenance');
        }
    }
}
