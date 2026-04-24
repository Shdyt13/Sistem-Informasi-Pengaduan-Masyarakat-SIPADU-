<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function get_all_users()
    {
        return $this->db->get('users')->result_array();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function tambah_user()
    {
        $data = [
            'username' => $this->input->post('username', true),
            // Password di-hash (enkripsi) default
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role', true)
        ];
        $this->db->insert('users', $data);
    }

    // Di dalam application/models/M_user.php
    // 532E48647974
    public function edit_user()
    {
        $id = $this->input->post('id'); // Mengambil ID dari input hidden di form
        $password_baru = $this->input->post('password');

        $data = [
            'username' => $this->input->post('username', true),
            'role' => $this->input->post('role', true)
        ];

        // Jika password diisi, maka update password. Jika kosong, pakai password lama.
        if (!empty($password_baru)) {
            $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function hapus_user($id)
    {
        $this->db->delete('users', ['id' => $id]);
    }
}