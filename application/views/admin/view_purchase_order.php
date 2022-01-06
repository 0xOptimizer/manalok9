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
					<div class="col-12">
						<button type="button" class="generateform-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE PO FORM</button>
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
														<?=$row['TransactionID']?>
													</td>
													<td class="text-center">
														<?=$row['Code']?>
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
								<h6>PURCHASE ORDER #</h6>
								<label><?=$purchaseOrder['OrderNo']?></label>
							</div>
							<div class="col-12">
								<h6>DATE CREATION</h6>
								<label><?=$purchaseOrder['DateCreation']?></label>
							</div>
							<div class="col-12 mb-3">
								<h6>PURCHASED FROM</h6>
								<label><?=$vendorDetails['Name']?> (
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
<?php $this->load->view('admin/modals/add_bill', array('purchaseOrder' => $purchaseOrder)); ?>
<?php endif; ?>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/modals/purchase_order_form.php', array(
	'getTransactionsByOrderNo' => $getTransactionsByOrderNo,
	'vendorDetails' => $vendorDetails
)); ?>

<form id="formExportTable" action="<?php echo base_url() . 'admin/xlsPurchaseOrder';?>" method="POST">
	<input type="hidden" name="order_no" value="<?=$orderNo?>">
	<input type="hidden" name="filename" value="purchase_order_<?=$orderNo?>">
	<input id="xls_deliverto" type="hidden" name="deliverto">
	<input id="xls_page" type="hidden" name="page">
	<input id="xls_attn" type="hidden" name="attn">
	<input id="xls_supplierinvoiceno" type="hidden" name="supplierinvoiceno">
	<input id="xls_terms" type="hidden" name="terms">
	<input id="xls_memo" type="hidden" name="memo">
	<input id="xls_freight" type="hidden" name="freight">
	<input id="xls_salestax" type="hidden" name="salestax">
	<input id="xls_lessdeposit" type="hidden" name="lessdeposit">
	<input id="xls_balancedue" type="hidden" name="balancedue">
	<input id="xls_preparedby" type="hidden" name="preparedby">
	<input id="xls_orderedby" type="hidden" name="orderedby">
	<input id="xls_approvedby" type="hidden" name="approvedby">
</form>

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
	// var tableTransactions = $('#transactionsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	'bLengthChange': false,
	// 	'order': [[ 0, 'desc' ]],
	// });
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

	$(document).on('submit', '#formAddPOBill', function(t) {
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
		$('#formExportTable').submit();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
