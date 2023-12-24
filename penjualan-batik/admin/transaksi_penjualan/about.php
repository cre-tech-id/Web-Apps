<?php include_once('../_header.php'); ?>

<div class="row" style="padding-top: 30px;">
    <div class="col-lg-12">
        <h1 class="page-header">
            <div class="row">
                <div class="col-md-4">
                    <strong>TRANSAKSI PENJUALAN</strong>
                </div>
                <?php include_once('../jam&tanggal.php'); ?>
            </div>

        </h1>
        <div class="alert alert-success" role="alert" style="font-size: 18px; font-family: cursive;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-info-circle"></i> Hello <strong><?= $_SESSION['username']; ?></strong>, anda berhasil masuk kedalam sistem sebagai <strong><?= $_SESSION['hak_akses']; ?></strong>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h1>Batik Fairuz</h1>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

            </div>
        </div>
    </div>
</div>

<div id="Modalnota" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
</div>

<div id="ModalLaporan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".modal_laporan").click(function(e) {
            var m = $(this).attr("id");
            $.ajax({
                url: "laporan.php",
                type: "GET",
                success: function(ajaxData) {
                    $("#ModalLaporan").html(ajaxData);
                    $("#ModalLaporan").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "transaksi-serverside.php",
            columnDefs: [{
                "searchable": false,
                "orderable": false,
                "targets": [3],
                "render": function(data, type, row) {
                    var btn = "<center><a href=\"#\" class=\"modal_view btn btn-info btn-xs\" id=\"" + data + "\"><span class=\"glyphicon glyphicon-open-file\" aria-hidden=\"true\"></span> <strong>Cek Nota</strong></a></center>";

                    $(".modal_view").click(function(e) {
                        var m = $(this).attr("id");
                        $.ajax({
                            url: "ceknota.php",
                            type: "GET",
                            data: {
                                nonota: m,
                            },
                            success: function(ajaxData) {
                                $("#Modalnota").html(ajaxData);
                                $("#Modalnota").modal('show', {
                                    backdrop: 'true'
                                });
                            }
                        });
                    });

                    return btn;
                }
            }],
            "order": [0, "desc"]
        });
    });
</script>

<?php include_once('../_footer.php'); ?>