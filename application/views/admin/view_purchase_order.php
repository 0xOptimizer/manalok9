<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

if ($this->input->get('orderNo')) {
	$orderNo = $this->input->get('orderNo');
} else {
	redirect('admin/purchase_orders');
}
$getPurchaseOrderByOrderNo = $this->Model_Selects->GetPurchaseOrderByNo($orderNo);
$purchaseOrder = $getPurchaseOrderByOrderNo->row_array();
$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($orderNo);

$getPOBills = $this->Model_Selects->GetBillsByPONo($orderNo);

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
			<a href="<?=base_url() . 'admin/purchase_orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO PURCHASE ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12">
						<h3>Purchase Order ID #<?=$purchaseOrder['ID']?>
							<?php if ($purchaseOrder['Status'] == '1'): ?>
								<span class="info-banner-sm"><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
							<?php elseif ($purchaseOrder['Status'] == '2'): ?>
								<span class="info-banner-sm text-success"><i class="bi bi-check-circle"></i> Received</span>
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
										<th class="text-center">TOTAL</th>
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
														<?=number_format($row['Amount'].$row['PriceUnit'], 2)?>
													</td>
												</tr>
										<?php endforeach;
										endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-5 col-md-3">
						<div class="row">
							<div class="col-12">
								<h6>PURCHASE ORDER #</h6>
								<label><?=$purchaseOrder['OrderNo']?></label>
							</div>
							<div class="col-12">
								<h6>DATE CREATION</h6>
								<label><?=$purchaseOrder['DateCreation']?></label>
							</div>
							<?php 
							$v_details = $this->Model_Selects->GetVendorByNo($purchaseOrder['VendorNo'])->row_array();
							?>
							<div class="col-12 mb-3">
								<h6>PURCHASED FROM</h6>
								<label><?=$v_details['Name']?> (
									<a href="<?=base_url() . 'admin/vendors#'. $purchaseOrder["VendorNo"]?>">
										<i class="bi bi-eye"></i> <?=$purchaseOrder['VendorNo']?>
									</a>
								)</label>
							</div>
							<?php $orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($purchaseOrder['OrderNo']); ?>
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
													$transactionsPriceTotal = 0;
													foreach ($orderTransactions->result_array() as $transaction) {
														$transactionsPriceTotal += $transaction['Amount'] * $transaction['PriceUnit'];
													}
													echo number_format($transactionsPriceTotal, 2);
													?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php if ($purchaseOrder['Status'] == '1' && $this->session->userdata('UserRestrictions')['purchase_orders_approve'] == 1): ?>
								<div class="col-12 text-center">
									<form id="approvePurchaseOrder" action="<?php echo base_url() . 'FORM_approvePurchaseOrder';?>" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="order_no" value="<?=$purchaseOrder['OrderNo']?>">
										<input id="orderApproved" type="hidden" name="approved">
										<button type="button" class="btn btn-danger rejectOrder"><i class="bi bi-trash-fill"></i> REJECT</button>
										<button type="button" class="btn btn-success approveOrder"><i class="bi bi-check2"></i> APPROVE</button>
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
							Bills
						</h3>
					</div>
				</div>
				<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_bill_creation'] == 1): ?>
				<div class="row">
					<div class="col-12">
						<button type="button" class="purchasebilling-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW</button>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<section>
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="billsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">BILL #</th>
								<th class="text-center">VENDOR</th>
								<th class="text-center">AMOUNT</th>
								<th class="text-center">DATE</th>
								<th class="text-center">MODE OF PAYMENT</th>
								<th class="text-center"></th>
							</thead>
							<tbody>
							<?php if ($getPOBills->num_rows() > 0):
								foreach ($getPOBills->result_array() as $row): ?>
									<tr>
										<td class="text-center">
											<?=$row['BillNo']?>
										</td>
										<td class="text-center">
											<?=$v_details['Name']?>
										</td>
										<td class="text-center">
											<?=number_format($row['Amount'], 2)?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<?=$row['ModeOfPayment']?>
										</td>
										<td>
											<a href="FORM_removeBill?bno=<?=$row['BillNo']?>">
												<button type="button" class="btn removeBill"><i class="bi bi-x-square text-danger"></i></button>
											</a>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
								<?php
								$total_bill_amount = $this->Model_Selects->GetTotalBillsByPONo($purchaseOrder['OrderNo'])->row_array()['Amount'];
								?>
								<tr>
									<td class="font-weight-bold text-center" colspan="2">TOTAL</td>
									<td class="font-weight-bold text-center"><?=number_format($total_bill_amount, 2)?></td>
									<td colspan="3"></td>
								</tr>
								<tr style="border-color: #a7852d;">
									<td class="font-weight-bold text-center" colspan="2">REMAINING PAYMENT</td>
									<td class="font-weight-bold text-center"><?=number_format($transactionsPriceTotal - $total_bill_amount, 2)?></td>
									<td colspan="3"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_bill_creation'] == 1): ?>
<div class="modal fade" id="PurchaseBilling" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formAddPOBill" action="<?php echo base_url() . 'FORM_addPOBill';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> PO Bills</h4>
				</div>
				<div class="modal-body">
					<?php
					$v_details = $this->Model_Selects->GetVendorByNo($purchaseOrder['VendorNo'])->row_array();
					?>
					<input type="hidden" name="purchase-order-no" value="<?=$purchaseOrder['OrderNo']?>" required>
					<div class="row">
						<div class="col-12">
							<div class="mx-auto">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														VENDOR NAME
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$v_details['Name']?>
														</b>
													</span>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														VENDOR #
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$v_details['VendorNo']?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">AMOUNT</label>
							<input type="number" class="form-control" name="amount" placeholder="0.00" step="0.000001" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="mode-payment">MODE OF PAYMENT</label>
							<input type="text" class="form-control" name="mode-payment" placeholder="Cash" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Bill</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php endif; ?>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-purchase-orders').addClass('active');
$(document).ready(function() {
	var tableTransactions = $('#transactionsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	// var tableBills = $('#billsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	'bLengthChange': false,
	// 	'order': [[ 0, 'desc' ]],
	// });

	$('.purchasebilling-btn').on('click', function() {
		$('#PurchaseBilling').modal('toggle');
	});

	$(document).on('click', '.removeot-btn', function() {
		if (!confirm('Remove Transaction from Purchase Order?') && $(this).data('id').length > 0) {
			event.preventDefault();
		} else {
			$('#rOTTransactionID').val($(this).data('transactionid'));
			$('#removePurchaseOrderTransaction').submit();
		}
	});
	$(document).on('click', '.rejectOrder', function() {
		if (!confirm('Reject Purchase Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('0');
			$('#approvePurchaseOrder').submit();
		}
	});
	$(document).on('click', '.approveOrder', function() {
		if (!confirm('Approve Purchase Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('1');
			$('#approvePurchaseOrder').submit();
		}
	});

	$(document).on('click', '.removeBill', function() {
		if (!confirm('Remove Bill?')) {
			event.preventDefault();
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
