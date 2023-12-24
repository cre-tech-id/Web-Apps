<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Web Kesenian</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/base/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/assets/base/css/fontawesome.css">
    <link rel="stylesheet" href="/assets/base/css/templatemo-digimedia-v1.css">
    <link rel="stylesheet" href="/assets/base/css/animated.css">
    <link rel="stylesheet" href="/assets/base/css/owl.css">
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
    @include('layout.base.navbar')
    @yield('content')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2023 Web Kesenian. All Rights Reserved.
                        <br>By: <a href="" target="_parent" title="free css templates">Ivan</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/assets/base/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/base/js/owl-carousel.js"></script>
    <script src="/assets/base/js/animation.js"></script>
    <script src="/assets/base/js/imagesloaded.js"></script>
    <script src="/assets/base/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="/assets/dashboard/js/flashscripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        $(document).on('click', '.open_modal', function() {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/kesenianjs/" + id,
                success: function(response) {
                    $('#id').val(response.id);
                    console.log(response)
                }
            });
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.pesan_karya', function() {
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "/karyajs/" + id,
                success: function(response) {
                    $('#id').val(response.id);
                    console.log(response)
                }
            });
        });
    });
    </script>

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
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" type="text/css" />
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script> -->
    <script type="text/javascript">
        $(function() {
            $("#txtDate").datepicker({
                dateFormat: 'dd/mm/yy',
                minDate: '0',
            });
        });
    </script>
</body>

</html>