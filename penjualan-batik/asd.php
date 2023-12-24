<pre>

<?php
error_reporting (0);
include “koneksi.php”;
?>
<!DOCTYPE html>
<html lang=”en”>
<head>
    <title> Belajar Validasi</title>
    <!– Bootstrap Core CSS –>
    <link href=”bootstrap/css/bootstrap.min.css” rel=”stylesheet”>
</head>
<div class=”container”>
<nav class=”navbar navbar-expand-sm bg-info navbar-dark “>
  <!– Brand/logo –>
  <a class=”navbar-brand” href=”#”>Validasi
  </a>
  <!– Links –>
  <ul class=”navbar-nav ml-auto”>
    <li class=”nav-item”>
      <a class=”btn btn-info dropdown” href=”http://localhost/validasi/index.php” role=”button”>Home</a>
    </li>
    <li class=”nav-item”>
      <a class=”btn btn-info dropdown” href=”http://localhost/validasi/view.php” role=”button”>View</a>
    </li>
  </ul>
</nav>
</div>
<body>
<!– alamat dan lokasi –>
<div class=”container”>
  <div class=”row”>
    <div class=”col-8″>
      <br>
        <h2>Form Registrasi </h2>
    <b>
    <div class=”col”>
      <div class=”col-md-12″>
             <form role=”form” method = “POST” action=””>
                  <div class=”box-body”>
                    <div class=”form-group”>
                      <label for=”exampleInputUsername”>Usernama</label>
                      <input type=”text” class=”form-control” id=”username” name=”username” placeholder=”Usernama” required data-fv-notempty-message=”Tidak boleh kosong”>
                    </div>
                     <div class=”form-group”>
                      <label for=”exampleInputPassword”>Password</label>
                      <input type=”password” class=”form-control” id=”password” name=”password” placeholder=”Password” required data-fv-notempty-message=”Tidak boleh kosong”>
                    </div>
                    <div class=”form-group”>
                      <label for=”exampleInputEmail1″>Email</label>
                      <input type=”text” class=”form-control” id=”email” name=”email” placeholder=”Email” required data-fv-notempty-message=”Tidak boleh kosong”>
                    </div>
                  </div><!– /.box-body –>
                  <button type=”submit” name = ‘add’  class=”btn btn-info”>Simpan</button>
              &nbsp;
              <button type=”reset” class=”btn btn-success”>Reset</button>
            </form>
            <?php
//proses
    if(isset($_POST[‘add’])) {
    $username=$_POST[‘username’];
    $password=md5($_POST[‘password’]);
    $email=$_POST[’email’];
//script PERINTAH MENGECEK AGAR TIDAK TERDAPAT USER dan EMAIL YANG SAMA
    $cek = mysql_num_rows(mysql_query(“SELECT * FROM user WHERE username=’$username’ or email=’$email'”));
    if ($cek > 0){
    echo “<script>window.alert(‘nama atau email yang anda masukan sudah ada’)
    window.location=’index.php'</script>”;
    }else {
    mysql_query(“INSERT INTO user(iduser,username,password, email)
    VALUES (”,’$username’,’$password’,’$email’)”);
    echo “<script>window.alert(‘DATA SUDAH DISIMPAN’)
    window.location=’index.php
    </script>”;
    }
    
    ?>
    </div>
    </b>
   </div>
  </div>
 </div>
<br>
<br>
</body>
<footer class=”main-footer”>
            <div class=”container”>
              <center>
              <strong>Copyright &copy; 2020 <a href=”#”>Validasi</a></strong>
    </center>
            </div><!– /.container –>
</footer>
</html>
</pre>