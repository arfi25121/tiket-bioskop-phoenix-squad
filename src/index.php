<?php
require __DIR__ . '/include/lib.php';
require __DIR__ . '/include/header_user.php';

$q = $db->prepare("SELECT * FROM `film`");
$q->execute();
$rows = $q->fetchAll();

?>
<style>
    .h-100 {
        height: 100% !important;
    }
</style>
<div class="main-container" id="app">
    <div class="pd-ltr-20 xs-pd-20-10">
			<div class="card-box pd-20 height-100-p mb-30 p-0">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner rounded">
						<div class="carousel-item active">
							<a href="/detail_film?id=1022"><img class="d-block w-100" src="/static/images/bg-thor.jpg" alt=""></a>
						</div>
						<div class="carousel-item">
							<a href="/detail_film?id=1021"><img class="d-block w-100" src="/static/images/iv-bg.jpg" alt=""></a>
						</div>
						<div class="carousel-item">
							<a href="#"><img class="d-block w-100" src="/static/images/dana-b.jpg" alt=""></a>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button"
							data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button"
							data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>

        <h2 class="text-dark h3 p-3">NOW SHOWING IN CINEMAS</h2>
        <div class="row">
        <?php foreach ($rows as $row) {
            if(is_file($film_image.$row['film_photo'])){
                $img_url = $film_image_path.$row['film_photo'];
            }else{
                $img_url = '/static/images/image-not-available.jpg';
            }                            
        ?>
            <div class="col-6 col-lg-3 mb-30">
                <div class="card-box height-100-p widget-style1 text-center">
                    <div class="d-flex flex-wrap align-items-center">
                        <a href="detail_film?id=<?= $row['id'] ?>"><img style="border-radius: 0.4rem !important;" src="<?= $img_url ?>" alt=""></a>
                    </div>
                    <h5 class="pd-10 font-18"><a href="detail_film?id=<?= $row['id'] ?>"><?= $row['judul'] ?></a></h5>
                </div>
            </div>
            <?php } ?>
        </div>

            <?php require __DIR__ . '/include/footer.php'; ?>