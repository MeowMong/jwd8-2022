<?php
    /*
		* @desc class ini digunakan untuk melakukan pengecekan tiket bus AKAP berdasarkan kode booking
		* @authors dibuat oleh Rasyid Ramadhani [1503460101-304] (rasyid.dot.id@gmail.com)
		* @version 1.1
		* @date : 28 September 2022
	*/

    // Pemanggilan kelas koneksi.php untuk mengakses variabel global
    require('koneksi.php');

    /*
        * @desc method setTotal digunakan untuk menghitung total harga sebuah tiket berdasarkan jenis penumpang (Lansia & Non-Lansia)
        * @param $jumlahTidakLansia digunakan untuk menampung jumlah penumpang yang umurnya kurang dari 60 tahun
        * @param $jumlahLansia digunakan untuk menampung jumlah penumpang yang umurnya lebih dari atau sama dengan 60 tahun
        * @return $totalHarga untuk mengembalikan total harga yang harus dibayar
    */
    function setTotal($jumlahTidakLansia, $jumlahLansia){
        global $hargaNormal, $potongan, $total1, $total2;

        // Perhitungan penumpang yang umurnya kurang dari 60 tahun
        $total1 = $jumlahTidakLansia * $hargaNormal;

        // Perhitungan penumpang yang umurnya lebih dari atau sama dengan 60 tahun yang mendapat diskon 10% dari harga per satuan tiketnya
        $totalDiskon = $jumlahLansia * $potongan;
        $total2 = $jumlahLansia * $hargaNormal - $totalDiskon;

        $totalHarga = $total1 + $total2;

        return $totalHarga;
    }

    /*
        * @desc method getTotal digunakan untuk mengambil data yang dihasilkan dari method setTotal
        * @param $setTotal sebagai parameter default
        * @return $setTotal untuk melihat data
    */
    function getTotal($setTotal){
        return $setTotal;
    }

?>

