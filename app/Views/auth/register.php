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

        /* Tambahan biar card CENTERRR */
        #app {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-8">
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
                                        <select class="form-control" name="departemen_karyawan" required>
                                            <option value="" disabled selected>Pilih Departemen</option>
                                            <option value="ACCOUNTING">ACCOUNTING</option>
                                            <option value="ADM MEKANIK">ADM MEKANIK</option>
                                            <option value="ADM PRODUKSI">ADM PRODUKSI</option>
                                            <option value="ADM SAMPLE">ADM SAMPLE</option>
                                            <option value="ASS. MD">ASS. MD</option>
                                            <option value="CMT">CMT</option>
                                            <option value="COMPLIANCE">COMPLIANCE</option>
                                            <option value="CUTTING">CUTTING</option>
                                            <option value="EXIM">EXIM</option>
                                            <option value="HR">HR</option>
                                            <option value="IE">IE</option>
                                            <option value="IT">IT</option>
                                            <option value="MARKER">MARKER</option>
                                            <option value="MD">MD</option>
                                            <option value="PACKING">PACKING</option>
                                            <option value="PPIC">PPIC</option>
                                            <option value="PSO">PSO</option>
                                            <option value="PURCHASING">PURCHASING</option>
                                            <option value="QA">QA</option>
                                            <option value="QC">QC</option>
                                            <option value="SALES">SALES</option>
                                            <option value="SAMPLE">SAMPLE</option>
                                            <option value="SEWING">SEWING</option>
                                            <option value="WAREHOUSE">WAREHOUSE</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email_users" required>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password_users" required>
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control" required>
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

                                    <div class="text-muted text-center">
                                        Already have an account? <a href="<?= base_url('login') ?>">Login</a>
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
            if (password.length >= 8) strength += 1;
            if (/\d/.test(password)) strength += 1;
            if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/.test(password)) strength += 1;
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