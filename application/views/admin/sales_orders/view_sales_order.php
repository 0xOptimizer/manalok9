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

$clientBTDetails = $this->Model_Selects->GetClientByNo($salesOrder['BillToClientNo'])->row_array();
$clientSTDetails = $this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array();

$getSOBills = $this->Model_Selects->GetInvoicesBySONo($orderNo);

$getAccounts = $this->Model_Selects->GetAccountSelection();


$return = $this->Model_Selects->GetReturnBySalesNo($salesOrder['OrderNo']);
$returnedProducts = array();

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
	@media print {
		.printExclude {
			display: none;
		}
		.modal-backdrop {
			opacity: 0 !important;
		}
		#app {
			display: none;
		}
		#salesOrderForm {
			display: block;
		}
		#salesOrderForm td {
			color: black !important;
		}
		#salesOrderForm td span {
			max-width: 100%;
		}
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
						<h3><i class="bi bi-receipt"></i> Sales Order ID #<?=$salesOrder['ID']?>
							<?php if ($salesOrder['Status'] == '1'): ?>
								<span class="info-banner-sm"><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
							<?php elseif ($salesOrder['Status'] == '2'): ?>
								<span class="info-banner-sm"><i class="bi bi-cash" style="color:#E4B55B;"></i> For Invoicing</span>
							<?php elseif ($salesOrder['Status'] == '3'): ?>
								<span class="info-banner-sm"><i class="bi bi-truck" style="color:#E4B55B;"></i> For Delivery</span>
							<?php elseif ($salesOrder['Status'] == '4'): ?>
								<span class="info-banner-sm"><i class="bi bi-check2" style="color:#E4B55B;"></i> Delivered</span>
							<?php elseif ($salesOrder['Status'] == '5'): ?>
								<span class="info-banner-sm text-success"><i class="bi bi-check-circle"></i> Received</span>
							<?php else: ?>
								<span class="info-banner-sm text-danger"><i class="bi bi-trash"></i> Rejected</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-12">
						<button type="button" class="generateform-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE SO FORM</button>
						|
						<?php if ($this->session->userdata('UserRestrictions')['sales_orders_accounting']): ?>
							<button type="button" class="accounting-btn btn btn-sm-secondary" style="font-size: 12px;"><i class="bi bi-receipt"></i> ACCOUNTING</button>
						<?php endif; ?>
						<button type="button" class="log-btn btn btn-sm-secondary" style="font-size: 12px;"><i class="bi bi-list"></i> LOG</button>
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
										<th class="text-center">#</th>
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">PRODUCT CODE</th>
										<th class="text-center">STOCK ID</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center">PRICE</th>
										<th class="text-center">TOTAL</th>
										<th class="text-center">FREEBIE</th>
									</thead>
									<tbody>
										<?php
										if ($getTransactionsByOrderNo->num_rows() > 0):
											foreach ($getTransactionsByOrderNo->result_array() as $no => $row): ?>
												<tr>
													<?php
													$returnedProduct = $this->Model_Selects->GetReturnProductByTID($row['TransactionID']);
													$totalReturnedQty = 0;
													if ($returnedProduct->num_rows() > 0) {
														$rProductDetails = $returnedProduct->row_array();
														$rProductDetails['PriceUnit'] = $row['PriceUnit'];
														array_push($returnedProducts, $rProductDetails);
														$totalReturnedQty = $rProductDetails['quantity'] + $rProductDetails['returned'];
													}
													?>
													<td class="text-center">
														<span style="font-style: italic; font-size: 12px;"><?=$no+1?></span>
													</td>
													<td class="text-center">
														<?=$row['TransactionID']?>
													</td>
													<td class="text-center">
														<?=$row['Code']?>
													</td>
													<td class="text-center">
														<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['stockID']?></span>
													</td>
													<td class="text-center">
														<?=($row['Amount'] - $totalReturnedQty)?>
													</td>
													<td class="text-center">
														<?=number_format($row['PriceUnit'], 2)?>
													</td>
													<td class="text-center">
														<?=number_format(($row['Amount'] - $totalReturnedQty) * $row['PriceUnit'], 2)?>
													</td>
													<td class="text-center">
														<?php if ($row['Freebie']): ?>
															<i class="bi bi-check-circle text-success"></i>
														<?php else: ?>
															<i class="bi bi-x-circle text-danger"></i>
														<?php endif; ?>
													</td>
												</tr>
										<?php endforeach;
										endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php if (sizeof($returnedProducts) > 0): ?>
							<div class="row mt-4">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<span style="font-size: 1.5em; color: #ebebeb;">
													<b> RETURNED ITEMS </b>
												</span>
												<a href="<?=base_url() . 'admin/view_return?returnNo='. $return->row_array()['ReturnNo']?>">
													<i class="bi bi-eye"></i> <?=$return->row_array()['ReturnNo']?>
												</a>
											</div>
											<div class="row">
												<div class="col-sm-12 table-responsive">
													<table id="transactionsTable" class="standard-table table">
														<thead style="font-size: 12px;">
															<th class="text-center">TRANSACTION ID</th>
															<th class="text-center">PRODUCT CODE</th>
															<th class="text-center">RETURNED</th>
															<th class="text-center">RETURNED TO INVENTORY</th>
															<th class="text-center">PRICE</th>
															<th class="text-center">TOTAL</th>
															<th class="text-center">FREEBIE</th>
														</thead>
														<tbody>
															<?php foreach ($returnedProducts as $row): ?>
																<tr>
																	<td class="text-center">
																		<?=$row['transactionid']?>
																	</td>
																	<td class="text-center">
																		<?=$row['prd_sku']?>
																	</td>
																	<td class="text-center">
																		<?=$row['quantity']?>
																	</td>
																	<td class="text-center">
																		<?=$row['returned']?>
																	</td>
																	<td class="text-center">
																		<?=number_format($row['PriceUnit'], 2)?>
																	</td>
																	<td class="text-center">
																		<?=number_format(($row['quantity'] + $row['returned']) * $row['PriceUnit'], 2)?>
																	</td>
																	<td class="text-center">
																		<?php if ($row['Freebie']): ?>
																			<i class="bi bi-check-circle text-success"></i>
																		<?php else: ?>
																			<i class="bi bi-x-circle text-danger"></i>
																		<?php endif; ?>
																	</td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-sm-5 col-md-3">
						<div class="row">
							<div class="col-12 mb-1">
								<h6>SALES ORDER #</h6>
								<label class="salesOrderNo"><?=$salesOrder['OrderNo']?></label>
							</div>
							<div class="col-12 mb-1">
								<h6>SALES ORDER DATE</h6>
								<label><?=$salesOrder['Date']?></label>
							</div>
							<div class="col-12 mb-1">
								<h6>BILL TO
									<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
										<?php if ($this->session->userdata('UserRestrictions')['mail_add']): ?>
											<button type="button" class="emailbtclient-btn btn btn-sm-primary" data-email="<?=$clientBTDetails['Email']?>"><i class="bi bi-envelope-fill"></i> EMAIL</button>
										<?php endif; ?>
									<?php endif; ?>
								</h6>
								<?php if ($clientBTDetails['ClientNo'] != NULL): ?>
									<label><?=$clientBTDetails['Name']?> (
										<a href="<?=base_url() . 'admin/clients#'. $clientBTDetails["ClientNo"]?>">
											<i class="bi bi-eye"></i> <?=$clientBTDetails['ClientNo']?>
										</a>
									)</label>
								<?php else: ?>
									<label class="warning-banner-sm">
										CLIENT DETAILS NOT AVAILABLE
									</label>
								<?php endif; ?>
							</div>
							<div class="col-12 mb-1">
								<h6>SHIP TO
									<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
										<?php if ($this->session->userdata('UserRestrictions')['mail_add']): ?>
											<button type="button" class="emailstclient-btn btn btn-sm-primary" data-email="<?=$clientSTDetails['Email']?>"><i class="bi bi-envelope-fill"></i> EMAIL</button>
										<?php endif; ?>
									<?php endif; ?>
								</h6>
								<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
									<label><?=$clientSTDetails['Name']?> (
										<a href="<?=base_url() . 'admin/clients#'. $clientSTDetails["ClientNo"]?>">
											<i class="bi bi-eye"></i> <?=$clientSTDetails['ClientNo']?>
										</a>
									)</label>
								<?php else: ?>
									<label class="warning-banner-sm">
										CLIENT DETAILS NOT AVAILABLE
									</label>
								<?php endif; ?>
							</div>
							<?php if ($salesOrder['Status'] == '3'): ?>
								<div class="col-12 mb-3">
									<h6>DATE OF DELIVERY</h6>
									<label><?=$salesOrder['DateDelivery']?></label>
								</div>
							<?php endif; ?>
							<?php
							$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($salesOrder['OrderNo']);
							// COMPUTE TOTALS
							$totalDiscount = $salesOrder['discountOutright'] + $salesOrder['discountVolume'] + $salesOrder['discountPBD'] + $salesOrder['discountManpower'];
							$transactionsPriceTotal = 0;
							$transactionsFreebiesTotal = 0;
							// $transactionsReturnedTotal = 0; // UNUSED
							foreach ($orderTransactions->result_array() as $transaction) {
								$price = $transaction['Amount'] * $transaction['PriceUnit'];
								if ($transaction['Freebie'] == 0) {
									$transactionsPriceTotal += $price;
								} else {
									$transactionsFreebiesTotal += $price;
								}
							}

							?>
							<div class="col-12 mt-3">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text">
												TOTAL PRICE / DISCOUNTED
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.5em; color: #ebebeb;">
												<b>
													<?php
													echo number_format($transactionsPriceTotal, 2) .' / ';
													echo number_format($transactionsPriceTotal - ($transactionsPriceTotal * ($totalDiscount * 0.01)), 2);
													?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text">
												TOTAL FREEBIES PRICE
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.5em; color: #ebebeb;">
												<b>
													<?=number_format($transactionsFreebiesTotal, 2)?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text">
												DISCOUNT
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												OUTRIGHT: <br>
												<b>
													[ <?=number_format(($transactionsPriceTotal * ($salesOrder['discountOutright'] * 0.01)), 2)?> ]
													( <?=$salesOrder['discountOutright']?>% )
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												VOLUME: <br>
												<b>
													[ <?=number_format(($transactionsPriceTotal * ($salesOrder['discountVolume'] * 0.01)), 2)?> ]
													( <?=$salesOrder['discountVolume']?>% )
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												PBD: <br>
												<b>
													[ <?=number_format(($transactionsPriceTotal * ($salesOrder['discountPBD'] * 0.01)), 2)?> ]
													( <?=$salesOrder['discountPBD']?>% )
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												MANPOWER: <br>
												<b>
													[ <?=number_format(($transactionsPriceTotal * ($salesOrder['discountManpower'] * 0.01)), 2)?> ]
													( <?=$salesOrder['discountManpower']?>% )
												</b>
											</span>
										</div>
										<div class="row mt-3">
											<span class="head-text">
												TOTAL DISCOUNT
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													[ <?=number_format(($transactionsPriceTotal * ($totalDiscount * 0.01)), 2)?> ]
													( <?=$totalDiscount?>% )
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php if ($salesOrder['Status'] == '1' && $this->session->userdata('UserRestrictions')['sales_orders_mark_for_invoicing']): ?>
								<div class="col-12 text-center">
									<h6>MARK FOR INVOICING</h6>
								</div>
								<div class="col-12 text-center">
									<form id="formApproveSalesOrder" action="<?php echo base_url() . 'FORM_approveSalesOrder';?>" method="POST">
										<input type="hidden" name="order_no" value="<?=$salesOrder['OrderNo']?>">
										<input id="orderApproved" type="hidden" name="approved">
										<button type="button" class="btn btn-danger rejectOrder"><i class="bi bi-trash-fill"></i> REJECT</button>
										<button type="button" class="btn btn-success approveOrder"><i class="bi bi-check2"></i> APPROVE</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '2' && $this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery']): ?>
								<div class="col-12 text-center">
									<button type="button" class="btn btn-success deliveryschedule-btn">
										<i class="bi bi-truck"></i> SCHEDULE FOR DELIVERY
									</button>
								</div>
							<?php elseif ($salesOrder['Status'] == '3' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_delivered']): ?>
								<div class="col-12 text-center">
									<form id="formMarkDelivered" action="<?php echo base_url() . 'FORM_markDelivered';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success deliveredmark">
											<i class="bi bi-check2"></i> MARK AS DELIVERED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '4' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_received']): ?>
								<div class="col-12 text-center">
									<form id="formMarkReceived" action="<?php echo base_url() . 'FORM_markReceived';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success receivedmark">
											<i class="bi bi-check2"></i> MARK AS RECEIVED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '5'): ?>
								<div class="col-12 text-center">
									<h5 class="text-success">SALES ORDER FULFILLED</h5>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php if ($salesOrder['Status'] >= '2'): ?>
			<div class="page-heading">
				<div class="page-title">
					<div class="row">
						<div class="col-12">
							<h3>
								Invoicing
							</h3>
						</div>
					</div>
					<?php if ($this->session->userdata('UserRestrictions')['sales_orders_invoice_creation']): ?>
						<div class="row">
							<div class="col-12">
								<button type="button" class="salesinvoicing-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW</button>
							</div>
						</div>
					<?php endif; ?>
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
									<th class="text-center"></th>
								</thead>
								<tbody>
								<?php if ($getSOBills->num_rows() > 0):
									foreach ($getSOBills->result_array() as $row): ?>
										<tr>
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
											</td>
											<td class="text-center">
												<?=$row['InvoiceNo']?>
											</td>
											<td class="text-center">
												<?=$clientBTDetails['Name']?>
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
												<?php if ($this->session->userdata('UserRestrictions')['invoice_delete']): ?>
													<a href="FORM_removeInvoice?ino=<?=$row['InvoiceNo']?>">
														<button type="button" class="btn removeInvoice"><i class="bi bi-trash text-danger"></i></button>
													</a>
												<?php endif; ?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
									<?php
									$total_invoice_amount = $this->Model_Selects->GetTotalInvoicesBySONo($salesOrder['OrderNo'])->row_array()['Amount'];
									?>
									<tr>
										<td class="font-weight-bold text-center" colspan="3">TOTAL</td>
										<td class="font-weight-bold text-center"><?=number_format($total_invoice_amount, 2)?></td>
										<td colspan="3"></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="font-weight-bold text-center" colspan="3">REMAINING PAYMENT (DISCOUNTED)</td>
										<td class="font-weight-bold text-center"><?=number_format(($transactionsPriceTotal - ($transactionsPriceTotal * ($totalDiscount * 0.01))) - $total_invoice_amount, 2);?></td>
										<td colspan="3"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/modals/sales_orders/sales_order_form.php', array(
	'salesOrder' => $salesOrder,
	'getTransactionsByOrderNo' => $getTransactionsByOrderNo,
	'clientBTDetails' => $clientBTDetails,
	'clientSTDetails' => $clientSTDetails
)); ?>
<?php $this->load->view('admin/modals/sales_orders/sales_order_accounting'); ?>
<?php $this->load->view('admin/modals/sales_orders/sales_order_logs'); ?>
<?php $this->load->view('admin/modals/sales_orders/schedule_delivery_sales_order'); ?>
<?php $this->load->view('admin/modals/sales_orders/add_invoice_so', array('salesOrder' => $salesOrder)); ?>
<?php $this->load->view('admin/modals/mails/add_mail.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-sales-orders').addClass('active');
$(document).ready(function() {
	function showAlert(type, message) {
		if ($('.alertNotification').length > 0) {
			$('.alertNotification').remove();
		}
		$('body').append($('<div>')
			.attr({
				class: 'alert position-absolute bottom-0 end-0 alert-dismissible fade show alertNotification alert-' + type, 
				role: 'alert',
				'data-bs-dismiss': 'alert'
			}).css({ 'z-index': 9999, cursor: 'pointer' })
			.append($('<strong>').html(type[0].toUpperCase() + type.slice(1) + '! '))
			.append($('<span>').html(message))
			.append($('<button>')
				.attr({
					type: 'button', 
					class: 'btn-close',
					'data-bs-dismiss': 'alert',
					'aria-label': 'Close'
				}))
		);
	}

	$('.salesinvoicing-btn').on('click', function() {
		$('#SalesInvoicing').modal('toggle');
	});
	$('.deliveryschedule-btn').on('click', function() {
		$('#DeliveryScheduling').modal('toggle');
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
		if (!confirm('Reject Sales Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('0');
			$('#formApproveSalesOrder').submit();
		}
	});
	$(document).on('click', '.approveOrder', function() {
		if (!confirm('Approve Sales Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('1');
			$('#formApproveSalesOrder').submit();
		}
	});

	$(document).on('click', '.deliveredmark', function() {
		if (!confirm('Mark Sales Order as delivered? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#formMarkDelivered').submit();
		}
	});
	$(document).on('click', '.receivedmark', function() {
		if (!confirm('Mark Sales Order as received? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#formMarkReceived').submit();
		}
	});

	$(document).on('click', '.removeInvoice', function() {
		if (!confirm('Remove Invoice?')) {
			event.preventDefault();
		}
	});

	// PO FORM FUNCTIONS
	$('.select-formtransaction-row').on('click', function() {
		$('#SalesOrderFormModal').data('selectTransactions', true);
		$('#SalesOrderFormModal').modal('toggle');

		$('#SalesOrderFormModal').data('prevscroll', $('#SalesOrderFormModal').scrollTop());
	});
	$(document).on('hidden.bs.modal', '#SalesOrderFormModal', function (event) {
		if ($('#SalesOrderFormModal').data('selectTransactions')) {
			$('#SalesOrderFormTransactionsModal').modal('toggle');
			$('#SalesOrderFormModal').data('selectTransactions', false);
		}
	});
	$(document).on('hidden.bs.modal', '#SalesOrderFormTransactionsModal', function (event) {
		$('#SalesOrderFormModal').modal('toggle');
		setTimeout(function() {
			$('#SalesOrderFormModal').animate({
				scrollTop: $('#SalesOrderFormModal').data('prevscroll')
			}, 50);
		}, 50);
	});

	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}
	function updFormTotalPrice() {
		let totalAmount = 0;
		$.each($('.soFormTransaction .amount'), function(key, obj) {
			totalAmount += parseFloat($(this).data('amount'));
		});
		$('#subTotal').html(moneyFormat(totalAmount));

		let dcOutright = $('#dcOutright').data('discount');
		$('#dcOutright').html(moneyFormat(totalAmount * (dcOutright / 100)));
		let dcVolume = $('#dcVolume').data('discount');
		$('#dcVolume').html(moneyFormat(totalAmount * (dcVolume / 100)));
		let dcPBD = $('#dcPBD').data('discount');
		$('#dcPBD').html(moneyFormat(totalAmount * (dcPBD / 100)));
		let dcManpower = $('#dcManpower').data('discount');
		$('#dcManpower').html(moneyFormat(totalAmount * (dcManpower / 100)));

		$('#total').html(moneyFormat(totalAmount - (totalAmount * ((dcOutright + dcVolume + dcPBD + dcManpower) / 100))));
	}
	
	$(document).on('click', '.add-formtransaction-row', function() {
		let ftClass = 'formTransaction_' + $(this).data('id');
		if ($('.' + ftClass).length < 1) {
			let tRow = $(this).clone();
			tRow.removeClass('add-formtransaction-row').addClass('soFormTransaction ' + ftClass);
			tRow.find('.totalAmountUnit').addClass('amount').removeClass('totalAmountUnit');

			$('.select-formtransaction-row').before(tRow);

			$(this).addClass('bg-secondary');
		} else {
			$('.' + ftClass).remove();
			$(this).removeClass('bg-secondary');
		}
		updFormTotalPrice();
	});


	// FORM GENERATION
	$('.generateform-btn').on('click', function() {
		$('#SalesOrderFormModal').modal('toggle');
	});
	$('#generate_form').click(function() {
		$('.inputManual').hide();
		$.each($('.inputManual'), function(key, obj) {
			$(this).parent().append(
				$('<span>').html($(this).val())
			);
		});
		$('#salesOrderForm').appendTo('body');
		$('#SalesOrderFormModal').modal('toggle');
		window.print();
		$('#salesOrderForm').appendTo('#SalesOrderFormModal .modal-body');
		$('.inputManual').show();
		$('.inputManual').siblings('span').remove();
	});
	$('#generate_excel').click(function() {
		if ($('.soFormTransaction').length > 0) {
			$('#xls_preparedby').val($('#prepared_by').val());

			// SET ROW INPUT VALUES
			$('.excelExportInputRow').remove();
			$.each($('.soFormTransaction'), function(key, obj) {
				$('#formExportTable').append($('<input>')
					.attr({
						class: 'excelExportInputRow',
						type: 'hidden',
						name: 'transactions[]'
					}).val($(this).data('id'))
				);
			});

			$('#formExportTable').submit();
		} else {
			showAlert('warning', 'No transactions selected!');
		}
	});


	// ACCOUNTING
	$(document).on('click', '.btn-delete-journal', function() {
		let journal_id = $(this).parents('tr').data('id');
		if (!confirm('Delete Journal #'+ journal_id +'? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#journalIDDelete').val(journal_id);
			$('#formDeleteJournal').submit();
		}
	});

	$('.accounting-btn').on('click', function() {
		$('#AccountingModal').modal('toggle');
	});
	$('.log-btn').on('click', function() {
		$('#LogModal').modal('toggle');
	});

	$('.newtransaction-btn').on('click', function() {
		$('#AccountingModal').data('action', 'newtransaction');
		$('#AccountingModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AccountingModal', function (event) {
		if ($('#AccountingModal').data('action') == 'newtransaction') {
			$('#AccountingModal').data('action', '');
			$('#AddJournalTransactionModal').modal('toggle');
		}
	});
	$(document).on('hidden.bs.modal', '#AddJournalTransactionModal', function (event) {
		$('#AccountingModal').modal('toggle');
	});


	var accounts_list = <?=json_encode($getAccounts->result_array())?>;
	var account_types = ['REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITY'];

	function updTransactionCount() {
		// update journal transaction count
		$('#transactionsCount').val($('.account_row').length);
		// update journal transaction input names
		$.each($('.account_row'), function(i, val) {
			$(this).find('.inpAccountID').attr('name', 'accountIDInput_' + i);
			$(this).find('.inpDebit').attr('name', 'debitInput_' + i);
			$(this).find('.inpCredit').attr('name', 'creditInput_' + i);
		});
		// total
		let debitTotal = 0;
		$.each($('.inpDebit'), function(i, val) {
			debitTotal += parseFloat($(this).val());
		});
		$('.debitTotal').html(debitTotal.toFixed(2));
		let creditTotal = 0;
		$.each($('.inpCredit'), function(i, val) {
			creditTotal += parseFloat($(this).val());
		});
		$('.creditTotal').html(creditTotal.toFixed(2));
	}
	$(document).on('click', '.add-account-row', function() {
		var this_row = 'ar_' + $('.account_row').length;
		$('.add-account-row').before($('<tr>')
			.attr({
				class: 'account_row highlighted ' + this_row,
			}).data('id', $('.account_row').length)
			.append($('<td>').attr({ // column-1
				class: ''
			}).append($('<select>').attr({
				class: 'select_accounts inpAccountID w-100'
			}).append($('<optgroup>').attr({
				class: 'type_0',
				label: 'REVENUES'
			})).append($('<optgroup>').attr({
				class: 'type_1',
				label: 'ASSETS'
			})).append($('<optgroup>').attr({
				class: 'type_2',
				label: 'LIABILITIES'
			})).append($('<optgroup>').attr({
				class: 'type_3',
				label: 'EXPENSES'
			})).append($('<optgroup>').attr({
				class: 'type_4',
				label: 'EQUITIES'
			}))))
			.append($('<td>').attr({ // column-2
				class: ''
			}).append($('<input>').attr({
				class: 'inpDebit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ // column-3
				class: ''
			}).append($('<input>').attr({
				class: 'inpCredit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
				type: 'button',
				class: 'btn remove-account-row'
			}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);

		for (var i = accounts_list.length - 1; i >= 0; i--) {
			$('.' + this_row + ' .type_' + accounts_list[i]['Type']).append($('<option>').attr({
				value: accounts_list[i]['ID']
			}).text(accounts_list[i]['Name']));
		}

		setTimeout(function() {
			$('.' + this_row).removeClass('highlighted');
		}, 2000);
		$('.' + this_row).fadeIn('2000');

		updTransactionCount();
	});

	// add two two transaction accounts
	$('.add-account-row').click(); $('.add-account-row').click();

	$(document).on('click', '.remove-account-row', function() {
		$(this).parents('tr').remove();

		updTransactionCount();
	});
	$(document).on('focus keyup change', '.inpDebit, .inpCredit', function() {
		updTransactionCount();
	});
	// disable other debit/credit on change
	$(document).on('focus keyup change', '.inpDebit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpCredit').val(0);
			$(this).parents('tr').find('.inpCredit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpCredit').removeAttr('disabled');
		}
	});
	$(document).on('focus keyup change', '.inpCredit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpDebit').val(0);
			$(this).parents('tr').find('.inpDebit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpDebit').removeAttr('disabled');
		}
	});

	$('#formAddJournal').on('submit', function(e) {
		let totalDebit = parseFloat($('.debitTotal').html());
		let totalCredit = parseFloat($('.creditTotal').html());
		if (totalDebit != totalCredit) {
			showAlert('warning', 'Debit and Credit must be equal.');
			e.preventDefault();
		} else if (totalDebit <= 0 || totalCredit <= 0) {
			showAlert('warning', 'Total must be more than 0.');
			e.preventDefault();
		}
	});

	// EMAIL
	$(document).on('click', '.emailbtclient-btn, .emailstclient-btn', function() {
		$('.send_to').val($(this).data('email'));
		$('.mail_subject').val(
			'Sales Order # ' + $('.salesOrderNo').html()
		);
		// $('.mail_message').val($(this).data('email'));
		// $('.mail_attachment').val($(this).data('email'));
		$('#add_mailtosend').modal('toggle');
	});
	$('#submit_formsend').on('click', function() {
		$('#form_emailsend').submit();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
