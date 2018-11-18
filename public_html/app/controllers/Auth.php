<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->data['class_body'] = 1;
        $this->load->model('backend/General_model', 'gral');
    }

    function access_get()
    {
        if ($this->ion_auth->logged_in()) {
            redirect(APP_FOLDER, 'refresh');
        } else {
            $this->data['title'] = gcfg('login', 'page_title');

            $this->load->view('auth/login', $this->data);
        }
    }

    function register_get()
    {
        if ($this->ion_auth->logged_in()) {
            redirect(APP_FOLDER, 'refresh');
        } else {
            $this->data['title'] = gcfg('register', 'page_title');

            $this->data['state_list'] = $this->gral->state_list()->result();

            $this->load->view('auth/register', $this->data);
        }
    }

    function city_list_post($state_id)
    {
        if ($this->input->is_ajax_request()) {
            $arr = array();

            $list_all = $this->gral->city_list($state_id);
            if ($list_all->num_rows() > 0) {
                $arr['city_list'] = $list_all->result();
            } else {
                $arr['city_list'] = NULL;
            }
            echo json_encode($arr);
        } else {
            $this->errorlib->show(404);
        }
    }

    function recovery_get()
    {
        $this->data['title'] = lang('email_forgot_password_link');

        $this->load->view('auth/forgot_password', $this->data);
    }

    function reset_get($code)
    {
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            $this->data['title'] = lang('reset_password_heading');
            $this->data['user_id'] = $this->pcrypt->data('encode', $user->id);
            $this->data['code'] = $code;

            $this->load->view('auth/reset_password', $this->data);
        } else {
            redirect('recuperar', 'refresh');
        }
    }

    function validate_post($section = NULL, $code = NULL)
    {
        if ($this->input->is_ajax_request()) {
            $arr = array();

            $this->form_validation->set_message('valid_email', '{field}|valid_email');
            $this->form_validation->set_message('required', '{field}|required');
            $this->form_validation->set_message('min_length', '{field}|min_length');
            $this->form_validation->set_message('max_length', '{field}|max_length');
            $this->form_validation->set_message('matches', '{field}|matches');
            $this->form_validation->set_message('is_unique', '{field}|is_unique');
            $this->form_validation->set_message('numeric', '{field}|numeric');
            $this->form_validation->set_message('is_natural_no_zero', '{field}|is_natural_no_zero');

            if (!(bool)$this->form_validation->run($section)) {
                $chk_required = strpos(validation_errors(), 'required');
                if ($section == 'reset_password') {
                    $chk_min = strpos(validation_errors(), 'min_length');
                    $chk_max = strpos(validation_errors(), 'max_length');
                    $chk_match = strpos(validation_errors(), 'matches');

                    if ($chk_required !== FALSE) {
                        $message = lang('missing_data');
                    } elseif ($chk_min !== FALSE) {
                        $message = sprintf(lang('min_length'), gcfg('min_password_length', 'ion_auth'));
                    } elseif ($chk_max !== FALSE) {
                        $message = sprintf(lang('max_length'), gcfg('max_password_length', 'ion_auth'));
                    } elseif ($chk_match !== FALSE) {
                        $message = lang('matches');
                    }
                } else {
                    $chk_numeric = strpos(validation_errors(), 'numeric');
                    $chk_unique = strpos(validation_errors(), 'is_unique');
                    $chk_valid_email = strpos(validation_errors(), 'valid_email');
                    $is_natural_no_zero = strpos(validation_errors(), 'is_natural_no_zero');

                    if ($chk_required !== FALSE || $is_natural_no_zero !== FALSE) {
                        $message = lang('missing_data');
                    } elseif ($chk_numeric !== FALSE) {
                        $message = lang('only_numbers');
                    } elseif ($chk_unique !== FALSE) {
                        $message = lang('account_creation_duplicate_email');
                    } elseif ($chk_valid_email !== FALSE) {
                        $message = sprintf(lang('email_invalid_address'), $this->input->post('identity'));
                    }
                }
                $arr = alertNotification('error', $section, $message, FALSE);
                $arr = array_merge($arr, array('errors' => validation_errors(' ', '|')));
            }

            if ((bool)$this->form_validation->run($section)) {
                switch ($section) {
                    case 'login':
                        $remember = (bool)$this->input->post('remember');

                        if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                            $arr = redirectResponse('login', APP_FOLDER);
                        } else {
                            $arr = alertNotification('error', $section, $this->ion_auth->errors(), TRUE, FALSE);
                        }
                    break;

                    case 'recovery':
                        $this->load->library('Pushmail');
                        $identity = $this->ion_auth->where(gcfg('identity', 'ion_auth'), $this->input->post('email'))->users()->row();

                        if (empty($identity)) {
                            $this->ion_auth->set_error('forgot_password_email_not_found');
                            $arr = alertNotification('error', $section, $this->ion_auth->errors(), FALSE);
                            $arr['errors'] = 'email';
                        } else {
                            $data = $this->ion_auth->forgotten_password($identity->{gcfg('identity', 'ion_auth')});
                            $check_send = $this->pushmail->recovery($data);
                            $arr = alertNotification('ok', $section, $this->ion_auth->messages().$check_send, TRUE, TRUE);
                        }
                    break;

                    case 'reset_password':
                        $user = $this->ion_auth->forgotten_password_check($code);

                        if ($user->id != $this->pcrypt->data('decode', $this->input->post('user_id'))) {
                            $this->ion_auth->clear_forgotten_password_code($code);

                            $arr = alertNotification('error', $section, lang('error_csrf'), TRUE, FALSE);
                        } else {
                            $identity = $user->{gcfg('identity', 'ion_auth')};
                            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
                            $arr = ($change) ? alertSwal('ok', $section, $this->ion_auth->messages(), TRUE, TRUE, APP_FOLDER.'salir') : alertNotification('error', $section, $this->ion_auth->errors(), TRUE, FALSE);
                        }
                    break;

                    case 'register':
                        $email = strtolower($this->input->post('identity'));
                        $this->load->library('Pushmail');

                        $additional_data = $this->_user_data();

                        $password = str_rand(gcfg('min_password_length', 'ion_auth'));

                        $group = 2;

                        $check = $this->ion_auth->register($email, $password, $email, $additional_data, array($group));

                        if ((int) $check) {
                            $full_name = $this->input->post('first_name').' '.$this->input->post('last_name');
                            $check_send = $this->pushmail->welcome($email, $password, $full_name, $group);
                            $arr = alertNotification('ok', $section, lang('account_creation_successful').', '.$check_send, TRUE, TRUE);
                        } else {
                            $arr = alertNotification('error', $section, lang('account_creation_unsuccessful'), TRUE, FALSE);
                        }
                    break;
                }
            }
            echo json_encode($arr);
        } else {
            $this->errorlib->show(404);
        }
    }

    private function _user_data()
    {
        $new_user_code = $this->gral->get_last_user_code()->user_code+1;
        $additional_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'full_name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
            'email' => $this->input->post('identity'),
            'dni' => $this->input->post('card_id'),
            'matricula' => $this->input->post('license'),
            'phone' => $this->input->post('phone'),
            'state' => $this->input->post('state_id'),
            'city' => $this->input->post('city_id'),
            'user_code' => $new_user_code
        );

        return $additional_data;
    }

    function logout()
    {
        $this->ion_auth->logout();
        $this->session->sess_destroy();
        redirect(APP_FOLDER, 'refresh');
    }
}
