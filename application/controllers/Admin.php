<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Inventaris_model', 'inventaris');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stats'] = $this->inventaris->getSummaryStats();
        $data['total_user'] = $this->db->count_all_results('user');
        $data['total_menu'] = $this->db->count_all_results('user_menu');
        $data['total_submenu'] = $this->db->count_all_results('user_sub_menu');
        $data['recent_items'] = array_slice($this->inventaris->getAllInventaris(), 0, 5);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role & Hak Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Nama Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => htmlspecialchars((string)$this->input->post('role', true))]);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Role baru berhasil ditambahkan!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role & Hak Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Hak akses role berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
    }

    public function deleterole($id)
    {
        if ($id != 1) {
            $this->db->delete('user_role', ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Role berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        }
        redirect('admin/role');
    }
}
