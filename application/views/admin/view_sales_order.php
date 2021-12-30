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
	.modal-backdrop {
		opacity: 0 !important;
	}
	@media print {
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
						<h3>Sales Order ID #<?=$salesOrder['ID']?>
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
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">PRODUCT CODE</th>
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
														<?=number_format($row['Amount'] * $row['PriceUnit'], 2)?>
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
								<h6>SALES ORDER #</h6>
								<label><?=$salesOrder['OrderNo']?></label>
							</div>
							<div class="col-12">
								<h6>DATE</h6>
								<label><?=$salesOrder['Date']?></label>
							</div>
							<div class="col-12">
								<h6>BILL TO</h6>
								<label><?=$clientBTDetails['Name']?> (
									<a href="<?=base_url() . 'admin/clients#'. $clientBTDetails["ClientNo"]?>">
										<i class="bi bi-eye"></i> <?=$clientBTDetails['ClientNo']?>
									</a>
								)</label>
							</div>
							<div class="col-12 mb-3">
								<h6>SHIP TO</h6>
								<label><?=$clientSTDetails['Name']?> (
									<a href="<?=base_url() . 'admin/clients#'. $clientSTDetails["ClientNo"]?>">
										<i class="bi bi-eye"></i> <?=$clientSTDetails['ClientNo']?>
									</a>
								)</label>
							</div>
							<?php if ($salesOrder['Status'] == '3'): ?>
								<div class="col-12 mb-3">
									<h6>DATE OF DELIVERY</h6>
									<label><?=$salesOrder['DateDelivery']?></label>
								</div>
							<?php endif; ?>
							<?php $orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($salesOrder['OrderNo']); ?>
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
										<div class="row mt-3">
											<span class="head-text">
												DISCOUNT
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												OUTRIGHT:
												<b>
													<?=$salesOrder['discountOutright']?>%
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												VOLUME:
												<b>
													<?=$salesOrder['discountVolume']?>%
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												PBD:
												<b>
													<?=$salesOrder['discountPBD']?>%
												</b>
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.15em; color: #ebebeb;">
												MANPOWER:
												<b>
													<?=$salesOrder['discountManpower']?>%
												</b>
											</span>
										</div>
										<div class="row mt-3">
											<span class="head-text">
												TOTAL PRICE / DISCOUNTED
											</span>
										</div>
										<div class="row">
											<span style="font-size: 1.5em; color: #ebebeb;">
												<b>
													<?php
													$totalDiscount = $salesOrder['discountOutright'] + $salesOrder['discountVolume'] + $salesOrder['discountPBD'] + $salesOrder['discountManpower'];
													$transactionsPriceTotal = 0;
													foreach ($orderTransactions->result_array() as $transaction) {
														$transactionsPriceTotal += $transaction['Amount'] * $transaction['PriceUnit'];
													}
													echo number_format($transactionsPriceTotal, 2) .' / ';
													echo number_format($transactionsPriceTotal - ($transactionsPriceTotal * ($totalDiscount * 0.01)), 2);
													?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php if ($salesOrder['Status'] == '1' && $this->session->userdata('UserRestrictions')['sales_orders_mark_for_invoicing'] == 1): ?>
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
							<?php elseif ($salesOrder['Status'] == '2' && $this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery'] == 1): ?>
								<div class="col-12 text-center">
									<button type="button" class="btn btn-success deliveryschedule-btn">
										<i class="bi bi-truck"></i> SCHEDULE FOR DELIVERY
									</button>
								</div>
							<?php elseif ($salesOrder['Status'] == '3' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_delivered'] == 1): ?>
								<div class="col-12 text-center">
									<form id="formMarkDelivered" action="<?php echo base_url() . 'FORM_markDelivered';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success deliveredmark">
											<i class="bi bi-check2"></i> MARK AS DELIVERED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '4' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_received'] == 1): ?>
								<div class="col-12 text-center">
									<form id="formMarkReceived" action="<?php echo base_url() . 'FORM_markReceived';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success receivedmark">
											<i class="bi bi-check2"></i> MARK AS RECEIVED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '5' && $this->session->userdata('UserRestrictions')['sales_orders_fulfill'] == 1): ?>
								<div class="col-12 text-center">
									<h5 class="text-success">SALES ORDER FULFILLED</h5>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php if ($salesOrder['Status'] == '2'): ?>
			<div class="page-heading">
				<div class="page-title">
					<div class="row">
						<div class="col-12">
							<h3>
								Invoicing
							</h3>
						</div>
					</div>
					<?php if ($this->session->userdata('UserRestrictions')['sales_orders_invoice_creation'] == 1): ?>
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
												<?=$row['OrderNo']?>
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
												<a href="FORM_removeInvoice?ino=<?=$row['InvoiceNo']?>">
													<button type="button" class="btn removeInvoice"><i class="bi bi-x-square text-danger"></i></button>
												</a>
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
<?php if ($this->session->userdata('UserRestrictions')['sales_orders_invoice_creation'] == 1): ?>
<?php $this->load->view('admin/modals/add_invoice', array('salesOrder' => $salesOrder)); ?>
<?php endif; ?>
<?php if ($this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery'] == 1): ?>
<div class="modal fade" id="DeliveryScheduling" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formScheduleDelivery" action="<?php echo base_url() . 'FORM_scheduleDelivery';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-truck" style="font-size: 24px;"></i> SO Delivery Scheduling</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>" required>
					<div class="form-group col-sm-12 col-md-9 mx-auto">
						<label class="input-label">DATE</label>
						<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Schedule for Delivery</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php endif; ?>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/modals/sales_order_form.php', array(
	'getTransactionsByOrderNo' => $getTransactionsByOrderNo,
	'clientBTDetails' => $clientBTDetails,
	'clientSTDetails' => $clientSTDetails
)); ?>

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
	// var tableTransactions = $('#transactionsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	'bLengthChange': false,
	// 	'order': [[ 0, 'desc' ]],
	// });

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

	$(document).on('submit', '#formAddSOInvoice', function(t) {
		// ACCOUNTING CHECKS
		let totalDebit = parseFloat($('.debitTotal').html());
		let totalCredit = parseFloat($('.creditTotal').html());
		if (totalDebit != totalCredit) {
			alert('Debit and Credit must be equal.');
			t.preventDefault();
		} else if (totalDebit <= 0 || totalCredit <= 0) {
			alert('Total must be more than 0.');
			t.preventDefault();
		}
	});

	// ACCOUNTING ADD
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
				value: 0
			})))
			.append($('<td>').attr({ // column-3
				class: ''
			}).append($('<input>').attr({
				class: 'inpCredit  w-100',
				type: 'number',
				min: '0',
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
	$('.add-account-row').click();
	$('.add-account-row').click();

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
			$(this).parents('td').siblings('td').children('.inpCredit').attr('disabled', '');
		} else {
			$(this).parents('td').siblings('td').children('.inpCredit').removeAttr('disabled');
		}
	});
	$(document).on('focus keyup change', '.inpCredit', function() {
		if ($(this).val() > 0) {
			$(this).parents('td').siblings('td').children('.inpDebit').attr('disabled', '');
		} else {
			$(this).parents('td').siblings('td').children('.inpDebit').removeAttr('disabled');
		}
	});


	$('.generateform-btn').on('click', function() {
		$('#SalesOrderFormModal').modal('toggle');
	});
	$('#generateform').click(function() {
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
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
