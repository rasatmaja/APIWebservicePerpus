<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webservice Perputakaan Pusat Universitas Brawijaya</title>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/puse-icons-feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/fav.png" />
    <script>
        $(document).ready(function() {
            $("#nim").keyup(function() { 
                var num = $("#nim").val(); 
                if (num.length > 0) {
                    if (!isNaN(num)) {
                        $('#nim-indicator').removeClass('text-danger').addClass('text-success');
                        $('#nim-text').text('');
                    } else {
                        $('#nim-indicator').removeClass('text-success').addClass('text-danger');
                        $('#nim-text').text('tidak boleh ada karakter selain angka!');
                        $('#nim-text').removeClass('text-success').addClass('text-danger');
                    }
                } else {
                    $('#nim-indicator').removeClass('text-success').addClass('text-danger');
                    $('#nim-text').text('tidak boleh kosong!');
                    $('#nim-text').removeClass('text-success').addClass('text-danger');
                }
            });
            $("#password").keyup(function() { 
                var num = $("#password").val(); 
                if (num.length > 0) {
                        $('#password-indicator').removeClass('text-danger').addClass('text-success');
                        $('#password-text').text('');
                    } else {
                    $('#password-indicator').removeClass('text-success').addClass('text-danger');
                    $('#password-text').text('tidak boleh kosong!');
                    $('#password-text').removeClass('text-success').addClass('text-danger');
                }
            });
        });
    </script>
</head>
<style>
        body, html {
        height: 100%;
    }

    .bg { 
        /* The image used */
        background-image: url("assets/images/ub.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
<body class="bg">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper">
                            <form action="api-management/login/" method="post">
                                <h3 class="text-center">DIGITAL LIBRARY UNIVERSITAS BRAWIJAYA</h3>
                                <div class="form-group">
                                    <label class="label">USERNAME</label>
                                    <div class="input-group">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="PLEASE INSERT YOUR NIM">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                        <i id="nim-indicator" class="text-danger mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                    <label id="nim-text" style="margin:5px 0px 0px 0px;"></label>
                                </div>
                                <div class="form-group">
                                    <label class="label">PASSWORD</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="*********">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                        <i id="password-indicator" class="text-danger mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                    <label id="password-text" style="margin:5px 0px 0px 0px;"></label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn btn-block">MASUK</button>
                                </div>
                                <?php if($_SESSION["failedLoginStatus"]==true){ ?>
                                    <p class="text-center text-danger">MAAF, USERNAME ATAU PASSWORD ANDA SALAH!</p>
                                <?php 
                                $_SESSION["failedLoginStatus"] = false;
                                } ?>
                            </form>
                        </div>
                        <ul class="auth-footer">

                        </ul>
                        <p class="footer-text text-center"><a class="text-white" href="<?php echo base_url(); ?>">SIAM PKL PERPUSTAKAAN UB © 2018</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
</body>

</html>