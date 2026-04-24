<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // 1. Jika sudah login, redirect sesuai role (ANTI LOOP)
       if ($this->session->userdata('username')) {
            
            $role = $this->session->userdata('role');
            
            if ($role == 'admin') {
                redirect('dashboard');
            } else {
                redirect('pengaduan'); 
            }
        }

        // 2. Validasi input login
        $this->form_validation->set_rules('username', 'Username', 'trim|required', [
            'required' => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password wajib diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('login_view', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        // 3. Ambil input
        $username = $this->input->post('username', true);
        $password = $this->input->post('password');

        // 4. Ambil user berdasarkan username
        $user = $this->db->get_where('users', ['username' => $username])->row_array();

        // 5. Jika user ditemukan
        if ($user) {

            // 6. Verifikasi password hash
            if (password_verify($password, $user['password'])) {

                // 7. Set session
                $data = [
                    'id_user'  => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role']
                ];
                $this->session->set_userdata($data);

                // 8. REDIRECT BERDASARKAN ROLE (FIX LOOP)
                if ($user['role'] == 'admin') {
                redirect('dashboard');
                } else {
                    redirect('pengaduan');
                }

            } else {
                // Password salah
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Password salah!</div>'
                );
                redirect('auth');
            }

        } else {
            // Username tidak ditemukan
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>'
            );
            redirect('auth');
        }
    }

    public function logout()
    {
        // Hapus semua session login
        $this->session->unset_userdata(['id_user', 'username', 'role']);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Anda telah logout!</div>'
        );
        redirect('auth');
    }
}
