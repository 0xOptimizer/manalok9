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

$vendorDetails = $this->Model_Selects->GetVendorByNo($purchaseOrder['VendorNo'])->row_array();

$getPOBills = $this->Model_Selects->GetBillsByPONo($orderNo);

$getAccounts = $this->Model_Selects->GetAccountSelection();

$getManualTransactionsByPONo = $this->Model_Selects->GetManualTransactionsByPONo($orderNo);

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
	.sectionToggle:hover {
		background-color: rgba(75, 75, 75, 0.3);
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
		#purchaseOrderForm {
			display: block;
		}
		#purchaseOrderForm td {
			color: black !important;
		}
		#purchaseOrderForm td span {
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
			<a href="<?=base_url() . 'admin/purchase_orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO PURCHASE ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12">
						<h3><i class="bi bi-receipt"></i> <?=$purchaseOrder['OrderNo']?>
							<?php if ($purchaseOrder['Status'] == '1'): ?>
								<span class="info-banner-sm"><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
							<?php elseif ($purchaseOrder['Status'] == '2'): ?>
								<span class="info-banner-sm text-success"><i class="bi bi-check-circle"></i> Received [<?=$purchaseOrder['DateApproved']?>]</span>
							<?php else: ?>
								<span class="info-banner-sm text-danger"><i class="bi bi-trash"></i> Rejected</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-12">
						<button type="button" class="generateform-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE PO FORM</button>
						<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_accounting']): ?>
							|
							<button type="button" class="accounting-btn btn btn-sm-secondary" style="font-size: 12px;"><i class="bi bi-receipt"></i> ACCOUNTING</button>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<section class="section">
				<hr style="height: 4px;">

				<div class="row">
					<div class="col-12 col-md-6 mb-1">
						<h6>PURCHASE ORDER #</h6>
						<label class="purchaseOrderNo"><?=$purchaseOrder['OrderNo']?></label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>DATE CREATION</h6>
						<label><?=$purchaseOrder['DateCreation']?></label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>PURCHASED FROM
							<?php if ($this->session->userdata('UserRestrictions')['mail_add']): ?>
								<button type="button" class="emailvendor-btn btn btn-sm-primary" data-email="<?=$vendorDetails['Email']?>"><i class="bi bi-envelope-fill"></i> EMAIL</button>
							<?php endif; ?>
						</h6>
						<label><?=$vendorDetails['Name']?> (
							<a href="<?=base_url() . 'admin/vendors#'. $purchaseOrder["VendorNo"]?>">
								<i class="bi bi-eye"></i> <?=$purchaseOrder['VendorNo']?>
							</a>
						)</label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>REMARKS 
							<button type="button" class="btn btn-sm addremarks-btn text-primary" data-remarks="<?=$purchaseOrder['Remarks']?>">
								<i class="bi bi-pencil-square"></i>
							</button>
						</h6>
						<label>
							<?=(($purchaseOrder['Remarks'] == NULL) ? '- - - - - -' : $purchaseOrder['Remarks'])?>
						</label>
					</div>
				</div>

				<hr style="height: 4px;">

				<?php

				$transactionsCostTotal = 0;
				$transactionsManualCostTotal = 0;

				?>

				<div class="row">
					<div class="col-12">
						<div class="row">
							<div class="col-12">
								<h4>
									<i class="bi bi-list-ul"></i> TRANSACTIONS
									<span class="text-center success-banner-sm">
										<i class="bi bi-list-ul"></i> <?=$getTransactionsByOrderNo->num_rows()?> TOTAL
									</span>
								</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<table id="transactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">PRODUCT CODE</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center">UNIT COST</th>
										<th class="text-center">UNIT PRICE</th>
										<th class="text-center">TOTAL COST</th>
									</thead>
									<tbody>
										<?php
										if ($getTransactionsByOrderNo->num_rows() > 0):
											foreach ($getTransactionsByOrderNo->result_array() as $tRow): 
												$stock = $this->Model_Selects->Check_prd_stockid($tRow['stockID']);
												if ($stock->num_rows() > 0):
													$sRow = $stock->row_array();

													$totalCost = $tRow['Amount'] * $tRow['PriceUnit'];
													$transactionsCostTotal += $totalCost;
													?>
													<tr>
														<td class="text-center">
															<?=$tRow['TransactionID']?>
														</td>
														<td class="text-center">
															<?=$tRow['Code']?>
														</td>
														<td class="text-center">
															<?=$tRow['Amount']?>
														</td>
														<td class="text-center">
															<?=number_format($tRow['PriceUnit'], 2)?>
														</td>
														<td class="text-center">
															<?=number_format($sRow['Retail_Price'], 2)?>
														</td>
														<td class="text-center">
															<?=number_format($totalCost, 2)?>
														</td>
													</tr>
											<?php endif;
											endforeach;
										endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<h6>
									<i class="bi bi-pencil"></i> MANUAL TRANSACTIONS
									<span class="text-center success-banner-sm">
										<i class="bi bi-pencil"></i> <?=$getManualTransactionsByPONo->num_rows()?> TOTAL
									</span>
								</h6>
								<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_add_manual_transaction']): ?>
									<button type="button" class="newmanualtransaction-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-plus-square"></i> NEW MANUAL TRANSACTION</button>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 table-responsive mb-3">
								<table id="transactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">ITEM NO</th>
										<th class="text-center">DESCRIPTION</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center">COST</th>
										<th class="text-center">TOTAL</th>
										<th></th>
									</thead>
									<tbody>
										<?php if ($getManualTransactionsByPONo->num_rows() > 0): ?>
											<?php foreach ($getManualTransactionsByPONo->result_array() as $row): 

												$totalCost = $row['Qty'] * $row['UnitCost'];
												$transactionsManualCostTotal += $totalCost;
												?>
												<tr>
													<td class="text-center">
														<?=$row['ItemNo']?>
													</td>
													<td class="text-center">
														<?=$row['Description']?>
													</td>
													<td class="text-center">
														<?=$row['Qty']?>
													</td>
													<td class="text-center">
														<?=number_format($row['UnitCost'], 2)?>
													</td>
													<td class="text-center">
														<?=number_format($totalCost, 2)?>
													</td>
													<td class="text-center">
														<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_remove_manual_transaction']): ?>
															<a href="FORM_removeManualTransaction?mtno=<?=$row['ManualTransactionNo']?>">
																<button type="button" class="btn removeManualTransaction"><i class="bi bi-trash text-danger"></i></button>
															</a>
														<?php endif; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold">
														<i class="bi bi-plus-circle text-success"></i> TOTAL MANUAL TRANSACTIONS
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.15em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsManualCostTotal, 2)?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-info'>Info:<br></span> (Total Transactions) + (Total Manual Transactions)">
														TOTAL PRICE
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsCostTotal + $transactionsManualCostTotal, 2)?>
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
				</div>

				<hr>

				<div class="row">
					<div class="col-12">
						<div class="row pt-4">
							<?php if ($purchaseOrder['Status'] == '1' && $this->session->userdata('UserRestrictions')['purchase_orders_approve']): ?>
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

		<hr style="height: 4px;">

		<div class="page-heading">
			<div class="page-title">
				<div class="row pt-3 toggleSectionBilling sectionToggle" style="cursor: pointer;">
					<div class="col-12">
						<h4>
							<i class="bi bi-cash"></i> BILLS
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> <?=$getPOBills->num_rows()?> TOTAL
							</span>
							<i class="bi bi-caret-down-fill float-end caret"></i>
						</h4>
					</div>
				</div>
				<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_bill_creation']): ?>
					<div class="row pt-3">
						<div class="col-12">
							<button type="button" class="purchasebilling-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-cash"></i> NEW BILL</button>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<section class="sectionBilling d-none">
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="billsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">BILL #</th>
								<th class="text-center">VENDOR</th>
								<th class="text-center">QTY</th>
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
											<?=$vendorDetails['Name']?>
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
											<?php if ($this->session->userdata('UserRestrictions')['bills_delete']): ?>
												<a href="FORM_removeBill?bno=<?=$row['BillNo']?>">
													<button type="button" class="btn removeBill"><i class="bi bi-trash text-danger"></i></button>
												</a>
											<?php endif; ?>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
								<?php
								$total_bill_amount = $this->Model_Selects->GetTotalBillsByPONo($purchaseOrder['OrderNo'])->row_array()['Amount'];
								?>
								<tr>
									<td class="font-weight-bold text-center" colspan="3">TOTAL</td>
									<td class="font-weight-bold text-center"><?=number_format($total_bill_amount, 2)?></td>
									<td colspan="3"></td>
								</tr>
								<tr style="border-color: #a7852d;">
									<td class="font-weight-bold text-center" colspan="3">REMAINING PAYMENT</td>
									<td class="font-weight-bold text-center"><?=number_format(
										($transactionsCostTotal + $transactionsManualCostTotal) - $total_bill_amount, 2)?></td>
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
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/purchase_orders/purchase_order_form.php', array(
	'purchaseOrder' => $purchaseOrder,
	'getTransactionsByOrderNo' => $getTransactionsByOrderNo,
	'getManualTransactionsByPONo' => $getManualTransactionsByPONo,
	'vendorDetails' => $vendorDetails
)); ?>
<?php $this->load->view('admin/_modals/purchase_orders/purchase_order_accounting.php'); ?>
<?php $this->load->view('admin/_modals/purchase_orders/add_manual_transaction', array('purchaseOrderNo' => $purchaseOrder['OrderNo'])); ?>
<?php $this->load->view('admin/_modals/mails/add_mail.php'); ?>
<?php $this->load->view('admin/_modals/purchase_orders/add_bill_po', array('purchaseOrder' => $purchaseOrder)); ?>
<?php $this->load->view('admin/_modals/purchase_orders/purchase_order_remarks', array('purchaseOrder' => $purchaseOrder)); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-purchase-orders').addClass('active');
$(document).ready(function() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});

	function showAlert(type, message) {
		if ($('.alertNotification').length > 0) {
			$('.alertNotification').remove();
		}
		$('body').append($('<div>')
			.attr({
				class: 'alert position-fixed bottom-0 end-0 alert-dismissible fade show alertNotification alert-' + type, 
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

	$('.purchasebilling-btn').on('click', function() {
		$('#PurchaseBilling').modal('toggle');
	});
	$('.addremarks-btn').on('click', function() {
		$('#PORemarks').modal('toggle');
		$('#purchase_order_remarks').val($(this).data('remarks'));
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

	// MANUAL TRANSACTIONS
	$('.newmanualtransaction-btn').on('click', function() {
		$('#PurchaseManualTransaction').modal('toggle');
	});
	$(document).on('click', '.removeManualTransaction', function() {
		if (!confirm('Remove Manual Transaction?')) {
			event.preventDefault();
		}
	});

	// PO FORM FUNCTIONS
	$('.select-formtransaction-row').on('click', function() {
		$('#PurchaseOrderFormModal').data('selectTransactions', true);
		$('#PurchaseOrderFormModal').modal('toggle');

		$('#PurchaseOrderFormModal').data('prevscroll', $('#PurchaseOrderFormModal').scrollTop());
	});
	$(document).on('hidden.bs.modal', '#PurchaseOrderFormModal', function (event) {
		if ($('#PurchaseOrderFormModal').data('selectTransactions')) {
			$('#PurchaseOrderFormTransactionsModal').modal('toggle');
			$('#PurchaseOrderFormModal').data('selectTransactions', false);
		}
	});
	$(document).on('hidden.bs.modal', '#PurchaseOrderFormTransactionsModal', function (event) {
		$('#PurchaseOrderFormModal').modal('toggle');
		setTimeout(function() {
			$('#PurchaseOrderFormModal').animate({
				scrollTop: $('#PurchaseOrderFormModal').data('prevscroll')
			}, 50);
		}, 50);
	});
	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}
	function updFormTotalPrice() {
		let totalAmount = 0;
		$.each($('.poFormTransaction .amount'), function(key, obj) {
			totalAmount += parseFloat($(this).data('amount'));
		});
		$('#totalAmount').html(moneyFormat(totalAmount));
	}
	
	$(document).on('click', '.add-formtransaction-row', function() {
		let ftClass = 'formTransaction_' + $(this).data('type') + '_' + $(this).data('id');
		if ($('.' + ftClass).length < 1) {
			let tRow = $(this).clone();
			tRow.removeClass('add-formtransaction-row').addClass('poFormTransaction ' + ftClass);
			tRow.find('.amount').before($('<td>').addClass('text-center').append($('<input>')
				.attr({
					type: 'text',
					class: 'inputManual formInputUnit'
				}))
			);
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
		$('#PurchaseOrderFormModal').modal('toggle');
	});
	$('#generate_form').click(function() {
		$('.inputManual').hide();
		$.each($('.inputManual'), function(key, obj) {
			$(this).parent().append(
				$('<span>').html($(this).val())
			);
		});
		$('#purchaseOrderForm').appendTo('body');
		$('#PurchaseOrderFormModal').modal('toggle');
		window.print();
		$('#purchaseOrderForm').appendTo('#PurchaseOrderFormModal .modal-body');
		$('.inputManual').show();
		$('.inputManual').siblings('span').remove();
	});
	$('#generate_excel').click(function() {
		if ($('.poFormTransaction').length > 0) {
			$('#xls_deliverto').val($('#deliverto').val());
			$('#xls_page').val($('#page').val());
			$('#xls_attn').val($('#attn').val());
			$('#xls_supplierinvoiceno').val($('#supplierinvoiceno').val());
			$('#xls_terms').val($('#terms').val());
			$('#xls_memo').val($('#memo').val());
			$('#xls_freight').val($('#freight').val());
			$('#xls_salestax').val($('#salestax').val());
			$('#xls_lessdeposit').val($('#lessdeposit').val());
			$('#xls_balancedue').val($('#balancedue').val());
			$('#xls_preparedby').val($('#preparedby').val());
			$('#xls_orderedby').val($('#orderedby').val());
			$('#xls_approvedby').val($('#approvedby').val());

			// SET ROW INPUT VALUES
			$('.excelExportInputRow').remove();
			$.each($('.poFormTransaction'), function(key, obj) {
				$('#formExportTable').append($('<input>')
					.attr({
						class: 'excelExportInputRow',
						type: 'hidden',
						name: $(this).data('type') + '[]'
					}).val($(this).data('id') + '_' + $(this).find('.formInputUnit').val())
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
	$(document).on('click', '.emailvendor-btn', function() {
		$('.send_to').val($(this).data('email'));
		$('.mail_subject').val(
			'Purchase Order # ' + $('.purchaseOrderNo').html()
		);
		// $('.mail_message').val($(this).data('email'));
		// $('.mail_attachment').val($(this).data('email'));
		$('#add_mailtosend').modal('toggle');
	});
	$('#submit_formsend').on('click', function() {
		$('#form_emailsend').submit();
	});

	// SECTION VIEWS
	$(document).on('click', '.toggleSectionBilling', function() {
		$('.sectionBilling').toggleClass('d-none');
		$(this).find('.caret').toggleClass('bi-caret-down-fill').toggleClass('bi-caret-up-fill');

		if ($(this).find('.caret').hasClass('bi-caret-up-fill')) {
			$(document).scrollTop($(document).scrollTop() + $('.sectionBilling').height());
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
