<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Global Config Custom
 *
 * @author Diego Plenco (www.plen.co)
 *
 */

/* Locale */
setlocale(LC_ALL, 'es_AR.utf8');
setlocale(LC_TIME, 'es_AR.utf8');
setlocale(LC_MONETARY, 'es_AR.utf8');
date_default_timezone_set('America/Argentina/Buenos_Aires');

define('APP_VERSION', 'v1');
define('FOOTER_COPY', '&copy; 2010 <a href="http://www.telefonica.com.ar" target="_blank">Telefonica</a>');
define('FOOTER_AUTHOR', 'Dise&ntilde;o de <a href="http://www.interferencias.speedy.com.ar" target="_blank">Administración Sinplex</a>');
define('FOOTER_TEXT', 'Ante cualquier problema, por favor comunicarse de 10hs a 12hs a los teléfonos <strong>11-4332-2662</strong> y <strong>11-4332-8989</strong>.');
define('PATH_PRIVATE_PLANOS', '/media/');
define('PATH_PUBLIC_PLANOS', '/ver/plano/');

/* Color Alert */
$config['color'] = array(
    'error' => '#ed5565',
    'ok' => '#5bc500',
    'warning' => '#f8ac59',
    'success' => '#5bc500',
    'info' => '#00a9e0',
);
$config['btnClass'] = array(
    'error' => 'btn btn-danger',
    'ok' => 'btn btn-success',
    'warning' => 'btn btn-warning',
    'success' => 'btn btn-success',
    'info' => 'btn btn-info',
);

/* AlertNotification BG*/
$config['alert_class'] = array(
    'error' => 'alert danger-bg',
    'ok' => 'alert success-bg',
    'warning' => 'warning-bg',
    'info' => 'info-bg',
    'alert_ok' => 'message-box message-success',
    'alert_error' => 'message-box message-danger'
);

/* Dynamic Icon for Buttons */
$config['icons'] = array(
    'disable_user' => 'fa fa-ban text-danger',
    'enable_user' => 'fa fa-circle text-success'
);

$config['action_ico_class'] = array(
    '0' => 'btn btn-info',
    '1' => 'btn btn-info-alt'
);
$config['action_ico_tooltip'] = array(
    '0' => 'Editar',
    '1' => 'Detalle'
);
$config['action_ico'] = array(
    '0' => 'fa fa-edit',
    '1' => 'fa fa-list-alt'
);
$config['status_codi_asesor'] = array(
    '0' => '',
    '1' => '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>'
);
$config['status_request'] = array(
    '0' => '<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>',
    '1' => '<i class="fa fa-check-circle text-success" aria-hidden="true"></i>'
);

$config['status_label'] = array(
    '0' => '<span class="text-danger font-bold">Error</span>',
    '1' => '<span class="text-success font-bold">Ok</span>',
);

$config['status_label_update'] = array(
    '0' => '<span class="text-blank font-bold">Sin Cambios</span>',
    '1' => '<span class="text-success font-bold">Ok</span>',
);

/*Extensiones permitidas en los formularios*/
$config['mime_type'] = array(
    'for_attached' => '.gif, .jpg, .jpeg, .png, .pdf',
    'for_config' => 'gif|png|jpg|jpeg|pdf'
);

// Grupo de Usuarios
$config['user_group_translate'] = array(
    'administrators' => 'administradores',
    'managers' => 'encargados'
);

$config['user_group_id'] = array(
    'administrators' => '1',
    'managers' => '2'
);

$config['user_group_label'] = array(
    '1' => 'administradores',
    '2' => 'encargados'
);
