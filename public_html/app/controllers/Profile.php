<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect(APP_FOLDER.'acceso', 'refresh');
        } else {
            $this->data['user_logged'] = $this->ion_auth->user()->row();
            allow_only(array('administrators','managers'));
            $this->load->model('backend/General_model', 'gral');
            $this->data['state_list'] = $this->gral->state_list()->result();
        }
    }

    function action_get()
    {
        $user_id_encode = $this->pcrypt->data('encode', $this->session->user_id);

        $this->data['user'] =  $this->ion_auth->user($this->session->user_id)->row();

        $this->data['user_id'] = $user_id_encode;
        $this->data['title'] = gcfg('profile', 'page_title');

        $this->load->view('profile/edit', $this->data);
    }

    function action_post()
    {
        if (!$this->input->is_ajax_request()) {
            $this->errorlib->show(404);
        } else {
            $arr = array();

            $user_id_decode = $this->pcrypt->data('decode', $this->input->post('user_id'));

            if ($this->session->user_id != $user_id_decode) {
                $arr = alertSwal('error', NULL, lang('error_csrf'), FALSE);
            } else {
                $this->load->library('form_validation');

                $this->form_validation->set_message('valid_email', '{field}|valid_email');
                $this->form_validation->set_message('is_unique', '{field}|is_unique');
                $this->form_validation->set_message('required', '{field}|required');
                $this->form_validation->set_message('numeric', '{field}|numeric');
                $this->form_validation->set_message('min_length', '{field}|min_length');
                $this->form_validation->set_message('max_length', '{field}|max_length');
                $this->form_validation->set_message('matches', '{field}|matches');

                $is_change_pass = ($this->input->post('password')) ? 'yes_pass_' : 'no_pass_';
                $is_change_email = ($this->data['user_logged']->email == $this->input->post('email')) ? 'no_mail' : 'yes_mail';

                $rules_id = 'profile_'.$is_change_pass.$is_change_email;

                if (!(bool)$this->form_validation->run($rules_id)) {
                    $chk_min = strpos(validation_errors(), 'min_length');
                    $chk_max = strpos(validation_errors(), 'max_length');
                    $chk_match = strpos(validation_errors(), 'matches');
                    $chk_valid_email = strpos(validation_errors(), 'valid_email');
                    $chk_unique = strpos(validation_errors(), 'is_unique');
                    $chk_numeric = strpos(validation_errors(), 'numeric');
                    $chk_required = strpos(validation_errors(), 'required');

                    if ($chk_required !== FALSE) {
                        $message = lang('missing_data');
                    } elseif ($chk_min !== FALSE) {
                        $message = sprintf(lang('min_length'), gcfg('min_password_length', 'ion_auth'));
                    } elseif ($chk_max !== FALSE) {
                        $message = sprintf(lang('max_length'), gcfg('max_password_length', 'ion_auth'));
                    } elseif ($chk_match !== FALSE) {
                        $message = lang('matches');
                    } elseif ($chk_unique !== FALSE || $chk_valid_email !== FALSE) {
                        $message = lang('account_creation_duplicate_email');
                    } elseif ($chk_numeric !== FALSE) {
                        $message = lang('only_numbers');
                    }

                    $arr = alertSwal('error', 'validation', $message, FALSE);
                    $arr['errors'] = validation_errors(' ', '|');
                }
                if ((bool)$this->form_validation->run($rules_id)) {
                    $data = $this->_user_data();

                    if ($this->input->post('password')) {
                        $data['password'] = $this->input->post('password');
                        $arr_logout = 1;
                    }

                    $check = $this->ion_auth->update($user_id_decode, $data);

                    if ((int) $check) {
                        $redirUrl = (isset($arr_logout)) ? APP_FOLDER.'salir' : APP_FOLDER;
                        $arr = alertSwal('ok', NULL, $this->ion_auth->messages(), TRUE, TRUE, $redirUrl);
                    } else {
                        $arr = alertSwal('error', NULL, $this->ion_auth->errors(), TRUE, FALSE);
                    }
                }
            }
            echo json_encode($arr);
        }
    }

    private function _user_data()
    {
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'full_name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
            'dni' => $this->input->post('card_id'),
            'matricula' => $this->input->post('license'),
            'phone' => $this->input->post('phone'),
            'state' => $this->input->post('state_id'),
            'city' => $this->input->post('city_id')
        );

        return $data;
    }
}
