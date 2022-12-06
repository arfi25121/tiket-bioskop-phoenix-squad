<?php
require __DIR__ . '/include/lib.php';
require __DIR__ . '/include/header_user.php';

$cek = check_pembelian_tiket($_GET['id']);
if (!$cek) {
    echo "<script>Swal.fire({
		icon: 'error',
		title: 'Error!',
		text: 'Tiket ini belum dibayar, harap bayar terlebih dahulu!',
	  })
	  </script>";
    exit;
}
$q = $db->prepare("SELECT * FROM `pembelian_tiket` where id = :id");
$q->execute([
    'id' => $_GET['id']
]);
$data_pembelian = $q->fetch();


$daftar_tiket = $db->prepare("SELECT * FROM `jadwal_kursi` where id_pembelian = :id");
$daftar_tiket->execute([
    'id' => $_GET['id']
]);
$daftar_tiket = $daftar_tiket->fetchAll();

?>
<script src="/static/js/qrcode.min.js"></script>
<style>
    .text-end {
        text-align: right;
    }
    .pointer{
        cursor: pointer;
    }
    .ps-2 {
        padding-left: 10px !important;
    }
    #qrcode{
        text-align: center;
    }
    #qrcode img{
        display: inline !important;
    }
</style>
<div class="main-container" id="app">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px col-12 col-lg-6">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Daftar Kursi dari tiket anda</h1>

                    <strong>Detail Film:</strong><br>
                    <p class="p-0 m-0 ps-2">Judul film: <?= $data_pembelian['judul_film'] ?></p>
                    <p class="p-0 m-0 ps-2">Tanggal: <?= $data_pembelian['tanggal_tayang'] ?></p>
                    <p class="p-0 m-0 ps-2">Jam: <?= $data_pembelian['jam'] ?></p>
                </div>
                <div class="pb-20 row">
                    <div class="col-12">
                        <div class="p-3">
                            <table class="table table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>ID Ticket</th>
                                        <th>No Kursi</th>
                                        <th class="text-end" style="padding-right: 32px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($daftar_tiket as $no => $tiket) {
                                        $no++;
                                        echo "
                                            <tr class=pointer onclick='QR({$tiket['id']})' data-toggle=\"modal\" data-target=\"#Medium-modal\">
                                                <td>#{$tiket['id']}</td>
                                                <td>{$tiket['no_kursi']}</td>
                                                <td class='text-end'><a onclick='QR({$tiket['id']})' data-toggle=\"modal\" data-target=\"#Medium-modal\" type=\"button\" class='btn btn-success btn-sm p-0 px-2 text-light'>QR Code</a></td>
                                            </tr>
                                        ";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">ID Ticket #2990</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="qrcode"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                width: 250,
                height: 250,
                colorDark : "#031533",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
            function QR(id_ticket) {
                qrcode.makeCode(btoa(btoa(id_ticket)));
            }
        </script>
        <?php require __DIR__ . '/include/footer.php'; ?>