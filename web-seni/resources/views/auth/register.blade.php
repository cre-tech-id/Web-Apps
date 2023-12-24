<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/dashboard/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Register</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/dashboard/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/dashboard/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/dashboard/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/assets/dashboard/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/assets/dashboard/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/dashboard/js/config.js"></script>
  <style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
  </head>

  <body>
  <div class="flash-error" data-flashdata="{{ session('message') }}"></div>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <!-- /Logo -->
              <h4 class="mb-2">Daftarkan akun anda disini</h4>
              <form id="form_regist" class="mb-3" action="{{route('doregister')}}" enctype='multipart/form-data' method="POST">
              @csrf
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Anda" autofocus  required/>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email Anda" required />
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukan Tempat lahir Anda" required/>
                </div>
                <div class='mb-3'>
                  <label for="alamat" class="form-label">Tanggal Lahir</label>
                  <div class="input-group">
                      <input id="txtDate" name="tanggal" type="text" class="form-control date-input" readonly="readonly" required />
                      <label class="input-group-btn" for="txtDate">
                          <span class="btn btn-default">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </label>
                  </div>
              </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Agama</label>
                  <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukan Agama Anda" required/>
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Anda" required/>
                </div>
                <div class="mb-3">
                  <label for="no" class="form-label">Nomor Hp</label>
                  <input type="text" class="form-control" id="nomor_hp" name="no_hp" placeholder="Masukan Nomor Hp Anda" required />
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role_id">
                        <option selected>Saya sebagai?</option>
                        <option value="2">Seniman</option>
                        <option value="3">Pengguna</option>
                    </select>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password"> Password</label>
                  <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                  <div id="message">
                      <h4>Password must contain the following:</h4>
                      <p id="letter" class="invalid">Huruf<b> kecil</b></p>
                      <p id="capital" class="invalid">Huruf <b> Kapital</b></p>
                      <p id="number" class="invalid"><b>Angka</b></p>
                      <p id="length" class="invalid">Minimal <b>8 karakter</b></p>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="password">Konfirmasi Password</label>
                    <input
                      type="password"
                      id="confirmpassword"
                      class="form-control"
                      name="confirmpassword"
                      aria-describedby="password" required
                      />
                </div>
                <div class="mb-3">
                  <label for="foto" class="form-label">Foto</label>
                  <input type="file" accept="image/*" class="form-control" id="foto" name="foto" required />
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Daftar</button>
              </form>
              <p class="text-center">
                <span>Sudah punya akun?</span>
                <a href="{{route('login')}}">
                  <span>masuk disini</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/dashboard/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/dashboard/vendor/libs/popper/popper.js"></script>
    <script src="/assets/dashboard/vendor/js/bootstrap.js"></script>
    <script src="/assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/dashboard/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/dashboard/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="/assets/dashboard/js/flashscripts.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css' media="screen" />
    <!-- Bootstrap -->
    <!-- Bootstrap DatePicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap DatePicker -->
    <script type="text/javascript">
        $(function () {
            $('#txtDate').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
    <script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
  </body>
</html>