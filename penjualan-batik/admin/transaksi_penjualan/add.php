<?php include_once('../_header.php'); ?>
<script>
    //mendeksripsikan variabel yang akan digunakan
    var nota;
    var tanggal;
    var kode;
    var menu;
    var harga;
    var jenis;
    var kategori;
    var stok;
    var bayar;
    var kembalian;
    var jumlah;
    $(function() {
        //meload file pk dengan operator ambil barang dimana nantinya
        //isinya akan masuk di combo box
        $("#kode").load("proses.php", "op=tampilkodemenu");

        //meload isi tabel
        $("#tabelmenu").load("proses.php", "op=menu");

        //mengkosongkan input text dengan masing2 id berikut
        $("#menu").val("");
        $("#harga").val("");
        $("#jenis").val("");
        $("#kategori").val("");
        $("#stok").val("");
        $("#jumlah").val("");

        //jika ada perubahan di kode barang 
        $("#kode").change(function() {
            kode = $("#kode").val();

            //tampilkan status loading dan animasinya
            $("#status").html("loading. . .");
            $("#loading").show();

            //lakukan pengiriman data
            $.ajax({
                url: "proses.php",
                data: "op=ambildata&kode=" + kode,
                cache: false,
                success: function(msg) {
                    data = msg.split("|");

                    //masukan isi data ke masing - masing field
                    $("#menu").val(data[0]);
                    $("#harga").val(data[1]);
                    $("#jenis").val(data[2]);
                    $("#kategori").val(data[3]);
                    $("#stok").val(data[4]);
                    $("#jumlah").focus();
                    //hilangkan status animasi dan loading
                    $("#status").html("");
                    $("#loading").hide();
                }
            });
        });

        $("#bayar").click(function() {
            kode = $("#kode").val();
            bayar = $("#bayar").val();
            if (bayar == "Null") {
                alert("Masukan Jumlah Uang");
                exit();
            }
            kembalian = $("#kembalian").val();

            //tampilkan status update
            $("#status").html('sedang diupdate. . .');
            $("#loading").show();

            $.ajax({
                url: "proses.php",
                data: "op=bayar&kode=" + kode + "&tbayar" + bayar + "&kembalian" + kembalian,
                cache: false,
                success: function(msg) {
                    if (msg == 'Sukses') {
                        $("#status").html('Pembayaran Berhasil. . .');
                    } else {
                        $("#status").html('ERROR. . .')
                    }
                    $("#loading").hide();
                    $("#barang").load("proses.php", "op=barang");
                    $("#kode").load("proses.php", "op=kode");
                }
            });
        });
        //jika tombol tambah di klik
        $("#tambah").click(function() {
            kode = $("#kode").val();
            stok = $('#stok').val();
            jumlah = $("#jumlah").val();
            if (kode == "Kode Barang") {
                alert("Kode Barang   Harus diisi");
                exit();
            } else if (jumlah > stok) {
                alert("Stok tidak terpenuhi");
                $("#jumlah").focus();
                exit();
            } else if (jumlah < 1) {
                alert("Jumlah beli tidak boleh 0");
                $("#jumlah").focus();
                exit();
            }
            $bayar = $("#bayar").val();
            menu = $("#menu").val();
            harga = $("#harga").val();
            jenis = $("#jenis").val();
            kategori = $("#kategori").val();
            stok = $("#stok ").val();

            $("#status").html("sedang diproses. . .");
            $("#loading").show();

            $.ajax({
                url: "proses.php",
                data: "op=tambahmenu&kode=" + kode + "&harga=" + harga + "&jumlah=" + jumlah + "&stok=" + stok + "&tunai" + bayar,
                cache: false,
                success: function(msg) {
                    if (msg == "sukses") {
                        $("#status").html("Berhasil disimpan. . .");
                    } else {
                        $("#status").html("ERROR. . .");
                    }
                    $("#loading").hide();
                    $("#menu").val("");
                    $("#jenis").val("");
                    $("#kategori").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                    $("#bayar").val("");
                    $("#kode").load("proses.php", "op=tampilkodemenu");
                    $("#tabelmenu").load("proses.php", "op=menu");
                }
            });
        });

        //jika tombol proses diklik
        $("#proses").click(function() {
            nota = $("#nota").val();
            tanggal = $("#tanggal").val();
            bayar = $("#bayar").val();

            $.ajax({
                url: "proses.php",
                data: "op=proses&nota=" + nota + "&tanggal=" + tanggal + "&bayar" + bayar,
                cache: false,
                success: function(msg) {
                    if (msg == 'sukses') {
                        $("#status").html('Transaksi Pembelian berhasil');
                        alert('Transaksi Berhasil');
                        window.location.replace('index.php');
                        exit();
                    } else {
                        $("#status").html('Transaksi Gagal');
                        alert('Transaksi Gagal');
                        exit();
                    }
                    $("#kode").load("proses.php", "op=tampilkodemenu");
                    $("#tabelmenu").load("proses.php", "op=menu");
                    $("#loading").hide();
                    $("#menu").val("");
                    $("#jenis").val("");
                    $("#kategori").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                }
            })
        })
    });
