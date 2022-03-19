<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch invoices
$getReturns = $this->Model_Selects->GetReturns();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>
<style>
	.tdFreebie {
		background-color: rgba(25, 135, 84, 0.3) !important;
	}
	.trAdded {
		background-color: rgba(255, 193, 7, 0.3) !important;
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
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-8">
						<h3><i class="bi bi-reply-fill"></i> Returns
							<span class="text-center success-banner-sm">
								<i class="bi bi-reply-fill"></i> <?=$getReturns->num_rows();?> TOTAL
							</span>
							<?php if ($getReturns->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Returns found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['returns_add']): ?>
							<button type="button" class="newreturn-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-reply-fill"></i> NEW RETURN</button>
						<?php endif; ?>
					</div>
					<div class="col-sm-12 col-md-2 mr-auto pt-4 pb-2" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="returnsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">RETURN #</th>
							<th class="text-center">SO #</th>
							<th class="text-center">DATE</th>
							<th class="text-center"></th>
						</thead>
						<tbody>
							<?php if ($getReturns->num_rows() > 0):
								foreach ($getReturns->result_array() as $row): ?>
									<tr>
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['ReturnNo']?>
										</td>
										<td class="text-center">
											<?=$row['SalesOrderNo']?>
										</td>
										<td class="text-center">
											<?=$row['DateCreation']?>
										</td>
										<td class="text-center">
											<?php if ($this->session->userdata('UserRestrictions')['return_product_view']): ?>
												<a href="<?=base_url() . 'admin/view_return?returnNo=' . $row['ReturnNo'];?>">
													<i class="bi bi-eye" style="color: #408AF7;"></i>
												</a>
											<?php endif; ?>
										</td>
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
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/returns/add_return.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-returns').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#returnsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
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
	
	var table = $('#returnsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});
	var tableClients = $('#clientsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableClientsSearch').on('keyup change', function() {
		tableClients.search($(this).val()).draw();
	});
	var tableSalesOrders = $('#salesOrdersTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
		'createdRow': function(row, data, dataIndex) {
			$(row).addClass('select-salesorder-row').data('no', data[1]);
		},
		'columnDefs': [ {
				'targets': 0,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('text-center').html($('<span>').addClass('db-identifier').css({ 'font-style': 'italic', 'font-size': '12px' }).html(cellData));
				}
			}, {
				'targets': 1,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('text-center');
				}
			}, {
				'targets': 2,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('text-center');
				}
			}, {
				'targets': 3,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('text-center');
				}
			}
		]
	});
	$('#tableSalesOrdersSearch').on('keyup change', function() {
		tableSalesOrders.search($(this).val()).draw();
	});
	// var tableSalesOrderProducts = $('#salesOrderProductsTable').DataTable( {
	// 	sDom: 'lrtip',
	// 	"bLengthChange": false,
 //    	"order": [[ 0, "desc" ]],
	// 	'createdRow': function(row, data, dataIndex) {
	// 	// 	let productstockID = data[1] + '_' + data[0];
	// 	// 	$(row).addClass('productStocks select-stock-row').data('sku', data[1]).data('productstockID', productstockID);
	// 		$(row).addClass('select-salesorderproduct-row').attr('data-selectSOP', data[0]);

	// 	// 	if ($('#salesOrderProducts').find("[data-stockid='"+ productstockID +"']").length > 0 ) {
	// 	// 		$(row).addClass('trAdded');
	// 	// 	}
	// 	},
	// 	'columnDefs': [ {
	// 			'targets': 0,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopTID text-center');
	// 			}
	// 		}, {
	// 			'targets': 1,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopSKU text-center');
	// 			}
	// 		}, {
	// 			'targets': 2,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopAmount text-center');
	// 			}
	// 		}, {
	// 			'targets': 3,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopPrice text-center').html(parseFloat(cellData).toFixed(2)).data('price', cellData);
	// 			}
	// 		}, {
	// 			'targets': 4,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopTotal text-center').html(parseFloat(cellData).toFixed(2)).data('total', cellData);
	// 			}
	// 		}, {
	// 			'targets': 5,
	// 			'createdCell': function (td, cellData, rowData, row, col) {
	// 				$(td).addClass('sopFreebie text-center');
	// 				if (cellData == 1) {
	// 					$(td).html($('<i>').attr({
	// 						class: 'bi bi-check-circle text-success'
	// 					})).data('freebie', true);
	// 				} else {
	// 					$(td).html($('<i>').attr({
	// 						class: 'bi bi-x-circle text-danger'
	// 					})).data('freebie', false);
	// 				}
	// 			}
	// 		}
	// 	]
	// });
	// $('#tableSalesOrderProductsSearch').on('keyup change', function() {
	// 	tableSalesOrderProducts.search($(this).val()).draw();
	// });


	$('.newreturn-btn').on('click', function() {
		$('#NewReturnModal').modal('toggle');
	});

	// SELECT CLIENT
	$(document).on('click', '#select-client-btn', function() {
		$('#NewReturnModal').data('openModal', 'clients');
		$('#NewReturnModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#NewReturnModal', function (event) {
		if ($('#NewReturnModal').data('openModal') == 'clients') {
			$('#NewReturnModal').data('openModal', '');
			$('#SelectClientModal').modal('toggle');
		} else if ($('#NewReturnModal').data('openModal') == 'salesorders') {
			$('#NewReturnModal').data('openModal', '');
			$('#SelectSalesOrdersModal').modal('toggle');
		}
		//  else if ($('#NewReturnModal').data('openModal') == 'salesorderproducts') {
		// 	$('#NewReturnModal').data('openModal', '');
		// 	$('#SelectSOProductsModal').modal('toggle');
		// }
	});
	$(document).on('click', '.select-client-row', function() {
		$('#select-client-btn span, .selectedClient').html('#' + $(this).data('no'));

		// ENABLE SELECT SALESORDER BUTTON
		$('#select-salesorder-btn').prop('disabled', false);
		$('#select-salesorder-btn span').html('SELECT SALES ORDER');

		// SET clientNo
		$('#select-client-btn').data('ClientNo', $(this).data('no'));

		// // CLEAR TABLE AND SO VALUE WHEN CHANGING CLIENT
		// if ($('#ProductsCount').val() > 0 || $('#SalesOrderNo').val().length > 0) {
		// 	$('tr.soProduct').remove();
		// 	$('#SalesOrderNo').val('');
		// 	updProductCount();
		// }

		// GET CLIENT SALES ORDERS
		$.get('getClientSalesOrders', { dataType: 'json', no: $(this).data('no') })
		.done(function(data) {
			tableSalesOrders.clear();
			let clientSalesOrders = $.parseJSON(data);
			$.each(clientSalesOrders, function(index, val) {
				tableSalesOrders.row.add([
					val.ID,
					val.OrderNo,
					val.Date,
					val.ItemCount
				]);
			});
			tableSalesOrders.draw();
		});

		$('#SelectClientModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#SelectClientModal', function (event) {
		$('#NewReturnModal').modal('toggle');
	});

	// SELECT SALES ORDER
	$(document).on('click', '#select-salesorder-btn', function() {
		$('#NewReturnModal').data('openModal', 'salesorders');
		$('#NewReturnModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#SelectSalesOrdersModal', function (event) {
		$('#NewReturnModal').modal('toggle');
	});
	$(document).on('click', '.select-salesorder-row', function() {
		$('#SalesOrderNo').val($(this).data('no'));
		$('#select-salesorder-btn span, .selectedSalesOrder').html('#' + $(this).data('no'));

		// CLEAR TABLE WHEN CHANGING SO
		// if ($('#ProductsCount').val() > 0) {
		// 	$('tr.soProduct').remove();
		// 	updProductCount();
		// }

		// GET CLIENT SALES ORDERS
		// $.get('getClientSalesOrderProducts', { dataType: 'json', no: $(this).data('no') })
		// .done(function(data) {
		// 	tableSalesOrderProducts.clear();
		// 	let clientSalesOrderProducts = $.parseJSON(data);
		// 	$.each(clientSalesOrderProducts, function(index, val) {
		// 		tableSalesOrderProducts.row.add([
		// 			val.TransactionID,
		// 			val.Code,
		// 			val.Amount,
		// 			val.PriceUnit,
		// 			(val.Amount * val.PriceUnit),
		// 			val.Freebie
		// 		]);
		// 	});
		// 	tableSalesOrderProducts.draw();
		// });

		$('#SelectSalesOrdersModal').modal('toggle');
	});

	// // ADD SALES ORDER PRODUCT
	// $(document).on('click', '.add-salesorderproduct-row', function() {
	// 	if ($('#SalesOrderNo').val().length < 1) {
	// 		showAlert('warning', 'No Sales Order selected!');
	// 	} else {
	// 		$('#NewReturnModal').data('openModal', 'salesorderproducts');
	// 		$('#NewReturnModal').modal('toggle');
	// 	}
	// });

	// // COMPUTE SO PRODUCTS TOTAL
	// function updProductCount() {
	// 	// update order transsaction input names
	// 	let totalProductsCount = 0;
	// 	$.each($('.soProduct'), function(i, val) {
	// 		if (typeof $(this).attr('data-soTID') !== typeof undefined && $(this).attr('data-soTID') !== false) {
	// 			$(this).find('.inpTID').attr('name', 'productTIDInput_' + i);
	// 			$(this).find('.inpQty').attr('name', 'productQtyInput_' + i);
	// 			$(this).find('.inpRemarks').attr('name', 'productRemarksInput_' + i);

	// 			totalProductsCount++;
	// 		}
	// 	});
	// 	// update order transaction count
	// 	$('#ProductsCount').val(totalProductsCount);
	// 	// total
	// 	let total = 0;
	// 	let totalFreebies = 0;
	// 	$.each($('.sopTotalPrice'), function(i, val) {
	// 		let productTotal = parseFloat($(this).data('total'));

	// 		if ($(this).parents('.soProduct').data('freebie')) {
	// 			totalFreebies += productTotal;
	// 		} else {
	// 			total += productTotal;
	// 		}
	// 	});
	// 	$('.productsTotal .total').html(total.toFixed(2));
	// 	$('.productsTotal .totalFreebies').html(totalFreebies.toFixed(2));

	// 	if (totalFreebies > 0) {
	// 		$('.productsTotal .totalFreebies').addClass('tdFreebie');
	// 	} else {
	// 		$('.productsTotal .totalFreebies').removeClass('tdFreebie');
	// 	}
	// }

	// // SELECT SALES ORDER PRODUCT
	// $(document).on('click', '.select-salesorderproduct-row', function() {
	// 	// NEW SALES ORDER PRODUCT ROW
	// 	let sopClassName = 'sop' + $('.soProduct').length;

	// 	if ($('#salesOrderReturnProducts').find("[data-soTID='"+ $(this).find('.sopTID').html() +"']").length < 1) {
	// 		$('.newProduct').before($('<tr>')
	// 			.attr({
	// 				class: 'soProduct highlighted ' + sopClassName,
	// 				'data-soTID': $(this).find('.sopTID').html()
	// 			}).data('freebie', $(this).find('.sopFreebie').data('freebie'))
	// 			.append($('<td>').attr({
	// 				class: 'text-center'
	// 			})
	// 				.html($(this).find('.sopFreebie').html()))
	// 			.append($('<td>').attr({
	// 				class: 'sopTID text-center'
	// 			}).html($(this).find('.sopTID').html())
	// 				.append($('<input>').attr({ // create hidden input for transaction id
	// 					class: 'inpTID',
	// 					type: 'hidden'
	// 				}).val($(this).find('.sopTID').html())))
	// 			.append($('<td>').attr({
	// 				class: 'sopQty text-center'
	// 			})
	// 				.append($('<input>').attr({
	// 					class: 'inpQty',
	// 					type: 'number',
	// 					value: $(this).find('.sopAmount').html(),
	// 					min: '0',
	// 					max: $(this).find('.sopAmount').html(),
	// 					placeholder: '*',
	// 					style: 'width: 5rem;',
	// 					required: ''
	// 				})))
	// 			.append($('<td>').attr({
	// 				class: 'sopPrice text-center'
	// 			}).data('price', $(this).find('.sopPrice').data('price'))
	// 				.append($('<span>').attr({
	// 					class: 'text-center'
	// 				}).html($(this).find('.sopPrice').html())))
	// 			.append($('<td>').attr({
	// 				class: 'sopTotalPrice text-center' + (($(this).find('.sopFreebie').data('freebie')) ? ' tdFreebie' : '')
	// 			}).data('total', 0)
	// 				.append($('<span>').attr({
	// 					class: 'text-center'
	// 				}).html('0.00')))
	// 			.append($('<td>').attr({
	// 				class: 'sopRemarks text-center'
	// 			})
	// 				.append($('<input>').attr({
	// 					class: 'inpRemarks',
	// 					type: 'text',
	// 					style: 'width: 8rem;'
	// 				})))
	// 			.append($('<td>').attr({ class: 'text-center' })
	// 				.append($('<button>').attr({
	// 					type: 'button',
	// 					class: 'btn remove-sop-btn'
	// 				})
	// 					.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
	// 		);
	// 		updProductCount();
	// 		setTimeout(function() {
	// 			$('.' + sopClassName).removeClass('highlighted');
	// 		}, 2000);

	// 		$(this).addClass('trAdded');
	// 		$('#SelectSOProductsModal').modal('toggle');
	// 		$('.inpQty').change();
	// 	} else {
	// 		showAlert('warning', 'Transaction is already added!');
	// 	}
	// });
	// $(document).on('focus keyup change', '.sopQty .inpQty', function() {
	// 	if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
	// 		$(this).val($(this).attr('max'));
	// 	} else if (parseInt($(this).val()) < parseInt($(this).attr('min'))) {
	// 		$(this).val($(this).attr('min'));
	// 	}

	// 	let td = $(this).parent('.sopQty');
	// 	if ($(this).val().length > 0) {
	// 		let sopTotal = parseInt($(this).val()) * parseFloat(td.siblings('.sopPrice').data('price'));
	// 		td.siblings('.sopTotalPrice').data('total', sopTotal).children('span').html(sopTotal.toFixed(2));
	// 	} else {
	// 		td.siblings('.sopTotalPrice').data('total', 0).children('span').html('0.00');
	// 	}
	// 	updProductCount();
	// });
	// $(document).on('click', '.remove-sop-btn', function() {
	// 	$('#salesOrderProductsTable').find("[data-selectSOP='"+ $(this).parents('tr').attr('data-soTID') +"']").removeClass('trAdded');
	// 	$(this).parents('tr').remove();
	// 	updProductCount();
	// });
	// $(document).on('hidden.bs.modal', '#SelectSOProductsModal', function (event) {
	// 	$('#NewReturnModal').modal('toggle');
	// });

	$(document).on('submit', '#formAddReturn', function(t) { // check inputs before submitting
		// let qty = 0;
		// // check product added inputs
		// $.each($('.soProduct'), function(i, val) {
		// 	if (typeof $(this).attr('data-soTID') !== typeof undefined && $(this).attr('data-soTID') !== false) {
		// 		qty = $(this).find('.inpQty').val();

		// 		if (qty <= 0) {
		// 			return false;
		// 		}
		// 	}
		// });

		if ($('#SalesOrderNo').val().length < 1) {
			showAlert('warning', 'No sales order selected!');
			$('#AddSalesOrderModal').animate({ scrollTop: 0 }, 1000);
			t.preventDefault();
		}
		//  else if (parseInt($('#ProductsCount').val()) < 1 || $('#ProductsCount').val().length < 1) {
		// 	showAlert('warning', 'Return items list is empty!');
		// 	t.preventDefault();
		// } else if (qty <= 0) {
		// 	showAlert('warning', 'Product/s dont have valid qty!');
		// 	t.preventDefault();
		// } else if (parseFloat($('.total').html()) <= 0) {
		// 	showAlert('warning', 'Ordered Products Total must be more than 0!');
		// 	t.preventDefault();
		// }
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
