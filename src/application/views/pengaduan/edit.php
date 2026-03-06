<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Pengaduan</h1>
        <a href="<?= base_url('pengaduan'); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('pengaduan/update'); ?>
            <input type="hidden" name="id_pengaduan" value="<?= $p['id'] ?>">

            <h5 class="font-weight-bold text-primary">A. Data Pelapor</h5>
            <div class="row">
                <div class="col-md-6">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?= $p['nik'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pelapor" class="form-control" value="<?= $p['nama_pelapor'] ?>" required>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= isset($pelapor['tempat_lahir']) ? $pelapor['tempat_lahir'] : '' ?>">
                </div>
                <div class="col-md-4">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= isset($pelapor['tgl_lahir']) ? $pelapor['tgl_lahir'] : '' ?>">
                </div>
                <div class="col-md-4">
                    <label>Agama</label>
                    <select name="agama" class="form-control">
                        <option value="-">-</option>
                        <?php 
                        $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                        $current_agama = isset($pelapor['agama']) ? $pelapor['agama'] : '';
                        foreach($agamas as $ag) {
                            $sel = ($current_agama == $ag) ? 'selected' : '';
                            echo "<option value='$ag' $sel>$ag</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>No. HP</label>
                    <input type="text" name="no_telp" class="form-control" value="<?= isset($pelapor['no_telp']) ? $pelapor['no_telp'] : '' ?>">
                </div>
                <div class="col-md-6">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" value="<?= isset($pelapor['pekerjaan']) ? $pelapor['pekerjaan'] : '' ?>">
                </div>
            </div>
            
            <div class="form-group mt-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= isset($pelapor['alamat']) ? $pelapor['alamat'] : '' ?></textarea>
            </div>

            <h5 class="font-weight-bold text-primary mt-4">B. Detail Layanan</h5>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" id="kategori" class="form-control" onchange="toggleOpsi()">
                    <option value="PBI-JK" <?= $p['kategori'] == 'PBI-JK' ? 'selected' : '' ?>>PBI-JK</option>
                    <option value="DTSEN" <?= $p['kategori'] == 'DTSEN' ? 'selected' : '' ?>>DTSEN</option>
                    <option value="JAMKESDA" <?= $p['kategori'] == 'JAMKESDA' ? 'selected' : '' ?>>JAMKESDA</option>
                    <option value="LAINNYA" <?= $p['kategori'] == 'LAINNYA' ? 'selected' : '' ?>>Lainnya</option>
                </select>
            </div>

            <div class="form-group p-3 border bg-light" id="opsi-pbijk" style="<?= $p['kategori'] == 'PBI-JK' ? '' : 'display:none' ?>">
                <label>Status Pengajuan:</label><br>
                <?php 
                    $subs = ['Reaktivasi', 'Peserta Baru', 'Pindah Segmen', 'Urgent'];
                    foreach($subs as $sub){
                        $checked = ($p['sub_kategori'] == $sub) ? 'checked' : '';
                        echo "<div class='custom-control custom-radio custom-control-inline'>
                                <input type='radio' name='sub_kategori' value='$sub' class='custom-control-input' id='$sub' $checked>
                                <label class='custom-control-label' for='$sub'>$sub</label>
                              </div>";
                    }
                ?>
            </div>

            <?php 
                $db_syarat = explode(', ', $p['syarat_terlampir']); 
                $db_syarat = array_map('trim', $db_syarat); // Bersihkan spasi
            ?>
            <div class="form-group border p-3 mt-3">
                <label class="font-weight-bold">Persyaratan:</label>
                <div class="row">
                    <?php 
                    $list_syarat = [
                        'Surat Keterangan DTSEN',
                        'Surat Kontrol / Rujukan Faskes tingkat pertama',
                        'Foto Copy Kartu KIS jika ada',
                        'NON DTSEN',
                        'Foto Copy KK dan KTP sebanyak 1 lembar',
                        'Foto Copy Surat Keterangan di rawat',
                        'Foto Copy SKTM'
                    ];
                    foreach($list_syarat as $ls) {
                        $cek = in_array($ls, $db_syarat) ? 'checked' : '';
                        echo "<div class='col-md-6'>
                                <div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='syarat[]' value='$ls' $cek>
                                    <label class='form-check-label'>$ls</label>
                                </div>
                              </div>";
                    }
                    ?>
                </div>
            </div>

            <h5 class="font-weight-bold text-primary mt-4">C. Anggota Keluarga</h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Nama</th><th>NIK</th><th>Tempat Lahir</th><th>Tgl Lahir</th><th>Agama</th><th>Pekerjaan</th><th><button type="button" class="btn btn-sm btn-success" onclick="tambahBaris()"><i class="fas fa-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody id="tabel-anggota">
                    <?php 
                    // TAMPILKAN ANGGOTA YANG SUDAH ADA
                    foreach($anggota as $a): 
                        // Ambil detail anggota dari tabel penduduk jika perlu
                        $det = $this->db->get_where('penduduk', ['nik' => $a['nik']])->row_array();
                    ?>
                    <tr>
                        <td><input type="text" name="nama_anggota[]" class="form-control form-control-sm" value="<?= $a['nama'] ?>"></td>
                        <td><input type="text" name="nik_anggota[]" class="form-control form-control-sm" value="<?= $a['nik'] ?>"></td>
                        <td><input type="text" name="tmpt_lahir_anggota[]" class="form-control form-control-sm" value="<?= isset($det['tempat_lahir']) ? $det['tempat_lahir'] : '' ?>"></td>
                        <td><input type="date" name="tgl_lahir_anggota[]" class="form-control form-control-sm" value="<?= isset($det['tgl_lahir']) ? $det['tgl_lahir'] : '' ?>"></td>
                        <td>
                            <select name="agama_anggota[]" class="form-control form-control-sm">
                                <option value="-">-</option>
                                <?php foreach($agamas as $ag): ?>
                                    <option value="<?= $ag ?>" <?= (isset($det['agama']) && $det['agama'] == $ag) ? 'selected' : '' ?>><?= $ag ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" name="pekerjaan_anggota[]" class="form-control form-control-sm" value="<?= isset($det['pekerjaan']) ? $det['pekerjaan'] : '' ?>"></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="form-group mt-3">
                <label>Isi Laporan</label>
                <textarea name="isi_laporan" class="form-control" rows="3"><?= $p['isi_laporan'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">SIMPAN PERUBAHAN</button>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    function toggleOpsi() {
        let kat = document.getElementById('kategori').value;
        document.getElementById('opsi-pbijk').style.display = (kat === 'PBI-JK') ? 'block' : 'none';
    }
    
    function tambahBaris() {
        let html = `
            <tr>
                <td><input type="text" name="nama_anggota[]" class="form-control form-control-sm" placeholder="Nama"></td>
                <td><input type="text" name="nik_anggota[]" class="form-control form-control-sm" placeholder="NIK"></td>
                <td><input type="text" name="tmpt_lahir_anggota[]" class="form-control form-control-sm" placeholder="Tempat"></td>
                <td><input type="date" name="tgl_lahir_anggota[]" class="form-control form-control-sm"></td>
                <td>
                    <select name="agama_anggota[]" class="form-control form-control-sm">
                        <option value="-">-</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                    </select>
                </td>
                <td><input type="text" name="pekerjaan_anggota[]" class="form-control form-control-sm" placeholder="Kerja"></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()"><i class="fas fa-trash"></i></button></td>
            </tr>`;
        document.getElementById('tabel-anggota').insertAdjacentHTML('beforeend', html);
    }
</script>