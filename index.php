<?php

define('ENVIRONMENT', 'development');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 1);

$system_path = 'system';
$application_folder = 'application';

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', str_replace('\\', '/', realpath($system_path)) . '/');
define('APPPATH', str_replace('\\', '/', realpath($application_folder)) . '/');
define('VIEWPATH', APPPATH . 'views/');

require_once BASEPATH . 'core/CodeIgniter.php';
