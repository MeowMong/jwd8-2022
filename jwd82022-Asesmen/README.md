# Project Pemesanan Tiket Bus AKAP

## Dibuat oleh
Project Pemesanan Tiket Bus AKAP dibuat oleh <b>Rasyid Ramadhani<b> [1503460101-304].

## Tanggal rilis
* Selasa, 28 September 2022

## Versi
- Ver1.1

## Tanggal Update
* Rabu, 28 September 2022

## Deskripsi
Project ini dirancang dengan tujuan mengimplementasikan PHP, HTML, serta library Bootstrap untuk membuat sebuah form <b>Pemesanan Tiket Bus AKAP<b>.

## Struktur Project
* README.md
* koneksi.php
* index.php
* layananCekTiket.php
* layananLihatDaftar.php
* layananPesanTiket.php
* img
    * ico
    * main
* data
    * db_tiketbus.sql
* lib
    * Bootstrap v5.2.0

## Fitur
- Tampilan website yang responsif
- Fitur untuk melakukan pemesanan Tiket Bus AKAP berdasarkan jenis kelas Bus AKAP dan jumlah penumpang (Lansia dan Non-Lansia)
- Fitur untuk melakukan pengecekan Tiket Bus AKAP berdasarkan input kode bookingnya
- Fitur untuk melihat semua daftar penumpang yang terdaftar berdasarkan jenis kelas BUS AKAP serta tanggal keberangkatan 

## Cara kerja fitur
* Melakukan pemesanan dapat dimulai dari bagian bar navigasi atau halaman utama website.
* Pengisian data pemesan dilakukan pada halaman layananPesanTiket.php. Setelah user menginputkan data dan persetujuan, maka akan muncul notifikasi serta akan lansung menuju halaman layananCekTiket.php dalam waktu 5 detik untuk menampilkan tiket yang telah dipesan.
* Pengecekan tiket dilakukan pada halaman layananCekTiket.php. User diminta untuk menginputkan kode booking tiket, setelah itu sistem akan menampilkan data pemesan berdasarkan kode booking tersebut. <b>Apabila user ingin menginput ulang (Mencari  ulang)<b>, maka user harus klik tombol <b>Ulangi<b> untuk fitur dapat bekerja dengan semestinya.
* Melihat daftar dilakukan pada halaman layananLihatDaftar.php. Sistem akan menampilkan tabel yang berisi kolom nama pemesan, kelas bus, dan tanggal keberangkatannya.


## Software pengembang
* [<b>XAMPP Control Panel<b>] -> Sebagai webserver lokal (Apache dan MySQL)
* [<b>Visual Studio Code<b>] -> Sebagai text Editor
* [<b>Microsoft Edge<b>] -> Sebagai pembuat tampilan dari code yang dijalankan pada Visual Studio Code dengan menghubungkan servernya melalui XAMPP.

## Spesifikasi
* <b>XAMPP<b> -> Versi 3.3.0
* <b>Visual Studio Code<b> -> Versi 1.70.2
* <b>Microsoft Edge<b> -> Versi 104.0.1293.70

## Library
* Bootstrap-5.2.0

### --- END of LINE ---