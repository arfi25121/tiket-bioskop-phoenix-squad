<?php
require __DIR__ . '/../include/lib.php';
parameter_must_exist('id');
$title = 'Detail Film';
require __DIR__ . '/../include/header_admin.php';
if($_GET['action'] ?? false and $_GET['action'] == 'delete'){
    $db->prepare("DELETE FROM `film` WHERE id = :id")->execute([
        'id' => $_GET['id']
    ]);
        echo "<script>Swal.fire({
            title: 'Success',
            text: \"Berhasil menghapus\",
            icon: 'success',
            confirmButtonColor: 'green',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.value) {
                window.location.href = 'films';
            }
        })</script>";
    exit;
}
if($_POST){
    if ($_FILES['image']['size'] == 0) {
        $fname_rand = NULL; //tidak ada gambar
    } else {
        $img = $_FILES['image'];
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        // check if image is valid
        $fname_rand = random_string(50) . '.' . $ext;
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $fname_rand = $fname_rand;
            @move_uploaded_file($img['tmp_name'], $film_image . $fname_rand);
        } else {
            $fname_rand = false;
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Invalid image extension',
              })
              </script>";
            exit('Invalid image');
        }
    }
    if($fname_rand??false){
        $image_query = "`film_photo` = '$fname_rand', ";
    }else{
        $image_query = "";
    }

    $query = $db->prepare("UPDATE `film` SET
    `judul` = :judul,
    `durasi` = :durasi,
    `tanggal_rilis` = :tanggal_rilis,
    `sinopsis` = :sinopsis,
    `penulis` = :penulis,
    `produser` = :produser,
    `sutradara` = :sutradara,
    $image_query
    `harga_tiket` = :harga_tiket
    WHERE `id` = :id");
    $status = $query->execute([
        'judul' => $_POST['judul'],
        'durasi' => $_POST['durasi'],
        'tanggal_rilis' => $_POST['tanggal_rilis'],
        'sinopsis' => $_POST['sinopsis'],
        'penulis' => $_POST['penulis'],
        'produser' => $_POST['produser'],
        'sutradara' => $_POST['sutradara'],
        'harga_tiket' => $_POST['harga'],
        'id' => $_GET['id']
    ]);
    if($status){
        echo "<script>Swal.fire(
            'Success',
            'Data Film Berhasil di Edit',
            'success'
          )</script>";
    }else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Data Film Gagal di Edit',
          })
          </script>";
    }
}

$film = $db->prepare('SELECT * FROM `film` where id=:id');
$film->execute(['id'=> $_GET['id']]);
$film = $film->fetch();
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Detail Film: <?php echo htmlspecialchars($film['judul']);?></h1>
                </div>
                <div class="pb-20 px-4">

                    <form method="POST" action="?id=<?= $_GET['id'] ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Judul</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="judul" value="<?php echo htmlspecialchars($film['judul']);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Durasi Film</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="durasi" value="<?php echo htmlspecialchars($film['durasi']);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tanggal Rilis</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="date" name="tanggal_rilis" value="<?php echo htmlspecialchars($film['tanggal_rilis']);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Penulis</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="penulis" value="<?php echo htmlspecialchars($film['penulis']??'');?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Produser</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="produser" value="<?php echo htmlspecialchars($film['produser']??'');?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Sutradara</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="sutradara" value="<?php echo htmlspecialchars($film['sutradara']??'');?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Sinopsis</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="sinopsis"><?php echo htmlspecialchars($film['sinopsis']??'');?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Harga Tiket</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="harga" value="<?php echo htmlspecialchars($film['harga_tiket']);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Image (450x663)</label>
                            <div class="col-sm-12 col-md-10">
                                <?php
                                    if($film['film_photo']??false and is_file($film_image.$film['film_photo'])){
                                        echo '<img class="rounded" src="'.$film_image_path.$film['film_photo'].'" style="max-width: 50%">';
                                    }
                                ?>
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <input type="submit" value="Edit" class="btn btn-success" style="width: 50%">
                            <input type="button" value="Hapus" class="btn btn-danger" style="width: 50%" onclick="hapus_film()">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <script>
        function hapus_film(){
            Swal.fire({
                title: 'Peringatan!',
                text: "Yakin Ingin Menghapus Film Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'YES'
            }).then((result) => {
                if (result.value) {
                    window.location.href = '?action=delete&id=<?= $_GET['id'] ?>';
                }
            })
        }
    </script>
    <?php require __DIR__ . '/../include/footer.php'; ?>