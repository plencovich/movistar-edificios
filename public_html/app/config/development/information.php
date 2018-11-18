<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Información General
 */

/**
 * APP_FOLDER
 * - Utilizar '/' para URL del tipo: http://dominio/ o http://www.dominio.com/
 * - Utilizar '/folder/' para URL del tipo: http://localhost/folder o http://www.dominio.com/folder
 */
define('APP_FOLDER','/');
define('PDO_HOST','');
define('PDO_DB','');
define('PDO_USER','');
define('PDO_PASS','');

$config['pushmail'] = array(
    'smtp_host' => '',
    'username' => '',
    'password' => '',
    'secure' => '',
    'port' => 587
);
