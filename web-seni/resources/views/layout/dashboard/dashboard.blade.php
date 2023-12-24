<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/dashboard/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/dashboard/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/dashboard/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/dashboard/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/dashboard/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />

    <style>
    .log {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .log:hover {
        transform: scale(1.1);
    }

    svg {
        height: 80px;
    }
    </style>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/dashboard/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/dashboard/js/config.js"></script>
</head>

<body>
    @include('layout.dashboard.sidebar')
    @yield('content')

    <!-- / Content -->
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                document.write(new Date().getFullYear());
                </script>
                made by
                <a href="#" class="footer-link fw-bolder">IVAN</a>
            </div>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/dashboard/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/dashboard/vendor/libs/popper/popper.js"></script>
    <script src="/assets/dashboard/vendor/js/bootstrap.js"></script>
    <script src="/assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/dashboard/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/dashboard/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/assets/dashboard/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/dashboard/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#btn_send").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{route('store')}}",
            data: {
                pesan: $("#pesan").val(),
                sender: $("#sender").val(),
                receiver: $("#receiver").val()
            },
        });
        document.getElementById("chat").reset();
    });
    </script>
</body>

</html>
