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
            overflow: hidden;
            height: 100vh;
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
    <div id="app" class="noselect">
        <section class=" section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <a href=" <?= base_url('/'); ?>" class="logo">
                                <img src='lgo.png' alt="LOGO WILLBES" style="width: 200px; object-fit: contain; object-position: center center;" srcset="" fetchpriority="high">
                            </a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header d-flex justify-content-center align-items-center">
                                <h4 class="m-0">IT Inventory PT. Willbes Global</h4>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">x</button>
                                            <b>Error!</b>
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form method="POST" action="<?= site_url('Auth/loginProcess') ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please eusi in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="invalid-feedback">
                                                Please eusi in your password
                                            </div>
                                            <div class="float-right">
                                                <a href="forgot" class="text-small">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                            <span class="input-group-text" onclick="togglePassword()"><i id="password-toggle" class="fa fa-eye"></i></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Tolong isi password Anda.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                    <div class=" text-muted text-center">
                                        Don't have an account? <a href="register">Create One</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        // Simpan data login jika checkbox "remember me" dicentang 
        const rememberMeCheckbox = document.querySelector('[name="remember" ]');
        const usernameInput = document.querySelector('[name="email" ]');
        const passwordInput = document.querySelector('[name="password" ]');
        rememberMeCheckbox.addEventListener('change', (e) => {
            if (e.target.checked) {
                // Simpan data login ke localStorage atau cookie
                localStorage.setItem('email', usernameInput.value);
                localStorage.setItem('password', passwordInput.value);
            } else {
                // Hapus data login dari localStorage atau cookie
                localStorage.removeItem('email');
                localStorage.removeItem('password');

            }
        });

        // Isi fields login dengan data yang disimpan jika tersedia
        if (localStorage.getItem('email') && localStorage.getItem('password')) {
            usernameInput.value = localStorage.getItem('email');
            passwordInput.value = localStorage.getItem('password');
            rememberMeCheckbox.checked = true;
        }

        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordToggle = document.getElementById("password-toggle");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.classList.remove("fa-eye");
                passwordToggle.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                passwordToggle.classList.remove("fa-eye-slash");
                passwordToggle.classList.add("fa-eye");
            }
        }
    </script>
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