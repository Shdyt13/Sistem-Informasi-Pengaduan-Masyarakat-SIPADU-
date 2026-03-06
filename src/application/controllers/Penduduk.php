<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Cek Login
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        
        // Load Model
        $this->load->model('M_penduduk');
        
        // Load Library Form Validation
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Penduduk';
        
        // Ambil data dari database via Model
        $data['penduduk'] = $this->M_penduduk->get_all_data();

        // Load View dengan Template
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penduduk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Penduduk';

        // Validasi Form
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penduduk/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->M_penduduk->tambah_data_penduduk();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('penduduk');
        }
    }

    public function hapus($id)
    {
        // CEK ROLE: Jika bukan admin, blokir!
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('flash', 'Gagal! Anda bukan Admin.');
            redirect('penduduk');
        }

        $this->M_penduduk->hapus_data_penduduk($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('penduduk');
    }

    public function ubah($id)
    {
        // CEK ROLE: Jika bukan admin, blokir!
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('flash', 'Gagal! Anda bukan Admin.');
            redirect('penduduk');
        }

        $data['title'] = 'Ubah Data Penduduk';
        
        // Ambil data lama
        $data['penduduk'] = $this->M_penduduk->get_penduduk_by_id($id);

        // Validasi Form
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penduduk/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_penduduk->ubah_data_penduduk();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('penduduk');
        }
    }

    // Endpoint AJAX Autocomplete
    public function get_autocomplete_json()
    {
        $term = $this->input->get('term'); 
        $penduduk = $this->M_penduduk->cari_penduduk_by_nama($term);

        $json_array = array();
        foreach ($penduduk as $row) {
            $json_array[] = array(
                'label' => $row['nama'] . " - NIK: " . $row['nik'],
                'value' => $row['nama'],
                'nik'   => $row['nik'],
                'telp'  => $row['no_telp']
            );
        }

        echo json_encode($json_array);
    }
}
