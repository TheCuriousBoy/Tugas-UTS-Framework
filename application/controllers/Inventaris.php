<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Inventaris_model', 'inventaris');
    }

    public function index()
    {
        $data['title'] = 'Data Inventaris IT (CRUD)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $keyword = $this->input->get('q', true);
        $kategori = $this->input->get('kategori', true);

        $data['keyword'] = $keyword;
        $data['kategori_aktif'] = $kategori;
        $data['items'] = $this->inventaris->getAllInventaris($keyword, $kategori);
        $data['stats'] = $this->inventaris->getSummaryStats();

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|trim|is_unique[inventaris_it.kode_barang]');
        $this->form_validation->set_rules('nama_barang', 'Nama Perangkat', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi Penempatan', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah Unit', 'required|trim|numeric');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventaris/index', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = [
                'kode_barang' => htmlspecialchars((string)$this->input->post('kode_barang', true)),
                'nama_barang' => htmlspecialchars((string)$this->input->post('nama_barang', true)),
                'kategori'    => htmlspecialchars((string)$this->input->post('kategori', true)),
                'lokasi'      => htmlspecialchars((string)$this->input->post('lokasi', true)),
                'jumlah'      => (int)$this->input->post('jumlah'),
                'kondisi'     => htmlspecialchars((string)$this->input->post('kondisi', true)),
                'spesifikasi' => htmlspecialchars((string)$this->input->post('spesifikasi', true)),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $this->db->insert('inventaris_it', $insert_data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Data perangkat inventaris berhasil ditambahkan!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('inventaris');
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Data Inventaris IT (CRUD)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['item'] = $this->inventaris->getInventarisById($id);

        if (!$data['item']) {
            redirect('inventaris');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventaris/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Data Inventaris IT (CRUD)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['item'] = $this->inventaris->getInventarisById($id);

        if (!$data['item']) {
            redirect('inventaris');
        }

        $this->form_validation->set_rules('nama_barang', 'Nama Perangkat', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi Penempatan', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah Unit', 'required|trim|numeric');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventaris/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'kode_barang' => htmlspecialchars((string)$this->input->post('kode_barang', true)),
                'nama_barang' => htmlspecialchars((string)$this->input->post('nama_barang', true)),
                'kategori'    => htmlspecialchars((string)$this->input->post('kategori', true)),
                'lokasi'      => htmlspecialchars((string)$this->input->post('lokasi', true)),
                'jumlah'      => (int)$this->input->post('jumlah'),
                'kondisi'     => htmlspecialchars((string)$this->input->post('kondisi', true)),
                'spesifikasi' => htmlspecialchars((string)$this->input->post('spesifikasi', true)),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $this->db->where('id', $id);
            $this->db->update('inventaris_it', $update_data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>Data perangkat <strong>' . $update_data['nama_barang'] . '</strong> berhasil diperbarui!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
            redirect('inventaris');
        }
    }

    public function delete($id)
    {
        $this->db->delete('inventaris_it', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-trash-alt me-2"></i>Data perangkat inventaris berhasil dihapus!<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>');
        redirect('inventaris');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Inventaris';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['items'] = $this->inventaris->getAllInventaris();
        $data['stats'] = $this->inventaris->getSummaryStats();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventaris/laporan', $data);
        $this->load->view('templates/footer');
    }
}
