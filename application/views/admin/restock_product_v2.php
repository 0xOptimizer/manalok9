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
						<div class="col-12">
							<p class="text-subtitle text-muted">
								List of Product Stocks
							</p>
						</div>
						<div class="col-12 col-md-8 pt-4 pb-2">
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock']): ?>
								<a id="scan_barcode_stocking" href="#" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#add_stock_restocking">
									<i class="bi bi-plus-square"></i>
									SCAN BARCODE
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								<a id="add_stock" href="#" class="btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#add_stock_restocking_manual">
									<i class="bi bi-plus-square"></i>
									ADD STOCK
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock'] || $this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								|
							<?php endif; ?>
							<a href="#" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cloud-download"></i> GENERATE REPORT</a>
							<?php if ($this->session->userdata('UserRestrictions')['restocking_scan_add_stock'] || $this->session->userdata('UserRestrictions')['restocking_manual_add_stock']): ?>
								|
								<a href="#" class="btn btn-sm-secondary" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#restocking_cart_modal"><i class="bi bi-cart"></i> CART</a>
							<?php endif; ?>
						</div>
						<div class="col-sm-12 col-md-4 mr-auto pt-4 pb-2" style="margin-top: -15px;">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
								</div>
								<input type="text" id="tableStocksSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
							</div>
						</div>
					</div>
				</div>

				<section class="section">
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
											<?php if ($this->session->userdata('UserRestrictions')['restocking_delete_stock'] && 0): ?>
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

	<?php $this->load->view('admin/_modals/restocking/modal_manual_restock_product_selection.php'); ?>

	<?php $this->load->view('admin/_modals/generate_report')?>

	<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>/assets/js/jquery.js"></script>
	<?php $this->load->view('main/globals/scripts.php'); ?>

	<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.js"></script>
	<script>
			$('.sidebar-admin-restock_productv2').addClass('active');
		$(document).ready(function() {


			var tableProducts = $('#selectproductsTable').DataTable( {
				sDom: 'lrtip',
				'bLengthChange': false,
				'order': [[ 0, 'desc' ]],
			});
			$('#tableProductsSearch').on('keyup change', function(){
				tableProducts.search($(this).val()).draw();
			});

			var table = $('#list_release').DataTable( {
				sDom: 'lrtip',
				'bLengthChange': false,
				'order': [[ 0, 'desc' ]],
				buttons: [
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6, 7 ]
					},
					customize: function ( doc ) {
						$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
						$(doc.document.body).find('h1').css('font-size', '24px');
						$(doc.document.body).find('h1').css('text-align', 'center'); 
					}
				},
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6, 7 ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6, 7 ]
					}
				},
				{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6, 7 ]
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6, 7 ]
					}
				}
				]});
			$('body').on('click', '#generateReport-Print', function () {
				table.button('0').trigger();
			});
			$('body').on('click', '#generateReport-Copy', function () {
				table.button('1').trigger();
			});
			$('body').on('click', '#generateReport-Excel', function () {
				table.button('2').trigger();
			});
			$('body').on('click', '#generateReport-CSV', function () {
				table.button('3').trigger();
			});
			$('body').on('click', '#generateReport-PDF', function () {
				table.button('4').trigger();
			});
			$('#tableStocksSearch').on('keyup change', function(){
				table.search($(this).val()).draw();
			});

			$(document).on('click', '.manualselect-btn', function() {
				$('#add_stock_restocking_manual').data('openModal', 'products');
				$('#add_stock_restocking_manual').modal('toggle');
			});
			$(document).on('hidden.bs.modal', '#add_stock_restocking_manual', function (event) {
				if ($('#add_stock_restocking_manual').data('openModal') == 'products') {
					$('#add_stock_restocking_manual').data('openModal', '');
					$('#SelectProductSKUModal').modal('toggle');
				}
			});
			$(document).on('hidden.bs.modal', '#SelectProductSKUModal', function (event) {
				$('#add_stock_restocking_manual').modal('toggle');
			});

			$(document).on('click', '.select-product-row', function() {
				$('#m_pre_sku').val($(this).data('sku'));
				$('#m_orig_price').val($(this).find('.pCost').data('cost'));
				$('#m_r_price').val($(this).find('.pPrice').data('price'));

				$('#m_pre_sku').change();

				$('#SelectProductSKUModal').modal('toggle');
			});

		});
	</script>
	<script type="text/javascript">
		/* VARIABLES */
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/restocking.js"></script>
	<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
