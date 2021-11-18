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
										<?php if ($salesOrder['Status'] != '0'): ?>
											<th class="text-center">STATUS</th>
										<?php endif; ?>
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
													<?php if ($salesOrder['Status'] != '0'): ?>
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
													<?php endif; ?>
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
								<h6>SALES ORDER #</h6>
								<label><?=$salesOrder['OrderNo']?></label>
							</div>
							<div class="col-12">
								<h6>DATE</h6>
								<label><?=$salesOrder['Date']?></label>
							</div>
							<div class="col-12">
								<h6>BILL TO</h6>
								<label><?=$this->Model_Selects->GetClientByNo($salesOrder['BillToClientNo'])->row_array()['Name']?></label>
							</div>
							<div class="col-12 mb-3">
								<h6>SHIP TO</h6>
								<label><?=$this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array()['Name']?></label>
							</div>
							<?php $orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($salesOrder['OrderNo']); ?>
							<?php if ($orderTransactions->num_rows() > 0): ?>
								<div class="col-12 mb-2">
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
		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12">
						<h3>
							Invoicing
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<button type="button" class="salesinvoicing-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW</button>
					</div>
				</div>
			</div>
			<section>
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="invoicesTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">INVOICE #</th>
								<th class="text-center">CLIENT</th>
								<th class="text-center">AMOUNT</th>
								<th class="text-center">DATE</th>
								<th class="text-center">MODE OF PAYMENT</th>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<span class="db-identifier" style="font-style: italic; font-size: 12px;">
											1
										</span>
									</td>
									<td class="text-center">
										I-000001
									</td>
									<td class="text-center">
										John Doe
									</td>
									<td class="text-center">
										500.00
									</td>
									<td class="text-center">
										2021-10-22
									</td>
									<td class="text-center">
										CASH
									</td>
								</tr>
								<tr>
									<td class="text-center">
										<span class="db-identifier" style="font-style: italic; font-size: 12px;">
											2
										</span>
									</td>
									<td class="text-center">
										I-000002
									</td>
									<td class="text-center">
										Jane Doe
									</td>
									<td class="text-center">
										1,500.00
									</td>
									<td class="text-center">
										2021-10-24
									</td>
									<td class="text-center">
										CASH
									</td>
								</tr>
								<tr>
									<td class="font-weight-bold text-center" colspan="3">TOTAL</td>
									<td class="font-weight-bold text-center">2,000.00</td>
									<td colspan="2"></td>
								</tr>
								<tr style="border-color: #a7852d;">
									<td class="font-weight-bold text-center" colspan="3">REMAINING PAYMENT</td>
									<td class="font-weight-bold text-center">20,000.00</td>
									<td colspan="2"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="modal fade" id="SalesInvoicing" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<!-- <form id="formAddSalesOrder" action="<?php echo base_url() . 'FORM_addSalesOrder';?>" method="POST" enctype="multipart/form-data"> -->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> SO Invoicing</h4>
				</div>
				<div class="modal-body">
					<!-- <input type="hidden" name="productCount" id="ProductsCount" required> -->
					<div class="row">
						<div class="col-12">
							<div class="mx-auto">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text">
												TOTAL REMAINING PAYMENT
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.5em; color: #ebebeb;">
												<b>
													20,000.00
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12 col-md-6">
							<label class="input-label">VENDOR NAME</label>
							<input type="text" class="form-control" name="name" placeholder="John Doe" required>
						</div>
						<div class="form-group col-sm-12 col-md-6">
							<label class="input-label">AMOUNT</label>
							<input type="number" class="form-control" name="amount" placeholder="0.00" step="0.000001" required>
						</div>
						<div class="form-group col-sm-12 col-md-6">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
						<div class="form-group col-sm-12 col-md-6">
							<label class="input-label">MODE OF PAYMENT</label>
							<!-- <select class="form-control" name="mode">
								<option value="0" selected>None</option>
							</select> -->
							<input type="text" class="form-control" name="mode" placeholder="Cash" required>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Invoic</button>
				</div>
			</div>
		<!-- </form> -->
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
	// var tableInvoices = $('#invoicesTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	'bLengthChange': false,
	// 	'order': [[ 0, 'desc' ]],
	// });

	$('.salesinvoicing-btn').on('click', function() {
		$('#SalesInvoicing').modal('toggle');
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
