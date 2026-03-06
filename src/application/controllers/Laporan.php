<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek Login Admin
        // Izinkan Admin DAN Petugas mengakses laporan
    if (!$this->session->userdata('username')) {
        redirect('auth');
    }
        $this->load->model('M_pengaduan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Generate Laporan';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_cetak_laporan();
        }
    }

    private function _cetak_laporan()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        // Memanggil fungsi Model
        $data['laporan'] = $this->M_pengaduan->get_laporan_by_date($tgl_awal, $tgl_akhir);
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        
        // Memanggil view cetak kertas
        $this->load->view('laporan/cetak', $data);
    }
}