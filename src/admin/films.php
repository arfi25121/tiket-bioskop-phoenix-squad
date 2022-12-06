<?php
require __DIR__ . '/../include/lib.php';
$title = 'Films';
require __DIR__ . '/../include/header_admin.php';

if ($_GET['action'] ?? false and $_GET['action'] == 'add_film' and $_POST) {

    if ($_FILES['image']['size'] == 0) {
        $fname_rand = NULL; //tidak ada gambar
    } else {
        // echo '<pre>';
        $img = $_FILES['image'];
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        // print_r($_FILES);
        // check if image is valid
        $fname_rand = random_string(50) . '.' . $ext;
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            @move_uploaded_file($img['tmp_name'], $film_image . $fname_rand);
        } else {
            exit('Invalid image');
        }
    }

    $judul = $_POST['judul'];
    $durasi = $_POST['durasi'];
    $tanggal_rilis = $_POST['tanggal_rilis'];
    $penulis = $_POST['penulis'];
    $produser = $_POST['produser'];
    $sutradara = $_POST['sutradara'];
    $sinopsis = $_POST['sinopsis'];
    $harga = $_POST['harga'];
    $gambar = $fname_rand;
    $q = $db->prepare("INSERT INTO `film` (`judul`, `durasi`, `tanggal_rilis`, `penulis`, `produser`, `sutradara`, `sinopsis`, `harga_tiket`, `film_photo`) VALUES (:judul, :durasi, :tanggal_rilis, :penulis, :produser, :sutradara, :sinopsis, :harga, :gambar)");
    $q->execute([
        'judul' => $judul,
        'durasi' => $durasi,
        'tanggal_rilis' => $tanggal_rilis,
        'penulis' => $penulis,
        'produser' => $produser,
        'sutradara' => $sutradara,
        'sinopsis' => $sinopsis,
        'harga' => $harga,
        'gambar' => $gambar
    ]);
    if ($q) {
        echo "<script>Swal.fire(
            'Success',
            'Film berhasil ditambahkan',
            'success'
          )</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Film Gagal ditambahkan!',
          })
          </script>";
    }
}

$films = ($db->query("SELECT * FROM `film`"))->fetchAll();
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Films</h1>
                </div>
                <div class="pb-20">
                    <table class="table table-hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">No.</th>
                                <th>Judul Film</th>
                                <th>Durasi</th>
                                <th>Tanggal Rilis</th>
                                <th>Harga Tiket</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($films as $film) {
                                $harga = number_format($film['harga_tiket'], 0, ',', '.');
                                echo "<tr>
									<td class=\"table-plus\">{$film['id']}</td>
									<td>{$film['judul']}</td>
									<td>{$film['durasi']} Menit</td>
									<td>{$film['tanggal_rilis']}</td>
									<td>Rp$harga</td>
									<td><a class='btn btn-primary btn-sm' href='film_details.php?id=" . $film['id'] . "'>Details</a></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="w-100 text-right pr-4">
                        <button class="btn btn-primary" onclick="tampil_form()"><i class="fa fa-plus" aria-hidden="true"></i>
Tambah Data Film</button>
                    </div>
                </div>
            </div>


            <div class="card-box mb-30 d-none" id="form_tambah">
                <div class="pd-20">
                    <h1 class="text-dark h3">Tambah Data Film</h1>
                </div>
                <div class="pb-20 px-4">

                    <form action="?action=add_film" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Judul</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="judul" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Durasi Film</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="durasi" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal Rilis</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="date" name="tanggal_rilis" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Penulis</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="penulis" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Produser</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="produser" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Sutradara</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="sutradara" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Sinopsis</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="sinopsis" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Harga Tiket</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="harga" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Image (450x663)</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <input type="submit" value="Submit" class="btn btn-success" style="width: 100%">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    <script>
        function tampil_form() {
            let x = document.getElementById('form_tambah')
            // remove class d-none
            x.classList.remove("d-none");
            x.focus()
        }
    </script>

    <?php require __DIR__ . '/../include/footer.php'; ?>