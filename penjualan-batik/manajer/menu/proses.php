<?php
require_once "../../_config/config.php";

if (isset($_POST['add'])) {
	$kd_menu = trim(mysqli_real_escape_string($con, $_POST['kd_menu']));
	$menu = trim(mysqli_real_escape_string($con, $_POST['menu']));
	$harga = trim(mysqli_real_escape_string($con, $_POST['harga']));
	$kd_kategori = trim(mysqli_real_escape_string($con, $_POST['kd_kategori']));
	$stok = trim(mysqli_real_escape_string($con, $_POST['stok']));
	$pict = $_FILES['gambar']['name'];
	$extensi = explode(".", $_FILES['gambar']['name']);
	$gambar = 'menu-' . round(microtime(true)) . "." . end($extensi);
	$sumber = $_FILES['gambar']['tmp_name'];

	if ($pict == '') {
		mysqli_query($con, "INSERT INTO tb_menu (kd_menu, menu, harga, kd_kategori, stok) VALUES ('$kd_menu', '$menu', '$harga',  '$kd_kategori', '$stok')") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil diinput'); window.location='data.php';</script>";
	} else {

		$location = "../../_assets/img/menu/";
		$upload = move_uploaded_file($sumber, $location . $gambar);
		if ($upload) {
			$cek = mysqli_query($con, "INSERT INTO tb_menu (kd_menu, menu, harga,  kd_kategori, stok, gambar) VALUES ('$kd_menu', '$menu', '$harga',  '$kd_kategori', '$stok', '$gambar')");
			echo "<script>alert('Data berhasil diinput. '); window.location='data.php';</script>";
		} else {
			echo "<script>alert('Data gagal diinput. Pastikan gambar yang di input, maksimal berukuran 1.5 MB'); window.location='data.php';</script>";
		}
	}
} else if (isset($_POST['edit'])) {
	$kd_menu = $_POST['kd_menu'];
	$menu = trim(mysqli_real_escape_string($con, $_POST['menu']));
	$harga = trim(mysqli_real_escape_string($con, $_POST['harga']));
	$kd_kategori = trim(mysqli_real_escape_string($con, $_POST['kd_kategori']));
	$stok = $_POST['stok'];

	$pict = $_FILES['gambar']['name'];
	$extensi = explode(".", $_FILES['gambar']['name']);
	$gambar = 'menu-' . round(microtime(true)) . "." . end($extensi);
	$sumber = $_FILES['gambar']['tmp_name'];

	if ($pict == '') {
		mysqli_query($con, "UPDATE tb_menu SET menu = '$menu', harga = '$harga',  kd_kategori = '$kd_kategori', stok = '$stok' WHERE kd_menu = '$kd_menu'") or die(mysqli_error($con));
		echo "<script>alert('Data berhasil di ubah'); window.location='data.php';</script>";
	} else {

		$location = "../../_assets/img/menu/";
		$upload = move_uploaded_file($sumber, $location . $gambar);

		if ($upload) {
			$sql = mysqli_query($con, "SELECT kd_menu, menu, harga,  kd_kategori, stok, gambar FROM tb_menu WHERE kd_menu = '$kd_menu'") or die(mysqli_error($con));
			$data = mysqli_fetch_array($sql);
			$gambar_awal = $data['gambar'];
			// unlink("../../_assets/img/menu/" . $gambar_awal);

			mysqli_query($con, "UPDATE tb_menu SET menu = '$menu', harga = '$harga',  kd_kategori = '$kd_kategori', stok = '$stok', gambar = '$gambar' WHERE kd_menu = '$kd_menu'") or die(mysqli_error($con));
			echo "<script>alert('Data berhasil di ubah'); window.location='data.php';</script>";
		} else {
			echo "<script>alert('Data gagal diubah. Pastikan gambar yang di input, maksimal berukuran 1.5 MB'); window.location='data.php';</script>";
		}
	}
}
