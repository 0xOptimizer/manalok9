<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
// Fetch Purchase Orders
$getAllPurchaseOrders = $this->Model_Selects->GetAllPurchaseOrders();
$getAccounts = $this->Model_Selects->GetAccountSelection();

$getAllProducts = $this->Model_Selects->GetAllProducts();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
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

	.vendorSelect, .purchaseNameIcon {
		cursor: pointer;
	}
	.vendorSelect:hover {
		background-color: rgba(0, 0, 0, 0.2);
	}
	.viewonly {
		color: #ccc !important;
	}
	.footerHead {
		color: #a7852d;
		font-size: 0.9rem;
	}
	.grid_stack {
		display: grid;
	}
	.grid_stack input, .grid_stack select {
		grid-column: 1;
		grid-row: 1;
	}
	.add_table td:hover {
		background-color: rgba(100, 100, 100, 0.1);
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
					<div class="col-12">
						<h3><i class="bi bi-receipt"></i> Purchase Orders
							<span class="text-center success-banner-sm">
								<i class="bi bi-receipt"></i> <?=$getAllPurchaseOrders->num_rows();?> TOTAL
							</span>
							<?php if ($getAllPurchaseOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Purchase Orders found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_add']): ?>
							<button type="button" class="newpurchaseorder-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW PURCHASE ORDER</button>
							|
						<?php endif; ?>
						<button type="button" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
						<a href="view_purchase_summary">
							<button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-list"></i> SUMMARY</button>
						</a>
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
					<table id="purchaseTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">SO #</th>
							<th class="text-center">DATE</th>
							<th class="text-center">ITEMS</th>
							<th class="text-center">TOTAL PRICE</th>
							<th class="text-center">STATUS</th>
						</thead>
						<tbody>
							<?php
							if ($getAllPurchaseOrders->num_rows() > 0):
								foreach ($getAllPurchaseOrders->result_array() as $row): ?>
									<tr data-urlredirect="<?=base_url() . 'admin/view_purchase_order?orderNo=' . $row['OrderNo'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['OrderNo']?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<?php $orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo']); ?>
										<td class="text-center">
											<?=$orderTransactions->num_rows()?>
										</td>
										<td class="text-center">
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
										</td>
										<td class="text-center">
											<?php if ($row['Status'] == '1'): ?>
												<span><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
											<?php elseif ($row['Status'] == '2'): ?>
												<span><i class="bi bi-check-circle text-success"></i> Received</span>
											<?php else: ?>
												<span><i class="bi bi-trash text-danger"></i> Rejected</span>
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

<?php $this->load->view('admin/_modals/purchase_orders/add_purchase_order'); ?>
<?php $this->load->view('admin/_modals/generate_report')?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>

<script>
$('.sidebar-admin-purchase-orders').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#purchaseTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>

	$('.newpurchaseorder-btn').on('click', function() {
		$('#AddPurchaseOrderModal').modal('toggle');
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
	
	var table = $('#purchaseTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		buttons: [
            {
	            extend: 'print',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5 ]
	            },
	            customize: function ( doc ) {
	            	$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
					$(doc.document.body).find('h1').css('font-size', '24px');
					$(doc.document.body).find('h1').css('text-align', 'center'); 
				}
	        },
	        {
	            extend: 'copyHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5 ]
	            }
	        },
	        {
	            extend: 'excelHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5 ]
	            }
	        },
	        {
	            extend: 'csvHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5 ]
	            }
	        },
	        {
	            extend: 'pdfHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5 ]
	            }
	        }
    ]});
    $('body').on('click', '#generateReport-Print', function () {
        table.button('0').trigger();
    });
    $('body').on('click', '#generateReport-Copy', function () {
        table.button('1').trigger();
    });
    $('body').on('click', '#generateReport-Excel', function () {
        table.button('2').trigger();
    });
    $('body').on('click', '#generateReport-CSV', function () {
        table.button('3').trigger();
    });
    $('body').on('click', '#generateReport-PDF', function () {
        table.button('4').trigger();
    });
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
	var tableProducts = $('#selectproductsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableProductsSearch').on('keyup change', function(){
		tableProducts.search($(this).val()).draw();
	});

	function updProductCount() {
		let totalProductsCount = 0;
		// update order transsaction input names
		$.each($('.orderProduct'), function(i, val) {
			$(this).attr('id', 'op' + i);
			if ($(this).find('.inpSKU').val().length > 0) {
				$(this).find('.inpSKU').attr('name', 'productCodeInput_' + totalProductsCount);
				$(this).find('.inpQty').attr('name', 'productQtyInput_' + totalProductsCount);
				$(this).find('.inpCost').attr('name', 'productCostInput_' + totalProductsCount);
				$(this).find('.inpPrice').attr('name', 'productPriceInput_' + totalProductsCount);
				$(this).find('.inpExpiration').attr('name', 'productExpirationInput_' + totalProductsCount);

				totalProductsCount++;
			}
		});
		// update order transaction count
		$('#ProductsCount').val(totalProductsCount);
		// total
		let subTotal = 0;
		$.each($('.productTotalCost'), function(i, val) {
			subTotal += parseFloat($(this).data('total'));
		});
		$('.productsTotal').html(subTotal.toFixed(2));
	}
	$(document).on('click', '.remove-product-btn', function() {
		$(this).parents('tr').remove();
		updProductCount();
	});
	$(document).on('click', '.add-product-row', function() {
		let opIDName = 'op' + $('.orderProduct').length;
		$('.newProduct').before($('<tr>')
			.attr({
				id: opIDName,
				class: 'orderProduct highlighted'
			})
			.append($('<td>').attr({
				class: 'text-center'
			})
				.append($('<input>').attr({ // create hidden input for product id
					class: 'inpSKU',
					type: 'hidden'
				}))
				.append($('<button>').attr({
					type: 'button',
					class: 'btn btn-info select-product-btn'
				})
					.append($('<i>').attr({ class: 'bi bi-plus' }).html('SELECT PRODUCT'))))
			.append($('<td>').attr({
				class: 'productQty text-center'
			})
				.append($('<input>').attr({
					class: 'inpQty',
					type: 'number',
					value: 0,
					min: '0',
					style: 'width: 5rem;',
					required: ''
				})))
			.append($('<td>').attr({
				class: 'productCost text-center'
			})
				.append($('<input>').attr({
					class: 'inpCost',
					type: 'number',
					value: 0,
					min: '0',
					step: '0.0001',
					style: 'width: 7rem;',
					required: ''
				})))
			.append($('<td>').attr({
				class: 'productPrice text-center'
			})
				.append($('<input>').attr({
					class: 'inpPrice',
					type: 'number',
					value: 0,
					min: '0',
					step: '0.0001',
					style: 'width: 7rem;',
					required: ''
				})))
			.append($('<td>').attr({
				class: 'text-center'
			})
				.append($('<span>').attr({
					class: 'productTotalCost text-center'
				}).html('0.00').data('total', 0)))
			.append($('<td>').attr({
				class: 'productExpiration text-center'
			})
				.append($('<input>').attr({
					class: 'inpExpiration',
					type: 'date',
					style: 'width: 9rem;'
				})))
			.append($('<td>').attr({ class: 'text-center' })
				.append($('<button>').attr({
					type: 'button',
					class: 'btn remove-product-btn'
				})
					.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);
		updProductCount();
		setTimeout(function() {
			$('#' + opIDName).removeClass('highlighted');
		}, 2000);
	});

	$(document).on('click', '.select-product-btn', function() {
		$('#AddPurchaseOrderModal').data('prevscroll', $('#AddPurchaseOrderModal').scrollTop());
		// $('#AddPurchaseOrderModal').modal('toggle');
		// $('#SelectProductSKUModal').modal('toggle');
		$('#AddPurchaseOrderModal').data('openModal', 'products');
		$('#AddPurchaseOrderModal').modal('toggle');

		$('#rowProductSelection').val($(this).parents('tr').attr('id'));
	});
	$(document).on('hidden.bs.modal', '#AddPurchaseOrderModal', function (event) {
		if ($('#AddPurchaseOrderModal').data('openModal') == 'products') {
			$('#AddPurchaseOrderModal').data('openModal', '');
			$('#SelectProductSKUModal').modal('toggle');
		}
	});

	$(document).on('click', '.select-product-row', function() {
		$('#' + $('#rowProductSelection').val() + ' .select-product-btn').html($(this).data('sku'));
		$('#' + $('#rowProductSelection').val() + ' .inpSKU').val($(this).data('sku'));

		$('#SelectProductSKUModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#SelectProductSKUModal', function (event) {
		$('#AddPurchaseOrderModal').modal('toggle');

		setTimeout(function() {
			$('#AddPurchaseOrderModal').animate({
				scrollTop: $('#AddPurchaseOrderModal').data('prevscroll')
			}, 50);
		}, 50);
	});

	$(document).on('focus keyup change', '.inpQty, .inpCost', function() {
		let p_row = $(this).parents('tr');
		let totalCost = parseFloat(p_row.find('.inpQty').val()) * parseFloat(p_row.find('.inpCost').val());
		p_row.find('.productTotalCost').html(totalCost.toFixed(2));
		p_row.find('.productTotalCost').data('total', totalCost);
		updProductCount();
	});

	// NAME SEARCH
	function hideNameDropdown() {
		if ($('.vendorPurchaseNameDropdown').hasClass('show')) {
			$('.vendorPurchaseNameSearch').dropdown('hide');
		}
	}
	function showNameDropdown() {
		if (!$('.vendorPurchaseNameDropdown').hasClass('show')) {
			$('.vendorPurchaseNameSearch').dropdown('show');
		}
	}
	$('.vendorPurchaseNameSearch').on('focus keyup', function() {
		if (!$('.purchaseNameIcon').hasClass('bi-backspace-fill')) {
			var searchVal = $(this).val();
			if (searchVal.length > 0) {
				$.ajax({
					url: 'searchVendorName',
					type: 'GET',
					dataType: 'JSON',
					data: { search : searchVal } ,
					success: function (response) {
						$('.vendorPurchaseNameDropdown').html('');
						$.each(response, function(index, val) {
							$('.vendorPurchaseNameDropdown').append($('<span>').attr({ class: 'dropdown-item vendorSelect vendorPurchaseDetailsSelect' }).html(val.Name).data('vendor-no', val.VendorNo));
						});
						$('.vendorPurchaseNameDropdown').append($('<span>').attr({ class: 'dropdown-item vendorSelect newVendor' }).html("[ NEW VENDOR ]"));
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			} else {
				$('.vendorPurchaseNameDropdown').html('');
				$('.vendorPurchaseNameDropdown').append($('<span>').attr({ class: 'dropdown-item vendorSelect newVendor' }).html("[ NEW VENDOR ]"));
			}
		} else {
			$('.vendorPurchaseNameDropdown').html('');
			hideNameDropdown();
		}
	}).on('keydown click', function(e) {
		if (!$('.purchaseNameIcon').hasClass('bi-backspace-fill')) {
			showNameDropdown();
		} else {
			$('.vendorPurchaseNameDropdown').html('');
			hideNameDropdown();
		}
	});
	$(document).on('click', '.vendorPurchaseDetailsSelect', function(t) {
		var vendorNo = $(this).data('vendor-no');
		if (vendorNo.length > 0) {
			$.ajax({
				url: 'searchVendorDetails',
				type: 'GET',
				dataType: 'JSON',
				data: { no: vendorNo } ,
				success: function (response) {
					$('.purchaseNameIcon').addClass('bi-check-circle-fill text-success'); // change name icon
					if ($('.purchaseNameIcon').hasClass('bi-x-circle-fill')) {
						$('.purchaseNameIcon').removeClass('bi-x-circle-fill text-danger');
					} else if ($('.purchaseNameIcon').hasClass('bi-backspace-fill')) {
						$('.purchaseNameIcon').removeClass('bi-backspace-fill text-light');
						$('.newVendorInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
					}

					$('.purchaseName').val(response.Name);
					$('.purchaseNo').val(response.VendorNo);
					$('.purchaseTIN').val(response.TIN);
					$('.purchaseAddress').val(response.Address);
					$('.purchaseContactNum').val(response.ContactNum);
					$('.purchaseKind').val(response.ProductServiceKind);
					$('.purchaseEmail').val(response.Email);

					$('#PurchaseFromNo').val(response.VendorNo); // change vendor no input

					hideNameDropdown();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
	$(document).on('click', '.newVendor', function(t) { // on clicking the new vendor button on dropdown
		$('.newVendorInput').removeClass('viewonly').removeAttr('readonly').attr('required', '');
		// clear inputs
		$('.purchaseName').val('');
		$('.purchaseTIN').val('');
		$('.purchaseAddress').val('');
		$('.purchaseContactNum').val('');
		$('.purchaseKind').val('');
		$('.purchaseEmail').val('');
		// change no value
		$('.purchaseNo').val($('.purchaseNo').data('newvno'));
		$('#PurchaseFromNo').val('newVendor');
		
		hideNameDropdown();

		$('.purchaseNameIcon').addClass('bi-backspace-fill text-light'); // change name icon
		if ($('.purchaseNameIcon').hasClass('bi-x-circle-fill')) {
			$('.purchaseNameIcon').removeClass('bi-x-circle-fill text-danger');
		} else if ($('.purchaseNameIcon').hasClass('bi-check-circle-fill')) {
			$('.purchaseNameIcon').removeClass('bi-check-circle-fill text-success');
		}
	});
	$(document).on('click', '.purchaseNameIcon', function(t) { // onclick of backspace icon
		if ($('.purchaseNameIcon').hasClass('bi-backspace-fill')) {
			$('.newVendorInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
			// clear inputs
			$('.purchaseName').val('');
			$('.purchaseTIN').val('');
			$('.purchaseAddress').val('');
			$('.purchaseContactNum').val('');
			$('.purchaseKind').val('');
			$('.purchaseEmail').val('');
			
			$('.purchaseNo').val('');
			$('#PurchaseFromNo').val('');
			// change icon
			$('.purchaseNameIcon').removeClass('bi-backspace-fill text-light');
			$('.purchaseNameIcon').addClass('bi-x-circle-fill text-danger');
		}
		hideNameDropdown();
	});
	$(document).on('submit', '#formAddPurchaseOrder', function(t) {
		let qty = 0;
		let cost = 0;
		let price = 0;
		// check product added inputs
		$.each($('.orderProduct'), function(i, val) {
			if (typeof $(this).find('.inpSKU').attr('name') !== typeof undefined && $(this).find('.inpSKU').attr('name') !== false) {
				qty = $(this).find('.inpQty').val();
				cost = $(this).find('.inpCost').val();
				price = $(this).find('.inpPrice').val();

				if (qty <= 0 || cost <= 0 || price <= 0) {
					return false;
				}
			}
		});

		if ($('#PurchaseFromNo').val().length < 1) {
			showAlert('warning', 'No vendor selected!');
			$('#AddPurchaseOrderModal').animate({ scrollTop: 0 }, 1000);
			t.preventDefault();
		} else if (parseInt($('#ProductsCount').val()) < 1 || $('#ProductsCount').val().length < 1) {
			showAlert('warning', 'Product list is empty!');
			t.preventDefault();
		} else if (qty <= 0 || cost <= 0 || price <= 0) {
			showAlert('warning', 'Product/s dont have valid qty/cost/price!');
			t.preventDefault();
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
