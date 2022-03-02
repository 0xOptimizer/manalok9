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

// Fetch products
$getDashLogs = $this->Model_Selects->GetDashboardLogs();

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
							<h3><i class="bi bi-calendar-check-fill"></i> Dashboard</h3>
						</div>
					</div>
				</div>
				<section class="section">
					<div class="row">
						<div class="col-sm-12 col-lg-8">
						<!-- <div class="col-1 ml-auto chart-hover-settings" style="margin-top: -30px; display: none;">
							<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-cog" style="margin-right: -1px;"></i></button>
						</div> -->
						<canvas id="productsChart" class="tppm-chart"></canvas>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="row">
							<div class="col-md-12">
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
													<?php if ($tps['InStock'] < 1) { echo '0'; } else { echo $tps['InStock']; } ?>
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<small>Total remaining stock</small>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row ml-2">
											<span class="head-text">
												RESTOCKED
											</span>
										</div>
										<div class="row ml-2">
											<span style="font-size: 2em; color: #ebebeb;">
												<b>
													<?php if ($totalrestock['Amount'] < 1) { echo '0'; } else { echo $totalrestock['Amount']; } ?>
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<small>Total stock added</small>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
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
													<?php if ($total_released['Amount'] < 1) { echo '0'; } else { echo $total_released['Amount']; } ?>
													
												</b>
											</span>
											<i class="fas fa-user-friends fa-fw card-icon ml-auto mr-2"></i>
										</div>
										<div class="wercher-card-weekly-tracker-container">
											<div class="wercher-card-weekly-tracker">
												<small>Total stock released</small>
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
									<?php if ($getDashLogs->num_rows() > 0):
										foreach ($getDashLogs->result_array() as $row): ?>
											<div class="row mt-2" style="border-bottom: 1px solid #3c3c3c; padding-bottom: 10px;">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<<?=$row['UserID']?>> <?=$row['Event']?>
													</b>
												</span>
												<div class="col-sm-12">
													<?php
													$dateDiff = strtotime(date('Y-m-d h:i:s A')) - strtotime($row['DateAdded']);
													$days = $dateDiff / (60 * 60 * 24);
													$hours = $dateDiff / (60 * 60);
													$minutes = $dateDiff / 60;
													if ($days > 1) {
														$timePassed = floor($days) . ' day';
														if ($days >= 2) {
															$timePassed .= 's';
														}
													}
													elseif ($hours > 1) {
														$timePassed = floor($hours) . ' hour';
														if ($hours >= 2) {
															$timePassed .= 's';
														}
													}
													elseif ($minutes > 1) {
														$timePassed = floor($minutes) . ' minute';
														if ($minutes >= 2) {
															$timePassed .= 's';
														}
													} else {
														$timePassed = $dateDiff . ' seconds';
													}
													?>
													<div class="text-muted"><?=$timePassed?> ago</div>
												</div>
											</div>
										<?php endforeach;
									endif;?>
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
									<div class="row">
										<div class="col-12 mt-2">
											<button type="button" class="btn btn-primary" style="width: 150px;"><i class="bi bi-server"></i> DATABASE</button>
										</div>
										<div class="col-12 mt-2">
											<button type="button" class="backup-btn btn btn-info" style="width: 150px;"><i class="bi bi-back"></i> BACKUP</button>
										</div>
										<div class="col-12 mt-2">
											<a href="<?=base_url() . 'admin/security';?>" class="btn btn-danger" style="width: 150px;"><i class="bi bi-shield-fill"></i> SECURITY</a>
										</div>
										<div class="col-12 mt-2">
											<button type="button" class="btn btn-secondary" style="width: 150px;"><i class="bi bi-wrench"></i> SETTINGS</button>
										</div>
									</div>
								</div>
								<!-- <div class="row ml-2 mt-2">
									<div class="col-sm-12">
										<span class="success-banner-sm">
											<i class="bi bi-check-circle-fill"></i> DATABASE LAST BACKED UP 2 DAYS AGO
										</span>
									</div>
								</div> -->
								<div class="row ml-2 mt-2">
									<div class="col-sm-12">
										<span class="success-banner-sm">
											<i class="bi bi-check-circle-fill"></i> 0 SUSPICIOUS VISITS FOUND
										</span>
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
<!-- Create a new employee modal -->
<?php $this->load->view('admin/modals/database_backupprompt.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">
<script src="<?php base_url(); ?>assets/js/Chart.bundle.min.js"></script>

<script>
$('.sidebar-admin-dashboard').addClass('active');
$(document).ready(function() {
	$('.backup-btn').on('click', function() {
		$('#databaseBackupPrompt').modal('toggle');
	});
	var totalProducts = new Chart(document.getElementById('productsChart'), {
		type: 'line',
		data: {
			labels: [<?php foreach ($all_months as $row) {
				$monthNum  = $row;
				$dateObj   = DateTime::createFromFormat('!m', $monthNum);
				$monthName = $dateObj->format('F');
				echo '"'.$monthName.'",';
			}?>],
			datasets: [{
				label: 'Total Products',
				data: [
				<?php foreach ($month_count as $row) {
					echo '"'.$row.'",';
				} ?>
				],
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
