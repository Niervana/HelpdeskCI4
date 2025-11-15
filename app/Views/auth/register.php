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
            <div class="container">
                <div class="row">

                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <a href=" <?= base_url('/'); ?>" class="logo">
                                <img src='lgo.png' alt="LOGO 100X500.png" style="width: 300px; object-fit: contain; object-position: center center;" srcset="" fetchpriority="high">
                            </a>
                        </div>
                        <div class="card card-primary">

                            <div class="card-body">
                                <form action="<?= site_url('register') ?>" method="post" autocomplete="off" onsubmit="return validatePassword();">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" required>
                                        <input type="hidden" name="role" value="2">
                                    </div>
                                    <div class="form-group">
                                        <label>Departemen</label>
                                        <input type="text" class="form-control" name="departemen_karyawan" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email_users">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password_users">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control">
                                            <input type="hidden" name="createdat_users" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="agree">
                                            <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="registerButton" disabled class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <script src="<?= base_url() ?>/template/node_modules/moment/min/moment.min.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const passwordIndicator = document.getElementById('pwindicator');
        const passwordLabel = passwordIndicator.querySelector('.label');
        const passwordBar = passwordIndicator.querySelector('.bar');

        function getPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) {
                strength += 1;
            }
            if (/\d/.test(password)) {
                strength += 1;
            }
            if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/.test(password)) {
                strength += 1;
            }
            return strength;
        }
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = getPasswordStrength(password);
            switch (strength) {
                case 0:
                    passwordLabel.textContent = 'Very Weak';
                    passwordBar.style.width = '10%';
                    passwordBar.style.backgroundColor = '#ff4d4d';
                    break;
                case 1:
                    passwordLabel.textContent = 'Weak';
                    passwordBar.style.width = '30%';
                    passwordBar.style.backgroundColor = '#ff4d4d';
                    break;
                case 2:
                    passwordLabel.textContent = 'Medium';
                    passwordBar.style.width = '50%';
                    passwordBar.style.backgroundColor = '#ffc107';
                    break;
                case 3:
                    passwordLabel.textContent = 'Strong';
                    passwordBar.style.width = '100%';
                    passwordBar.style.backgroundColor = '#28a745';
                    break;
                default:
                    break;
            }
        });

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password2").value;
            if (password != confirmPassword) {
                alert("Password confirmation does not match.");
                return false;
            }
            return true;
        }
        var agreeCheckbox = document.getElementById("agree");
        var registerButton = document.getElementById("registerButton");
        agreeCheckbox.addEventListener("change", function() {
            registerButton.disabled = !agreeCheckbox.checked;
        });
    </script>
</body>

</html>