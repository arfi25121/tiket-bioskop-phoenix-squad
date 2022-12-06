<?php
require __DIR__.'/include/lib.php';
parameter_must_exist('id');
$title = 'Invoice';
require __DIR__.'/include/header_user.php';


$cek_paid = check_pembelian_tiket($_GET['id']);

$q = $db->prepare("SELECT * FROM `pembelian_tiket` where id = :id");
$q->execute([
    'id' => $_GET['id']
]);
$data_pembelian = $q->fetch();

if(!$data_pembelian){
	echo "<script>Swal.fire({
		icon: 'error',
		title: 'Error!',
		text: 'Data Pembelian Tidak Ditemukan!',
	  })
	  </script>";
	exit;
}
if($_GET['success']){
	echo "<script>Swal.fire({
		icon: 'success',
		title: 'Success',
		text: 'Berhasil melakukan pembayaran',
	  })
	  </script>";
}

$data_user = ($db->query("select * from users where id={$data_pembelian['id_user']}"))->fetch();
$total_kursi = $data_pembelian['total']/$data_pembelian['harga_per_tiket'];
?>
<style>
    .invoice-rate{
        width: 25% !important;
    }
    .invoice-hours{
        width: 15% !important;
    }
</style>
    <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10 mb-5">
			<div class="min-height-200px" style="margin-bottom: 50px">
				<div class="invoice-wrap rounded">
					<div class="invoice-box">
						<div class="invoice-header">
                        <?php
                        if($cek_paid){
                            echo '<span class="border border-success text-success position-absolute fw-bold p-1"><b>PAID</b></span>';
                        }else{
                            echo '<span class="border border-danger text-danger position-absolute fw-bold p-1"><b>UNPAID</b></span>';
                        }
                        ?>
							<div class="logo text-center">
								<img src="vendors/images/deskapp-logo.png" alt="">
							</div>
						</div>
						<h4 class="text-center mb-30 weight-600">
                            INVOICE
                        </h4>
						<div class="row pb-30">
							<div class="col-md-6">
								<h5 class="mb-15"><?php echo htmlspecialchars($data_user['nama']) ?></h5>
								<p class="font-14 mb-5">Date created: <strong class="weight-600"><?= $data_pembelian['tanggal'] ?></strong></p>
								<p class="font-14 mb-5">Invoice No: <strong class="weight-600">#<?= $_GET['id'] ?></strong></p>
							</div>
							<div class="col-md-6">
								<div class="text-right">
									<p class="font-14 mb-5"><?php echo htmlspecialchars($data_user['nama']) ?>,</p>
									<p class="font-14 mb-5"><?php echo htmlspecialchars($data_user['alamat']??'') ?></p>
								</div>
							</div>
						</div>
						<div class="invoice-desc pb-30">
							<div class="invoice-desc-head clearfix">
								<div class="invoice-sub">Name</div>
								<div class="invoice-rate">Tanggal & Jam</div>
								<div class="invoice-hours">Total Kursi</div>
								<div class="invoice-subtotal">Subtotal</div>
							</div>
							<div class="invoice-desc-body" style="min-height: 250px;">
								<ul>
									<li class="clearfix">
										<div class="invoice-sub">Tiket Bioskop</div>
										<div class="invoice-rate"><?= $data_pembelian['tanggal_tayang'] ?> | <?= $data_pembelian['jam'] ?></div>
										<div class="invoice-hours text-center"><?= $total_kursi??'0' ?></div>
										<div class="invoice-subtotal"><span class="weight-600">Rp<?=  $data_pembelian['total'] ?></span></div>
									</li>
								</ul>
							</div>
							<div class="invoice-desc-footer">
								<div class="invoice-desc-head clearfix">
									<div class="invoice-sub">Payment Method</div>
									<div class="invoice-rate">Due By</div>
									<div class="invoice-subtotal">Total Due</div>
								</div>
								<div class="invoice-desc-body">
									<ul>
										<li class="clearfix">
											<div class="invoice-sub">
												<p class="font-14 mb-5"><strong class="weight-600 font-20">Qris </strong>(Automatic)</p>
											</div>
											<div class="invoice-rate font-20 weight-600"><?= $data_pembelian['tanggal_tayang'] ?></div>
											<div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">Rp<?=  $data_pembelian['total'] ?></span></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php if(!$cek_paid){ echo '
                        <div class="text-center">
                            <a href="pay/?id='. $_GET['id'] .'" class="btn btn-success w-100">Pay Now!</a>
                        </div>'; } ?>
					</div>
				</div>
			</div>

<?php
require __DIR__.'/include/footer.php';
?>