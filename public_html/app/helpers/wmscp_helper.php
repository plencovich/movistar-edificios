<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Content Manager Helper Helper
 *
 * @author Diego Plenco (www.plen.co)
 *
 *
 **/

if (! function_exists('wmscp')) {

    function wmscp($wmscp_name)
    {
        $ci =& get_instance();
        return $ci->wmscp->get_cms_option($wmscp_name);
    }
}

if (! function_exists('check_maintenance')) {

    function check_maintenance()
    {
        $ci =& get_instance();
        return $ci->wmscp->check_maintenance();
    }
}