<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Headicon -->
        <title>Bus AKAP - Cek Tiket</title>
        <link rel="shortcut icon" href="img/ico/DIRJEN-PD.ico" type="image/x-icon">

        <!-- Bootstrap-5.2.0 CSS -->
        <link rel="stylesheet" href="lib/bootstrap-5.2.0/css/bootstrap.min.css" />
    </head>

    <body class="bg-secondary">
        <!-- Navbar -->
        <section class="sticky-top">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container container-fluid position-relative d-flex">
                    <!-- Logo utama & tombol responsif navbar -->
                    <div>
                        <a class="navbar-brand text-warning fs-1 fw-bold" href="index.php">Tiket Bus AKAP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                    <!-- Fitur Navbar -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <!-- Container - Beranda -->
                            <li class="nav-item mx-5">
                                <a class="nav-link text-warning" aria-current="page" href="index.php">Beranda</a>
                            </li>

                            <!-- Container - Layanan -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-warning active fw-bold border-bottom border-warning"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Layanan </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item text-warning" href="layananPesanTiket.php">Pesan Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="#">Cek Tiket</a>
                                    </li>
                                    <li><a class="dropdown-item text-warning" href="layananLihatDaftar.php">Lihat
                                            Daftar Penumpang</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- End of Fitur Navbar -->
                </div>
            </nav>
        </section>
        <!-- End of Navbar -->

        <!-- Main Content -->
        <br>
        <section class="container my-4">
            <!-- Form input kode booking -->
            <form method="GET" action="layananCekTiket.php">
                <div class="card p-3 text-bg-dark">
                    <h4 class="text-warning card-header">Form Cek Tiket</h4>
                    <div class="card-body row">

                        <!-- Konten sebelah kiri -->
                        <div class="col-md-7">
                            <div class="mt-1 mb-4 row">

                                <!-- Input kode booking -->
                                <label for="kode_book" class="col-sm-5 col-form-label">Kode Booking</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="kode_book" name="kode_book" placeholder="Masukkan kode booking..." required>
                                </div>

                                <!-- Button opsi (Proses mencari / Ulang halaman) -->
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-warning fw-bolder px-4" name="cari">Cari</button>
                                    <a type="button" class="btn btn-dark text-warning fw-bolder px-3 my-2" href="layananCekTiket.php" name="refresh">Ulang</a>
                                </div>
                            </div>
                        </div>

                        <!-- Konten sebelah kanan -->
                        <div class="col-md-5">
                            <div class="mt-1 mb-4 row">

                                <!-- Button pesan opsi pesan tiket -->
                                <div class="col text-end">
                                    <a for="belumPesan" class="col-sm-5 col-form-label link-warning text-decoration-none" href="layananPesanTiket.php">Belum memiliki tiket ? <strong>Pesan Sekarang!</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statement untuk memproses pencarian pada database MySQL berdasarkan kode booking yang diinputkan -->
                    <?php
                        if (isset($_GET['kode_book'])) {
                            $kode_book        = $_GET['kode_book'];
                            $sql1             = "SELECT * FROM tiket_penumpang WHERE kode_book like '%".$kode_book."%'";
                            $q1               = mysqli_query($koneksi, $sql1);
                            while ($r1 = mysqli_fetch_array($q1)) {
                                $id_penumpang     = $r1['id_penumpang'];
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
                                ?>

                                <!-- Detail Data Penumpang -->
                                <h4 class="text-warning card-header">Rincian</h4>
                                <div class="card-body row">
                                    <div class="col-md-12 d-flex justify-content-start">
                                        <div class="card w-100 mt-1 mb-4 bg-dark border-warning text-warning p-3">
                                            <!-- Header of Card Content -->
                                            <div class="row">
                                                <!-- Left Content -->
                                                <div class="col-md-6 justify-content-start">
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Nomor Pesanan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="id_penumpang" name="id_penumpang" value="<?php echo $id_penumpang ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Tanggal/Jam Transaksi</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="tgl_transaksi" value="<?php echo $tgl_transaksi ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Nama Pemesan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="nama_pemesan" value="<?php echo $nama_pemesan ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Nomor Identitas</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="no_ktp" value="<?php echo $no_ktp ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">No. HP</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="no_hp" value="<?php echo $no_hp ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Jumlah Tagihan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="total_bayar" value="<?php echo $total_bayar ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label">Jadwal Keberangkatan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-light" id="staticEmail" name="tgl_brkt" value="<?php echo $tgl_brkt ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <!-- Right Content -->
                                                <div class="col-md-6">
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label text-start fs-4 fw-bold">Kode Booking :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-warning text-center fs-4 fw-bold" id="staticEmail" name="kode_book" value="<?php echo $kode_book ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="staticEmail" class="col-sm-6 col-form-label text-start fs-4 fw-bold">Kelas Tiket :</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" readonly class="form-control-plaintext text-warning text-center fs-4 fw-bold" id="staticEmail" name="jenis_kelas" value="<?php echo $jenis_kelas ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                
                                            <!-- Body of Card Content -->
                                            <div class="row">
                                                <div class="card w-100 mt-1 mb-4 bg-dark border-secondary text-warning p-3">
                                                    <h4 class="text-warning card-header">Detail Penumpang</h4>
                                                    <div class="card-body col-md-12">
                                                        <div class="row text-light">
                                                            <div class="col-md-4 text-start">
                                                                <label for="staticEmail" class="col-form-label">Bukan Lansia (Usia < 60 Tahun)</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label for="staticEmail" class="col-form-label" name="jml_tidak_lansia">x <?php echo $jml_tidak_lansia ?> tiket</label>
                                                            </div>
                                                            <div class="col-md-4 text-end">
                                                                <label for="staticEmail" class="col-form-label">Rp <?php setTotal($jml_tidak_lansia, $jml_lansia); echo $total1; ?>,-</label>
                                                            </div>
                                                        </div>
                                
                                                        <div class="row text-light">
                                                            <div class="col-md-4 text-start">
                                                                <label for="staticEmail" class="col-form-label">Lansia (Usia >= 60 Tahun)</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label for="staticEmail" class="col-form-label" name="jml_lansia">x <?php echo $jml_lansia ?> tiket</label>
                                                            </div>
                                                            <div class="col-md-4 text-end">
                                                                <label for="staticEmail" class="col-form-label">Rp <?php echo $total2; ?>,-</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>
                </div>
            </form>
        </section>
        <!-- End of Main Content -->

        <!-- Footer -->
        <br>
        <section class="mt-5">
            <div class="text-bg-dark fixed-bottom py-2">
                <div class="container">
                    <p>©2022 Tiket BUS AKAP - Web Services. All Rights Reserved</p>
                </div>
            </div>
        </section>
        <!-- End of Footer -->

        <!-- Bootstrap-5.2.0 JavaScript -->
        <script src="lib/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    </body>

</html>