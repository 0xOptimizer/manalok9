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

// Fetch user logs
$getUserLogs = $this->Model_Selects->GetUserLogs($this->session->userdata('UserID'));
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
					<div class="col-12 col-md-6">
						<h3>My Activities
							<span class="text-center success-banner-sm">
								<i class="bi bi-person-badge-fill"></i> <?=$getUserLogs->num_rows();?> TOTAL
							</span>
							<?php if ($getUserLogs->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No logs found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-0 col-md-10"></div>
					<div class="col-sm-12 col-md-2 mr-auto" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="logsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>ID</th>
							<th>EVENT</th>
							<th>DESCRIPTION</th>
							<th>URL</th>
							<th>DATE</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getUserLogs->num_rows() > 0):
								foreach ($getUserLogs->result_array() as $row): ?>
									<tr>
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td>
											<?=$row['Event']?>
										</td>
										<td>
											<?=($row['Description'] ? $row['Description'] : 'N/A')?>
										</td>
										<td>
											<a href="<?=$row['PageURL']?>"><i class="bi bi-link-45deg"></i></a>
										</td>
										<td>
											<?=$row['DateAdded']?>
										</td>
										<td>
											<?php
											$dateDiff = strtotime(date('Y-m-d h:i:s A')) - strtotime($row['DateAdded']);
											$days = $dateDiff / (60 * 60 * 24);
											$hours = $dateDiff / (60 * 60);
											$minutes = $dateDiff / 60;
											if ($days > 1) {
												$timePassed = floor($days) . 'd';
											}
											elseif ($hours > 1) {
												$timePassed = floor($hours) . 'h';
											}
											elseif ($minutes > 1) {
												$timePassed = floor($minutes) . 'm';
											} else {
												$timePassed = $dateDiff . 's';
											}
											?>
											<div class="text-muted"><?=$timePassed?> ago</div>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-employee-attendance').addClass('active');
$(document).ready(function() {
	
	var table = $('#logsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
    });
    $('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
