<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Pengaduan Baru</h1>
        <a href="<?= base_url('pengaduan'); ?>" class="btn btn-secondary btn-sm shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-alt mr-1"></i> Form Input Data Lengkap</h6>
                </div>
                <div class="card-body">
                    <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?= $this->session->flashdata('message'); ?>

                    <?= form_open('pengaduan/simpan'); ?>

                    <h5 class="text-secondary font-weight-bold border-bottom pb-2">A. Data Pelapor / Kepala Keluarga</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" id="nik" class="form-control" required placeholder="NIK 16 Digit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelapor" id="nama_pelapor" class="form-control" required placeholder="Nama Sesuai KTP">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="agama" id="agama" class="form-control">
                                    <option value="-">- Pilih -</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. HP / WA</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="2"></textarea>
                    </div>

                    <h5 class="text-secondary font-weight-bold border-bottom pb-2 mt-4">B. Detail Pengajuan</h5>
                    <div class="form-group">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" id="kategori" class="form-control" required onchange="toggleOpsi()">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="PBI-JK">PBI-JK / Rekomendasi (BPJS)</option>
                            <option value="DTSEN">DTSEN (Data Terpadu)</option>
                            <option value="JAMKESDA">JAMKESDA</option>
                            <option value="LAINNYA">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group p-3 border rounded bg-light" id="opsi-pbijk" style="display:none;">
                        <label class="font-weight-bold text-primary">Status Pengajuan (Wajib untuk PBI-JK):</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="opt_reaktif" name="sub_kategori" class="custom-control-input" value="Reaktivasi">
                            <label class="custom-control-label font-weight-bold" for="opt_reaktif">Reaktivasi (Aktifkan Kembali)</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="opt_baru" name="sub_kategori" class="custom-control-input" value="Peserta Baru">
                            <label class="custom-control-label" for="opt_baru">Peserta Baru</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="opt_pindah" name="sub_kategori" class="custom-control-input" value="Pindah Segmen">
                            <label class="custom-control-label" for="opt_pindah">Pindah Segmen</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="opt_urgent" name="sub_kategori" class="custom-control-input" value="Urgent">
                            <label class="custom-control-label" for="opt_urgent">Urgent</label>
                        </div>
                    </div>

                    <div class="form-group border p-3 rounded bg-white mt-3">
                        <label class="font-weight-bold"><i class="fas fa-check-square"></i> Kelengkapan Persyaratan:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Surat Keterangan DTSEN">
                                    <label class="form-check-label">Surat Keterangan DTSEN</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Surat Kontrol / Rujukan Faskes tingkat pertama">
                                    <label class="form-check-label">Surat Kontrol / Rujukan Faskes</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Foto Copy Kartu KIS jika ada">
                                    <label class="form-check-label">Foto Copy Kartu KIS (Jika ada)</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="NON DTSEN">
                                    <label class="form-check-label">NON DTSEN</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Foto Copy KK dan KTP sebanyak 1 lembar">
                                    <label class="form-check-label">Foto Copy KK dan KTP (1 Lembar)</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Foto Copy Surat Keterangan di rawat">
                                    <label class="form-check-label">Foto Copy Resume Medis / Surat Rawat</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="syarat[]" value="Foto Copy SKTM">
                                    <label class="form-check-label">Foto Copy SKTM</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-secondary font-weight-bold border-bottom pb-2 mt-4">C. Anggota Keluarga</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="font-size: 0.9rem;">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th width="20%">Nama</th>
                                    <th width="15%">NIK</th>
                                    <th width="15%">Tempat Lahir</th>
                                    <th width="12%">Tgl Lahir</th>
                                    <th width="10%">Agama</th>
                                    <th width="15%">Pekerjaan</th>
                                    <th width="5%"><button type="button" class="btn btn-success btn-sm btn-circle" onclick="tambahBaris()"><i class="fas fa-plus"></i></button></th>
                                </tr>
                            </thead>
                            <tbody id="tabel-anggota"></tbody>
                        </table>
                    </div>

                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Isi Laporan / Keterangan Tambahan</label>
                        <textarea name="isi_laporan" class="form-control" rows="3" required placeholder="Contoh: Pengaktifan BPJS, Permohonan Rekomendasi, dll"></textarea>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fas fa-save mr-2"></i> SIMPAN DATA PENGADUAN</button>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 532E48647974 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    function toggleOpsi() {
        let kat = $('#kategori').val();
        if(kat === 'PBI-JK') $('#opsi-pbijk').show();
        else { $('#opsi-pbijk').hide(); $('input[name="sub_kategori"]').prop('checked', false); }
    }

    // TAMBAH BARIS (TANPA KOLOM HUBUNGAN)
    function tambahBaris() {
        let html = `
            <tr>
                <td><input type="text" name="nama_anggota[]" class="form-control form-control-sm" placeholder="Nama"></td>
                <td><input type="text" name="nik_anggota[]" class="form-control form-control-sm" placeholder="NIK"></td>
                <td><input type="text" name="tmpt_lahir_anggota[]" class="form-control form-control-sm" placeholder="Tempat Lahir"></td>
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
                <td><input type="text" name="pekerjaan_anggota[]" class="form-control form-control-sm" placeholder="Pekerjaan"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm btn-circle" onclick="this.closest('tr').remove()"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
        $('#tabel-anggota').append(html);
    }

    $(function () {
        // ... (Script Autocomplete Tetap Sama, tidak berubah) ...
        $("#nama_pelapor, #nik").autocomplete({
            source: "<?= base_url('pengaduan/cari_penduduk_json'); ?>",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $("#nama_pelapor").val(ui.item.value);
                $("#nik").val(ui.item.nik);
                $("#no_telp").val(ui.item.no_telp);
                $("#pekerjaan").val(ui.item.pekerjaan);
                $("#alamat").val(ui.item.alamat);
                $("#tempat_lahir").val(ui.item.tempat_lahir);
                $("#tgl_lahir").val(ui.item.tgl_lahir);
                $("#agama").val(ui.item.agama);
            }
        });
    });
</script>