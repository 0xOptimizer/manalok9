<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
$date = date('M j, Y');

if ($this->input->get('date')) {
	$date = $this->input->get('date');
	$date = date('M j, Y', strtotime($date));
}
$isCurrentDate = false;
if ($date == date('M j, Y')) {
	$isCurrentDate = true;
}

?>
<style>
	.rotate-text {
		-webkit-transform:rotate(-75deg);
	}
	.card-container a {
		text-decoration: none;
	}
	.card-headers {
		border-radius: 3px 3px 0px 0px;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
		padding-left: 20px;
		color: #FFFFFF;
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
						<h3>Dashboard</h3>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-sm-12 col-lg-8">
						<!-- <div class="col-1 ml-auto chart-hover-settings" style="margin-top: -30px; display: none;">
							<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-cog" style="margin-right: -1px;"></i></button>
						</div> -->
						<canvas id="productsChart" class="w-100" width="800" height="350"></canvas>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="row ml-2">
											<span class="head-text">
												IN STOCK
											</span>
										</div>
										<div class="row ml-2">
											<span style="font-size: 2em; color: #ebebeb;">
												<b>
													8231
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<i class="bi bi-caret-up"></i>6000 this month
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="row ml-2">
											<span class="head-text">
												SOLD
											</span>
										</div>
										<div class="row ml-2">
											<span style="font-size: 2em; color: #ebebeb;">
												<b>
													11395
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<i class="bi bi-caret-up"></i>900 this week
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="row ml-2">
											<span class="head-text">
												RELEASED
											</span>
										</div>
										<div class="row ml-2">
											<span style="font-size: 2em; color: #ebebeb;">
												<b>
													834
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<i class="bi bi-caret-up"></i>40 this week
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="row ml-2">
											<span class="head-text">
												NEW
											</span>
										</div>
										<div class="row ml-2">
											<span style="font-size: 2em; color: #ebebeb;">
												<b>
													6000
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<i class="bi bi-caret-up"></i>750 this week
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-12 col-lg-6">
						<div class="card">
							<div class="card-body">
								<div class="row ml-2">
									<span class="head-text">
										WHAT'S NEW
									</span>
								</div>
								<div class="activity-log ml-2">
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin4&gt; logged out.
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">15 seconds ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin1&gt; created a new user.
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">2 minutes ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin1&gt; logged in.
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">5 minutes ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin2&gt; added 200 x &lt;product&gt;.
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">8 minutes ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin0&gt; created a new user.
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">1 day ago</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-3">
						<div class="card">
							<div class="card-body">
								<div class="row ml-2">
									<span class="head-text">
										EMPLOYEES ONLINE
									</span>
								</div>
								<div class="employees-online ml-2">
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin1&gt;
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">Clocked in 5 minutes ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin2&gt;
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">Clocked in 33 minutes ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin3&gt;
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">Clocked in 1 hour ago</div>
										</div>
									</div>
									<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
										<span style="font-size: 1.15em; color: #ebebeb;">
											<b>
												&lt;admin0&gt;
											</b>
										</span>
										<div class="col-sm-12">
											<div class="text-muted">Clocked in 3 hours ago</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-3">
						<div class="card">
							<div class="card-body">
								<div class="row ml-2">
									<span class="head-text">
										ADDITIONAL DATA
									</span>
								</div>
								<div class="additional-data ml-2">
									<div class="row mt-2">
										<div class="col-sm-6">
											<button type="button" class="btn btn-primary" style="width: 150px;"><i class="bi bi-server"></i> DATABASE</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="btn btn-info" style="width: 150px;"><i class="bi bi-back"></i> BACKUP</button>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-sm-6">
											<button type="button" class="btn btn-danger" style="width: 150px;"><i class="bi bi-shield-fill"></i> SECURITY</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="btn btn-secondary" style="width: 150px;"><i class="bi bi-wrench"></i> SETTINGS</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
<script src="<?php base_url(); ?>assets/js/Chart.bundle.min.js"></script>
<script>
$('.sidebar-admin-dashboard').addClass('active');
$(document).ready(function() {
	var totalProducts = new Chart(document.getElementById('productsChart'), {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November', 'December'],
				datasets: [{
					label: 'Total Products',
					data: ['2000', '3000', '1500', '2250', '2500', '2750', '5000', '7000', '5500', '1200', '1800', '7200'],
					backgroundColor: [
					'rgba(167, 133, 45, 0.5)',
					],
					borderColor: [
					'rgba(185, 92, 26, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 2
				}]
			},
			options: {
				scales: {
					yAxes: [{

						ticks: {
							stepValue: 1,
							beginAtZero: true
						}
					}]
				},
				title: {
					display: true,
					text: 'Total products per month'
				},
				legend: {
					display: false
				}
			}
		});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
