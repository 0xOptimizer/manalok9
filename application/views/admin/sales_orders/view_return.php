<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

if ($this->input->get('returnNo')) {
	$returnNo = $this->input->get('returnNo');
} else {
	redirect('admin/sales_orders');
}
$getReturnByReturnNo = $this->Model_Selects->GetReturnByReturnNo($returnNo);
$return = $getReturnByReturnNo->row_array();

$getReturnProductsByReturnNo = $this->Model_Selects->GetReturnProductsByReturnNo($returnNo);


$returnItemsQtyTotal = array('GOOD' => 0, 'DAMAGED' => 0,'RETURNED' => 0);
$returnItemsPriceTotal = array('GOOD' => 0, 'DAMAGED' => 0,'RETURNED' => 0);

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
			<a href="<?=base_url() . 'admin/returns'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO RETURNS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-12">
						<h3>
							<i class="bi bi-reply-fill"></i> <?=$return['ReturnNo']?>
						</h3>
						<i class="bi bi-receipt"></i> Sales Order [ <a href="<?=base_url() . 'admin/view_sales_order?orderNo='. $return["SalesOrderNo"]?>">
							<i class="bi bi-eye"></i> <?=$return['SalesOrderNo']?>
						</a> ]
					</div>
				</div>
			</div>
			<section class="section mt-1">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-8">
						<?php if ($this->session->userdata('UserRestrictions')['return_product_add']): ?>
							<button type="button" class="newreturn-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-reply"></i> NEW RETURN ITEM</button>
						<?php endif; ?>
					</div>
					<div class="col-12 col-sm-6 col-md-4" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableReturnsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="salesOrderProductsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">TRANSACTION ID</th>
								<th class="text-center">STOCK ID</th>
								<th class="text-center">DATE</th>
								<th class="text-center">REMARKS</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL PRICE</th>
								<th class="text-center">FREEBIE</th>
								<th></th>
							</thead>
							<tbody>
								<?php
								if ($getReturnProductsByReturnNo->num_rows() > 0):
									foreach ($getReturnProductsByReturnNo->result_array() as $row):
										$transactionDetails = $this->Model_Selects->GetTransactionsByTID($row['transactionid'])->row_array();

										$returnItemsQtyTotal[$row['remarks']] += $row['quantity'];
										$returnItemsPriceTotal[$row['remarks']] += $row['quantity'] * $transactionDetails['PriceUnit']; ?>
										<tr data-id="<?=$row['transactionid']?>">
											<td class="text-center">
												<?=$row['transactionid']?>
											</td>
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['stockid']?></span>
											</td>
											<td class="text-center">
												<?=$row['date_added']?>
											</td>
											<td class="text-center remarks">
												<?=$row['remarks']?>
											</td>
											<td class="text-center quantity_total">
												<?=$row['quantity']?>
											</td>
											<td class="text-center">
												<?=number_format($row['quantity'] * $transactionDetails['PriceUnit'], 2)?>
											</td>
											<td class="text-center">
												<?php if ($row['Freebie'] == 1): ?>
													<i class="bi bi-check-circle text-success"></i>
												<?php else: ?>
													<i class="bi bi-x-circle text-danger"></i>
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?php if ($this->session->userdata('UserRestrictions')['return_product_delete']): ?>
													<a href="FORM_removeReturnProduct?rid=<?=$row['id']?>">
														<button type="button" class="btn removeReturn"><i class="bi bi-trash text-danger"></i></button>
													</a>
												<?php endif; ?>
											</td>
										</tr>
								<?php endforeach;
								else: ?>
									<tr>
										<td class="text-center text-muted" colspan="7">
											RETURNED ITEMS LIST IS EMPTY
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-12 col-md-4 px-3">
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											GOOD RETURNS TOTAL QTY
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=$returnItemsQtyTotal['GOOD']?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											GOOD RETURNS TOTAL PRICE
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=number_format($returnItemsPriceTotal['GOOD'], 2)?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 px-3">
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											DAMAGED RETURNS TOTAL QTY
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=$returnItemsQtyTotal['DAMAGED']?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											DAMAGED RETURNS TOTAL PRICE
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=number_format($returnItemsPriceTotal['DAMAGED'], 2)?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 px-3">
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											RETURNED ITEMS TOTAL QTY
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=$returnItemsQtyTotal['RETURNED']?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="card">
								<div class="text-center p-2">
									<div class="row">
										<span class="head-text fw-bold">
											RETURNED ITEMS TOTAL PRICE
										</span>
									</div>
									<div class="row">
										<div class="col-12">
											<span style="font-size: 1.15em; color: #ebebeb;">
												<b>
													<?=number_format($returnItemsPriceTotal['RETURNED'], 2)?>
												</b>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/returns/add_return_product.php', array('return' => $return)); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-returns').addClass('active');
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
	var tableReturns = $('#returnsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableReturnsSearch').on('keyup change', function() {
		tableReturns.search($(this).val()).draw();
	});
	// var tableSalesOrderProducts = $('#salesOrderProductsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	"bLengthChange": false,
 //    	"order": [[ 0, "desc" ]],
	// });
	// $('#tableSalesOrderProductsSearch').on('keyup change', function() {
	// 	tableSalesOrderProducts.search($(this).val()).draw();
	// });

	$('.newreturn-btn').on('click', function() {
		$('#AddReturnProduct').modal('toggle');
	});
	// ADD SALES ORDER PRODUCT
	$(document).on('click', '.select-transaction-btn', function() {
		if ($('#addReturnNo').val().length < 1) {
			showAlert('warning', 'No Return #!');
		} else {
			$('#AddReturnProduct').data('openModal', 'salesorderproducts');
			$('#AddReturnProduct').modal('toggle');
		}
	});
	$(document).on('hidden.bs.modal', '#AddReturnProduct', function (event) {
		if ($('#AddReturnProduct').data('openModal') == 'salesorderproducts') {
			$('#AddReturnProduct').data('openModal', '');
			$('#SelectSOProductsModal').modal('toggle');
		}
	});
	$(document).on('hidden.bs.modal', '#SelectSOProductsModal', function (event) {
		$('#AddReturnProduct').modal('toggle');
	});
	$(document).on('click', '.select-transaction-row', function() {
		$('#addTransactionID').val($(this).data('id'));
		$('.select-transaction-btn').html($(this).data('id'));
		$('#SelectSOProductsModal').modal('toggle');

		var tID = $(this).data('id');
		if (tID.length > 0) {
			$.ajax({
				url: 'getReturnTransactionDetails',
				type: 'GET',
				dataType: 'JSON',
				data: { tid: tID } ,
				success: function (response) {
					let good = parseInt(response.GOOD);
					let damaged = parseInt(response.DAMAGED);
					let returned = parseInt(response.RETURNED);
					let orderedRemaining = parseInt(response.ORDERED) - (good + damaged + returned);
					$('#pt_quantityorderedremaining').text(orderedRemaining).data('qty', orderedRemaining);

					$('#rt_good').text(good).data('qty', good);
					$('#rt_damaged').text(damaged).data('qty', damaged);
					$('#rt_returned').text(returned).data('qty', returned);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	// // EDIT RETURN PRODUCT
	// $(document).on('click', '.btn-update-return', function() {
	// 	let tr = $(this).parents('tr');

	// 	$('.updateTransactionID').html(tr.data('id'));
	// 	$('#updateTransactionID').val(tr.data('id'));

	// 	// $('.updateQty').attr('max', tr.data('total')).val(tr.data('total'));

	// 	$('.updateRemarks').val(tr.find('.remarks').html().trim());

	// 	$('#UpdateReturnProduct').modal('toggle');
	// });

	// // infoMessage

	// // RETURN TO INVENTORY
	// $(document).on('click', '.btn-inventory-return', function() {
	// 	let tr = $(this).parents('tr');

	// 	if (tr.data('qty') > 0) {
	// 		$('.inventoryReturnTransactionID').html(tr.data('id'));
	// 		$('#inventoryReturnTransactionID').val(tr.data('id'));
	// 		$('.inventoryReturnQty').attr('max', tr.data('qty')).val(tr.data('qty'));

	// 		$('#InventoryReturnProduct').modal('toggle');
	// 	} else {
	// 		showAlert('warning', 'Update return qty first!');
	// 	}
	// });
	// $(document).on('submit', '#updateReturnProductToInventory', function(e) {
	// 	if (!confirm('Return amount to product inventory? (This action cannot be undone)')) {
	// 		e.preventDefault();
	// 	}
	// });

	$(document).on('click', '.removeReturn', function() {
		if (!confirm('Remove Return?')) {
			event.preventDefault();
		}
	});

	$(document).on('submit', '#AddReturnProduct', function() {
		if ($('#pt_quantityorderedremaining').data('qty') < $('#newReturnQty').val()) {
			showAlert('warning', 'Selected qty is more than the remaining ordered quantity.');
			event.preventDefault();
		} else if ($('#newReturnQty').val() < 1) {
			showAlert('warning', 'Qty is not valid.');
			event.preventDefault();
		} else if ($('#addTransactionID').val().length < 1) {
			showAlert('warning', 'No selected transaction.');
			event.preventDefault();
		}
	});

	$(document).on('change', '#returnRemarks', function() {
		if ($(this).val() == 'RETURNED') {
			showAlert('info', 'Returning to inventory cannot be undone!');
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
