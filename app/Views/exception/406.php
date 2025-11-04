<?php

use App\Controllers\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>IT INVENTORY</title>

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
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h1>406</h1>
                        <div class="page-description">
                            the request from the browser cannot be fulfilled by the server.
                        </div>

                        <div class="mt-3">
                            <a href="/nirvana/public/">Back to Home</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="simple-footer mt-5">

                Copyright &copy; 2023 <div class="bullet"></div> Developed By <a href="#">Nirvana Rahadian</a>
                <a href="https://instagram.com/nirvhd"><i class="fa-brands fa-instagram"></i></a>
                <a href="mailto:kharismanirvana@gmail.com"><i class="fa-regular fa-envelope"></i></a>

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