<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$getAllPurchaseOrders = $this->Model_Selects->GetOrders();
$GetOrderedTransactions = $this->Model_Selects->GetOrderedTransactions();

?>

</head>
<body>
<div id="app">
	<?php $this->load->view('main/template/sidebar') ?>
	<div id="main">
		<header class="mb-3">
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>
			<a href="<?=base_url() . 'admin/orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO PURCHASE ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6">
						<h3>Purchase Order Summary
							<?php if ($getAllPurchaseOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Purchase Orders found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<b>dd/mm/yyyy - <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button></b>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="ordersTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">DATE OF P.O</th>
							<th class="text-center">PURCHASE ORDER NO.</th>
							<th class="text-center">AMOUNT OF P.O</th>
							<th class="text-center">CLIENT'S NAME</th>
							<th class="text-center">ADDRESS</th>
							<?php
							$transactionProductCodes = array_unique(array_column($GetOrderedTransactions->result_array(), 'Code'));
							foreach ($transactionProductCodes as $key => $val): ?>
								<th class="text-center"><?=$val?></th>
							<?php endforeach; ?>
						</thead>
						<tbody>
							<?php
							if ($getAllPurchaseOrders->num_rows() > 0):
								foreach ($getAllPurchaseOrders->result_array() as $row): ?>
									<tr>
										<?php
										$poTransactions = $this->Model_Selects->GetOrderTransactions($row["ID"])->result_array();
										$totalAmount = array_sum(array_column($poTransactions, 'Amount'));
										?>
										<td class="text-center">
											<?=$row['DateCreation']?>
										</td>
										<td class="text-center">
											<?=$row['SeriesNo']?>
										</td>
										<td class="text-center">
											<?=$totalAmount?>
										</td>
										<td class="text-center">
											<?=$row['ClientName']?>
										</td>
										<td class="text-center">
											<?=$row['ShipAddress']?>
										</td>
										<?php
										foreach ($transactionProductCodes as $key => $val):
											$qty = 0;
											foreach ($poTransactions as $row) {
												if ($val == $row['Code']) {
													$qty += $row['Amount'];
												}
											} ?>
											<td class="text-center">
												<?=$qty?>
											</td>
										<?php endforeach; ?>
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
$('.sidebar-admin-orders').addClass('active');
$(document).ready(function() {
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
