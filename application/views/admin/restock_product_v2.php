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
	.btn { 
		margin-top: 4px;
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
							<h3>
								<i class="bi bi-card-list"></i> Restocking
							</h3>
						</div>
						<div class="col-12 col-md-12 pt-4 pb-2">
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock']): ?>
								<a id="scan_barcode_stocking" href="#" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#add_stock_restocking">
									<i class="bi bi-plus-square"></i>
									SCAN BARCODE
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								<a id="add_stock" href="#" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#add_stock_restocking_manual">
									<i class="bi bi-plus-square"></i>
									ADD STOCK
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock'] || $this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								|
							<?php endif; ?>
							<a href="#" class="scnrestock-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cloud-download"></i> GENERATE REPORT</a>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock'] || $this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								|
								<a href="#" class="scnrestock-btn btn btn-sm-secondary" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#restocking_cart_modal"><i class="bi bi-cart"></i> CART</a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<section class="section">
					<div class="col-12">
						<p class="text-subtitle text-muted">
							List of Product Stocks
						</p>
					</div>
					<div class="table-responsive">
						<table id="list_release" class="table">
							<thead>
								<th>
									ID
								</th>
								<th>
									SKU
								</th>
								<th>
									STOCKS
								</th>
								<th>
									REMAINING
								</th>
								<th>
									RELEASED
								</th>
								<th>
									RETAIL PRICE
								</th>
								<th>
									ORIG. PRICE
								</th>
								<th>
									EXPIRATION
								</th>
								<th>
									ACTION
								</th>
							</thead>
							<tbody>
								<?php foreach ($get_allstocks->result_array() as $row): ?>
									<tr>
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td>
											<?php echo (!empty($row['Product_SKU'])) ? $row['Product_SKU'] : 'N/A'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Stocks'])) ? $row['Stocks'] : '0'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Current_Stocks'])) ? $row['Current_Stocks'] : '0'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Released_Stocks'])) ? $row['Released_Stocks'] : '0'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Retail_Price'])) ? $row['Retail_Price'] : '---'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Price_PerItem'])) ? $row['Price_PerItem'] : '---'; ?>
										</td>
										<td>
											<?php echo (!empty($row['Expiration_Date'])) ? $row['Expiration_Date'] : '---'; ?>
										</td>
										<td>
											<a class="modal_view mx-2 text-primary" href="#" data-id="<?php echo $row['ID']; ?>">
												<i class="bi bi-eye"></i>
											</a>
											<?php if ($this->session->userdata('UserRestrictions')['restocking_update_stock']): ?>
												<a class="modal_update mx-2 text-success" href="#" data-id="<?php echo $row['ID']; ?>">
													<i class="bi bi-pencil-square"></i>
												</a>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['restocking_delete_stock']): ?>
												<a class="modal_delete mx-2 text-danger" href="#" data-id="<?php echo $row['ID']; ?>">
													<i class="bi bi-trash"></i>
												</a>
											<?php endif; ?>
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
	<div class="notif_prompts">
		<?php print $this->session->flashdata('prompt_status'); ?>
	</div>

	<?php $this->load->view('admin/_modals/restocking/add_stock_restocking.php'); ?>
	<?php $this->load->view('admin/_modals/restocking/add_stock_scan_barcode.php'); ?>
	<?php $this->load->view('admin/_modals/restocking/cart_modal_restocking.php'); ?>
	<?php $this->load->view('admin/_modals/restocking/delete_stock_modal.php'); ?>
	<?php $this->load->view('admin/_modals/restocking/view_stock_modal.php'); ?>
	<?php $this->load->view('admin/_modals/restocking/update_stock_modal.php'); ?>


	<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>/assets/js/jquery.js"></script>
	<?php $this->load->view('main/globals/scripts.php'); ?>

	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.js"></script>
	<script>
			$('.sidebar-admin-restock_productv2').addClass('active');
		$(document).ready(function() {


			$('#list_release').DataTable();

		});
	</script>
	<script type="text/javascript">
		/* VARIABLES */
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/restocking.js"></script>
	<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
