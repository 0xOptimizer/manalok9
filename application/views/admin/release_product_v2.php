<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');


// Fetch products
$getAllReleases = $this->Model_Selects->GetAllReleases();

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
	.card_stockdetails
	{
		/*background-color: #f2f7ff;*/
		border-radius: 7px;
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
								<i class="bi bi-card-checklist"></i> Releasing
							</h3>
						</div>
						<div class="col-12 col-md-12 pt-4 pb-2">
							<?php if ($this->session->userdata('UserRestrictions')['releasing_scan_add_stock']): ?>
								<a href="#" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#modal_scan_releasing">
									<i class="bi bi-plus-square"></i>
									SCAN BARCODE
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['releasing_manual_add_stock']): ?>
								<a href="#" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#modal_manual_releasing">
									<i class="bi bi-plus-square"></i>
									RELEASE STOCK
								</a>
							<?php endif; ?>
							<?php if ($this->session->userdata('UserRestrictions')['releasing_scan_add_stock'] || $this->session->userdata('UserRestrictions')['releasing_manual_add_stock']): ?>
								|
							<?php endif; ?>
							<a href="#" class="scnrestock-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cloud-download"></i> GENERATE REPORT</a>
							<!-- | -->
							<!-- <a href="#" class="btn btn-sm-secondary" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target=""><i class="bi bi-cart"></i> CART</a> -->
						</div>
					</div>
				</div>

				<section class="section">
					<div class="col-12">
						<p class="text-subtitle text-muted">
							Click SCAN BARCODE or RELEASE STOCK to proceed.
						</p>
					</div>
					
					<div class="card my-4">
						<div class="card-body">
							<h6 class="my-4">
								STOCK DETAILS
							</h6>
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2"> UID </dt>
								<dd class="col-12 col-sm-12 col-md-10"> <span id="s_uid">-----------</span> </dd>
								<dt class="col-12 col-sm-12 col-md-2"> SKU </dt>
								<dd class="col-12 col-sm-12 col-md-10"> <span id="s_sku">-----------</span> </dd>
							</dl>
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2"> Stock </dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<dl class="row">
										<dt class="col-6 col-sm-6 col-md-2">
											Current
										</dt>
										<dd class="col-6 col-sm-6 col-md-10">
											<span id="c_stocks">-----------</span>
										</dd>
										<dt class="col-6 col-sm-6 col-md-2">
											Released
										</dt>
										<dd class="col-6 col-sm-6 col-md-10">
											<span id="r_stocks">-----------</span>
										</dd>
									</dl>
								</dd>
							</dl>
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2"> Price </dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<dl class="row">
										<dt class="col-6 col-sm-6 col-md-2">
											Retail 
										</dt>
										<dd class="col-6 col-sm-6 col-md-10">
											&#8369; <span id="r_price">-----------</span>
										</dd>
										<dt class="col-6 col-sm-6 col-md-2">
											Original
										</dt>
										<dd class="col-6 col-sm-6 col-md-10">
											&#8369; <span id="or_price">-----------</span>
										</dd>
										<dt class="col-6 col-sm-6 col-md-2">
											Total
										</dt>
										<dd class="col-6 col-sm-6 col-md-10">
											&#8369; <span id="total_pricesss">-----------</span>
										</dd>
									</dl>
								</dd>
							</dl>
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2"> Manufacturer </dt>
								<dd class="col-12 col-sm-12 col-md-10"> <span id="manufacturer_name">-----------</span> </dd>
								<dt class="col-12 col-sm-12 col-md-2"> Expiration Date </dt>
								<dd class="col-12 col-sm-12 col-md-10"> <span id="exp_date">-----------</span> </dd>
								<dt class="col-12 col-sm-12 col-md-2"> Description </dt>
								<dd class="col-12 col-sm-12 col-md-10"> <span id="descrpts">-----------</span> </dd>
							</dl>
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2"></dt>
								<?php if ($this->session->userdata('UserRestrictions')['releasing_scan_add_stock'] || $this->session->userdata('UserRestrictions')['releasing_manual_add_stock']): ?>
									<dd class="col-12 col-sm-12 col-md-10"><button id="btn_release_stock" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#release_inp_quantity" data-id="" data-uid="" data-sku="" data-quantity=""><i class="bi bi-check"></i> Release</button></dd>
								<?php endif; ?>
							</dl>
						</div>
					</div>

					<hr class="my-5">

					<div class="row">
						<div class="col-12 col-md-12">
							<h3>
								<i class="bi bi-card-checklist"></i> Releases
							</h3>
						</div>
						<div class="col-sm-12 col-md-4 ms-auto pt-4 pb-2" style="margin-top: -15px;">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
								</div>
								<input type="text" id="tableReleasesSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table id="releasesTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">DATE</th>
								<th class="text-center">CODE</th>
								<th class="text-center">QTY</th>
								<th class="text-center">RELEASED TO</th>
								<th class="text-center">STOCK ID</th>
								<th class="text-center">RELEASED BY</th>
								<th class="text-center"></th>
							</thead>
							<tbody>
								<?php
								if ($getAllReleases->num_rows() > 0):
									foreach ($getAllReleases->result_array() as $row): 
										$user = $this->Model_Selects->GetUserDetails($userID)->row_array();
										?>
										<tr>
											<td class="text-center">
												<?=$row['Date']?>
											</td>
											<td class="text-center">
												<?=$row['TransactionID']?>
											</td>
											<td class="text-center">
												<?=$row['Qty']?>
											</td>
											<td class="text-center">
												<?=(strlen($row['ReleasedTo']) > 0 ? $row['ReleasedTo'] : '---')?>
											</td>
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['StockID']?></span>
											</td>
											<td class="text-center">
												<?=$user['LastName'] .', '. $user['FirstName']?>
											</td>
											<td class="text-center">
												<?php if (0): ?>
													<a class="text-danger" href="admin/Delete_release?id=<?=$row['ID']?>">
														<i class="bi bi-trash"></i>
													</a>
												<?php endif; ?>
												<?php if ($this->session->userdata('UserRestrictions')['releasing_edit']): ?>
													<a class="update-product-btn text-warning" href="#" data-id="<?=$row['ID']?>" data-releasedto="<?=$row['ReleasedTo']?>">
														<i class="bi bi-pencil"></i>
													</a>
												<?php endif; ?>
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
	<div class="notif_prompts">
		<?php print $this->session->flashdata('prompt_status'); ?>
	</div>

	<?php $this->load->view('admin/_modals/releasing/modal_scan_releasing.php'); ?>
	<?php $this->load->view('admin/_modals/releasing/modal_manual_releasing.php'); ?>
	<?php $this->load->view('admin/_modals/releasing/modal_release_quantity.php'); ?>
	<?php $this->load->view('admin/_modals/releasing/modal_stock_selection.php'); ?>
	<?php $this->load->view('admin/_modals/releasing/modal_release_update.php'); ?>

	<?php $this->load->view('admin/_modals/releasing/modal_manual_release_product_selection.php'); ?>


	<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>/assets/js/jquery.js"></script>
	<?php $this->load->view('main/globals/scripts.php'); ?>

	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.js"></script>
	<script>
			$('.sidebar-admin-releasing_productv2').addClass('active');
		$(document).ready(function() {


		});
	</script>
	<script type="text/javascript">
		/* VARIABLES */
		var tableStocks = $('#selectstocksTable').DataTable( {
			sDom: 'lrtip',
			'bLengthChange': false,
			'order': [[ 0, 'desc' ]],
			'createdRow': function(row, data, dataIndex) {
				$(row).addClass('select-stock-row').data('stock_id', data[0]);
			},
			'columnDefs': [ {
					'targets': 0,
					'createdCell': function (td, cellData, rowData, row, col) {
						$(td).addClass('text-center').html($('<span>').addClass('db-identifier').css({ 'font-style': 'italic', 'font-size': '12px' }).html(cellData)).data('stockID',cellData);
					}
				}, {
					'targets': 1,
					'createdCell': function (td, cellData, rowData, row, col) {
						$(td).addClass('text-center');
					}
				}, {
					'targets': 2,
					'createdCell': function (td, cellData, rowData, row, col) {
						$(td).addClass('text-center');
					}
				}, {
					'targets': 3,
					'createdCell': function (td, cellData, rowData, row, col) {
						$(td).addClass('stockPrice text-center').html(parseFloat(cellData).toFixed(2)).data('retailPrice', cellData);
					}
				}, {
					'targets': 4,
					'createdCell': function (td, cellData, rowData, row, col) {
						$(td).addClass('text-center');
					}
				}
			]
		});
		$('#tableStocksSearch').on('keyup change', function(){
			tableStocks.search($(this).val()).draw();
		});

		var tableProducts = $('#selectproductsTable').DataTable( {
			sDom: 'lrtip',
			'bLengthChange': false,
			'order': [[ 5, 'desc' ]],
		});
		$('#tableProductsSearch').on('keyup change', function(){
			tableProducts.search($(this).val()).draw();
		});

		$(document).on('click', '.manualselect-btn', function() {
			$('#modal_manual_releasing').data('openModal', 'products');
			$('#modal_manual_releasing').modal('toggle');
		});
		$(document).on('hidden.bs.modal', '#modal_manual_releasing', function (event) {
			if ($('#modal_manual_releasing').data('openModal') == 'products') {
				$('#modal_manual_releasing').data('openModal', '');
				$('#SelectProductSKUModal').modal('toggle');
			}
		});
		$(document).on('hidden.bs.modal', '#SelectProductSKUModal', function (event) {
			$('#modal_manual_releasing').modal('toggle');
		});

		$(document).on('click', '.select-product-row', function() {
			$('#inp_sku').val($(this).data('sku'));

			$('#inp_sku').change();

			$('#SelectProductSKUModal').modal('toggle');
		});


		// RELEASES TABLE
		var tableReleases = $('#releasesTable').DataTable( {
			sDom: 'lrtip',
			'bLengthChange': false,
			'order': [[ 0, 'desc' ]],
		});
		$('#tableReleasesSearch').on('keyup change', function(){
			tableReleases.search($(this).val()).draw();
		});

		$(document).on('click', '.update-product-btn', function() {
			$('#releaseID').val($(this).data('id'));
			$('#released_to').val($(this).data('releasedto'));

			$('#UpdateReleaseModal').modal('toggle');
		});
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/releasing.js"></script>

	<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
