<?php
require './include/lib.php';
if($_SESSION['id'] ?? false){
    // sudah login
    if($_SESSION['sebagai']=='admin'){
        exit(header("Location: /admin"));
    }else{
        exit(header("Location: /"));
    }
}
if($_POST??false){
    // register account
	$email = $_POST['email'];
	$pass  = $_POST['password'];
	$nama  = $_POST['nama'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$q = $db->prepare("SELECT * FROM `users` where email = :us limit 1");
	$q->execute([
		'us' => $email
	]);
	$row = $q->fetch();
	if($row){
		$msg = "<script>Swal.fire({
			icon: 'error',
			title: 'Email sudah terdaftar!',
		  })
		  </script>";
	}else{
		$q = $db->prepare("INSERT INTO `users` (`email`, `password`, `nama`, `no_hp`, `jenis_kelamin`, `sebagai`, `alamat`) VALUES (:em, :pw, :na, :nh, :jk, :sg, :al)");
		$q->execute([
			'em' => $email,
			'pw' => $pass,
			'na' => $nama,
			'nh' => $no_hp,
			'jk' => $jenis_kelamin,
			'sg' => 'user',
			'al' => $alamat
		]);
		$msg = "<script>Swal.fire({
			title: 'Success',
			text: \"Berhasil mendaftarkan account, silahkan login.\",
			icon: 'success',
			confirmButtonColor: '#21921c',
			confirmButtonText: 'YES'
		}).then((result) => {
			if (result.value) {
				window.location.href = '/login';
			}
		})
		  </script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?= $title??'' ?> - Register</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
    <style>
		@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
		.logo-xxi{
			font-family: 'Bebas Neue', cursive;
			font-size: 40px;
		}
	</style>

	<script src="/static/js/sweetalert2.js"></script>
</head>
<body class="login-page">
	<?= $msg??'' ?>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="/">
					<div class="logo-xxi row text-dark" style="margin-left:0px">
                        <img src="/static/images/svg.svg" style="width: 40px">
                        <?= $app_name??'' ?>
                    </div>
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="/login">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Register</h2>
						</div>
						<form method="POST">
							<div class="input-group custom">
								<input name="nama" value="" type="text" class="form-control form-control-lg" placeholder="Nama" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input name="no_hp" value="" type="text" class="form-control form-control-lg" placeholder="No HP" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-phone"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<select class="custom-select col-12" name="jenis_kelamin" required>
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
							<div class="input-group custom">
								<textarea class="form-control" placeholder="Alamat" name="alamat" style="height: 100px;" required></textarea>
							</div>
							<div class="input-group custom">
								<input name="email" value="" type="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope-o"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input name="password" value="" type="password" class="form-control form-control-lg" placeholder="**********" required>
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-primary btn-lg btn-block" href="index.html">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>