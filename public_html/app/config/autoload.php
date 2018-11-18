<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('ion_auth','database', 'session', 'pcrypt', 'errorlib', 'wmscp');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'language', 'plenco', 'text', 'string','wmscp');

$autoload['config'] = array('global','page_title', 'information');

$autoload['language'] = array('global', 'auth', 'ion_auth','email');

$autoload['model'] = array();
