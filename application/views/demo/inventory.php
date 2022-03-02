<?php

$globalHeader;

?>
<style>
	#clock{
		font-size: 3.2rem;
		font-weight: bolder;
	}

	#salutation {
		font-size: 2.2rem;
	}
</style>
</head>
<body>
<div id="app">
	<?php $this->load->view('main/template/sidebar') ?>
	<div id="main">
		<header class="mb-3">
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>
		</header>
		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6 order-md-1 order-last">
						<h3>Inventory System [Demo]</h3>
						<p class="text-subtitle text-muted"></p>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-sm-12 mb-1">
						<p class="text-subtitle text-muted">- Dashboard</p>
					</div>
					<div class="col-sm-12 mb-4">
						<img class="border-gold" src="<?=base_url() . 'assets/images/demo/demo4.png';?>" width="1280" height="720">
					</div>
					<div class="col-sm-12 mb-1">
						<p class="text-subtitle text-muted">- Products Section</p>
					</div>
					<div class="col-sm-12 mb-2">
						<img class="border-gold" src="<?=base_url() . 'assets/images/demo/demo3.png';?>" width="1280" height="720">
					</div>
					<div class="col-sm-12 mb-2">
						<img class="border-gold" src="<?=base_url() . 'assets/images/demo/demo2.png';?>" width="1280" height="720">
					</div>
					<div class="col-sm-12">
						<img class="border-gold" src="<?=base_url() . 'assets/images/demo/demo1.png';?>" width="1280" height="720">
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/moment.min.js"></script>
<script type="text/javascript">
$('.sidebar-demo-inventory').addClass('active');
</script>
</body>

</html>
