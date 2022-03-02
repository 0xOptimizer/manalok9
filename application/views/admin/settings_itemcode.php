<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>

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
					<div class="col-12 col-md-12">
						<h3>ITEM CODE</h3>
						
					</div>
					<div class="col-12 col-md-12 pt-4 pb-2">
						<button type="button" class="newitemcode-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW ITEM CODE</button>
					</div>
					<p class="text-subtitle text-muted">Create or update Item code properties.</p>
				</div>
			</div>

			<section class="section">
				<div class="table-responsive">
					<table id="itemcodess" class="table">
						<thead>
							<tr>
								<th>
									BRAND
								</th>
								<th>
									CHAR
								</th>
								<th>
									TYPE
								</th>
								<th>
									ITEM CODE
								</th>
								<th>
									UNIQUE CODE
								</th>
								<th>
									ACTION
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($AllItem_Code->result_array() as $row): ?>
								<tr scope="row">
									<td>
										<?php print $row['Brand_Top']; ?>
									</td>
									<td>
										<?php print $row['Cat_Char']; ?>
									</td>
									<td>
										<?php print $row['Prod_Type']; ?>
									</td>
									<td>
										<?php print $row['ItemCode']; ?>
									</td>
									<td>
										<?php print $row['uniqueID']; ?>
									</td>
									<td width="100">
										<a style="margin-left: 6px; color: #61B330;" href="#"><i class="bi bi-eye"></i></a>
										<a style="margin-left: 6px; color: #1BABD5 ;" href="#"><i class="bi bi-pencil"></i></a>
										<a style="margin-left: 6px; color: #C84534 ;" href="<?=base_url()?>admin/remove_thisicode?uid=<?php print $row['uniqueID']; ?>"><i class="bi bi-trash"></i></a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<?php $this->load->view('admin/modals/add_itemcode.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<!-- <script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {

	//--------------- SIDEBAR ---------------//
	$('.sidebar-admin-settings-itemcode').addClass('active');

	//--------------- TABLE ---------------//
	$('#itemcodess').DataTable();

	//--------------- MODALS ---------------//
	$('#add_itemcode').modal({
		backdrop: 'static',
		keyboard: false
	});
	$('.newitemcode-btn').on('click', function() {
		$('#add_itemcode').modal('toggle');
	});
	$("#ModalDismisss").on('click', function() {
		$('#add_itemcode').modal('toggle');
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
