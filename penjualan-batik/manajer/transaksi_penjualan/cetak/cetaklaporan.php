<?php
require_once("../../../_config/config.php");
require_once("../../../vendor/autoload.php");

// $mpdf = new \Mpdf\Mpdf();
// ob_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Cetak Laporan</title>
  <style type="text/css">
    .tabel {
      border-collapse: collapse;
    }

    .header {
      padding: 4mm;
      background-color: #31B0D5;
      border: 1px solid;
      text-align: center;
    }

    .tabel th {
      padding: 10px 5px;
      background-color: #D9EDF7;
      color: black;
      font-size: 13px;
      text-align: center;
    }

    .tabel td {
      padding: 5px 5px;
      background-color: #ffffff;
      color: black;
      font-size: 12px;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="header">
    <strong><span style="font-size:25px;">BATIK FAIRUZ PEKALONGAN</span></strong>
  </div>
  <br>
  <table border="0" class="tabel">';
    <?php

    $sql_penjualan = mysqli_query($con, "SELECT * FROM penjualan order by nonota asc") or die(Mysqli_error($con));
    while ($data = mysqli_fetch_array($sql_penjualan)) {
      $tgl = $data['tanggal'];
      $tanggal = date('d F Y', strtotime($tgl));
    ?>
      <tr>
        <td colspan="2">
          <table cellspacing="0" cellpadding="0" border="1">
            <tr>
              <th colspan="4" style="border-right:0;"></th>
              <th style="border-left:0;"><strong>Nota</strong></th>
              <td style="font-size:13px; background-color:#EEFFFF;"><?= $data['nonota'] ?></td>
            </tr>
            <tr>
              <th colspan="4" style="border-right:0;"></th>
              <th style="border-left:0;"><strong>Tanggal</strong></th>
              <td style="font-size:13px; background-color:#EEFFFF;"><?= $tanggal ?></td>
            </tr>
            <tr>
              <th style="width:250px;">Menu</th>
              <th style="width:40px;">Jenis</th>
              <th style="width:80px;">Kategori</th>
              <th style="width:83px;">Harga</th>
              <th style="width:30px;">Jumlah</th>
              <th style="width:110px;">Subtotal</th>
            </tr>
            <?php
            $query_mysql = mysqli_query($con, "SELECT b.menu, d.jenis, c.kategori, a.harga, a.jumlah, a.subtotal FROM detailpenjualan a, tb_menu b, tb_kategori c, tb_jenis d, penjualan e WHERE e.nonota = a.nonota AND a.kd_menu = b.kd_menu AND b.kd_kategori = c.kd_kategori AND c.kd_jenis = d.kd_jenis AND e.nonota = '" . $data['nonota'] . "'") or die(mysqli_error($con));
            while ($r = mysqli_fetch_array($query_mysql)) {
            ?>
              <tr>
                <td><?= $r['menu'] ?></td>
                <td><?= $r['jenis'] ?></td>
                <td><?= $r['kategori'] ?></td>
                <td>Rp <?= number_format($r['harga'], 2, ",", ".") ?></td>
                <td><?= $r['jumlah'] ?></td>
                <td>Rp <?= number_format($r['subtotal'], 2, ",", ".") ?></td>
              </tr>
            <?php
            }
            ?>
            <tr>
              <th colspan="4" style="border-right:0;"></th>
              <th style="border-left:0;"><strong>Total</strong></th>
              <td style="font-size:13px; background-color:#EEFFFF;">Rp. <?= number_format($data['total'], 2, ",", ".") ?></td>
            </tr>
            <tr>
              <th colspan="4" style="border-right:0;"></th>
              <th style="border-left:0;"><strong>Bayar</strong></th>
              <td style="font-size:13px; background-color:#EEFFFF;">Rp. <?= number_format($data['bayar'], 2, ",", ".") ?></td>
            </tr>
            <tr>
              <th colspan="4" style="border-right:0;"></th>
              <th style="border-left:0;"><strong>Kembalian</strong></th>
              <td style="font-size:13px; background-color:#EEFFFF;">Rp. <?= number_format($data['kembalian'], 2, ",", ".") ?></td>
            </tr>
          </table>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>


// require_once('../../../_assets/libs/vendor/autoload.php');

// use Spipu\Html2Pdf\Html2Pdf;

// $html2pdf = new Html2Pdf('P','A4','en');
// $html2pdf->pdf->SetDisplayMode('fullpage');
// $html2pdf->writeHTML($content);
// $html2pdf->output('laporan_transaksi.pdf');
<!-- $html = ob_get_contents(); -->
<!-- ob_end_clean(); -->
<!-- $mpdf->WriteHTML(utf8_encode($html)); -->
<!-- $mpdf->Output('laporan_transaksi.pdf'); -->