<?php

use App\Controllers\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>HRM HKTI</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fonta/css/all.min.css">
    <!-- CSS Libraries -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">

    <style>
        body {
            /* overflow-y: hidden; */
            /* If unnecessary, remove this line */
            background: linear-gradient(180deg, #ffffff 0%, #2e78ff 100%);

            background-size: cover;
            animation: bg-pan-top 8s both;
        }

        @keyframes bg-pan-top {
            0% {
                background-position: 50% 100%;
            }

            100% {
                background-position: 50% 0%;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center" style="height:100vh">
                    <div class="card">
                        <div class="col-sm" <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon bg-success">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h2>Request Success</h2>
                                <p class="lead">
                                    Akun mu sudah diajukan, just contact IT departement. (Code: <a href="#" class="bb">150598</a>)
                                </p>
                                <a href="register" class="btn btn-warning mt-4">Daftar Lagi</a>
                                <a href="login" class="mt-4 bb">Login</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>



    </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/assets/modules/moment.min.js"></script>
    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
</body>

</html>