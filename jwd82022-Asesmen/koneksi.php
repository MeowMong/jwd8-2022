<?php
    /*
		* @desc class ini digunakan untuk memproses data pemesanan tiket bus AKAP serta mengakses variabel
		* @authors dibuat oleh Rasyid Ramadhani [1503460101-304] (rasyid.dot.id@gmail.com)
		* @version 1.1
		* @date : 28 September 2022
	*/

    // Membuat koneksi ke database MySQL yang bernama db_tiketbus
    $host       = "localhost";
    $user       = "root";
    $pass       = "";
    $db         = "db_tiketbus";

    // Statement status koneksi (Sukses / Gagal terhubung)
    $koneksi    = mysqli_connect($host, $user, $pass, $db);
    if (!$koneksi) {
        die("Tidak dapat terhubung ke database");
    }

    // Deklarasi & Inisialisasi variabel yang umumnya digunakan pada project ini
    $id_penumpang     = "";
    $kode_book        = "";
    $no_ktp           = "";
    $nama_pemesan     = "";
    $no_hp            = "";
    $jenis_kelas      = "";
    $jml_tidak_lansia = "";
    $jml_lansia       = "";
    $total_bayar      = "";
    $tgl_brkt         = "";
    $tgl_transaksi    = "";
    $hargaNormal      = 200000;
    $total1           = "";
    $total2           = "";
    $potongan         = ($hargaNormal * 10) / 100;

    $sukses = "";
    $error  = "";