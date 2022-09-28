<?php
    /*
		* @desc class ini digunakan untuk melakukan pemesanan tiket bus AKAP dan menyimpannya ke database
		* @authors dibuat oleh Rasyid Ramadhani [1503460101-304] (rasyid.dot.id@gmail.com)
		* @version 1.1
		* @date : 28 September 2022
	*/

    // Pemanggilan kelas koneksi.php untuk mengakses variabel global
    require('koneksi.php');

    /*
        * @desc method getKodeBook digunakan untuk membuat kode booking dari campuran karakter huruf dan angka dengan panjang 7 karakter
        * @param $panjang memiliki nilai 7 sebagai limit panjang karakter
        * @return $data untuk mengembalikan nilai variabel $data yang berisi 7 karakter acak yang menjadi satu
    */
    function getKodeBook($panjang = 7){
        $karakter = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $data = '';
        for ($i = 0; $i < $panjang; $i++){
            $random = rand(0, strlen($karakter) - 1 );
            $data .= $karakter[$random];
        }
        return $data;
    }

    // Inisialisasi variabel untuk menjalankan method dan menyimpannya
    $kode_book = getKodeBook();

    /*
        * @desc method setTotal digunakan untuk menghitung total harga sebuah tiket berdasarkan jenis penumpang (Lansia & Non-Lansia)
        * @param $jumlahTidakLansia digunakan untuk menampung jumlah penumpang yang umurnya kurang dari 60 tahun
        * @param $jumlahLansia digunakan untuk menampung jumlah penumpang yang umurnya lebih dari atau sama dengan 60 tahun
        * @return $totalHarga untuk mengembalikan total harga yang harus dibayar
    */
    function setTotal($jumlahTidakLansia, $jumlahLansia){
        global $hargaNormal, $potongan;

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

    // Statement untuk menyimpan data kedalam database MySQL
    // Statement berjalan apabila ada aksi (Klik) dari sebuah button dengan name atau variabel 'simpan_data'
    if (isset($_POST['simpan_data'])) {
        $kode_book        = $_POST['kode_book'];
        $no_ktp           = $_POST['no_ktp'];
        $nama_pemesan     = $_POST['nama_pemesan'];
        $no_hp            = $_POST['no_hp'];
        $jenis_kelas      = $_POST['jenis_kelas'];
        $jml_tidak_lansia = $_POST['jml_tidak_lansia'];
        $jml_lansia       = $_POST['jml_lansia'];
        $jumlahBayar      = setTotal($jml_tidak_lansia, $jml_lansia);
        $total_bayar      = getTotal($jumlahBayar);
        $tgl_brkt         = $_POST['tgl_brkt'];

        if ($kode_book || $no_ktp || $nama_pemesan || $no_hp || $jenis_kelas || $jml_tidak_lansia || $jml_lansia || $total_bayar || $tgl_brkt || $tgl_transaksi) {
            // Simpan data
            $sql1   = "INSERT INTO tiket_penumpang(kode_book, no_ktp, nama_pemesan, no_hp, jenis_kelas, jml_tidak_lansia, jml_lansia, total_bayar, tgl_brkt) VALUES ('$kode_book', '$no_ktp', '$nama_pemesan', '$no_hp', '$jenis_kelas', '$jml_tidak_lansia', '$jml_lansia', '$total_bayar', '$tgl_brkt')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Tiket berhasil Dibeli!";
            } else { 
                $error      = "GAGAL menambahkan data baru!";
            }
        } else {
            $error  = "Silahkan masukkan data!";
        }
    }

