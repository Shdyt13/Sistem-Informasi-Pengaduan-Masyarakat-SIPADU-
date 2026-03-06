<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('role')) {
            redirect('auth');
        }
        $this->load->library('form_validation');
    }

    // 1. INDEX
    public function index()
    {
        $data['title'] = 'Data Pengaduan Masyarakat';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        
        // Join ke penduduk untuk ambil no_telp
        $this->db->select('pengaduan.*, penduduk.no_telp'); 
        $this->db->from('pengaduan');
        $this->db->join('penduduk', 'pengaduan.nik = penduduk.nik', 'left');
        $this->db->order_by('tgl_pengaduan', 'DESC');
        
        $data['pengaduan'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengaduan/index', $data);
        $this->load->view('templates/footer');
    }

    // 2. DETAIL
    public function detail($id)
    {
        $data['title'] = 'Detail Pengaduan';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data['p'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        if (!$data['p']) {
            $this->session->set_flashdata('flash_error', 'Data tidak ditemukan!');
            redirect('pengaduan');
        }

        $data['anggota'] = $this->db->get_where('pengaduan_anggota', ['id_pengaduan' => $id])->result_array();
        $data['pelapor'] = $this->db->get_where('penduduk', ['nik' => $data['p']['nik']])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengaduan/detail', $data);
        $this->load->view('templates/footer');
    }

    // 3. TAMBAH
    public function tambah()
    {
        $data['title'] = 'Tambah Pengaduan';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|exact_length[16]');
        $this->form_validation->set_rules('nama_pelapor', 'Nama Pelapor', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('isi_laporan', 'Isi Laporan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pengaduan/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->simpan();
        }
    }

    // ==========================================
    // PERBAIKAN LOGIKA SIMPAN (MENGHANDLE ANGGOTA KE PENDUDUK)
    // ==========================================
    public function simpan()
    {
        // 1. Simpan/Update Data Pelapor (Kepala Keluarga/Utama) ke Tabel Penduduk
        $nik_pelapor   = $this->input->post('nik');
        $alamat_utama  = $this->input->post('alamat'); // Alamat ini dipakai juga untuk anggota

        $data_penduduk = [
            'nik'          => $nik_pelapor,
            'nama'         => $this->input->post('nama_pelapor'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir'    => $this->input->post('tgl_lahir'),
            'agama'        => $this->input->post('agama'),
            'pekerjaan'    => $this->input->post('pekerjaan'),
            'no_telp'      => $this->input->post('no_telp'),
            'alamat'       => $alamat_utama
        ];

        $cek = $this->db->get_where('penduduk', ['nik' => $nik_pelapor])->num_rows();
        if ($cek == 0) {
            $this->db->insert('penduduk', $data_penduduk);
        } else {
            $this->db->where('nik', $nik_pelapor);
            $this->db->update('penduduk', $data_penduduk);
        }

        // 2. Simpan Data Pengaduan
        $syarat_input  = $this->input->post('syarat');
        $syarat_string = !empty($syarat_input) ? implode(', ', $syarat_input) : '';

        $data_pengaduan = [
            'nama_pelapor'   => $this->input->post('nama_pelapor'),
            'nik'            => $nik_pelapor,
            'kategori'       => $this->input->post('kategori'),
            'sub_kategori'   => $this->input->post('sub_kategori'),
            'isi_laporan'    => $this->input->post('isi_laporan'),
            'tgl_pengaduan'  => date('Y-m-d'),
            'status'         => 'Pending',
            'syarat_terlampir' => $syarat_string
        ];
        $this->db->insert('pengaduan', $data_pengaduan);
        $id_baru = $this->db->insert_id(); 

        // 3. Simpan Anggota Keluarga (Looping)
        // Tangkap Array dari Form
        $nama_anggota      = $this->input->post('nama_anggota');
        $nik_anggota       = $this->input->post('nik_anggota');
        $tmpt_lahir_anggota= $this->input->post('tmpt_lahir_anggota'); // Baru
        $tgl_lahir_anggota = $this->input->post('tgl_lahir_anggota');  // Baru
        $agama_anggota     = $this->input->post('agama_anggota');      // Baru
        $pekerjaan_anggota = $this->input->post('pekerjaan_anggota');  // Baru

        if ($nama_anggota) {
            $batch_relasi = [];
            
            for ($i = 0; $i < count($nama_anggota); $i++) {
                // Pastikan Nama & NIK tidak kosong agar tidak error
                if (!empty($nama_anggota[$i]) && !empty($nik_anggota[$i])) {
                    
                    // A. SIAPKAN DATA PENDUDUK (ANGGOTA)
                    $data_anggota_penduduk = [
                        'nik'          => $nik_anggota[$i],
                        'nama'         => $nama_anggota[$i],
                        'tempat_lahir' => isset($tmpt_lahir_anggota[$i]) ? $tmpt_lahir_anggota[$i] : '-',
                        'tgl_lahir'    => isset($tgl_lahir_anggota[$i]) ? $tgl_lahir_anggota[$i] : NULL,
                        'agama'        => isset($agama_anggota[$i]) ? $agama_anggota[$i] : '-',
                        'pekerjaan'    => isset($pekerjaan_anggota[$i]) ? $pekerjaan_anggota[$i] : '-',
                        'alamat'       => $alamat_utama, // Ikut alamat pelapor
                        'no_telp'      => '-' // Default strip karena mungkin anak kecil
                    ];

                    // B. CEK APAKAH ANGGOTA SUDAH ADA DI TABEL PENDUDUK?
                    $cek_anggota = $this->db->get_where('penduduk', ['nik' => $nik_anggota[$i]])->num_rows();
                    
                    if ($cek_anggota == 0) {
                        // Belum ada -> Insert
                        $this->db->insert('penduduk', $data_anggota_penduduk);
                    } else {
                        // Sudah ada -> Update (agar data terbaru tersimpan)
                        $this->db->where('nik', $nik_anggota[$i]);
                        $this->db->update('penduduk', $data_anggota_penduduk);
                    }

                    // C. SIAPKAN DATA UTK TABEL RELASI (pengaduan_anggota)
                    $batch_relasi[] = [
                        'id_pengaduan'    => $id_baru,
                        'nama'            => $nama_anggota[$i],
                        'nik'             => $nik_anggota[$i],
                        'status_hubungan' => '-'
                    ];
                }
            }
            
            // D. INSERT BATCH KE PENGADUAN_ANGGOTA
            if ($batch_relasi) {
                $this->db->insert_batch('pengaduan_anggota', $batch_relasi);
            }
        }

        $this->session->set_flashdata('flash', 'Data Berhasil Disimpan');
        redirect('pengaduan');
    }

    // 4. HAPUS
    public function hapus($id)
    {
        $this->db->delete('pengaduan', ['id' => $id]);
        $this->db->delete('pengaduan_anggota', ['id_pengaduan' => $id]);
        $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
        redirect('pengaduan');
    }

    // 5. EDIT
    public function edit($id)
    {
        $data['title'] = 'Edit Pengaduan';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data['p'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        if(!$data['p']){ redirect('pengaduan'); }

        $data['anggota'] = $this->db->get_where('pengaduan_anggota', ['id_pengaduan' => $id])->result_array();
        $data['pelapor'] = $this->db->get_where('penduduk', ['nik' => $data['p']['nik']])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengaduan/edit', $data);
        $this->load->view('templates/footer');
    }

    // ==========================================
    // PERBAIKAN LOGIKA UPDATE
    // ==========================================
    public function update()
    {
        $id_pengaduan  = $this->input->post('id_pengaduan');
        $syarat_input  = $this->input->post('syarat');
        $syarat_string = !empty($syarat_input) ? implode(', ', $syarat_input) : '';
        $alamat_utama  = $this->input->post('alamat');

        // 1. Update Pengaduan
        $data_update = [
            'nik'            => $this->input->post('nik'),
            'nama_pelapor'   => $this->input->post('nama_pelapor'),
            'kategori'       => $this->input->post('kategori'),
            'sub_kategori'   => $this->input->post('sub_kategori'),
            'isi_laporan'    => $this->input->post('isi_laporan'),
            'syarat_terlampir' => $syarat_string
        ];
        
        $this->db->where('id', $id_pengaduan);
        $this->db->update('pengaduan', $data_update);

        // 2. Update/Simpan Penduduk (Pelapor)
        $nik_pelapor = $this->input->post('nik');
        $data_penduduk = [
            'nama'         => $this->input->post('nama_pelapor'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tgl_lahir'    => $this->input->post('tgl_lahir'),
            'agama'        => $this->input->post('agama'),
            'pekerjaan'    => $this->input->post('pekerjaan'),
            'no_telp'      => $this->input->post('no_telp'),
            'alamat'       => $alamat_utama
        ];
        
        $cek = $this->db->get_where('penduduk', ['nik' => $nik_pelapor])->num_rows();
        if($cek > 0) {
            $this->db->where('nik', $nik_pelapor);
            $this->db->update('penduduk', $data_penduduk);
        } else {
            $data_penduduk['nik'] = $nik_pelapor;
            $this->db->insert('penduduk', $data_penduduk);
        }

        // 3. Update Anggota Keluarga (Hapus lama -> Insert Baru)
        $this->db->delete('pengaduan_anggota', ['id_pengaduan' => $id_pengaduan]);
        
        $nama_anggota      = $this->input->post('nama_anggota');
        $nik_anggota       = $this->input->post('nik_anggota');
        // Tangkap data detail anggota (jika ada form edit yg mendukung ini, 
        // tapi minimal logika simpan ke penduduk ada di sini juga)
        $tmpt_lahir_anggota= $this->input->post('tmpt_lahir_anggota');
        $tgl_lahir_anggota = $this->input->post('tgl_lahir_anggota');
        $agama_anggota     = $this->input->post('agama_anggota');
        $pekerjaan_anggota = $this->input->post('pekerjaan_anggota');

        if ($nama_anggota) {
            $batch_relasi = [];
            for ($i = 0; $i < count($nama_anggota); $i++) {
                if (!empty($nama_anggota[$i]) && !empty($nik_anggota[$i])) {
                    
                    // A. SIAPKAN DATA PENDUDUK (ANGGOTA)
                    // Cek apakah data detail dikirim (karena di form edit mungkin beda nama field)
                    // Jika form edit strukturnya sama dengan tambah, kode ini aman.
                    $data_anggota_penduduk = [
                        'nik'          => $nik_anggota[$i],
                        'nama'         => $nama_anggota[$i],
                        'tempat_lahir' => isset($tmpt_lahir_anggota[$i]) ? $tmpt_lahir_anggota[$i] : '-',
                        'tgl_lahir'    => isset($tgl_lahir_anggota[$i]) ? $tgl_lahir_anggota[$i] : NULL,
                        'agama'        => isset($agama_anggota[$i]) ? $agama_anggota[$i] : '-',
                        'pekerjaan'    => isset($pekerjaan_anggota[$i]) ? $pekerjaan_anggota[$i] : '-',
                        'alamat'       => $alamat_utama,
                        'no_telp'      => '-'
                    ];

                    // B. SIMPAN KE TABEL PENDUDUK
                    $cek_anggota = $this->db->get_where('penduduk', ['nik' => $nik_anggota[$i]])->num_rows();
                    if ($cek_anggota == 0) {
                        $this->db->insert('penduduk', $data_anggota_penduduk);
                    } else {
                        $this->db->where('nik', $nik_anggota[$i]);
                        $this->db->update('penduduk', $data_anggota_penduduk);
                    }

                    // C. SIAPKAN BATCH PENGADUAN_ANGGOTA
                    $batch_relasi[] = [
                        'id_pengaduan'    => $id_pengaduan,
                        'nama'            => $nama_anggota[$i],
                        'nik'             => $nik_anggota[$i],
                        'status_hubungan' => '-'
                    ];
                }
            }
            if ($batch_relasi) {
                $this->db->insert_batch('pengaduan_anggota', $batch_relasi);
            }
        }
        $this->session->set_flashdata('flash', 'Data Berhasil Diperbaharui');
        redirect('pengaduan');
    }

    // 7. UBAH STATUS
    public function ubah_status()
    {
        $id = $this->input->post('id_pengaduan');
        $status = $this->input->post('status');
        $this->db->set('status', $status);
        $this->db->where('id', $id); 
        $this->db->update('pengaduan');
        $this->session->set_flashdata('flash', 'Status Pengaduan Diperbarui');
        redirect('pengaduan/detail/' . $id); 
    }

    // ==========================================
    // 8. FUNGSI AUTOFILL (AUTOCOMPLETE)
    // ==========================================
    public function cari_penduduk_json()
    {
        $term = $this->input->get('term'); // Parameter dari jQuery UI Autocomplete
        
        $this->db->like('nama', $term);
        $this->db->or_like('nik', $term);
        $this->db->limit(10);
        $query = $this->db->get('penduduk')->result_array();

        $data = [];
        foreach ($query as $row) {
            $data[] = [
                'label'        => $row['nik'] . ' - ' . $row['nama'], // Yang tampil di list
                'value'        => $row['nama'], // Yang masuk ke input nama
                'nik'          => $row['nik'],
                'no_telp'      => $row['no_telp'],
                'pekerjaan'    => $row['pekerjaan'],
                'alamat'       => $row['alamat'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tgl_lahir'    => $row['tgl_lahir'],
                'agama'        => $row['agama']
            ];
        }
        echo json_encode($data);
    }

    // ==========================================
    // 10. CETAK SURAT (PAKAI API ONLINE - PALING MUDAH)
    // ==========================================
    public function cetak_surat($id)
    {
        // A. AMBIL DATA UTAMA
        $this->db->select('
            pengaduan.*, 
            penduduk.nama as nama_penduduk, 
            penduduk.alamat as alamat_pelapor, 
            penduduk.no_telp as hp_pelapor,
            penduduk.tempat_lahir,
            penduduk.tgl_lahir,
            penduduk.agama,
            penduduk.pekerjaan as kerja_pelapor
        ');
        $this->db->from('pengaduan');
        $this->db->join('penduduk', 'pengaduan.nik = penduduk.nik', 'left');
        $this->db->where('pengaduan.id', $id);
        $data['row'] = $this->db->get()->row_array();

        if (!$data['row']) {
            echo "Data tidak ditemukan!";
            return;
        }

        // B. AMBIL DATA ANGGOTA (TETAP WAJIB ADA 'penduduk.alamat')
        $this->db->select('
            pengaduan_anggota.*, 
            penduduk.tempat_lahir, 
            penduduk.tgl_lahir, 
            penduduk.agama, 
            penduduk.pekerjaan,
            penduduk.alamat
        ');
        $this->db->from('pengaduan_anggota');
        $this->db->join('penduduk', 'pengaduan_anggota.nik = penduduk.nik', 'left');
        $this->db->where('pengaduan_anggota.id_pengaduan', $id);
        $data['anggota'] = $this->db->get()->result_array();

        // ==========================================
        // C. GENERATE QRCODE VIA ONLINE API
        // ==========================================
        $nik_pelapor = $data['row']['nik'];
        
        // Kita gunakan layanan QuickChart.io (Stabil & Gratis)
        // Format URL: https://quickchart.io/qr?text=ISI_DATA&size=UKURAN
        $data['qrcode_url'] = "https://quickchart.io/qr?text=" . $nik_pelapor . "&size=150";

        // ==========================================

        // D. LOAD VIEW
        $kategori = $data['row']['kategori'];
        $sub_kategori = $data['row']['sub_kategori'];

        if ($kategori == 'DTSEN') {
            $this->load->view('pengaduan/cetak/surat_dtsen', $data);
        } 
        elseif ($kategori == 'PBI-JK' && $sub_kategori == 'Reaktivasi') {
            $this->load->view('pengaduan/cetak/surat_reaktifasi', $data);
        } 
        else {
            $this->load->view('pengaduan/cetak/surat_umum', $data);
        }
    }
}