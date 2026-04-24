<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 532E48647974
class M_penduduk extends CI_Model {

    /* =========================================================
       DATA PENDUDUK
       ========================================================= */

    public function get_all_data()
    {
        return $this->db->get('penduduk')->result_array();
    }

    public function tambah_data_penduduk()
    {
        $data = [
            "nik"       => $this->input->post('nik', true),
            "nama"      => $this->input->post('nama', true),
            "alamat"    => $this->input->post('alamat', true),
            "no_telp"   => $this->input->post('no_telp', true),
            "pekerjaan" => $this->input->post('pekerjaan', true)
        ];

        return $this->db->insert('penduduk', $data);
    }

    public function get_penduduk_by_id($id)
    {
        return $this->db->get_where('penduduk', ['id' => $id])->row_array();
    }

    public function ubah_data_penduduk()
    {
        $data = [
            "nik"       => $this->input->post('nik', true),
            "nama"      => $this->input->post('nama', true),
            "alamat"    => $this->input->post('alamat', true),
            "no_telp"   => $this->input->post('no_telp', true),
            "pekerjaan" => $this->input->post('pekerjaan', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('penduduk', $data);
    }

    // Hapus langsung (dipakai setelah OTP valid)
    public function hapus_data_penduduk($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('penduduk');
    }

    // Alias agar konsisten dengan controller OTP
    public function hapus_penduduk($id)
    {
        return $this->hapus_data_penduduk($id);
    }

    /* =========================================================
       AUTOCOMPLETE
       ========================================================= */

    public function cari_penduduk_by_nama($keyword)
    {
        $this->db->like('nama', $keyword);
        $this->db->or_like('nik', $keyword);
        $this->db->limit(10);
        return $this->db->get('penduduk')->result_array();
    }

    /* =========================================================
       OTP VERIFIKASI (KRUSIAL)
       ========================================================= */

    // Simpan request OTP baru
    public function simpan_otp($data)
    {
        $this->db->set($data);
        // MySQL menghitung waktu 15 menit ke depan
        $this->db->set('expired_at', 'DATE_ADD(NOW(), INTERVAL 15 MINUTE)', FALSE);
        
        return $this->db->insert('otp_verifikasi');
    }

    // Cek Validitas OTP (Paling Krusial)
    public function cek_validitas_otp($user_id, $otp, $target_data)
    {
        $sql = "SELECT * FROM otp_verifikasi 
                WHERE user_id = ? 
                AND kode_otp = ? 
                AND target_data = ? 
                AND (status = 'pending' OR status = '') 
                AND expired_at >= NOW()";
        
        return $this->db->query($sql, [$user_id, $otp, $target_data])->row_array(); 
    }

    // Update status OTP (pending → used / expired)
    public function update_status_otp($id_otp, $status)
    {
        $this->db->where('id', $id_otp);
        return $this->db->update('otp_verifikasi', ['status' => $status]);
    }
}