<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load Configs
$config = array();
require APPPATH . 'config/config.php';
$GLOBALS['CI_CONFIG'] = $config;

// Helper Functions Standar CodeIgniter 3
function base_url($uri = '')
{
    $base = rtrim($GLOBALS['CI_CONFIG']['base_url'], '/') . '/';
    $uri = ltrim($uri, '/');
    return $base . $uri;
}

function site_url($uri = '')
{
    return base_url($uri);
}

function redirect($uri = '', $method = 'auto', $code = NULL)
{
    if (!preg_match('#^(\w+:)?//#i', $uri)) {
        $uri = base_url($uri);
    }
    header('Location: ' . $uri, TRUE, $code ? $code : 302);
    exit;
}

function set_value($field, $default = '')
{
    return isset($_POST[$field]) ? htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8') : $default;
}

function form_error($field = '', $prefix = '', $suffix = '')
{
    $ci = get_instance();
    return $ci->form_validation->error($field, $prefix, $suffix);
}

function validation_errors($prefix = '', $suffix = '')
{
    $ci = get_instance();
    return $ci->form_validation->error_string($prefix, $suffix);
}

// Class CI_DB_result
class CI_DB_result
{
    private $result_data = array();

    public function __construct($res)
    {
        if ($res instanceof mysqli_result) {
            while ($row = $res->fetch_assoc()) {
                $this->result_data[] = $row;
            }
        }
    }

    public function result_array()
    {
        return $this->result_data;
    }

    public function row_array()
    {
        return isset($this->result_data[0]) ? $this->result_data[0] : null;
    }

    public function num_rows()
    {
        return count($this->result_data);
    }
}

class CI_DB_driver
{
    public $conn;
    private $qb_where = array();
    private $qb_set = array();
    private $qb_order = '';

    public function __construct($db_config)
    {
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->conn = @new mysqli(
            $db_config['hostname'],
            $db_config['username'],
            $db_config['password'],
            $db_config['database']
        );

        if ($this->conn->connect_error) {
            die('<div style="font-family:sans-serif;max-width:680px;margin:50px auto;padding:24px;border:1px solid #fecaca;background:#fef2f2;border-radius:12px;color:#991b1b;">
                <h3 style="margin-top:0;">Koneksi Database Belum Siap</h3>
                <p>Aplikasi belum dapat terhubung ke database <strong>' . htmlspecialchars($db_config['database']) . '</strong> di MySQL/phpMyAdmin.</p>
                <ol style="line-height:1.7;">
                    <li>Pastikan modul <strong>Apache</strong> dan <strong>MySQL</strong> di XAMPP Control Panel sudah berstatus <strong>Started (Hijau)</strong>.</li>
                    <li>Buka <a href="http://localhost/phpmyadmin" target="_blank">http://localhost/phpmyadmin</a>.</li>
                    <li>Buat database bernama <code>db_si_framework</code> lalu <strong>Import</strong> file <code>database/db_si_framework.sql</code>.</li>
                </ol>
                <p style="font-size:13px;color:#7f1d1d;">Detail Teknis: ' . htmlspecialchars($this->conn->connect_error) . '</p>
            </div>');
        }
        $this->conn->set_charset($db_config['char_set']);
    }

    public function escape_str($str)
    {
        return $this->conn->real_escape_string((string)$str);
    }

    public function query($sql)
    {
        $res = $this->conn->query($sql);
        return new CI_DB_result($res);
    }

    public function where($key, $val = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->where($k, $v);
            }
            return $this;
        }
        $k = trim($key);
        $escaped = "'" . $this->escape_str($val) . "'";
        if (strpos($k, ' ') !== false) {
            $this->qb_where[] = "$k $escaped";
        } else {
            $this->qb_where[] = "`$k` = $escaped";
        }
        return $this;
    }

    public function order_by($field, $dir = 'ASC')
    {
        $this->qb_order = " ORDER BY `$field` $dir ";
        return $this;
    }

    private function _build_where()
    {
        if (empty($this->qb_where)) {
            return '';
        }
        $sql = ' WHERE ' . implode(' AND ', $this->qb_where);
        $this->qb_where = array();
        return $sql;
    }

    public function get($table)
    {
        $where = $this->_build_where();
        $order = $this->qb_order;
        $this->qb_order = '';
        $sql = "SELECT * FROM `$table`" . $where . $order;
        return $this->query($sql);
    }

    public function get_where($table, $where = array())
    {
        $this->where($where);
        return $this->get($table);
    }

    public function count_all_results($table)
    {
        $res = $this->get($table);
        return $res->num_rows();
    }

    public function insert($table, $data)
    {
        $cols = array();
        $vals = array();
        foreach ($data as $k => $v) {
            $cols[] = "`$k`";
            $vals[] = "'" . $this->escape_str($v) . "'";
        }
        $sql = "INSERT INTO `$table` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ")";
        return $this->conn->query($sql);
    }

    public function set($key, $val = '')
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->qb_set[$k] = $v;
            }
        } else {
            $this->qb_set[$key] = $val;
        }
        return $this;
    }

    public function update($table, $data = null)
    {
        if (is_array($data)) {
            $this->set($data);
        }
        $sets = array();
        foreach ($this->qb_set as $k => $v) {
            $sets[] = "`$k` = '" . $this->escape_str($v) . "'";
        }
        $this->qb_set = array();
        $where = $this->_build_where();
        $sql = "UPDATE `$table` SET " . implode(', ', $sets) . $where;
        return $this->conn->query($sql);
    }

    public function delete($table, $where = array())
    {
        if (!empty($where)) {
            $this->where($where);
        }
        $w = $this->_build_where();
        $sql = "DELETE FROM `$table`" . $w;
        return $this->conn->query($sql);
    }
}

