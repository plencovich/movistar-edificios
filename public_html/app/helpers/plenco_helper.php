<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Plen.co Helper
 *
 * @author Diego Plenco (www.plen.co)
 *
 * Es un conjunto de funciones/shortcuts.
 *
 **/

/**
 * Global Config Helper
 * Es un shortcut a $this->config-item($key, $group)
 **/

if (! function_exists('gcfg')) {

    function gcfg($key, $group)
    {
        $ci =& get_instance();
        $line = $ci->config->item($key, $group);

        return $line;
    }
}

/**
 * Access Helper
 **/

/**
* allow_only()
* Usar para filtrar acceso en el controlador/métodos
**/
if (! function_exists('allow_only')) {

    function allow_only($group)
    {
        $ci =& get_instance();
        $access = ($ci->ion_auth->logged_in() and $ci->ion_auth->in_group($group)) ? TRUE : FALSE ;

        if ($access === FALSE) {
            $ci->errorlib->show(403);
        }
        return NULL;
    }
}

/**
* only()
* Usar para mostrar contenido a determinados grupos de IonAuth en las vistas.
**/

if (! function_exists('only')) {

    function only($group)
    {
        $ci =& get_instance();
        $access = ($ci->ion_auth->logged_in() and $ci->ion_auth->in_group($group)) ? TRUE : FALSE ;

        return $access;
    }
}

/**
* gnou()
* Obtiene el primer grupo a que pertenece el usuario logueado.
**/

if (! function_exists('gnou')) {

    function gnou()
    {
        $ci =& get_instance();
        $group = $ci->ion_auth->get_users_groups()->row();

        return $group->name;
    }
}

/**
 * Generate Response Helper
 **/
/*Se utiliza para mostrar los sweetalert**/
if (! function_exists('alertSwal')) {

    function alertSwal($type, $section, $message, $validation, $status = NULL, $redirUrl = NULL)
    {
        $arr = array(
            'validation' => $validation,
            'status' => $status,
            'type' => $section,
            'message' => $message,
            'title' => lang('title_'.$type),
            'btnColor' => gcfg($type, 'color'),
            'btnClass' => gcfg($type, 'btnClass'),
            'redirUrl' => $redirUrl
        );
        return $arr;
    }
}

/*Se utiliza para mostrar el div.alerNotification**/
if (! function_exists('alertNotification')) {

    function alertNotification($type, $section, $message, $validation, $status = NULL)
    {
        $arr = array(
                'validation' => $validation,
                'status' => $status,
                'type' => $section,
                'message' => $message,
                'classMain' => gcfg($type, 'alert_class'),
                'classIcon' => gcfg('alert_'.$type, 'icons')
        );
        return $arr;
    }
}

/* Se utiliza para los submit Ok con redireccionamiento **/
if (! function_exists('redirectResponse')) {

    function redirectResponse($section, $redirUrl)
    {
        $arr = array(
                'validation' => TRUE,
                'type' => $section,
                'status' => TRUE,
                'redirUrl' => $redirUrl
        );
        return $arr;
    }
}

/*Se utiliza para mostrar los sweetalert custom en front**/
if (! function_exists('alertSwalFront')) {

    function alertSwalFront($type, $section, $message, $validation, $status = NULL, $redirUrl = NULL)
    {
        $arr = array(
            'validation' => $validation,
            'status' => $status,
            'type' => $section,
            'message' => $message,
            'title' => lang('title_'.$section),
            'btnColor' => gcfg($type, 'color'),
            'btnClass' => 'btnForm',
            'redirUrl' => $redirUrl,
            'ico' => PATH_ICO_ALERT,
            'icow' => '85',
            'icoh' => '74',
            'alt' => lang('title_'.$section),
        );
        return $arr;
    }
}

/**
 * CSRF Helper (unused)
 * Funciones para validar formularios o información
 **/
if (! function_exists('_get_csrf_nonce')) {

    function _get_csrf_nonce()
    {
        $ci =& get_instance();

        $csrf = new stdClass();

        $csrf->key = random_string('alnum', 8);
        $csrf->value = random_string('alnum', 20);
        $ci->session->set_flashdata('csrfkey', $csrf->key);
        $ci->session->set_flashdata('csrfvalue', $csrf->value);

        return $csrf;
    }
}

if (! function_exists('_valid_csrf_nonce')) {

    function _valid_csrf_nonce()
    {
        $ci =& get_instance();
        if ($ci->input->post($ci->session->flashdata('csrfkey')) !== FALSE && $ci->input->post($ci->session->flashdata('csrfkey')) == $ci->session->flashdata('csrfvalue')) {
                return TRUE;
        } else {
                return FALSE;
        }
    }
}

/**
 * Random String and Numeric
 * Genera cadena de texto aleatoria
 **/
if (! function_exists('str_rand')) {

    function str_rand($qty)
    {
        $str = random_string('alnum', $qty);

        return $str;
    }
}

if (! function_exists('num_rand')) {

    function num_rand($qty)
    {
        $str = random_string('numeric', $qty);

        return $str;
    }
}

/**
 * Crea SLUG
 * Convierte un string en slug
 **/
if (! function_exists('create_slug')) {

    function create_slug($item)
    {
        $lower_item = strtolower($item);
        $str = convert_accented_characters(url_title($lower_item, '-', TRUE));

        return $str;
    }
}

/**
 * Convert Date
 **/
if ( ! function_exists('date_to'))
{

    function date_to($convert_to,$item_date)
    {
        switch ($convert_to) {
            case 'human':
                $new_date = DateTime::createFromFormat('Y-m-d', $item_date);
                return $new_date->format('d-m-Y');
            break;

            case 'humanWithTime':
                $new_date = DateTime::createFromFormat('Y-m-d H:i:s', $item_date);
                return $new_date->format('d-m-Y H:i:s');
            break;

            case 'eng':
                $new_date = DateTime::createFromFormat('Y-m-d', $item_date);
                return $new_date->format('m-d-Y');
            break;

            case 'sql':
                $new_date = DateTime::createFromFormat('d-m-Y', $item_date);
                return $new_date->format('Y-m-d');
            break;

            case 'customDate':
                $new_date = DateTime::createFromFormat('d-m-Y', $item_date);
                return $new_date->format('d/m/Y');
            break;

            case 'customDateTime':
                $new_date = DateTime::createFromFormat('Y-m-d H:i:s', $item_date);
                return $new_date->format('d/m/Y H:i:s');
            break;
        }
    }
}
