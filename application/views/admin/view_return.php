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

$salesOrderTransactions = $this->Model_Selects->GetUnreturnedTransactionsByOrderNo($return['SalesOrderNo']);

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
					<div class="col-12 col-md-6">
						<h3><i class="bi bi-reply-fill"></i> Return ID #<?=$return['ID']?> <span class="text-secondary">[ <?=$returnNo?> ]</span>
						</h3>
						<a href="<?=base_url() . 'admin/view_sales_order?orderNo='. $return["SalesOrderNo"]?>">
							<i class="bi bi-eye"></i> <?=$return['SalesOrderNo']?>
						</a>
					</div>
					<div class="col-12">
						<?php if ($this->session->userdata('UserRestrictions')['return_product_add']): ?>
							<button type="button" class="newreturn-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-reply"></i> RETURN ITEM</button>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-12 ">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<table id="returnsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">#</th>
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">STOCK ID</th>
										<th class="text-center">PRODUCT CODE</th>
										<th class="text-center">DATE</th>
										<th class="text-center">REMARKS</th>
										<th class="text-center">RETURNED / UNRETURNED</th>
										<th class="text-center">RETURNED TO INVENTORY</th>
										<th class="text-center">FREEBIE</th>
										<th></th>
									</thead>
									<tbody>
										<?php
										if ($getReturnProductsByReturnNo->num_rows() > 0):
											foreach ($getReturnProductsByReturnNo->result_array() as $no => $row): ?>
												<tr data-id="<?=$row['transactionid']?>" data-qty="<?=$row['quantity']?>" data-total="<?=$row['quantity_total']?>">
													<td class="text-center">
														<span style="font-style: italic; font-size: 12px;"><?=$no+1?></span>
													</td>
													<td class="text-center">
														<?=$row['transactionid']?>
													</td>
													<td class="text-center">
														<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['stockid']?></span>
													</td>
													<td class="text-center">
														<?=$row['prd_sku']?>
													</td>
													<td class="text-center">
														<?=$row['date_added']?>
													</td>
													<td class="text-center remarks">
														<?=$row['remarks']?>
													</td>
													<td class="text-center">
														<?=$row['quantity']?> / <?=$row['quantity_total'] - $row['quantity']?>
													</td>
													<td class="text-center remarks">
														<?=$row['returned']?>
													</td>
													<td class="text-center">
														<?php if ($row['Freebie'] == 1): ?>
															<i class="bi bi-check-circle text-success"></i>
														<?php else: ?>
															<i class="bi bi-x-circle text-danger"></i>
														<?php endif; ?>
													</td>
													<td class="text-center">
														<?php if ($this->session->userdata('UserRestrictions')['return_product_edit']): ?>
															<i class="bi bi-pencil btn-update-return" style="color: #229F4B;"></i>
														<?php endif; ?>
														<?php if ($this->session->userdata('UserRestrictions')['return_product_return_to_inventory']): ?>
															<?php if ($row['quantity'] > 0): ?>
																<i class="bi bi-reply-all btn-inventory-return" style="color: #a7852d;"></i>
															<?php endif; ?>
														<?php endif; ?>
													</td>
												</tr>
										<?php endforeach;
										endif; ?>
									</tbody>
								</table>
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

<?php $this->load->view('admin/modals/returns/add_return_product.php', array('return' => $return)); ?>
<?php $this->load->view('admin/modals/returns/update_return_product.php'); ?>
<?php $this->load->view('admin/modals/returns/return_product_to_inventory.php'); ?>

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
	// var tableTransactions = $('#transactionsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	'bLengthChange': false,
	// 	'order': [[ 0, 'desc' ]],
	// });
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
	var tableSalesOrderProducts = $('#salesOrderProductsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSalesOrderProductsSearch').on('keyup change', function() {
		tableSalesOrderProducts.search($(this).val()).draw();
	});

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
	});

	$(document).on('click', '.btn-update-return', function() {
		let tr = $(this).parents('tr');

		$('.updateTransactionID').html(tr.data('id'));
		$('#updateTransactionID').val(tr.data('id'));
		$('.updateRemarks').val(tr.find('.remarks').html().trim());
		$('.updateQty').attr('max', tr.data('total')).val(tr.data('total'));

		$('#UpdateReturnProduct').modal('toggle');
	});

	$(document).on('click', '.btn-inventory-return', function() {
		let tr = $(this).parents('tr');

		if (tr.data('qty') > 0) {
			$('.inventoryReturnTransactionID').html(tr.data('id'));
			$('#inventoryReturnTransactionID').val(tr.data('id'));
			$('.inventoryReturnQty').attr('max', tr.data('qty')).val(tr.data('qty'));

			$('#InventoryReturnProduct').modal('toggle');
		} else {
			showAlert('warning', 'Update return qty first!');
		}
	});
	$(document).on('submit', '#updateReturnProductToInventory', function(e) {
		if (!confirm('Return amount to product inventory? (This action cannot be undone)')) {
			e.preventDefault();
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
