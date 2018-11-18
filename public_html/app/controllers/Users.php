<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect(APP_FOLDER.'acceso', 'refresh');
        } else {
            allow_only(array('administrators'));
            $this->data['user_logged'] = $this->ion_auth->user()->row();
            $this->data['title'] = gcfg('crud_users', 'page_title');
            $this->load->model('backend/General_model', 'gral');
        }
    }

    function main_get($user_type)
    {
        $groups=$this->ion_auth->groups()->result_array();
        $key = array_search($user_type, array_column($groups, 'name'));

        if (in_array($user_type, $groups[$key])) {
            $this->data['btn_action'] = 1;
            $this->data['user_type'] = gcfg($user_type, 'user_group_translate');
            $this->data['group_name'] = $user_type;

            $this->data['users'] = $this->ion_auth->select('auth_users.*, auth_users.id as id, auth_users.id as user_id, p.descrip as state_name, c.descrip as city_name')
            ->where('visible', 1)->users($user_type)->result();

            if (count($this->data['users']) > 0) {
                $this->load->view('users/list', $this->data);
            } else {
                redirect('usuarios/'.$user_type.'/add');
            }
        } else {
            $this->errorlib->show(404);
        }
    }

    function sheet_get($user_type, $user_id = NULL)
    {
        $action = $this->uri->segment(3);
        switch ($action) {
            case 'add':
                $this->data['user'] = NULL;
                $this->data['user_id'] = NULL;
                $this->data['check_m'] = $this->pcrypt->data('encode', 0);
                $this->data['user_group'] = $this->pcrypt->data('encode', gcfg($user_type, 'user_group_id'));

                $this->data['btn_submit_label'] = lang('create_user_submit_btn');
                $this->data['form_heading'] = lang('create_user_heading');
                $this->data['form_subheading'] = lang('create_user_subheading');
            break;

            case 'edit':
                $user_id_decode = $this->pcrypt->data('decode', $user_id);

                if ((bool)$user_id_decode) {
                    $this->data['user'] =  $this->ion_auth->user($user_id_decode)->row();
                    $this->data['user_id'] = $user_id;
                    $this->data['check_m'] = $this->pcrypt->data('encode', $this->data['user']->email);
                    $this->data['current_user_group'] = $this->ion_auth->get_users_groups($user_id_decode)->result();
                    $this->data['users_group'] = $this->ion_auth->groups()->result_array();
                    $this->data['btn_submit_label'] = lang('edit_user_submit_btn');
                    $this->data['form_heading'] = lang('edit_user_heading');
                    $this->data['form_subheading'] = lang('edit_user_subheading');
                } else {
                    $this->errorlib->show(404);
                }
            break;
        }
        $this->data['user_type'] = gcfg($user_type, 'user_group_translate');
        $this->data['state_list'] = $this->gral->state_list()->result();

        $this->load->view('users/sheet', $this->data);
    }

    function sheet_post($user_type, $action)
    {
        if (!$this->input->is_ajax_request()) {
            $this->errorlib->show(404);
        } else {
            $arr = array();
            $item_decode = $this->pcrypt->data('decode', $this->input->post('item_id'));
            switch ($action) {
                case 'save':
                    $user_id_decode = $this->pcrypt->data('decode', $this->input->post('user_id'));
                    $old_mail = $this->pcrypt->data('decode', $this->input->post('check_m'));

                    $this->load->library('form_validation');

                    $is_change_email = ($old_mail == $this->input->post('email')) ? 'no_mail' : 'yes_mail';

                    $this->form_validation->set_message('required', '{field}|required');
                    $this->form_validation->set_message('valid_email', '{field}|valid_email');
                    $this->form_validation->set_message('is_unique', '{field}|is_unique');
                    $this->form_validation->set_message('numeric', '{field}|numeric');

                    if (!(bool)$this->form_validation->run('user_'.$is_change_email)) {
                        $chk_valid_email = strpos(validation_errors(), 'valid_email');
                        $chk_unique = strpos(validation_errors(), 'is_unique');
                        $chk_numeric = strpos(validation_errors(), 'numeric');
                        $chk_required = strpos(validation_errors(), 'required');

                        if ($chk_required !== FALSE) {
                            $message = lang('missing_data');
                        } elseif ($chk_unique !== FALSE || $chk_valid_email !== FALSE) {
                            $message = lang('account_creation_duplicate_email');
                        } elseif ($chk_numeric !== FALSE) {
                            $message = lang('only_numbers');
                        }

                        $arr = alertSwal('error', 'validation', $message, FALSE);
                        $arr['errors'] = validation_errors(' ', '|');
                    }
                    if ((bool)$this->form_validation->run('user_'.$is_change_email)) {
                        $email = strtolower($this->input->post('email'));
                        $this->load->library('Pushmail');

                        $additional_data = $this->_user_data($is_change_email);

                        if ((bool)$user_id_decode) { // SAVE -> Usuario existente

                            $group = $this->input->post('user_group');
                            if (isset($group) && !empty($group)) {
                                $this->ion_auth->remove_from_group(NULL, $user_id_decode);
                                $this->ion_auth->add_to_group($group, $user_id_decode);
                            }

                            $check = $this->ion_auth->update($user_id_decode, $additional_data);

                            if ((int) $check) {
                                $arr = alertSwal('ok', NULL, lang('update_successful'), TRUE, TRUE, APP_FOLDER.'usuarios/'.$user_type);
                            } else {
                                $arr = alertSwal('error', NULL, lang('update_unsuccessful'), FALSE);
                            }
                        } else { // SAVE -> Usuario nuevo

                            $password = str_rand(gcfg('min_password_length', 'ion_auth'));

                            $group = $this->pcrypt->data('decode', $this->input->post('user_group'));

                            $check = $this->ion_auth->register($email, $password, $email, $additional_data, array($group));

                            if ((int) $check) {
                                $full_name = $this->input->post('first_name').' '.$this->input->post('last_name');
                                $check_send = $this->pushmail->welcome($email, $password, $full_name, $group);
                                $arr = alertSwal('ok', NULL, lang('account_creation_successful').',<br>'.$check_send, TRUE, TRUE, '/usuarios/'.$user_type);
                            } else {
                                $arr = alertSwal('error', NULL, lang('account_creation_unsuccessful'), FALSE);
                            }
                        }
                    }
                    break;

                case 'moderate':
                    if ($this->ion_auth->is_admin()) {
                        if ((bool) $this->input->post('status')) {
                            $msg = $this->ion_auth->deactivate($item_decode);
                            $arr['new_status'] = 0;
                            $arr['icon'] = gcfg('disable_user', 'icons');
                        } else {
                            $msg = $this->ion_auth->activate($item_decode);
                            $arr['new_status'] = 1;
                            $arr['icon'] = gcfg('enable_user', 'icons');
                        }
                    } else {
                        $arr = alertSwal('error', NULL, lang('error_403'), FALSE);
                    }
                    break;

                case 'delete':
                    if ($this->ion_auth->is_admin()) {
                        $action_del = $this->ion_auth->delete_user($item_decode);

                        if ((bool) $action_del) {
                            $arr = alertSwal('ok', NULL, lang('delete_successful'), TRUE, TRUE);
                        } else {
                            $arr = alertSwal('error', NULL, lang('delete_unsuccessful'), FALSE, FALSE);
                        }
                    } else {
                        $arr = alertSwal('error', NULL, lang('error_403'), FALSE);
                    }
                    break;
            }
            echo json_encode($arr);
        }
    }

    private function _user_data($is_change_email)
    {
        $additional_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'full_name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
            'dni' => $this->input->post('card_id'),
            'matricula' => $this->input->post('license'),
            'phone' => $this->input->post('phone'),
            'state' => $this->input->post('state_id'),
            'city' => $this->input->post('city_id')
        );

        if ($is_change_email == 'yes_mail') {
            $additional_data = array_merge($additional_data, array('email' => $this->input->post('email')));
        }

        return $additional_data;
    }
}
