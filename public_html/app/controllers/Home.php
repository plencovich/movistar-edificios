<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect(APP_FOLDER.'acceso');
        } else {
            allow_only(array('administrators','managers'));
            $this->user_info = $this->ion_auth->user()->row();
            $this->data['user_logged'] = $this->user_info;
            $this->load->model('backend/Dashboard_model', 'dash');
        }
    }

    public function index()
    {
        $this->data['title'] = gcfg('dashboard', 'page_title');
        if (gnou() == 'managers') {
            $this->data['ask_for_advice'] = $this->dash->ask_advice($this->user_info->user_code);
            $this->data['submit_plans'] = $this->dash->submit_plans($this->user_info->user_code);
            $this->data['request_test'] = $this->dash->request_test($this->user_info->user_code);
        }
        $this->load->view('dashboard', $this->data);
    }
}
