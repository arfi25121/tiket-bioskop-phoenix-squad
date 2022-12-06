<?php
require __DIR__ . '/include/lib.php';
$title = 'Pembelian';
require __DIR__ . '/include/header_user.php';

// daftar tiket film yang dibeli
$q = $db->prepare("SELECT * FROM `pembelian_tiket`,jadwal_film,film,jadwal_waktu where id_jadwal_film = jadwal_film.id_jadwal and film.id=jadwal_film.id_film and jadwal_waktu.id_jadwal=pembelian_tiket.id_jadwal_film and jadwal_waktu.jam=pembelian_tiket.jam and id_user = :id_user");
$q->execute([
    'id_user' => $_SESSION['id']
]);
$rows = $q->fetchAll();
?>

<style>
    #lunas:hover::after{
        content: ' | Details';
    }
    .pointer {cursor: pointer;}
</style>
<div class="main-container" id="app">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px col-12">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Daftar Pembelian</h1>
                </div>
                <div class="pb-20 row">
                    <div class="col-12">
                        <div class="p-3">
                            <table class="table table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pembelian</th>
                                        <th>Judul Film</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th style="width: 22%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   foreach ($rows as $no => $row) {
                                        // print_r($row);
                                        $no++;
                                        if($row['status'] ??false){
                                            $loc = "/ticket?id={$row[0]}";
                                            $status = "<a id=lunas class='btn btn-success btn-sm p-0 px-2' href='/ticket?id={$row[0]}'>PAID</a>";
                                        }else{
                                            $loc = "/invoice?id={$row[0]}";
                                            $status = "<a class='btn btn-danger btn-sm p-0 px-2' href=\"/invoice?id={$row[0]}\">UNPAID</a>";
                                        }
                                        echo "
                                            <tr onclick='window.location=\"$loc\"' class=pointer>
                                                <td>$no</td>
                                                <td>#{$row[0]}</td>
                                                <td>{$row['judul']}</td>
                                                <td>{$row['tanggal']}</td>
                                                <td>{$row['jam']}</td>
                                                <td>$status</td>
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
    
        <?php require __DIR__ . '/include/footer.php'; ?>