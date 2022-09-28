<?php require('koneksi.php'); ?>

<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                    <div class="">
                        <a class="navbar-brand text-warning fs-1 fw-bold" href="index.php">Tiket Bus AKAP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item mx-5">
                                <a class="nav-link text-warning" aria-current="page" href="index.php">Beranda</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-warning active fw-bold border-bottom border-warning"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Layanan </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item text-warning" href="#">Pesan Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="layananCekTiket.php">Cek Tiket</a>
                                    </li>
                                    <li><a class="dropdown-item text-warning" href="layananLihatDaftar.php">Lihat
                                            Daftar Penumpang</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>
        <!-- End of Navbar -->

        <!-- Main Content -->
        <br>
        <section class="container my-4">
            <form action="" method="GET">
                <div class="card p-3 text-bg-dark">
                    <h4 class="text-warning card-header">Daftar Penumpang</h4>
                    <div class="card-body row">
                        <!-- Left Side Content -->
                        <div class="col-lg-12">
                            <table class="table table-dark table-hover">
                                <thead class="text-warning">
                                    <tr>
                                        <th scope="col-1">No</th>
                                        <th scope="col-4">Nama</th>
                                        <th scope="col-3">Kelas</th>
                                        <th scope="col-4">Jadwal Keberangkatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql1 = "SELECT * FROM tiket_penumpang ORDER BY jenis_kelas ASC";
                                        $q1   = mysqli_query($koneksi, $sql1);
                                        $num  = 1;
                                        while ($r1 = mysqli_fetch_array($q1)) {
                                            $id_penumpang     = $r1['id_penumpang'];
                                            $nama_pemesan     = $r1['nama_pemesan'];
                                            $jenis_kelas      = $r1['jenis_kelas'];
                                            $tgl_brkt         = $r1['tgl_brkt'];
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $num++ ?></th>
                                                <td scope="row"><?php echo $nama_pemesan ?></td>
                                                <td scope="row"><?php echo $jenis_kelas ?></td>
                                                <td scope="row"><?php echo $tgl_brkt ?></td>
                                            </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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