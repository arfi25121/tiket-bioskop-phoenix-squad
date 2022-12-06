<?php
require __DIR__. '/../include/lib.php';
require __DIR__. '/../include/header_admin.php';

$total_film = ($db->query('SELECT count(*) as total FROM `film`'))->fetch();
$total_film = $total_film['total'];

$total_visitor = ($db->query('SELECT sum(total) as total FROM `visitor_counter`'))->fetch()['total'];
$total_customer = ($db->query("SELECT count(*) as total FROM `users` where sebagai = 'user'"))->fetch()['total'];
$total_admin = ($db->query("SELECT count(*) as total FROM `users` where sebagai = 'admin'"))->fetch()['total'];
$total_pendapatan = ($db->query("SELECT sum(total) as total FROM `pembelian_tiket` where status = 'paid'"))->fetch()['total'];
if($database_type == 'sqlite'){
	// query untuk database sqlite 
	$total_pendapatan_bulan_ini = ($db->query("SELECT sum(total) as total FROM `pembelian_tiket` where status = 'paid' and strftime('%m', tanggal) = strftime('%m', date('now'))"))->fetch()['total'];
}else{
	$total_pendapatan_bulan_ini = ($db->query("SELECT sum(total) as total FROM `pembelian_tiket` where status = 'paid' and month(tanggal) = month(now())"))->fetch()['total'];
}

// get last 7 day from visitor counter 
$tgl = date("d");
$dt = date("Y-m-");
$tgls = [];
for ($i=0; $i < 7; $i++) { 
	$tgl--;
	// echo "($tgl)";
	if($tgl==0 or $tgl <1){
		continue;
	}
	$p = (@$db->query("select total from visitor_counter where tanggal='$dt$tgl'")->fetch()['total']??0);
	$tgls[$tgl] = $p;
}

ksort($tgls); //mengurutkan
?>
<style>
	.oth-pausi .apexcharts-tooltip.apexcharts-theme-light.apexcharts-active{
		opacity: 0;
	}
</style>
    <div class="main-container">
		<div class="xs-pd-20-10 pd-ltr-20">
			<div class="title pb-20">
				<h2 class="h3 mb-0">Dashboard</h2>
			</div>

			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?= $total_visitor ?></div>
								<div class="font-14 text-secondary weight-500">Total Visitor</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-calendar1"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark">Rp<?php echo number_format($total_pendapatan_bulan_ini ??0, 0, ',', '.'); ?></div>
								<div class="font-14 text-secondary weight-500">Pendapatan Bulan ini</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><span class="icon-copy fa fa-money"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark">Rp<?php echo number_format($total_pendapatan??0, 0, ',', '.'); ?></div>
								<div class="font-14 text-secondary weight-500">Total Pendapatan</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><i class="icon-copy fa fa-money" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?= $total_admin ?></div>
								<div class="font-14 text-secondary weight-500">Administrator</div>
							</div>
							<div class="widget-icon">
								<div class="icon"><i class="icon-copy fa fa-user-o" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row pb-10">
				<div class="col-md-8 mb-20">
					<div class="card-box height-100-p pd-20">
						<div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
							<div class="h5 mb-md-0">Visitor Counter</div>
							<div class="form-group mb-md-0">
								<select class="form-control form-control-sm selectpicker">
									<option value="">Last 7 days</option>
								</select>
							</div>
						</div>
						<div id="activities-chart"></div>
					</div>
				</div>
				<div class="col-md-4 mb-20 oth-pausi">
					<div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
						<div class="d-flex justify-content-between pb-20 text-white">
							<div class="icon h1 text-white">
								<i class="fa fa-film" aria-hidden="true"></i>
							</div>
							<div class="font-14 text-right">
								<div></div>
								<div class="font-12"></div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-end">
							<div class="text-white">
								<div class="font-14">Total Films</div>
								<div class="font-24 weight-500"><?= $total_film ?></div>
							</div>
							<div class="max-width-150">
								<div id="appointment-chart"></div>
							</div>
						</div>
					</div>
					<div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
						<div class="d-flex justify-content-between pb-20 text-white">
							<div class="icon h1 text-white">
								<i class="fa fa-users" aria-hidden="true"></i>
							</div>
							<div class="font-14 text-right">
								<div></div>
								<div class="font-12"></div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-end">
							<div class="text-white">
								<div class="font-14">Total Customer</div>
								<div class="font-24 weight-500"><?= $total_customer ?></div>
							</div>
							<div class="max-width-150">
								<div id="surgery-chart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
<script>
	var options = {
	series: [
	{
		name: "Total Visitor",
		data: [
			<?php foreach($tgls as $tgl => $value){
				echo $value.', ';
			}
			?>
		]
	},
	// {
	// 	name: "Bulan Lalu",
	// 	data: [15, 10, 17, 15, 23, 21, 30, 20, 26, 20, 28, 25]
	// }
	],
	chart: {
		height: 300,
		type: 'line',
		zoom: {
			enabled: false,
		},
		dropShadow: {
			enabled: true,
			color: '#000',
			top: 18,
			left: 7,
			blur: 16,
			opacity: 0.2
		},
		toolbar: {
			show: false
		}
	},
	colors: ['#f0746c', '#255cd3'],
	dataLabels: {
		enabled: false,
	},
	stroke: {
		width: [3,3],
		curve: 'smooth'
	},
	grid: {
		show: false,
	},
	markers: {
		colors: ['#f0746c', '#255cd3'],
		size: 5,
		strokeColors: '#ffffff',
		strokeWidth: 2,
		hover: {
			sizeOffset: 2
		}
	},
	xaxis: {
		categories: [
			<?php foreach($tgls as $tgl => $value){
				echo "'Tanggal $tgl',";
			}
			?>	
			// 'Tanggal 1', 'Tanggal 2', 'Tanggal 3', 'Tanggal 4', 'Tanggal 5', 'Tanggal 6', 'Tanggal 7'
		],
		max: 7,
		labels:{
			style:{
				colors: '#8c9094'
			}
		}
	},
	yaxis: {
		min: 0,
		max: <?php echo max($tgls)+2??1; ?>,
		labels:{
			style:{
				colors: '#8c9094'
			}
		}
	},
	legend: {
		position: 'top',
		horizontalAlign: 'right',
		floating: true,
		offsetY: 0,
		labels: {
			useSeriesColors: true
		},
		markers: {
			width: 10,
			height: 10,
		}
	}
};

</script>
<?php require __DIR__.'/../include/footer.php'; ?>