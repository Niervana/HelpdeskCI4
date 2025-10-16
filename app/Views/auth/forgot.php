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
            background: linear-gradient(180deg, #7dff0bff 10%, #148ffbff 100%);

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href=" <?= base_url('/'); ?>" class="logo">
                                <img src='lgo.png' alt="LOGO 100X500.png" style="width: 300px; object-fit: contain; object-position: center center;" srcset="" fetchpriority="high">
                            </a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Forgot Password</h4>
                            </div>

                            <div class="card-body">
                                <p class="text-muted">We will send a Information to IT Departement</p>
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <a href="<?= base_url('verifikasi'); ?>"><button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Forgot Password
                                        </button>
                                </div>

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