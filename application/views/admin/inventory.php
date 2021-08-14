<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$totalStocks = 0;
$getAllProducts = $this->Model_Selects->GetAllProducts();
if ($getAllProducts->num_rows() > 0) {
	foreach ($getAllProducts->result_array() as $row) {
		$totalStocks += $row['InStock'];
	}
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
					<div class="col-sm-12">
						<h3>Inventory
							<span class="text-center success-banner-sm">
								<i class="bi bi-cart-fill"></i> <?=$totalStocks;?> IN STOCK
							</span>
							<span class="text-center info-banner-sm">
								<i class="bi bi-exclamation-triangle-fill"></i> JULY XX, XXXX TO AUGUST XX, XXXX
							</span>
							<!-- <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW</button> -->
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="btn btn-sm-success">TOTAL</button>
						<button type="button" class="btn btn-sm-secondary">MONTHLY</button>
						<button type="button" class="btn btn-sm-secondary">SEMI-ANNUAL</button>
						<button type="button" class="btn btn-sm-secondary">ANNUAL</button>
						<button type="button" class="btn btn-sm-secondary">CUSTOM DATE</button>
						|
						<button type="button" class="btn btn-sm-primary">GENERATE REPORT</button>
					</div>
					<div class="col-sm-12 col-md-2 mr-auto pt-4 pb-2" style="margin-top: -15px;">
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
					<table id="productsTable" class="table">
						<thead style="font-size: 12px;">
							<th>PRODUCT</th>
							<th>IN STOCKS</th>
							<th>SHO | Shopee</th>
							<th>PHYS | Physical Shop</th>
							<th>RELEASED</th>
							<!-- <th>CURRENT STOCKS</th> -->
						</thead>
						<tbody>
							<?php
							if ($getAllProducts->num_rows() > 0):
								foreach ($getAllProducts->result_array() as $row): ?>
									<tr>
										<td>
											<?=$row['Code'];?>
										</td>
										<td>
											<?=$row['InStock'];?>
										</td>
										<td>
											0
										</td>
										<td>
											0
										</td>
										<td>
											<?=$row['Released']?>
										</td>
										<!-- <td>
											150
										</td> -->
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
$('.sidebar-admin-inventory').addClass('active');
$(document).ready(function() {
	var table = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 1, "desc" ]],
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
