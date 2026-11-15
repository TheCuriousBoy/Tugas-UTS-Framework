<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Deteksi Base URL secara otomatis agar langsung berjalan di localhost/nama_folder_apapun
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script_dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
$config['base_url'] = $protocol . $host . $script_dir;

$config['index_page'] = '';
$config['uri_protocol'] = 'REQUEST_URI';
$config['charset'] = 'UTF-8';
$config['encryption_key'] = 'SI_Semester3_Framework_Key_2026';
