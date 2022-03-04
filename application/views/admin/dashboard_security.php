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

// Fetch data
$getAllSecurityLogs = $this->Model_Selects->GetAllSecurityLogs();
$getAllUsers = $this->Model_Selects->GetAllUsers();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>
<style>
	/*body {
		background-color: #121b11 !important;
	}*/
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
			<a href="<?=base_url() . 'admin'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO DASHBOARD</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6">
						<h3>
							<i class="bi bi-shield-fill"></i> Security Overview
						</h3>
					</div>
					<div class="col-sm-12 col-md-10">
						<span class="text-center success-banner-sm">
							<i class="bi bi-eye-fill"></i> <?=$getAllSecurityLogs->num_rows();?> TOTAL PAGE VISITS
						</span>
						<span class="text-center success-banner-sm">
							<i class="bi bi-person-fill"></i> <?=$getAllUsers->num_rows();?> TOTAL USERS
						</span>
					</div>
					<div class="col-sm-12 col-md-2 mr-auto" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="securityTableSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="securityTable" class="standard-table-nodesign table">
						<thead style="font-size: 12px;">
							<th></th>
							<th>USER</th>
							<th>AGENT</th>
							<th>PLATFORM</th>
							<th>COUNTRY</th>
							<th>PAGE</th>
							<th>TIME</th>
						</thead>
						<tbody style="font-size: 14px;">
							<?php
							if ($getAllSecurityLogs->num_rows() > 0):
								foreach ($getAllSecurityLogs->result_array() as $row): ?>
									<tr style="background-color: #121b11;">
										<td>
											<span style="color: #198754;"><i class="bi bi-check-circle"></i></span>
										</td>
										<td>
											<?=$row['UserID'];?>
										</td>
										<td>
											<?=$row['Agent'];?>
										</td>
										<td>
											<?=$row['Platform'];?>
										</td>
										<td>
											<?=$row['IPAddress']?> (<?=$row['Country'];?>)
										</td>
										<td>
											<a href="<?=$row['PageURL'];?>"><?=$row['PageURL'];?></a>
										</td>
										<td>
											<span class="text-muted"><?=$row['DateAdded'];?></span>
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
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-dashboard').addClass('active');
$(document).ready(function() {
	var table = $('#securityTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#securityTableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
