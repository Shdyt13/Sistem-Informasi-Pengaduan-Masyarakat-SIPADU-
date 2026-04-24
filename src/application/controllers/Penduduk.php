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

        // Load Library
        $this->load->library('form_validation');

        // Load Helper WhatsApp
        $this->load->helper('wa');
    }

    public function index()
    {
        $data['title'] = 'Data Penduduk';
        $data['penduduk'] = $this->M_penduduk->get_all_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penduduk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data Penduduk';

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
    // 532E48647974
    public function ubah($id)
    {
        // Hanya admin
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('penduduk');
        }

        $data['title'] = 'Ubah Data Penduduk';
        $data['penduduk'] = $this->M_penduduk->get_penduduk_by_id($id);

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

    /* =========================================================
       OTP DELETE FLOW
       ========================================================= */

    // Request OTP & Kirim WhatsApp
    public function request_hapus($id_penduduk)
    {
        if ($this->session->userdata('role') != 'admin') {
            redirect('penduduk');
        }

        // Ambil data penduduk berdasarkan ID
        $data_penduduk = $this->M_penduduk->get_penduduk_by_id($id_penduduk);
        $nama_penduduk = $data_penduduk ? $data_penduduk['nama'] : 'Nama Tidak Ditemukan';

        $kode_otp = rand(100000, 999999);
        $no_kadis = "6282268478964";

        $data_otp = [
            'user_id'     => $this->session->userdata('id_user'),
            'kode_otp'    => $kode_otp,
            'tujuan'      => $no_kadis,
            'target_data' => $id_penduduk,
            'status'      => 'pending'
        ];

        if ($this->M_penduduk->simpan_otp($data_otp)) {

            $pesan = "*⚠️ PERMINTAAN HAPUS DATA SIPADU*\n\n"
                   . "Admin meminta izin menghapus data penduduk berikut:\n\n"
                   . "ID: $id_penduduk\n"
                   . "Nama: $nama_penduduk\n\n"
                   . "Kode OTP Anda:\n$kode_otp\n\n"
                   . "Berlaku 15 menit. Jangan bagikan kode ini.";

            kirim_wa($no_kadis, $pesan);

            $this->session->set_flashdata('info', 'OTP telah dikirim ke WhatsApp Kepala Dinas.');
            redirect('penduduk/form_otp/' . $id_penduduk);
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim OTP.');
            redirect('penduduk');
        }
    }

    // Form Input OTP
    public function form_otp($id_penduduk)
    {
        $data['title'] = 'Verifikasi OTP Hapus Data';
        $data['id_penduduk'] = $id_penduduk;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penduduk/form_otp', $data);
        $this->load->view('templates/footer');
    }

    // Verifikasi OTP & Eksekusi Hapus
    public function verifikasi_hapus()
    {
        $id_penduduk = $this->input->post('target_data');
        $input_otp   = trim($this->input->post('otp')); 
        $user_id     = $this->session->userdata('id_user');

        $cek_otp = $this->M_penduduk->cek_validitas_otp($user_id, $input_otp, $id_penduduk);

        if ($cek_otp) {
            $this->M_penduduk->hapus_data_penduduk($id_penduduk);
            $this->M_penduduk->update_status_otp($cek_otp['id'], 'used');

            $this->session->set_flashdata('success', 'Data penduduk berhasil dihapus.');
            redirect('penduduk');
        } else {
            $this->session->set_flashdata('error', 'OTP salah atau sudah kedaluwarsa.');
            redirect('penduduk/form_otp/' . $id_penduduk);
        }
    }

    /* =========================================================
       AJAX AUTOCOMPLETE
       ========================================================= */

    public function get_autocomplete_json()
    {
        $term = $this->input->get('term');
        $penduduk = $this->M_penduduk->cari_penduduk_by_nama($term);

        $json = [];
        foreach ($penduduk as $row) {
            $json[] = [
                'label' => $row['nama'] . ' - NIK: ' . $row['nik'],
                'value' => $row['nama'],
                'nik'   => $row['nik'],
                'telp'  => $row['no_telp']
            ];
        }

        echo json_encode($json);
    }

    // Method hapus lama dinonaktifkan demi keamanan
}