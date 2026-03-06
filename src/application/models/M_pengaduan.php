<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengaduan extends CI_Model
{
    // 1. Ambil Semua Data
    public function get_all_pengaduan()
    {
        $this->db->select('pengaduan.*, penduduk.nama, penduduk.no_telp');
        $this->db->from('pengaduan');
        $this->db->join('penduduk', 'penduduk.nik = pengaduan.nik', 'left');
        $this->db->order_by('pengaduan.tgl_pengaduan', 'DESC');
        return $this->db->get()->result_array();
    }

    // 2. Ambil Satu Data
    public function get_pengaduan_by_id($id)
    {
        return $this->db->get_where('pengaduan', ['id' => $id])->row_array();
    }

    // 3. Ubah Data Isi Laporan
    public function ubah_pengaduan()
    {
        $data = [
            'nama_pelapor' => $this->input->post('nama_pelapor', true),
            'kategori'     => $this->input->post('kategori', true),
            'isi_laporan'  => $this->input->post('isi_laporan', true),
        ];

        $this->db->where('id', $this->input->post('id_pengaduan'));
        $this->db->update('pengaduan', $data);
    }

    // 4. Hapus Data
    public function hapus_pengaduan($id)
    {
        $this->db->delete('pengaduan', ['id' => $id]);
    }

    // 5. Hitung Semua
    public function hitung_semua()
    {
        return $this->db->count_all('pengaduan');
    }

    // 6. Hitung Status
    public function hitung_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('pengaduan');
    }

    // 7. Laporan Berdasarkan Tanggal
    public function get_laporan_by_date($tgl_awal, $tgl_akhir)
    {
        $this->db->where('tgl_pengaduan >=', $tgl_awal);
        $this->db->where('tgl_pengaduan <=', $tgl_akhir);
        return $this->db->get('pengaduan')->result_array();
    }

    // =========================
    // FUNGSI KUNCI UNTUK CETAK
    // =========================
    public function get_detail_cetak($id)
    {
        $this->db->select('
            pengaduan.*,
            penduduk.alamat        as alamat_pelapor,
            penduduk.no_telp       as hp_pelapor,
            penduduk.pekerjaan     as kerja_pelapor,
            penduduk.tempat_lahir,
            penduduk.tgl_lahir,
            penduduk.agama
        ');
        $this->db->from('pengaduan');
        $this->db->join('penduduk', 'penduduk.nik = pengaduan.nik', 'left');
        $this->db->where('pengaduan.id', $id);
        return $this->db->get()->row_array();
    }

    // Anggota Keluarga + Detail Penduduk
    public function get_anggota_lengkap($id_pengaduan)
    {
        $this->db->select('pa.*, pd.tempat_lahir, pd.tgl_lahir, pd.agama, pd.pekerjaan, pd.alamat');
        $this->db->from('pengaduan_anggota pa');
        $this->db->join('penduduk pd', 'pa.nik = pd.nik', 'left');
        $this->db->where('pa.id_pengaduan', $id_pengaduan);
        return $this->db->get()->result_array();
    }
}