class CI_Session
{
    public function userdata($key = null)
    {
        if ($key === null) {
            return $_SESSION;
        }
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set_userdata($key, $val = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
        } else {
            $_SESSION[$key] = $val;
        }
    }

    public function unset_userdata($key)
    {
        unset($_SESSION[$key]);
    }

    public function set_flashdata($key, $val)
    {
        $_SESSION['_flash_' . $key] = $val;
    }

    public function flashdata($key)
    {
        $k = '_flash_' . $key;
        if (isset($_SESSION[$k])) {
            $val = $_SESSION[$k];
            unset($_SESSION[$k]);
            return $val;
        }
        return '';
    }
}

class CI_Input
{
    public function post($index = null, $xss_clean = false)
    {
        if ($index === null) return $_POST;
        if (!isset($_POST[$index])) return null;
        $val = trim((string)$_POST[$index]);
        return $xss_clean ? strip_tags($val) : $val;
    }

    public function get($index = null, $xss_clean = false)
    {
        if ($index === null) return $_GET;
        if (!isset($_GET[$index])) return null;
        $val = trim((string)$_GET[$index]);
        return $xss_clean ? strip_tags($val) : $val;
    }
}

class CI_Form_validation
{
    private $rules = array();
    private $errors = array();

    public function set_rules($field, $label = '', $rules = '')
    {
        $this->rules[$field] = array(
            'field' => $field,
            'label' => $label ? $label : $field,
            'rules' => explode('|', $rules)
        );
        return $this;
    }

    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }
        $this->errors = array();
        $ci = get_instance();

        foreach ($this->rules as $field => $item) {
            $val = isset($_POST[$field]) ? $_POST[$field] : '';
            $label = $item['label'];

            foreach ($item['rules'] as $rule) {
                if ($rule === 'trim') {
                    $val = trim((string)$val);
                    $_POST[$field] = $val;
                } elseif ($rule === 'required' && $val === '') {
                    $this->errors[$field] = "Kolom $label wajib diisi.";
                    break;
                } elseif ($rule === 'valid_email' && $val !== '' && !filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = "Format $label tidak valid.";
                    break;
                } elseif ($rule === 'numeric' && $val !== '' && !is_numeric($val)) {
                    $this->errors[$field] = "Kolom $label harus berupa angka.";
                    break;
                } elseif (preg_match('/^min_length\[(\d+)\]$/', $rule, $m)) {
                    if (strlen($val) < (int)$m[1]) {
                        $this->errors[$field] = "$label minimal harus {$m[1]} karakter.";
                        break;
                    }
                } elseif (preg_match('/^matches\[(.+)\]$/', $rule, $m)) {
                    $other = isset($_POST[$m[1]]) ? $_POST[$m[1]] : '';
                    if ($val !== $other) {
                        $this->errors[$field] = "Konfirmasi $label tidak cocok.";
                        break;
                    }
                } elseif (preg_match('/^is_unique\[([^\.]+)\.([^\]]+)\]$/', $rule, $m)) {
                    $table = $m[1];
                    $col = $m[2];
                    $exists = $ci->db->get_where($table, array($col => $val))->num_rows();
                    if ($exists > 0) {
                        $this->errors[$field] = "$label sudah terdaftar di dalam database.";
                        break;
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function error($field, $prefix = '', $suffix = '')
    {
        if (!isset($this->errors[$field])) {
            return '';
        }
        return $prefix . $this->errors[$field] . $suffix;
    }

    public function error_string($prefix = '<div>', $suffix = '</div>')
    {
        if (empty($this->errors)) return '';
        $out = '';
        foreach ($this->errors as $err) {
            $out .= $prefix . $err . $suffix;
        }
        return $out;
    }
}

class CI_URI
{
    public $segments = array();

    public function __construct()
    {
        $request_uri = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
        $script_name = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
        $script_dir = rtrim(str_replace(basename($script_name), '', $script_name), '/');

        $path = $request_uri;
        if ($script_dir !== '' && stripos($path, $script_dir) === 0) {
            $path = substr($path, strlen($script_dir));
        }
        $path = ltrim($path, '/');
        if (stripos($path, 'index.php') === 0) {
            $path = ltrim(substr($path, strlen('index.php')), '/');
        }

        $parts = array_values(array_filter(explode('/', $path), 'strlen'));
        foreach ($parts as $idx => $part) {
            $this->segments[$idx + 1] = $part;
        }
    }

    public function segment($n, $default = null)
    {
        return isset($this->segments[$n]) ? $this->segments[$n] : $default;
    }
}

#[\AllowDynamicProperties]
class CI_Loader
{
    public function __get($key)
    {
        return get_instance()->$key;
    }
    public function view($view, $vars = array(), $return = false)
    {
        $ci = get_instance();
        extract($vars);
        $file = VIEWPATH . $view . '.php';
        if (!file_exists($file)) {
            die("View file tidak ditemukan: " . htmlspecialchars($file));
        }
        ob_start();
        include $file;
        $output = ob_get_clean();
        if ($return) {
            return $output;
        }
        echo $output;
    }

    public function model($model, $name = '')
    {
        $ci = get_instance();
        $model_file = APPPATH . 'models/' . ucfirst($model) . '.php';
        if (file_exists($model_file)) {
            require_once $model_file;
            $class = ucfirst($model);
            $prop = $name ? $name : strtolower($model);
            $ci->$prop = new $class();
        }
    }
}

#[\AllowDynamicProperties]
class CI_Model
{
    public function __get($key)
    {
        return get_instance()->$key;
    }
}

#[\AllowDynamicProperties]
class CI_Controller
{
    private static $instance;
    public $load;
    public $db;
    public $session;
    public $input;
    public $form_validation;
    public $uri;

    public function __construct()
    {
        self::$instance =& $this;
        $this->load = new CI_Loader();
        $this->session = new CI_Session();
        $this->input = new CI_Input();
        $this->uri = new CI_URI();

        require APPPATH . 'config/database.php';
        $this->db = new CI_DB_driver($db['default']);
        $this->form_validation = new CI_Form_validation();
    }

    public static function &get_instance()
    {
        return self::$instance;
    }
}

function &get_instance()
{
    return CI_Controller::get_instance();
}

require_once APPPATH . 'helpers/wpu_helper.php';
require_once APPPATH . 'config/routes.php';

$uri = new CI_URI();
$controller_name = $uri->segment(1) ? ucfirst(strtolower($uri->segment(1))) : ucfirst($route['default_controller']);
$method_name = $uri->segment(2) ? strtolower($uri->segment(2)) : 'index';
$params = array_slice($uri->segments, 2);

$controller_file = APPPATH . 'controllers/' . $controller_name . '.php';
if (!file_exists($controller_file)) {
    die("Halaman / Controller <strong>" . htmlspecialchars($controller_name) . "</strong> tidak ditemukan.");
}

require_once $controller_file;
$CI = new $controller_name();
if (!method_exists($CI, $method_name)) {
    die("Method <strong>" . htmlspecialchars($method_name) . "</strong> tidak ditemukan pada controller " . htmlspecialchars($controller_name));
}

call_user_func_array(array($CI, $method_name), $params);
