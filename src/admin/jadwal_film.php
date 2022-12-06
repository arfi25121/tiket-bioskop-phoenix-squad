<?php
require __DIR__ . '/../include/lib.php';
$title = 'Jadwal Film';
require __DIR__ . '/../include/header_admin.php';

$films = ($db->query('SELECT * FROM `film`'))->fetchAll();
// action=add_jadwal&film_id=22
if ($_GET ?? false and $_GET['action'] == 'add_jadwal' and $_POST) {
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $film_id = $_GET['film_id'];

    $jadwal_film = $db->prepare('select * from jadwal_film where id_film=:id');
    $jadwal_film->execute(['id' => $film_id]);
    $jadwal_film = $jadwal_film->fetch();
    // print_r($jadwal_film);
    if (!$jadwal_film) {
        // jika belum ada maka di insert dulu
        $q = $db->prepare('insert into jadwal_film values (NULL, :id_film)');
        $q->execute(['id_film' => $film_id]);

        // get last id auto increment
        $id_jadwal = $db->lastInsertId();
    } else {
        $id_jadwal = $jadwal_film['id_jadwal'];
    }

    $q = $db->prepare('insert into jadwal_waktu values (:id_jadwal, :tanggal, :jam)');
    $q->execute(['id_jadwal' => $id_jadwal, 'tanggal' => $tanggal, 'jam' => $jam]);
    if ($q) {
        echo "<script>Swal.fire(
            'Success',
            'Berhasil menambah jadwal',
            'success'
          )</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal menambah jadwal',
          })
          </script>";
    }
}elseif ($_GET ?? false and $_GET['action'] == 'hapus_jadwal') {
    $id_jadwal = $_GET['id'];
    $q = $db->prepare('delete from jadwal_film where id_jadwal=:id_jadwal');
    $q2 = $db->prepare('delete from jadwal_waktu where id_jadwal=:id_jadwal');
    try{
        $q2->execute(['id_jadwal' => $id_jadwal]);
        $q->execute(['id_jadwal' => $id_jadwal]);
        $status = true;
    }catch(PDOException $e){
        $status = false;
    }
    
    if ($status) {
        echo "<script>Swal.fire(
            'Success',
            'Berhasil menghapus jadwal',
            'success'
          )</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Gagal menghapus jadwal',
          })
          </script>";
    }
}
?>

<style>
    .glyphicon {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-style: normal;
        font-variant-ligatures: normal;
        font-variant-caps: normal;
        font-variant-numeric: normal;
        font-variant-east-asian: normal;
        font-weight: normal;
        font-stretch: normal;
        font-size: inherit;
        line-height: 1;
        font-family: FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
    }

    .glyphicon-chevron-up::before {
        content: "\f062";
    }

    .glyphicon-chevron-down::before {
        content: "\f063";
    }
</style>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Jadawal Film</h1>
                </div>
                <div class="pb-20">
                    <ul class="list-group">

                        <?php
                        foreach ($films as $no => $film) {
                            $rand_c = 'Pausi-' . random_string(32);
                            $q = $db->prepare('select *, (select count(*) from jadwal_kursi where jadwal_kursi.id_jadwal=jadwal_film.id_jadwal and jadwal_kursi.jam=jadwal_waktu.jam) as kursi_terisi from jadwal_film, jadwal_waktu
                            where jadwal_film.id_jadwal=jadwal_waktu.id_jadwal and jadwal_film.id_film=:id order by tanggal');
                            $q->execute([
                                'id' => $film['id']
                            ]);
                            $jadwals = $q->fetchAll();
                        ?>

                            <a class="list-group-item list-group-item-action flex-column align-items-start">
                                <h5 class="mb-1 h5"><?= $film['judul'] ?></h5>
                                <?php
                                if (!$jadwals) {
                                    echo "Belum ada jadwal film akan tayang!";
                                } else { ?>
                                    <div class="pb-1">
                                        <small class="text-muted weight-600">Jadwal Tayang</small>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <table class="table table-bordered table-hover table-sm">
                                            <thead>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Kursi Tersedia</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($jadwals as $jadwal) {
                                                    $kursi = $total_kursi - $jadwal['kursi_terisi'];
                                                    echo "<tr>
                                                    <td>{$jadwal['tanggal']}</td>
                                                    <td>{$jadwal['jam']}</td>
                                                    <td>{$kursi}</td>
                                                    <td><a class='btn btn-danger text-light btn-sm p-1 m-0' onclick='hapus({$jadwal['id_jadwal']})'>Hapus</a></td>
                                                </tr>";
                                                }
                                                echo '</table>';

                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                <?php } ?>
                                <!-- <small class="text-right mr-3"> -->
                                <div class="text-right">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#<?= $rand_c ?>" role="button" aria-expanded="false" aria-controls="collapseExample">Tambah Jadwal</button>
                                </div>
                            </a>

                            <li class="collapse" id="<?= $rand_c ?>">

                                <form action="?action=add_jadwal&film_id=<?= $film['id'] ?>" method="post">
                                    <div class="card card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input class="form-control" type="date" name="tanggal" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Jam</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input type="text" name="jam" class="form-control" placeholder="Format {jam:menit}; contoh: 07:30" pattern="[0-9]{2}:[0-9]{2}" required>
                                            </div>
                                        </div>
                                        <input type="submit" value="Submit" class="btn btn-success">
                                    </div>
                                </form>
                            </li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <script>
        function hapus(id){
            Swal.fire({
                title: 'Peringatan!',
                text: "Yakin Ingin Menghapus Jadwal Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'YES'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '?action=hapus_jadwal&id='+id;
                }
            })
        }
    </script>
<?php require __DIR__ . '/../include/footer.php'; ?>