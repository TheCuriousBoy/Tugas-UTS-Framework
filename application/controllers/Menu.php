<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Nama Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => htmlspecialchars((string)$this->input->post('menu', true))]);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Menu baru berhasil ditambahkan!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('menu');
        }
    }

    public function editmenu($id)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu_item'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'Nama Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->set('menu', htmlspecialchars((string)$this->input->post('menu', true)));
            $this->db->where('id', $id);
            $this->db->update('user_menu');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Data menu berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('menu');
        }
    }

    public function deletemenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-trash-alt me-2"></i>Menu berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Judul Submenu', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Kategori Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL Submenu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon FontAwesome', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data_insert = [
                'title'     => htmlspecialchars((string)$this->input->post('title', true)),
                'menu_id'   => (int)$this->input->post('menu_id'),
                'url'       => htmlspecialchars((string)$this->input->post('url', true)),
                'icon'      => htmlspecialchars((string)$this->input->post('icon', true)),
                'is_active' => $this->input->post('is_active') ? 1 : 0
            ];
            $this->db->insert('user_sub_menu', $data_insert);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Submenu baru berhasil ditambahkan!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('menu/submenu');
        }
    }

    public function editsubmenu($id)
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['sub'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Judul Submenu', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Kategori Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL Submenu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon FontAwesome', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'title'     => htmlspecialchars((string)$this->input->post('title', true)),
                'menu_id'   => (int)$this->input->post('menu_id'),
                'url'       => htmlspecialchars((string)$this->input->post('url', true)),
                'icon'      => htmlspecialchars((string)$this->input->post('icon', true)),
                'is_active' => $this->input->post('is_active') ? 1 : 0
            ];
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', $update_data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Submenu berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('menu/submenu');
        }
    }

    public function deletesubmenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-trash-alt me-2"></i>Submenu berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        redirect('menu/submenu');
    }
}
