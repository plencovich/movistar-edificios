<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Errors Library
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

class Errorlib
{
    private $data;

    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function show($type)
    {
        $this->data['user_logged'] = ($this->ion_auth->logged_in()) ? $this->ion_auth->user()->row() : NULL ;

        if ($this->input->is_ajax_request()) {
            echo gcfg('error_'.$type, 'page_title').PHP_EOL;
            echo $is_404 = ($type == '404') ? current_url() : NULL ;
        } else {
            $this->data['type'] = $type;
            $this->data['class_body'] = 1;
            $this->data['title'] = gcfg('error_'.$type, 'page_title').' :: '.wmscp('project_name');

            $this->load->view('errors/backend', $this->data);
        }
        exit();
    }
}
