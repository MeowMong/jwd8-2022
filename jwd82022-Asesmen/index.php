<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bus AKAP - Beranda</title>
        <link rel="shortcut icon" href="img/ico/DIRJEN-PD.ico" type="image/x-icon">

        <!-- My Style -->
        <!-- <link rel="stylesheet" href="lib/css/style.css"> -->

        <!-- Bootstrap-5.2.0 CSS -->
        <link rel="stylesheet" href="lib/bootstrap-5.2.0/css/bootstrap.min.css" />
    </head>

    <body class="bg-secondary">
        <!-- Navbar -->
        <section>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <div class="container container-fluid position-relative d-flex">
                    <!-- Logo -->
                    <div>
                        <a class="navbar-brand text-warning fs-1 fw-bold" href="index.php">Tiket Bus AKAP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>

                    <!-- Menu -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item mx-5 border-bottom border-warning">
                                <a class="nav-link text-warning active fw-bold" aria-current="page" href="#">Beranda</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Layanan </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item text-warning" href="layananPesanTiket.php">Pesan Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="layananCekTiket.php">Cek Tiket</a></li>
                                    <li><a class="dropdown-item text-warning" href="layananLihatDaftar.php">Lihat Daftar Penumpang</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>
        <!-- End of Navbar -->

        <!-- Main Content -->
        <br class="mt-5">
        <br class="mt-5">
        <section class="container text-light">
            <div class="row">
                <!-- Left Side Content -->
                <div class="col-md-6">
                    <div class="row">
                        <p class="fs-3 fw-bold">Layanan Kami</p>
                    </div>
                    <div class="row">
                        <p class="fs-5 fw-normal" style="text-align: justify;">Mewujudkan transportasi Jabodetabek dengan integrasi pelayanan transportasi yang aman, nyaman & terjangkau oleh masyarakat.<br><br>Rasakan mudahnya memesan tiket dari operator-operator bus terbaik untuk berbagai rute di Indonesia.</p>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <a type="button" class="btn btn-warning fw-bolder py-3 px-5" href="layananPesanTiket.php">Pesan Tiketmu Sekarang!</a>
                        </div>
                    </div>
                </div>
                <!-- End of Left Side Content -->

                <!-- Right Side Content -->
                <div class="col-md-6">
                    <div class="row">
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <img src="img/main/akap1.png" class="d-block rounded w-100 h-auto float-end" alt="img/main/akap1.png">
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="img/main/akap2.png" class="d-block rounded w-100 h-auto float-end" alt="img/main/akap2.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Right Side Content -->
            </div>
        </section>
        <!-- End of Main Content -->

        <!-- Footer -->
        <section>
            <div class="bg-dark fixed-bottom py-2">
                <div class="container text-light">
                    <p>©2022 Tiket BUS AKAP - Web Services. All Rights Reserved</p>
                </div>
            </div>
        </section>
        <!-- End of Footer -->

        <!-- Bootstrap-5.2.0 JavaScript -->
        <script src="lib/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
