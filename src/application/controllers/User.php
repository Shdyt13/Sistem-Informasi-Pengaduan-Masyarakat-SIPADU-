<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        // Cek apakah user adalah admin (hanya admin yang boleh akses controller ini)
        if ($this->session->userdata('role') != 'admin') {
            redirect('pengaduan');
        }

        $this->load->model('M_user');
        $this->load->library('form_validation');
    }

    // 532E48647974
    public function index()
    {
        $data['title'] = 'Manajemen User & Profil';
        
        // Ambil data user yang sedang login (Admin)
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        
        // Ambil semua data user untuk tabel
        $data['users_list'] = $this->M_user->get_all_users();

        // Rules validasi untuk Tambah User Baru
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
            'is_unique' => 'Username ini sudah terpakai!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika validasi sukses, jalankan tambah user
            $this->M_user->tambah_user();
            $this->session->set_flashdata('flash', 'User Baru Berhasil Ditambahkan');
            redirect('user');
        }
    }

    // Fungsi Update Profil Diri Sendiri (Admin)
    public function update_profil_saya()
    {
        $id = $this->input->post('id');
        $password_baru = $this->input->post('password');
        $username_baru = $this->input->post('username');

        $data = ['username' => $username_baru];

        // Jika password diisi, hash dan masukkan ke data update
        if (!empty($password_baru)) {
            $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        // Update session jika username admin berubah
        if ($this->session->userdata('username') != $username_baru) {
            $this->session->set_userdata('username', $username_baru);
        }
        
        $this->session->set_flashdata('flash', 'Profil Anda Berhasil Diperbarui');
        redirect('user');
    }

    public function hapus($id)
    {
        $this->M_user->hapus_user($id);
        $this->session->set_flashdata('flash', 'User Berhasil Dihapus');
        redirect('user');
    }

    // 1. Fungsi Untuk membuka halaman edit
    public function form_edit($id)
    {
        $data['title'] = 'Edit Data User';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        
        // Ambil data user yang ingin diedit berdasarkan ID
        $data['user_edit'] = $this->db->get_where('users', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/form_edit', $data);
        $this->load->view('templates/footer');
    }

    // 2. FUNGSI SIMPAN
    public function edit()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            // Jika gagal, kembalikan ke halaman user
            $this->session->set_flashdata('flash_error', 'Gagal update: Data tidak lengkap.');
            redirect('user');
        } else {
            // Proses Update ke Database
            $id = $this->input->post('id');
            $data = [
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role')
            ];

            // Cek jika ada password baru
            $password_baru = $this->input->post('password');
            if (!empty($password_baru)) {
                $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
            }

            $this->db->where('id', $id);
            $this->db->update('users', $data);

            $this->session->set_flashdata('flash', 'Data User Berhasil Diubah');
            redirect('user');
        }
    }

}