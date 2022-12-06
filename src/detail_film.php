<?php
require __DIR__ . '/include/lib.php';

$q = $db->prepare("SELECT * FROM `film` where id=:id");
$q->execute(['id'=>$_GET['id']]);
$film = $q->fetch();
if(!$film){
    exit("<script src=\"/static/js/sweetalert2.js\"></script><body></body>
    <script>Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Film tidak ditemukan!',
      })
      </script>");
}

if(is_file($film_image.$film['film_photo'])){
    $img_url = $film_image_path.$film['film_photo'];
}else{
    $img_url = '/static/images/image-not-available.jpg';
}

// print_r($film);
$jadwals = $db->prepare('select *, (select count(*) from jadwal_kursi where jadwal_kursi.id_jadwal=jadwal_film.id_jadwal and jadwal_kursi.jam=jadwal_waktu.jam) as kursi_terisi from jadwal_film, jadwal_waktu
where jadwal_film.id_jadwal=jadwal_waktu.id_jadwal and jadwal_film.id_film=:id');
$jadwals->execute(['id'=>$_GET['id']]);
$jadwals = $jadwals->fetchAll();

$title = $film['judul'];
require __DIR__ . '/include/header_user.php';
?>
<style>
    .table td{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .titik{
        position: absolute;
        /* z-index: 3999; */
        margin-left: -15px;
    }
</style>
<div class="main-container" id="app">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px col-12">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pb-20 row">
                    <div class="col-12 col-lg-4">
                        <div class="p-3">
                            <img src="<?= $img_url ?>" class="img-thumbnail shadow-lg" style="max-width: 300px;border-radius: 0.9rem !important;">
                        </div>
                    </div>
                    <div class="col">
                        <div class="pd-20">
                            <h1 class="text-dark h3"><?= $film['judul'] ?></h1>

                            <div class="row">
                                <div class="col-3 py-1">Tanggal Rilis:</div>
                                <div class="col-9 py-1 d-flex"><div class="titik">:</div> <?= $film['tanggal_rilis'] ?></div>

                                <div class="col-3 py-1">Durasi</div>
                                <div class="col-9 py-1"><div class="titik">:</div> <?= $film['durasi'] ?> menit</div>

                                <div class="col-3 py-1">Penulis:</div>
                                <div class="col-9 py-1"><div class="titik">:</div><?= $film['penulis'] ?></div>

                                <div class="col-3 py-1">Sutradara:</div>
                                <div class="col-9 py-1"><div class="titik">:</div><?= $film['sutradara'] ?></div>

                                <div class="col-3 py-1">Produser:</div>
                                <div class="col-9 py-1"><div class="titik">:</div><?= $film['produser'] ?></div>

                                <div class="col-3 py-1">Sinopsis:</div>
                                <div class="col-9 py-1"><div class="titik">:</div><?php echo str_replace("\n", '<br>', $film['sinopsis']);  ?></div>
                            </div>

                            <!-- <p class="p-0 my-3">Tanggal Rilis: <?= $film['tanggal_rilis'] ?></p>
                            <p class="p-0 my-3">Durasi: <?= $film['durasi'] ?> minutes</p>
                            <p class="p-0 my-3">Penulis: <?= $film['penulis'] ?></p>
                            <p class="p-0 my-3">Sutradara: <?= $film['sutradara'] ?></p>
                            <p class="p-0 my-3">Produser: <?= $film['produser'] ?></p>
                            <p class="p-0 my-3">Sinopsis: <?php echo str_replace("\n", '<br>', $film['sinopsis']);  ?></p> -->
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <h2 class="text-dark h3 p-3">Jadwal Tayang di Bioskop</h2>
                    <?php if(!$jadwals): ?>
                    <p class="px-3">Belum ada jadwal.</p>
                    <?php else: ?>
                    <div class="col-12 col-lg-6">
                        <table class="table nowarp table-hover table-sm table-striped table-bordered shadow">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Kursi Tersedia</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($jadwals as $key => $jadwal) {
                                $kursi = $total_kursi-$jadwal['kursi_terisi'];?>
                                <tr>
                                    <td><?= $jadwal['tanggal'] ?></td>
                                    <td><?= $jadwal['jam'] ?></td>
                                    <td><?= $kursi ?></td>
                                    <td><a class="btn btn-success btn-sm px-1" <?php echo "href=\"pesan.php?id={$_GET['id']}&id_jadwal={$jadwal['id_jadwal']}&tanggal={$jadwal['tanggal']}&jam={$jadwal['jam']}\""; ?>>Pesan sekarang</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
    
        <?php require __DIR__ . '/include/footer.php'; ?>