<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['display_override'][] = array(
    'class' => '',
    'function' => 'compress',
    'filename' => 'Compress.php',
    'filepath' => 'hooks'
);

$hook['post_controller'][] = array(
    'class' => '',
    'function' => 'secure_project',
    'filename' => 'Security.php',
    'filepath' => 'hooks'
);
