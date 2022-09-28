<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "db_tiketbus";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak dapat terhubung ke database");
}

$id_penumpang = "";
$kode_book = "";
$no_ktp = "";
$nama_pemesan = "";
$no_hp = "";
$jenis_kelas = "";
$jml_tidak_lansia = "";
$jml_lansia = "";
$total_bayar = "";
$tgl_brkt = "";
$tgl_transaksi = "";

$sukses     = "";
$error      = "";

// EDIT
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// EDIT
if ($op == 'edit') {
    $id_penumpang     = $_GET['id_penumpang'];
    $sql1             = "SELECT * FROM tiket_penumpang WHERE id_penumpang = '$id_penumpang'";
    $q1               = mysqli_query($koneksi, $sql1);
    $r1               = mysqli_fetch_array($q1);
    $kode_book        = $r1['kode_book'];
    $no_ktp           = $r1['no_ktp'];
    $nama_pemesan     = $r1['nama_pemesan'];
    $no_hp            = $r1['no_hp'];
    $jenis_kelas      = $r1['jenis_kelas'];
    $jml_tidak_lansia = $r1['jml_tidak_lansia'];
    $jml_lansia       = $r1['jml_lansia'];
    $total_bayar      = $r1['total_bayar'];
    $tgl_brkt         = $r1['tgl_brkt'];
    $tgl_transaksi    = $r1['tgl_transaksi'];

    if ($id_penumpang == '') {
        $error = "Data tidak ditemukan";
    }
}

// DELETE
if ($op == 'delete') {
    $id_penumpang     = $_GET['id_penumpang'];
    $sql1   = "DELETE FROM tiket_penumpang WHERE id_penumpang = '$id_penumpang'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses     = "Menghapus data BERHASIL!";
    } else {
        $error      = "GAGAL menghapus data!";
    }
}

// CREATE
if (isset($_POST['simpan_data'])) {
    $kode_book        = $_POST['kode_book'];
    $no_ktp           = $_POST['no_ktp'];
    $nama_pemesan     = $_POST['nama_pemesan'];
    $no_hp            = $_POST['no_hp'];
    $jenis_kelas      = $_POST['jenis_kelas'];
    $jml_tidak_lansia = $_POST['jml_tidak_lansia'];
    $jml_lansia       = $_POST['jml_lansia'];
    $total_bayar      = $_POST['total_bayar'];
    $tgl_brkt         = $_POST['tgl_brkt'];
    $tgl_transaksi    = $_POST['tgl_transaksi'];

    if ($kode_book || $no_ktp || $nama_pemesan || $no_hp || $jenis_kelas || $jml_tidak_lansia || $jml_lansia || $total_bayar || $tgl_brkt || $tgl_transaksi) {
        // Simpan edit
        if ($op == 'edit') {
            $sql1   = "UPDATE tiket_penumpang SET kode_book = '$kode_book', no_ktp = '$no_ktp', nama_pemesan = '$nama_pemesan', no_hp = '$no_hp', jenis_kelas = '$jenis_kelas', jml_tidak_lansia = '$jml_tidak_lansia', jml_lansia = '$jml_lansia', total_bayar = '$total_bayar', tgl_brkt = '$tgl_brkt', tgl_transaksi = '$tgl_transaksi', WHERE id_penumpang = '$id_penumpang'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Memperbarui data BERHASIL!";
            } else {
                $error      = "GAGAL memperbarui data!";
            }
        } else {
            // Simpan data
            $sql1   = "INSERT INTO tiket_penumpang(kode_book, no_ktp, nama_pemesan, no_hp, jenis_kelas, jml_tidak_lansia, jml_lansia, total_bayar, tgl_brkt, tgl_transaksi) VALUES ('$kode_book', '$no_ktp', '$nama_pemesan', '$no_hp', '$jenis_kelas', '$jml_tidak_lansia', '$jml_lansia', '$total_bayar', '$tgl_brkt', '$tgl_transaksi')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Menambahkan data baru BERHASIL!";
            } else {
                $error      = "GAGAL menambahkan data baru!";
            }
        }
    } else {
        $error  = "Silahkan masukkan data!";
    }
}

<!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                                <div class="modal-content text-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 d-flex">
                                                <div class="card w-100 mt-1 mb-4 text-bg-light p-3">
                                                    <!-- Header of Card Content -->
                                                    <div class="row">
                                                        <!-- Left Content -->
                                                        <div class="col-md-6 justify-content-start">
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label">Tanggal/Jam Transaksi</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": Lorem Ipsum Sir Dolor" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="nama_pemesan" class="col-sm-6 col-form-label">Nama Pemesan</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="nama_pemesan" name="nama_pemesan" value="<?php echo $nama_pemesan ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label">Nomor Identitas</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"  name="no_ktp" value="<?php echo $no_ktp ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label">No. HP</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"  name="no_hp" value="<?php echo $no_hp ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label">Jumlah Tagihan</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="total_bayar" value="<?php echo getTotal(); ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label">Jadwal Keberangkatan</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="tgl_brkt" value="<?php echo $tgl_brkt ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <!-- Right Content -->
                                                        <div class="col-md-6">
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fs-4 fw-bold">Kode Booking</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext text-secondary text-center fs-4 fw-bold" id="staticEmail" name="kode_book" value="<?php echo getKodeBook(); ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail" class="col-sm-6 col-form-label text-start fs-4 fw-bold">Kelas Tiket</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" readonly class="form-control-plaintext text-secondary text-center fs-4 fw-bold" id="staticEmail" name="jenis_kelas" value="<?php echo $jenis_kelas ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <!-- Body of Card Content -->
                                                    <div class="row">
                                                        <div class="card w-100 mt-1 bg-dark border-secondary text-warning p-3">
                                                            <h4 class="text-warning card-header">Detail Penumpang</h4>
                                                            <div class="card-body col-md-12">
                                                                <div class="row text-light">
                                                                    <div class="col-md-4 text-start">
                                                                        <label for="staticEmail" class="col-form-label">Bukan Lansia (Usia < 60 Tahun)</label>
                                                                    </div>
                                                                    <div class="col-md-4 text-center">
                                                                        <label for="staticEmail"class="col-form-label" name="jml_tidak_lansia" value="<?php echo $jml_tidak_lansia ?>"></label>
                                                                    </div>
                                                                    <div class="col-md-4 text-end">
                                                                        <label for="staticEmail" class="col-form-label" value="<?php echo $total1 ?>">,-</label>
                                                                    </div>
                                                                </div>
    
                                                                <div class="row text-light">
                                                                    <div class="col-md-4 text-start">
                                                                        <label for="staticEmail" class="col-form-label">Lansia (Usia >= 60 Tahun)</label>
                                                                    </div>
                                                                    <div class="col-md-4 text-center">
                                                                        <label for="staticEmail" class="col-form-label"name="jml_lansia" value="<?php echo $jml_lansia ?>"></label>
                                                                    </div>
                                                                    <div class="col-md-4 text-end">
                                                                        <label for="staticEmail" class="col-form-label" value="<?php echo $total2 ?>">-</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" name="simpan_data" >Pesan Sekarang</button>
                                        <!-- <input class="rounded" type="submit" value="Kirim" name="simpan_data"> -->
                                    </div>
                                </div>
                            </div>
                        </div>