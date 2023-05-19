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
    <!-- Start GA -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> -->
    <!-- <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script> -->
    <!-- /END GA -->
    <style>
        body {
            overflow-y: hidden;
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <a href=" <?= base_url('/'); ?>" class="logo">
                                <img src="https://static.wixstatic.com/media/1c5adc_cce1d829b1c1432baeeba778ad268029~mv2.png/v1/fill/w_326,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/LOGO%20100X500.png" alt="LOGO 100X500.png" style="width: 300px; object-fit: contain; object-position: center center;" srcset="https://static.wixstatic.com/media/1c5adc_cce1d829b1c1432baeeba778ad268029~mv2.png/v1/fill/w_326,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/LOGO%20100X500.png" fetchpriority="high">
                            </a>
                        </div>
                        <div class="card card-primary">
                            <!-- <div class="card-header">
                            
                            </div> -->

                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="frist_name">ID Karyawan</label>
                                            <input id="frist_name" type="text" class="form-control" name="frist_name" autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="last_name">Nama</label>
                                            <input id="last_name" type="text" class="form-control" name="last_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control" name="password-confirm">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                            <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <a href="<?= base_url('prank'); ?>"><button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>

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