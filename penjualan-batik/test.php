<?php
$query = mysqli_connect("localhost", "root", "");
mysqli_select_db($query, "pos");
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
ob_start();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mari Belajar Coding</title>
</head>

<body>
    <div align="center">
        <h2 align="center">Data Mahasiswa</h2>
        <table align="center" width="60%" border="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Nota</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = "select * from penjualan";
                $query = mysqli_query($query, $sql);
                while ($dataPenjualan = mysqli_fetch_array($query)) {
                ?>
                    <tr>

                        <td><?= $no++ ?></td>
                        <td><?= $dataPenjualan['nonota'] ?></td>
                        <td><?= $dataPenjualan['tanggal'] ?></td>
                        <td><?= $dataPenjualan['total'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>