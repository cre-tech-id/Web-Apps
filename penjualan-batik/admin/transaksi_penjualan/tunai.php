<?php
// koneksi database
require_once "../../_config/config.php";

// menangkap data yang di kirim dari form
// $id = $_POST['nonota'];
$bayar = $_POST['bayar'];
$total = $_GET['subtotal'];
$kembalian = $bayar - $total;

// update data ke database
$cek = mysqli_query($con, "INSERT INTO tblsementara VALUES ('',bayar='$bayar', kembalian='$kembalian')");
mysqli_error($con, $cek);


// mengalihkan halaman kembali ke index.php
header("location:add.php");
