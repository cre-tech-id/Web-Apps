<?php
require_once "../../_config/config.php";
$op = isset($_GET['op']) ? $_GET['op'] : null;
if ($op == 'tampilkodemenu') {
    $data = mysqli_query($con, "select * from tb_menu");
    echo "<option>Kode Menu Barang</option>";
    while ($r = mysqli_fetch_array($data)) {
        echo "<option value='$r[kd_menu]'>$r[kd_menu]</option>";
    }
} else if ($op == 'ambildata') {
    $kode = $_GET['kode'];
    $dt = mysqli_query($con, "select a.kd_menu, a.menu, a.harga, a.stok, c.jenis, b.kategori from tb_menu a, tb_kategori b, tb_jenis c WHERE a.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis AND kd_menu='$kode'");
    $d = mysqli_fetch_array($dt);
    echo $d['menu'] . "|" . $d['harga'] . "|" . $d['jenis'] . "|" . $d['kategori'] . "|" . $d['stok'];
} else if ($op == 'menu') {
    $brg = mysqli_query($con, "SELECT a.kd_menu, d.menu, a.harga, c.jenis, b.kategori, a.jumlah, a.bayar, a.subtotal from tblsementara a, tb_kategori b, tb_jenis c, tb_menu d WHERE a.kd_menu = d.kd_menu AND d.kd_kategori = b.kd_kategori AND b.kd_jenis = c.kd_jenis");
    echo "<thead>
            <tr>
                <td>Kode Menu Barang</td>
                <td>Nama</td>
                <td>Jenis</td>
                <td>Kategori</td>
                <td>Harga</td>
                <td>Jumlah Beli</td>
                <td>Subtotal</td>
                <td>Tools</td>
            </tr>
        </thead>";
    $total = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));

    while ($r = mysqli_fetch_array($brg)) {
        echo "<tr>
                <td>$r[kd_menu]</td>
                <td>$r[menu]</td>
                <td>$r[jenis]</td>
                <td>$r[kategori]</td>
                <td>Rp. " . number_format($r['harga']) . "</td>
                <td>$r[jumlah]</td>
                <td>Rp. " . number_format($r['subtotal']) . "</td>
                <td><a href='proses.php?op=hapus&kd_menu=$r[kd_menu]' id='hapus'>Hapus</a></td>
                
            </tr>";
    }
    echo "<tr>
        <td colspan='6' align='right'><strong>Total</strong></td>
        <td colspan='1'>Rp. " . number_format($total['total']) . "</td>
        <td></td>
    </tr>";
    echo "<tr>
        <td colspan='6' align='right'><strong>Bayar</strong></td>
        <input value=" . number_format($total['total']) . " tabindex='19' type='hidden' name='total' id='total' value='0' maxlength='15' class='form-control color-select' onclick='this.select()' onKeyPress='return numbersonly(this, event);' onkeyup='this.value=formatCurrency(total.value); hit_susut()'>
        <td colspan='1'><input  tabindex='19' type='text' name='nominal_bayar' id='nominal_bayar' value='0' maxlength='15' class='form-control color-select' onclick='this.select()' onKeyPress='return numbersonly(this, event);' onkeyup='this.value=formatCurrency(nominal_bayar.value); hit_susut()'></td>
    </tr>";
    echo "<tr>
        <td colspan='6' align='right'><strong>Kembalian</strong></td>
        <td colspan='1'><input disable readonly class='form-control color-select' type='text' name='kembalian' id='kembalian'></td>
        <td></td>
    </tr>";
} else if ($op == 'tambahmenu') {
    $kd_menu = $_GET['kode'];
    $harga = $_GET['harga'];
    $jumlah = $_GET['jumlah'];
    // $tunai = $_GET['tunai'];
    $subtotal = $harga * $jumlah;
    // $kembalian = $tunai - $kembalian;

    $tambah = mysqli_query($con, "INSERT into tblsementara (kd_menu, harga, jumlah, subtotal)
                        values ('$kd_menu', '$harga','$jumlah','$subtotal')");
    if ($tambah) {
        echo "sukses";
    } else {
        echo "ERROR";
    }
} else if ($op == 'hapus') {
    $kode = $_GET['kd_menu'];
    $del = mysqli_query($con, "delete from tblsementara where kd_menu='$kode'");
    if ($del) {
        echo "<script>window.location='add.php';</script>";
    } else {
        echo "<script>alert('Hapus Data Berhasil');
                window.location='add.php';</script>";
    }
} else if ($op == 'bayar') {
    // $kode = $_GET['kd_menu'];

    $to = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));
    $tot = $to['total'];
    $buy = (mysqli_query($con, "select tunai tblsementara"));
    $bayar = $buy;
    $kembalian = $bayar - $tot;
    $byr = mysqli_query($con, "INSERT INTO from tblsementara (tunai, kembalian) VALUES ('$bayar','$kembalian') ");
    if ($byr) {
        echo "<script>window.location='add.php';</script>";
    } else {
        echo "<script>alert('Pembayaran Gagal');
                window.location='add.php';</script>";
    }
} elseif ($op == 'proses') {
    $nota = $_GET['nota'];
    $tanggal = $_GET['tanggal'];
    $to = mysqli_fetch_array(mysqli_query($con, "select sum(subtotal) as total from tblsementara"));
    $tot = $to['total'];
    $bayar = $_GET['bayar'];
    $simpan = mysqli_query($con, "insert into penjualan(nonota,tanggal,total, bayar)
                        values ('$nota','$tanggal','$tot','$bayar')");

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
}
