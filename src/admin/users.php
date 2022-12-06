<?php
require __DIR__. '/../include/lib.php';
$title = 'Users';
require __DIR__. '/../include/header_admin.php';

if($_GET['action'] ?? false and $_GET['action'] == 'add_user' and $_POST){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $q = $db->prepare("INSERT INTO `users` (email, password, sebagai, no_hp, nama, jenis_kelamin) VALUES (:email, :password, :sebagai, :no_hp, :nama, :jenis_kelamin)");
    $q->execute([
        'email' => $email,
        'password' => $password,
        'sebagai' => 'admin',
        'no_hp' => $no_hp,
        'nama' => $nama,
        'jenis_kelamin' => $jenis_kelamin
    ]);
    if($q){
        echo "<script>Swal.fire(
            'Success',
            'User berhasil ditambahkan',
            'success'
          )</script>";
    }else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'User Gagal ditambahkan!',
          })
          </script>";
    }
}else if($_GET['action'] ?? false and $_GET['action'] == 'delete'){
    $id = $_GET['id'];
    $q = $db->prepare("DELETE FROM `users` WHERE `id` = :id");
    $q->execute([
        'id' => $id
    ]);
    if($q){
        echo "<script>Swal.fire(
            'Success',
            'User berhasil dihapus',
            'success'
          )</script>";
    }else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'User Gagal dihapus!',
          })
          </script>";
    }
}elseif($_GET['action'] ?? false and $_GET['action'] == 'edit' and $_POST){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $q = $db->prepare("UPDATE `users` SET
    `email` = :email,
    `password` = :password,
    `no_hp` = :hp,
    `nama` = :nama,
    `jenis_kelamin` = :jk
    WHERE `id` = :id");
    $q->execute([
        'id'=>$_GET['id'],
        'email' => $email,
        'password'=> $password,
        'hp' => $no_hp,
        'nama'=> $nama,
        'jk' => $jenis_kelamin
    ]);
    if($q){
        echo "<script>Swal.fire(
            'Success',
            'User berhasil diedit',
            'success'
          )</script>";
    }else{
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'User Gagal diedit!',
          })
          </script>";
    }

}

$users = ($db->query("SELECT * FROM `users` where sebagai='admin'"))->fetchAll();
?>



<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Users</h1>
                </div>
                <div class="pb-20">
                    <table class="table table-hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>no_hp</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($users as $user){
                            ?>
                            <tr>
                                <td class="table-plus"><?= $i ?></td>
                                <td><?= $user['nama'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['sebagai'] ?></td>
                                <td><?= $user['no_hp'] ?></td>
                                <td><?= $user['jenis_kelamin'] ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="users?action=edit&id=<?= $user['id'] ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm text-light" onclick="delete_user()">Delete</a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="w-100 text-right pr-4">
                        <button class="btn btn-primary" onclick="tampil_form()"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Data User</button>
                    </div>
                </div>
            </div>


            <div class="card-box mb-30 d-none" id="form_tambah">
                <div class="pd-20">
                    <h1 class="text-dark h3">Tambah Data User</h1>
                </div>
                <div class="pb-20 px-4">

                    <form action="?action=add_user" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">No Hp</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="no_hp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-12 col-md-10">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <input type="submit" value="Submit" class="btn btn-success" style="width: 100%">
                        </div>
                    </form>

                </div>
            </div>

            <?php if($_GET['action'] ?? false and $_GET['action'] == 'edit'): 
            $user_info = $db->prepare('SELECT * FROM `users` where id=:id');
            $user_info->execute(['id'=>$_GET['id']]);
            $user_info = $user_info->fetch();
            ?>
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Edit Data User</h1>
                </div>
                <div class="pb-20 px-4">

                    <form action="?action=edit&id=<?= $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="nama" value="<?= $user_info['nama']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="email" name="email" value="<?= $user_info['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="password" name="password" value="<?= $user_info['password']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">No Hp</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="no_hp" value="<?= $user_info['no_hp']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-12 col-md-10">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="Laki-laki" <?php if($user_info['jenis_kelamin'] == 'Laki-laki'){echo 'selected';} ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if($user_info['jenis_kelamin'] == 'Perempuan'){echo 'selected';} ?>>Perempuan</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <input type="submit" value="Submit" class="btn btn-success" style="width: 100%">
                        </div>
                    </form>

                </div>
            </div>
            <?php endif; ?>
        </div>

    <script>
        function delete_user(){
            // 
            Swal.fire({
                title: 'Peringatan!',
                text: "Yakin Ingin Menghapus User Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'YES'
            }).then((result) => {
                if (result.value) {
                    window.location.href = 'users?action=delete&id=<?= $user['id'] ?>';
                }
            })
        }
        function tampil_form() {
            let x = document.getElementById('form_tambah')
            // remove class d-none
            x.classList.remove("d-none");
            x.focus()
        }
    </script>



<?php require __DIR__ . '/../include/footer.php'; ?>