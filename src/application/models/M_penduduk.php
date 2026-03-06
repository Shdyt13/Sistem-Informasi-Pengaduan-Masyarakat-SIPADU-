<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penduduk extends CI_Model {

    public function get_all_data()
    {
        // Ambil semua data dari tabel 'penduduk'
        return $this->db->get('penduduk')->result_array();
    }

    public function tambah_data_penduduk()
    {
        $data = [
            "nik" => $this->input->post('nik', true), // true untuk pengamanan XSS
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true),
            "pekerjaan" => $this->input->post('pekerjaan', true)
        ];

        $this->db->insert('penduduk', $data);
    }

    public function hapus_data_penduduk($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('penduduk');
    }

    public function get_penduduk_by_id($id)
    {
        // Ambil data berdasarkan ID (untuk ditampilkan di form edit)
        return $this->db->get_where('penduduk', ['id' => $id])->row_array();
    }

    public function ubah_data_penduduk()
    {
        $data = [
            "nik" => $this->input->post('nik', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "no_telp" => $this->input->post('no_telp', true),
            "pekerjaan" => $this->input->post('pekerjaan', true)
        ];

        // Cari baris yang ID-nya sesuai dengan input hidden 'id'
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('penduduk', $data);
    }

    // Fungsi untuk Autocomplete
    public function cari_penduduk_by_nama($keyword)
    {
        $this->db->like('nama', $keyword);
        $this->db->or_like('nik', $keyword); // Bisa cari pakai NIK
        $this->db->limit(10); // Batasi maksimal 10 saran
        return $this->db->get('penduduk')->result_array();
    }
}