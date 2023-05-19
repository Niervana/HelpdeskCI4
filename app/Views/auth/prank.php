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
                <div class="row align-items-center">
                    <div class="card">
                        <div class="col-sm" <div class="card-header">
                            <h4>Request Diedit</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon bg-danger">
                                    <i class="fas fa-times"></i>
                                </div>
                                <h2>HTTP Request Failed</h2>
                                <p class="lead">
                                    We tried it, but failed when requesting data to the server, sorry. (Code: <a href="#" class="bb">14045</a>)
                                </p>
                                <a href="#" class="btn btn-warning mt-4">Try Again</a>
                                <a href="#" class="mt-4 bb">Cancel</a>
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