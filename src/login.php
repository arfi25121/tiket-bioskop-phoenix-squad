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
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $q = $db->prepare("SELECT * FROM `users` where email = :us and password = :pw limit 1");
    $q->execute([
        'us' => $email,
        'pw' => $pass
    ]);
    $row = $q->fetch();
    // print_r($row);
    if($row){
        if($row['sebagai']=='admin'){
            $_SESSION['sebagai'] = 'admin';
        }else{
            $_SESSION['sebagai'] = 'user';
        }
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['no_hp'] = $row['no_hp'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];


        if($_SESSION['redirect_to'] ?? false){
            header("Location: {$_SESSION['redirect_to']}");
            $_SESSION['redirect_to'] = NULL;
            exit;
        }

        if($row['sebagai']=='admin'){
            exit(header("Location: /admin"));
        }else{
            exit(header("Location: /"));
        }
        
    }else{
        $msg = "<script>Swal.fire({
            icon: 'error',
            title: 'Email atau Password salah!',
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
	<title><?= $title??'' ?> - Login</title>

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
					<li><a href="register">Register</a></li>
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
							<h2 class="text-center text-primary">Login To <?= $title??'' ?></h2>
						</div>
						<form method="POST">
							<div class="input-group custom">
								<input name="email" value="<?php echo htmlspecialchars($_POST['email']??'', ENT_QUOTES) ?>" type="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input name="password" value="<?php echo htmlspecialchars($_POST['password']??'', ENT_QUOTES) ?>" type="password" class="form-control form-control-lg" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<button type="submit" class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="register">Register To Create Account</a>
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