</script>

<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>PENJUALAN</strong>
                </div>
                <?php include_once('../jam&tanggal.php'); ?>
            </div>
        </h1>
        <ol class="breadcrumb alert alert-info">
            <li class="active" style="font-size: 18px; font-family: cursive;">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Transaksi Penjualan > Tambah Data Transaksi
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
<script>
    function numbersonly(myfield, e, dec) {
        var key;
        var keychar;
        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);
        // control keys
        if ((key == null) || (key == 0) || (key == 8) ||
            (key == 9) || (key == 13) || (key == 27))
            return true;
        // numbers
        else if ((("0123456789").indexOf(keychar) > -1))
            return true;
        // decimal point jump
        else if (dec && (keychar == ".")) {
            myfield.form.elements[dec].focus();
            return false;
        } else
            return false;
    }

    function formatCurrency(num) {
        num = num.toString().replace(/\Rp.|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        //cents = num%100;
        num = Math.floor(num / 100).toString();
        //if(cents<10)
        //cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' +
            num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num);
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") //1,000,000
    }

    function hit_susut() {
        var hrg = document.getElementById('nominal_bayar').value;
        var umur = document.getElementById('total').value;
        var susut = 0;
        hrg = hrg.replace(/\,/g, ''); // var a='1,125'; 1125, but a string, so convert it to number
        hrg = parseInt(hrg, 10);

        umur = umur.replace(/\,/g, ''); // var a='1,125'; 1125, but a string, so convert it to number
        umur = parseInt(umur, 10);


        susut = Math.floor(parseInt(hrg) - parseInt((umur)));
        hrg = formatNumber(hrg); //1000000 -> 1,000,000 
        //if(!isNaN(susut)){
        document.getElementById('kembalian').value = formatNumber(susut); //1000000 -> 1,000,000

        //}
    }
</script>



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
                    <label>Pilih Barang</label>
                    <br>
                    <select id="kode" class="form-control"></select>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="menu" placeholder="Menu" disabled>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control" id="harga" placeholder="Harga" disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="jenis" placeholder="Jenis" disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="kategori" placeholder="Kategori" disabled>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="stok" placeholder="stok" disabled>
                </div>
                <div class="col-md-2">
                    <input type="number" id="jumlah" class="form-control" placeholder="Jumlah" class="span1">
                </div>
                <!-- <div class="col-md-2">
                    <input type="number" id="tunai" name="tunai" class="form-control" placeholder="Jumlah Uang" class="span1">
                </div> -->
                <hr>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" id="tambah">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah
                    </button>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <span id="status"></span>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-2">
                    <label>Daftar Barang yang Dibeli</label>
                </div>
            </div>
            <div class="table-responsive">
                <table id="tabelmenu" class="table table-striped table-bordered table-hover">
                </table>
            </div>
            <div class="row" style="margin-top: 20px;">
                <div class="alert alert-success">
                    <button type="button" class="btn btn-success simpan_all" id="simpan_all">
                        <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.simpan_all', function() {
                var nota = $('#nota').val();
                var tanggal = $('#tanggal').val();
                var nominal_bayar = $('#nominal_bayar').val();
                $.ajax({
                    type: 'POST',
                    url: 'pembayaran.php',
                    data: 'nota=' + nota +
                        '&tanggal=' + tanggal +
                        '&nominal_bayar=' + nominal_bayar,
                    success: function(response) {
                        console.log(response);

                        setTimeout(' window.location.href = "add.php"; ', 1000);

                    }
                });
            });

        });
    </script>


    <?php include_once('../_footer.php'); ?>