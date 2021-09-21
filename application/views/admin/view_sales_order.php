<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

if ($this->input->get('orderNo')) {
	$orderNo = $this->input->get('orderNo');
} else {
	redirect('admin/sales_orders');
}
$getSalesOrderByOrderNo = $this->Model_Selects->GetSalesOrderByNo($orderNo);
$salesOrder = $getSalesOrderByOrderNo->row_array();
$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($orderNo);

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
			<a href="<?=base_url() . 'admin/sales_orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO SALES ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6">
						<h3>Sales Order ID #<?=$salesOrder['ID']?>
							<?php if ($salesOrder['Status'] == '1'): ?>
								<span class="info-banner-sm"><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
							<?php elseif ($salesOrder['Status'] == '2'): ?>
								<span class="info-banner-sm"><i class="bi bi-cash" style="color:#E4B55B;"></i> Waiting For Payment</span>
							<?php else: ?>
								<span class="info-banner-sm text-danger"><i class="bi bi-trash"></i> Rejected</span>
							<?php endif; ?>
						</h3>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-12 col-sm-7 col-md-9">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<table id="transactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">ID</th>
										<th class="text-center">PRODUCT CODE</th>
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center">PRICE</th>
										<th class="text-center">TRANSACTION DATE</th>
										<th class="text-center">STATUS</th>
										<th class="text-center">USER</th>
										<?php if ($salesOrder['Status'] == '1'): ?>
											<th></th>
										<?php endif; ?>
									</thead>
									<tbody>
										<?php
										if ($getTransactionsByOrderNo->num_rows() > 0):
											foreach ($getTransactionsByOrderNo->result_array() as $row): ?>
												<tr>
													<td class="text-center">
														<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
													</td>
													<td class="text-center">
														<?=$row['Code']?>
													</td>
													<td class="text-center">
														<?=$row['TransactionID']?>
													</td>
													<td class="text-center">
														<?=$row['Amount']?>
													</td>
													<td class="text-center">
														<?=number_format($row['PriceUnit'], 2)?>
													</td>
													<td class="text-center">
														<?=$row['Date']?>
													</td>
													<td class="text-center">
														<?php if ($row['Status'] == '0'): ?>
															<span class="text-center info-banner-sm">
																<i class="bi bi-asterisk"></i>&nbsp;Pending
															</span>
														<?php elseif ($row['Status'] == '1'): ?>
															<span class="text-center success-banner-sm">
																<i class="bi bi-check-circle-fill"></i>&nbsp;Approved
															</span>
														<?php endif; ?>
													</td>
													<td class="text-center">
														<?=$row['UserID']?>
													</td>
													<?php if ($salesOrder['Status'] == '1'): ?>
														<td class="text-center">
															<i class="bi bi-x-square text-danger removeot-btn" data-transactionid="<?=$row['TransactionID']?>"></i>
														</td>
													<?php endif; ?>
												</tr>
										<?php endforeach;
										endif; ?>
									</tbody>
								</table>
								<form id="removeSalesOrderTransaction" action="<?php echo base_url() . 'FORM_removeSalesOrderTransaction';?>" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="order_no" value="<?=$salesOrder['OrderNo']?>">
									<input id="rOTTransactionID" type="hidden" name="transaction_id">
								</form>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-5 col-md-3">
						<div class="row">
							<div class="col-12">
								<h6>Sales Order #</h6>
								<label><?=$salesOrder['OrderNo']?></label>
							</div>
							<div class="col-12">
								<h6>DATE CREATION</h6>
								<label><?=$salesOrder['DateCreation']?></label>
							</div>
							<div class="col-12">
								<h6>BILL TO</h6>
								<label><?=$this->Model_Selects->GetClientByNo($salesOrder['BillToClientNo'])->row_array()['Name']?></label>
							</div>
							<div class="col-12">
								<h6>SHIP TO</h6>
								<label><?=$this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array()['Name']?></label>
							</div>
							<?php if ($salesOrder['Status'] != '0'): ?>
								<?php $orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo']); ?>
								<div class="col-12 mt-2">
									<div class="card">
										<div class="text-center p-2">
											<div class="row">
												<span class="head-text">
													TOTAL ITEMS
												</span>
											</div>
											<div class="row">
												<span style="font-size: 1.5em; color: #ebebeb;">
													<b>
														<?=$orderTransactions->num_rows()?>
													</b>
												</span>
											</div>
											<div class="row">
												<span class="head-text">
													TOTAL PRICE
												</span>
											</div>
											<div class="row">
												<span style="font-size: 1.5em; color: #ebebeb;">
													<b>
														<?php
														if ($orderTransactions->num_rows() > 0) {
															$transactionsPriceTotal = 0;
															foreach ($orderTransactions->result_array() as $transaction) {
																$transactionsPriceTotal += $transaction['Amount'] * $transaction['PriceUnit'];
															}
															echo number_format($transactionsPriceTotal, 2);
														} else {
															echo '0';
														}
														?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?php if ($salesOrder['Status'] == '1'): ?>
								<div class="col-12 text-center">
									<form id="approveSalesOrder" action="<?php echo base_url() . 'FORM_approveSalesOrder';?>" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="order_no" value="<?=$salesOrder['OrderNo']?>">
										<input id="orderApproved" type="hidden" name="approved">
										<button type="button" class="btn btn-danger rejectOrder"><i class="bi bi-trash-fill"></i> Reject</button>
										<button type="button" class="btn btn-success approveOrder"><i class="bi bi-check2"></i> Approve</button>
									</form>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-sales-orders').addClass('active');
$(document).ready(function() {
	var tableTransactions = $('#transactionsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});

	$(document).on('click', '.removeot-btn', function() {
		if (!confirm('Remove Transaction from Sales Order?') && $(this).data('id').length > 0) {
			event.preventDefault();
		} else {
			$('#rOTTransactionID').val($(this).data('transactionid'));
			$('#removeSalesOrderTransaction').submit();
		}
	});
	$(document).on('click', '.rejectOrder', function() {
		if (!confirm('Reject Sales Order?')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('0');
			$('#approveSalesOrder').submit();
		}
	});
	$(document).on('click', '.approveOrder', function() {
		if (!confirm('Approve Sales Order?')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('1');
			$('#approveSalesOrder').submit();
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
