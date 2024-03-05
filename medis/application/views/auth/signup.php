<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets'); ?>/img/fav.png">
    <link rel="icon" type="image/png" href="<?= base_url('assets'); ?>img/fav.png">
    <title>
        Sign Up Page!
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets'); ?>/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url('assets'); ?>/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href=".<?= base_url('assets'); ?>/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets'); ?>/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-5">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                        project for free.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register Page!</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('auth/register'); ?>" method="POST" role="form">
                                <div class="mb-3">
                                    <input type="text" required name="nama" class="form-control" placeholder="Name"
                                        aria-label="Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" required name="email" class="form-control" placeholder="Email"
                                        aria-label="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" required name="password" class="form-control"
                                        placeholder="Password" aria-label="Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="<?= base_url('auth'); ?>"
                                        class="text-primary text-gradient font-weight-bold">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Penkes Edukasi
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?= base_url('assets'); ?>/js/core/popper.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets'); ?>/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>