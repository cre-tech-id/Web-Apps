<?php
// koneksi database
require_once "../../_config/config.php";

// menangkap data yang di kirim dari form
// $id = $_POST['nonota'];
$nominal_bayar = $_POST['nominal_bayar'];
$nota = $_POST['nota'];
$tanggal = $_POST['tanggal'];
$nominal_bayar = str_replace(",", "", $nominal_bayar);
$to = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));
$tot = $to['total'];
$kembalian = $nominal_bayar - $tot;


$simpan = mysqli_query($con, "insert into penjualan(nonota,tanggal,total, bayar, kembalian)
                        values ('$nota','$tanggal','$tot','$nominal_bayar','$kembalian')");

if ($simpan) {
    $query = mysqli_query($con, "select * from tblsementara");
    while ($r = mysqli_fetch_row($query)) {
        mysqli_query($con, "INSERT INTO detailpenjualan(nonota,kd_menu,harga,jumlah,subtotal)
                        values('$nota','$r[0]','$r[1]','$r[2]','$r[3]')");
        mysqli_query($con, "UPDATE tb_menu set stok=stok-'$r[2]'
                        where kd_menu='$r[0]'");
    }
    //hapus seluruh isi tabel sementara
    mysqli_query($con, "truncate table tblsementara");
    echo "sukses";
} else {
    echo "ERROR";
}

// mengalihkan halaman kembali ke index.php
header("location:add.php");
