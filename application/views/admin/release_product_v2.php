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
	</script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/releasing.js"></script>

	<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
