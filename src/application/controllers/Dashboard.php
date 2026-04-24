<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek login
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

   public function index()
    {
        $data['title'] = 'Dashboard';
        
        // Load Model Pengaduan
        $this->load->model('M_pengaduan');

        // Ambil Data Statistik Real-time
        $data['total_aduan'] = $this->M_pengaduan->hitung_semua();
        $data['total_selesai'] = $this->M_pengaduan->hitung_status('Selesai');
        $data['total_proses'] = $this->M_pengaduan->hitung_status('Proses');
        $data['total_pending'] = $this->M_pengaduan->hitung_status('Pending');
        
        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard_view', $data);
        $this->load->view('templates/footer');
    }
} //532E48647974