?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Headicon -->
        <title>Bus AKAP - Pesan Tiket</title>
        <link rel="shortcut icon" href="img/ico/DIRJEN-PD.ico" type="image/x-icon" />

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
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link dropdown-toggle text-warning active fw-bold border-bottom border-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Layanan </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item text-warning" href="#">Pesan Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="layananCekTiket.php">Cek Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="layananLihatDaftar.php">Lihat Daftar Penumpang</a></li>
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
        <br />
        <section class="container my-4">
            <!-- Alert error & success -->
            <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=layananCekTiket.php?kode_book=$kode_book&cari=");
                }
            ?>

            <!-- Form Pemesanan Tiket -->
            <form action="" method="POST">

                <!-- Inner card -->
                <div class="card p-3 text-bg-dark">
                    <h4 class="text-warning card-header">Form Pemesanan Tiket</h4>
                    <div class="card-body row">

                        <!-- Konten sebelah Kiri -->
                        <div class="col-md-7">

                            <!-- Input Nama -->
                            <div class="mb-3 row">
                                <label for="nama_pemesan" class="col-sm-5 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" required="">
                                </div>
                            </div>
                            
                            <!-- Input No. KTP -->
                            <div class="mb-3 row">
                                <label for="no_ktp" class="col-sm-5 col-form-label">Nomor Identitas</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan no. KTP" required="" />
                                </div>
                            </div>

                            <!-- Input No.HP -->
                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-5 col-form-label">No. HP</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" required="" />
                                </div>
                            </div>

                            <!-- Input jenis Kelas BUS -->
                            <div class="mb-3 row">
                                <label for="jenis_kelas" class="col-sm-5 col-form-label">Kelas Penumpang</label>
                                <div class="col-sm-7">
                                    <select class="form-select form-select-md" aria-label=".form-select-md example" id="jenis_kelas" name="jenis_kelas" required="">
                                        <option selected>Klik untuk pilih Kelas...</option>
                                        <option value="Ekonomi" <?php if ($jenis_kelas == "Ekonomi") echo "selected" ?>>Ekonomi</option>
                                        <option value="Bisnis" <?php if ($jenis_kelas == "Bisnis") echo "selected" ?>>Bisnis</option>
                                        <option value="Eksekutif" <?php if ($jenis_kelas == "Eksekutif") echo "selected" ?>>Eksekutif</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Input Jadwal Keberangkatan -->
                            <div class="mb-3 row">
                                <label for="tgl_brkt" class="col-sm-5 col-form-label">Jadwal Keberangkatan</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control" name="tgl_brkt" id="tgl_brkt" required="" />
                                </div>
                            </div>

                            <!-- Input jumlah penumpang Non-Lansia -->
                            <div class="mb-3 row">
                                <div class="col-sm-5 col-form-label">
                                    <div class="row">
                                        <label for="jml_tidak_lansia">Jumlah Penumpang</label>
                                        <label for="jml_tidak_lansia" class="fw-lighter"><small>Bukan Lansia (Usia < 60)</small></label>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="jml_tidak_lansia" id="jml_tidak_lansia" required="" />
                                </div>
                            </div>

                            <!-- Input jumlah penumpang Lansia -->
                            <div class="mb-3 row">
                                <div class="col-sm-5 col-form-label">
                                    <div class="row">
                                        <label for="jml_lansia">Jumlah Penumpang Lansia</label>
                                        <label for="jml_lansia" class="fw-lighter"><small>Usia = 60 atau lebih dari 60</small></label>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" name="jml_lansia" id="jml_lansia" required="" />
                                </div>
                            </div>

                            <!-- Harga Tiket -->
                            <div class="mb-1 row text-warning">
                                <label for="hargaTiket" class="col-sm-5 col-form-label fs-3 fw-bold">Harga Tiket</label>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control-plaintext text-warning fs-3 fw-bold" id="hargaTiket" value="Rp <?php echo $hargaNormal ?>,-" />
                                </div>
                            </div>
                            <div class="mb-1 row text-dark">
                                <label for="hargaTiket" class="col-sm-5 col-form-label fs-3 fw-bold">Kode Booking</label>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control-plaintext text-dark fs-3 fw-bold" id="kode_book" name="kode_book" value="<?php echo $kode_book ?>" />
                                </div>
                            </div>

                            <!-- Checkbox persetujuan -->
                            <hr />
                            <div class="my-5 row">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" required="" />
                                    <label class="form-check-label" for="inlineCheckbox1">
                                        <em>Saya dan/atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan.</em>
                                    </label>
                                </div>
                            </div>

                            <!-- Button opsi (Batalkan / Proses Tiket) -->
                            <div class="my-5 row">
                                <div class="col-md-5 d-grid gap-2">
                                    <a type="button" class="btn btn-secondary fw-bolder py-3 px-5" href="index.php">Batalkan</a>
                                </div>
                                <div class="col-md-7 d-grid gap-2">
                                    <!-- <button type="submit" class="btn btn-warning fw-bolder py-3 px-5" data-bs-toggle="modal" name="simpan_data" data-bs-target="#staticBackdrop">Proses Tiket</button> -->
                                    <button type="submit" class="btn btn-warning fw-bolder py-3 px-5" href="layananPesanTiket.php" name="simpan_data" >Proses Tiket</button>
                                </div>
                            </div>
                        </div>
                        <!-- End of Konten sebelah kiri -->
    
                        <!-- Konten sebelah Kanan -->
                        <div class="col-md-5 d-flex justify-content-end">
                            <!-- Inner Card -->
                            <div class="card bg-dark border-warning text-warning p-3" style="width: 500px">
                                <div class="card-body vstack gap-4">
                                    <!-- Nama Kelas Bus -->
                                    <h4 class="card-title">Kelas Ekonomi</h4>

                                    <!-- Carousel Gambar -->
                                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" data-bs-interval="3000">
                                                <img src="img/main/akap1.png" class="d-block w-100" style="object-fit: contain" alt="img/main/akap1.png" />
                                            </div>
                                            <div class="carousel-item" data-bs-interval="3000">
                                                <img src="img/main/akap2.png" class="d-block w-100" style="object-fit: contain" alt="img/main/akap2.png" />
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                    <!-- Deskripsi Kelas Bus -->
                                    <div class="text-center px-md-3">
                                        <p class="card-text">
                                            Bus AKAP Kelas Eksekutif Plus kami adalah bus mewah dengan model MHD dengan konfigurasi kursi 2+2 dibangun oleh karoseri Adi Putro di atas Sasis Mercedes-benz OH1626 dengan berbagai fasilitas ekstra
                                            sehingga menambah kenyamanan Anda saat melakukan perjalanan jauh bersama dengan orang-orang yang Anda sayangi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Konten sebelah kanan -->
                    </div>
                </div>
            </form>
        </section>
        <!-- End of Main Content -->

        <!-- Footer -->
        <br />
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
