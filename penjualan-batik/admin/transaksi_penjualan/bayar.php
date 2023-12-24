<?php include_once('../_header.php'); ?>
<br>
<br>

<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>PEMBAYARAN</strong>
                </div>
                <?php include_once('../jam&tanggal.php'); ?>
            </div>
        </h1>
        <ol class="breadcrumb alert alert-info">
            <li class="active" style="font-size: 18px; font-family: cursive;">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Transaksi Penjualan > Pembayaran
            </li>
        </ol>
    </div>
</div>
<?php
include_once('../../_config/config.php');
$tgl = date("Y-m-d");
$query = "SELECT max(nonota) as maxnonota FROM penjualan";
$hasil = mysqli_query($con, $query);
$data  = mysqli_fetch_array($hasil);
$nonota = $data['maxnonota'];
$q = "SELECT * FROM tblsmentara";
// $total = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($nonota, 4, 7);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%05s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%05s", 12); maka akan dihasilkan '00012'
// atau misal sprintf("%05s", 1); maka akan dihasilkan string '00001'
$char = "NOTA";
$newID = $char . sprintf("%07s", $noUrut);
?>
<form>
    <div class="form-group">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"><label>Nota</label></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type='text' class='form-control' id='nota' value='<?= $newID ?>' disabled>
                </div>
                <div class="col-md-2">
                    <input type='text' class='form-control' id='tanggal' value='<?= $tgl ?>' disabled>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2">
                    <label>Total Pembayaran</label>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <input type="hidden" name="nota" value="<?php echo $d['nonota']; ?>">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="total" value='<?= $total ?>' disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="tunai" name="tunai" placeholder="Jumlah Uang">
                </div>
                <div class="col-md-2">
                    <a href="tunai.php" class="btn btn-success">Bayar</a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <span id="status"></span>
                </div>
            </div>

            <div class="table-responsive">
                <table id="tabelmenu" class="table table-striped table-bordered table-hover">
                </table>
            </div>

        </div>
    </div>
</form>
<?php include_once('../_footer.php'); ?>