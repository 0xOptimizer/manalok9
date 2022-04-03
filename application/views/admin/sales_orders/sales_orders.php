<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
// Fetch Sales Orders
$getAllSalesOrders = $this->Model_Selects->GetAllSalesOrders();
$getAccounts = $this->Model_Selects->GetAccountSelection();

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

	.clientSelect, .billNameIcon, .shipNameIcon {
		cursor: pointer;
	}
	.clientSelect:hover {
		background-color: rgba(0, 0, 0, 0.2);
	}
	.viewonly {
		color: #ccc !important;
		border-color: #5f5f5f;
	}
	.footerHead {
		color: #a7852d;
		font-size: 0.9rem;
	}
	.add_table td:hover {
		background-color: rgba(100, 100, 100, 0.1);
	}
	.footerDiscount, .footerDiscount * {
		cursor: pointer;
	}
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
					<div class="col-12">
						<h3><i class="bi bi-receipt"></i> Sales Orders
							<span class="text-center success-banner-sm">
								<i class="bi bi-receipt"></i> <?=$getAllSalesOrders->num_rows();?> TOTAL
							</span>
							<?php if ($getAllSalesOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Sales Orders found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['sales_orders_add']): ?>
							<button type="button" class="newsalesorder-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW SALES ORDER</button>
							|
						<?php endif; ?>
						<button type="button" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
						<a href="view_sales_summary">
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
					<table id="salesTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">SO #</th>
							<th class="text-center">DATE</th>
							<th class="text-center">ITEMS</th>
							<th class="text-center">REMAINING PAYMENT</th>
							<th class="text-center">STATUS</th>
						</thead>
						<tbody>
							<?php
							if ($getAllSalesOrders->num_rows() > 0):
								foreach ($getAllSalesOrders->result_array() as $row): ?>
									<tr data-urlredirect="<?=base_url() . 'admin/view_sales_order?orderNo=' . $row['OrderNo'];?>">
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
											<?=number_format($row['TotalRemainingPayment'], 2)?>
										</td>
										<td class="text-center">
											<?php if ($row['Status'] == '1'): ?>
												<span><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
											<?php elseif ($row['Status'] == '2'): ?>
												<span><i class="bi bi-cash" style="color:#E4B55B;"></i> For Invoicing</span>
											<?php elseif ($row['Status'] == '3'): ?>
												<span><i class="bi bi-truck" style="color:#E4B55B;"></i> Delivery Scheduled</span>
											<?php elseif ($row['Status'] == '4'): ?>
												<span><i class="bi bi-check2" style="color:#E4B55B;"></i> Delivered</span>
											<?php elseif ($row['Status'] == '5'): ?>
												<span><i class="bi bi-check-circle text-success"></i> Fulfilled</span>
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

<?php $this->load->view('admin/_modals/sales_orders/add_sales_order'); ?>
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
$('.sidebar-admin-sales-orders').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#salesTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
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

	$('.newsalesorder-btn').on('click', function() {
		$('#AddSalesOrderModal').modal('toggle');
	});

	var table = $('#salesTable').DataTable( {
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
	var tableStocks = $('#selectstocksTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		'createdRow': function(row, data, dataIndex) {
			let productstockID = data[1] + '_' + data[0];
			$(row).addClass('productStocks select-stock-row').data('sku', data[1]).data('productstockID', productstockID);

			if ($('#salesOrderProducts').find("[data-stockid='"+ productstockID +"']").length > 0 ) {
				$(row).addClass('trAdded');
			}
		},
		'columnDefs': [ {
				'targets': 0,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockID text-center').html($('<span>').addClass('db-identifier').css({ 'font-style': 'italic', 'font-size': '12px' }).html(cellData)).data('stockID',cellData);
				}
			}, {
				'targets': 1,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockSKU text-center');
				}
			}, {
				'targets': 2,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockCurrentStocks text-center');
				}
			}, {
				'targets': 3,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockPrice text-center').html(parseFloat(cellData).toFixed(2)).data('retailPrice', cellData);
				}
			}, {
				'targets': 4,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockDateAdded text-center');
				}
			}, {
				'targets': 5,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockExpirationDate text-center');
				}
			}
		]
	});
	$('#tableStocksSearch').on('keyup change', function(){
		tableStocks.search($(this).val()).draw();
	});

	function updProductCount() {
		// update order transsaction input names
		let totalProductsCount = 0;
		$.each($('.orderProduct'), function(i, val) {
			if (typeof $(this).attr('data-stockid') !== typeof undefined && $(this).attr('data-stockid') !== false) {
				$(this).find('.inpFreebie').attr('name', 'productFreebieInput_' + i);
				$(this).find('.inpDiscount').attr('name', 'productDiscountInput_' + i);
				$(this).find('.inpSKU').attr('name', 'productSKUInput_' + i);
				$(this).find('.inpStockID').attr('name', 'productStockIDInput_' + i);
				$(this).find('.inpQty').attr('name', 'productQtyInput_' + i);

				totalProductsCount++;
			}
		});
		// update order transaction count
		$('#ProductsCount').val(totalProductsCount);
		// total
		let subTotal = 0;
		let totalFreebies = 0;

		let totalDiscountedProducts = 0; // discounted products are not included in computation of category discounts
		let totalProductDiscountDeductions = 0; // total price discounted

		$.each($('.productTotalPrice'), function(i, val) {
			let productTotal = parseFloat($(this).data('product-total'));
			
			totalProductDiscountDeductions += parseFloat($(this).data('product-discount-deduction'));

			if ($(this).parents('.orderProduct').data('freebie')) {
				totalFreebies += productTotal;
			} else if ($(this).parents('.orderProduct').data('discounted')) {
				totalDiscountedProducts += productTotal;
			} else {
				subTotal += productTotal;
			}
		});
		$('.productsTotal .subTotal').html(subTotal.toFixed(2));
		$('.productsTotal .totalFreebies').html(totalFreebies.toFixed(2));

		if (totalFreebies > 0) {
			$('.productsTotal .totalFreebies').addClass('tdFreebie');
		} else {
			$('.productsTotal .totalFreebies').removeClass('tdFreebie');
		}
		

		var totalDiscount = 0;
		if ($('.cbDiscountOutright').is(':checked')) {
			let discount = parseFloat($('.dcOutright').html()) * 0.01;
			totalDiscount += subTotal * discount;
			$('.dcOutrightAmt').html((subTotal * discount).toFixed(2));
		} else {
			$('.dcOutrightAmt').html('0.00');
		}
		if ($('.cbDiscountVolume').is(':checked')) {
			let discount = parseFloat($('.dcVolume').html()) * 0.01;
			totalDiscount += subTotal * discount;
			$('.dcVolumeAmt').html((subTotal * discount).toFixed(2));
		} else {
			$('.dcVolumeAmt').html('0.00');
		}
		if ($('.cbDiscountPBD').is(':checked')) {
			let discount = parseFloat($('.dcPBD').html()) * 0.01;
			totalDiscount += subTotal * discount;
			$('.dcPBDAmt').html((subTotal * discount).toFixed(2));
		} else {
			$('.dcPBDAmt').html('0.00');
		}
		if ($('.cbDiscountManpower').is(':checked')) {
			let discount = parseFloat($('.dcManpower').html()) * 0.01;
			totalDiscount += subTotal * discount;
			$('.dcManpowerAmt').html((subTotal * discount).toFixed(2));
		} else {
			$('.dcManpowerAmt').html('0.00');
		}

		$('.totalProductDiscounts').html(totalProductDiscountDeductions.toFixed(2));
		$('.totalCategoryDiscount').html(totalDiscount.toFixed(2));
		$('.total').html(((subTotal - totalDiscount) + totalDiscountedProducts).toFixed(2));
	}
	$(document).on('click', '.add-product-row', function() {
		let opClassName = 'op' + $('.orderProduct').length;

		$('.newProduct').before($('<tr>')
			.attr({
				class: 'orderProduct highlighted ' + opClassName
			}).data({
				'uClass': opClassName,
				'freebie': false,
				'discounted': false
			})
			.append($('<td>').attr({
				class: 'text-center'
			})
				.append($('<div>').attr({
					class: 'form-check form-switch form-check-inline text-center'
				})
					.append($('<input>').attr({
						class: 'inpFreebie form-check-input',
						type: 'checkbox'
					}))))
			.append($('<td>').attr({
				class: 'productDiscount text-center'
			}).data('product-discount', 0)
				.append($('<input>').attr({
					class: 'inpDiscount',
					type: 'number',
					value: 0,
					min: '0',
					style: 'width: 3.5rem;'
				})))
			.append($('<td>').attr({
				class: 'text-center'
			})
				.append($('<input>').attr({ // create hidden input for product id
					class: 'inpSKU',
					type: 'hidden'
				}))
				.append($('<input>').attr({ // create hidden input for stock id
					class: 'inpStockID',
					type: 'hidden'
				}))
				.append($('<button>').attr({
					type: 'button',
					class: 'btn btn-info select-product-btn'
				})
					.append($('<i>').attr({ class: 'bi bi-plus' }).html('SELECT PRODUCT'))))
			.append($('<td>').attr({
				class: 'text-center'
			})
				.append($('<span>').attr({
					class: 'productAdded text-center'
				}).html('N/A')))
			.append($('<td>').attr({
				class: 'productQty text-center'
			})
				.append($('<input>').attr({
					class: 'inpQty',
					type: 'number',
					value: 0,
					min: '0',
					max: '0',
					style: 'width: 5rem;',
					required: ''
				})))
			.append($('<td>').attr({
				class: 'productPrice text-center'
			})
				.append($('<span>').attr({
					class: 'text-center'
				}).html('0.00').data('price', 0)))
			.append($('<td>').attr({
				class: 'productTotalPrice text-center'
			}).data({
				'product-total': 0,
				'product-discount-deduction': 0
			})
				.append($('<span>').attr({
					class: 'text-center'
				}).html('0.00')))
			.append($('<td>').attr({ class: 'text-center' })
				.append($('<button>').attr({
					type: 'button',
					class: 'btn remove-product-btn'
				})
					.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);
		updProductCount();
		setTimeout(function() {
			$('.' + opClassName).removeClass('highlighted');
		}, 2000);
	});

	$(document).on('click', '.select-product-btn', function() {
		$('#AddSalesOrderModal').data('prevscroll', $('#AddSalesOrderModal').scrollTop());
		$('#AddSalesOrderModal').data('openModal', 'products');
		$('#AddSalesOrderModal').modal('toggle');

		$('#rowProductSelection').val($(this).parents('.orderProduct').data('uClass'));
	});
	$(document).on('hidden.bs.modal', '#AddSalesOrderModal', function (event) {
		if ($('#AddSalesOrderModal').data('openModal') == 'products') {
			$('#AddSalesOrderModal').data('openModal', '');
			$('#SelectProductSKUModal').modal('toggle');
		}
	});

	$(document).on('click', '.select-product-row', function() {
		// get product stocks
		$.get('getProductStocks', { dataType: 'json', sku: $(this).data('sku') })
		.done(function(data) {
			tableStocks.clear();
			let productStocks = $.parseJSON(data);
			$.each(productStocks, function(index, val) {
				tableStocks.row.add([
					val.ID,
					val.Product_SKU,
					val.Current_Stocks,
					val.Retail_Price,
					val.Date_Added,
					val.Expiration_Date
				]);
			});
			tableStocks.draw();
		});

		$('#AddSalesOrderModal').data('openModal', 'stocks');
		$('#SelectProductSKUModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#SelectProductSKUModal', function (event) {
		if ($('#AddSalesOrderModal').data('openModal') == 'stocks') {
			$('#AddSalesOrderModal').data('openModal', '');
			$('#SelectProductStockModal').modal('toggle');
		} else {
			$('#AddSalesOrderModal').modal('toggle');
			setTimeout(function() {
				$('#AddSalesOrderModal').animate({
					scrollTop: $('#AddSalesOrderModal').data('prevscroll')
				}, 50);
			}, 50);
		}
	});

	$(document).on('click', '.select-stock-row', function() {
		let productstockID = $(this).data('productstockID');
		if ($('#salesOrderProducts').find("[data-stockid='"+ productstockID +"']").length < 1) {
			let productClass = '.' + $('#rowProductSelection').val();
			$(productClass).attr('data-stockid', productstockID);
			$(productClass + ' .select-product-btn').html($(this).data('sku'));
			$(productClass + ' .inpSKU').val($(this).data('sku'));
			$(productClass + ' .inpStockID').val($(this).children('.stockID').data('stockID'));
			$(productClass + ' .productAdded').html($(this).children('.stockDateAdded').html());
			$(productClass + ' .productPrice').children('span').html($(this).children('.stockPrice').html()).data('price', $(this).children('.stockPrice').data('retailPrice'));

			$(productClass + ' .inpQty').attr({
				'max': $(this).children('.stockCurrentStocks').html()
			}).val(0);

			$('#SelectProductStockModal').modal('toggle');
			tableStocks.clear();
			updProductCount();
		} else {
			showAlert('warning', 'Product is already added!');
		}
	});
	$(document).on('hidden.bs.modal', '#SelectProductStockModal', function (event) {
		$('#AddSalesOrderModal').modal('toggle');
		setTimeout(function() {
			$('#AddSalesOrderModal').animate({
				scrollTop: $('#AddSalesOrderModal').data('prevscroll')
			}, 50);
		}, 50);
	});
	$(document).on('focus keyup change', '.inpDiscount', function() {
		$(this).parents('.productDiscount').data('product-discount', $(this).val());
		$(this).parents('.orderProduct').find('.inpQty').change();

		if ($(this).val() > 0) {
			$(this).parents('.orderProduct').data('discounted', true);
		} else {
			$(this).parents('.orderProduct').data('discounted', false);
		}

		if ($(this).parents('.orderProduct').find('.productTotalPrice').data('product-total') < 0) {
			showAlert('danger', 'Total Price for product is below zero!')
		}

		updProductCount();
	});
	$(document).on('focus keyup change', '.inpQty', function() {
		if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
			$(this).val($(this).attr('max'));
		} else if (parseInt($(this).val()) < parseInt($(this).attr('min'))) {
			$(this).val($(this).attr('min'));
		}

		let td = $(this).parent('.productQty');
		if ($(this).val().length > 0) {
			let discount = parseInt($(this).parents('.orderProduct').find('.productDiscount').data('product-discount'));
			let discountTotal = 0;
			let productTotal = parseInt($(this).val()) * parseFloat(td.siblings('.productPrice').children('span').data('price'));

			if ($.isNumeric(discount)) {
				discountTotal = (discount / 100) * productTotal;
			}

			productTotal -= discountTotal;

			td.siblings('.productTotalPrice').data('product-total', productTotal).data('product-discount-deduction', discountTotal).children('span').html(productTotal.toFixed(2));
			
			if (productTotal < 0) {
				showAlert('danger', 'Total Price for product is below zero!')
			}
		} else {
			td.siblings('.productTotalPrice').data('product-total', 0).data('product-discount-deduction', 0).children('span').html('0.00');
		}
		updProductCount();
	});
	$(document).on('click', '.remove-product-btn', function() {
		$(this).parents('.orderProduct').remove();
		updProductCount();
	});
	$(document).on('change', '.inpFreebie', function(e) {
		let orderProduct = $(this).parents('.orderProduct');
		if ($(this).prop('checked')) {
			orderProduct.data('freebie', true);
			orderProduct.find('.productTotalPrice').addClass('tdFreebie');
		} else {
			orderProduct.data('freebie', false);
			orderProduct.find('.productTotalPrice').removeClass('tdFreebie');
		}
		updProductCount();
	});



	// NAME SEARCH - BILL TO
	function hideBillNameDropdown() {
		if ($('.clientBillNameDropdown').hasClass('show')) {
			$('.clientBillNameSearch').dropdown('hide');
		}
	}
	function showBillNameDropdown() {
		if (!$('.clientBillNameDropdown').hasClass('show')) {
			$('.clientBillNameSearch').dropdown('show');
		}
	}
	$('.newBillInput').on('focus', function() {
		hideBillNameDropdown();
	});
	$('.clientBillNameSearch').on('focus keyup', function() {
		if (!$('.billNameIcon').hasClass('bi-backspace-fill')) {
			var searchVal = $(this).val();
			if (searchVal.length > 0 ) {
				$.ajax({
					url: 'searchClientName',
					type: 'GET',
					dataType: 'JSON',
					data: { search : searchVal } ,
					success: function (response) {
						$('.clientBillNameDropdown').html('');
						$.each(response, function(index, val) {
							$('.clientBillNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect clientBillDetailsSelect' }).html(val.Name).data('client-no', val.ClientNo));
						});
						$('.clientBillNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect newBillClient' }).html("[ NEW CLIENT ]"));
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			} else {
				$('.clientBillNameDropdown').html('');
				$('.clientBillNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect newBillClient' }).html("[ NEW CLIENT ]"));
			}
		} else {
			$('.clientBillNameDropdown').html('');
			hideBillNameDropdown();
		}
	}).on('keydown click', function(e) {
		if (!$('.billNameIcon').hasClass('bi-backspace-fill')) {
			showBillNameDropdown();
		} else {
			$('.clientBillNameDropdown').html('');
			hideBillNameDropdown();
		}
	});
	$(document).on('click', '.clientBillDetailsSelect', function(t) { // onclick of search result
		var clientNo = $(this).data('client-no');
		if (clientNo.length > 0) {
			$.ajax({
				url: 'searchClientDetails',
				type: 'GET',
				dataType: 'JSON',
				data: { no: clientNo } ,
				success: function (response) {
					$('.billNameIcon').addClass('bi-check-circle-fill text-success'); // change name icon
					if ($('.billNameIcon').hasClass('bi-x-circle-fill')) {
						$('.billNameIcon').removeClass('bi-x-circle-fill text-danger');
					} else if ($('.billNameIcon').hasClass('bi-backspace-fill')) {
						$('.billNameIcon').removeClass('bi-backspace-fill text-light');
					}

					$('.newBillInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');

					$('.billName').val(response.Name);
					$('.billNo').val(response.ClientNo);
					$('.billAddress').val(response.Address);
					$('.billCity').val(response.CityStateProvinceZip);
					$('.billCountry').val(response.Country);
					$('.billContact').val(response.ContactNum);
					$('.billTIN').val(response.TIN);
					$('.billTerritory').val(response.TerritoryManager);
					$('.billEmail').val(response.Email);

					$('.billCategory option[value=' + response.Category + ']').prop('selected', true);
					$('.billCategory').change();

					$('#BillToNo').val(response.ClientNo); // change client no input

					hideBillNameDropdown();

					if ($('#BillToNo').val() == $('#ShipToNo').val()) {
						$('.newShipInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');
						// showAlert('info', 'Updating on shipping client details is disabled since shipping and billing clients are the same.');
					}

					// if shipping update has been disabled after choosing two similar clients, enable it again
					if ($('#BillToNo').val() != $('#ShipToNo').val() && $('#ShipToNo').val() != 'shipToBillingClient' && $('#ShipToNo').val() != 'newShipClient') {
						$('.newShipInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	$(document).on('click', '.newBillClient', function(t) { // on clicking the new client button on dropdown
		$('.newBillInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
		// clear inputs
		$('.billName').val('');
		$('.newBillInput').val('');
		$('.billCategory option[value=0]').prop('selected', true);
		$('.billCategory').change();
		// change no value
		$('.billNo').val('');
		$('#BillToNo').val('newBillClient');
		
		hideBillNameDropdown();

		$('.billNameIcon').addClass('bi-backspace-fill text-light'); // change name icon
		if ($('.billNameIcon').hasClass('bi-x-circle-fill')) {
			$('.billNameIcon').removeClass('bi-x-circle-fill text-danger');
		} else if ($('.billNameIcon').hasClass('bi-check-circle-fill')) {
			$('.billNameIcon').removeClass('bi-check-circle-fill text-success');
		}
		// show ship to bill button
		$('.shipToBillingClient').show();

		// if shipping update has been disabled after choosing two similar clients, enable it again
		if ($('#ShipToNo').val() != 'shipToBillingClient' && $('#ShipToNo').val() != 'newShipClient' && $('#ShipToNo').val() != '') {
			$('.newShipInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
		}
	});
	$(document).on('click', '.billNameIcon', function(t) { // onclick of backspace icon
		if ($('.billNameIcon').hasClass('bi-backspace-fill')) {
			$('.newBillInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');
			// clear inputs
			$('.billName').val('');
			$('.newBillInput').val('');
			$('.billCategory option[value=0]').prop('selected', true);
			$('.billCategory').change();
			// change no value
			$('.billNo').val('');
			$('#BillToNo').val('');
			// change icon
			$('.billNameIcon').removeClass('bi-backspace-fill text-light');
			$('.billNameIcon').addClass('bi-x-circle-fill text-danger');
		}
		hideBillNameDropdown();
		// hide ship to bill button
		$('.shipToBillingClient').hide();
		$('.shipToSelectClient').hide();
		if ($('#ShipToNo').val() == 'shipToBillingClient') {
			$('.shipName').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
			// clear inputs
			$('.shipName').val('');
			$('.newShipInput').val('');
			$('.shipCategory option[value=0]').prop('selected', true);
			// change no value
			$('.shipNo').val('');
			$('#ShipToNo').val('');
			// change icon
			$('.shipNameIcon').addClass('bi-x-circle-fill text-danger'); // change name icon
			$('.shipNameIcon').removeClass('bi-check-circle-fill text-success');
			hideShipNameDropdown();
		}

		// if shipping update has been disabled after choosing two similar clients, enable it again
		if ($('#ShipToNo').val() != 'shipToBillingClient' && $('#ShipToNo').val() != 'newShipClient') {
			$('.newShipInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
		}
	});

	// NAME SEARCH - SHIP TO
	function hideShipNameDropdown() {
		if ($('.clientShipNameDropdown').hasClass('show')) {
			$('.clientShipNameSearch').dropdown('hide');
		}
	}
	function showShipNameDropdown() {
		if (!$('.clientShipNameDropdown').hasClass('show')) {
			$('.clientShipNameSearch').dropdown('show');
		}
	}
	$('.newShipInput').on('focus', function() {
		hideShipNameDropdown();
	});
	$('.clientShipNameSearch').on('focus keyup', function() {
		if (!$('.shipNameIcon').hasClass('bi-backspace-fill') && !$(this).hasClass('viewonly')) {
			var searchVal = $(this).val();
			if (searchVal.length > 0 ) {
				$.ajax({
					url: 'searchClientName',
					type: 'GET',
					dataType: 'JSON',
					data: { search : searchVal } ,
					success: function (response) {
						$('.clientShipNameDropdown').html('');
						$.each(response, function(index, val) {
							$('.clientShipNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect clientShipDetailsSelect' }).html(val.Name).data('client-no', val.ClientNo));
						});
						$('.clientShipNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect newShipClient' }).html("[ NEW CLIENT ]"));
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			} else {
				$('.clientShipNameDropdown').html('');
				$('.clientShipNameDropdown').append($('<span>').attr({ class: 'dropdown-item clientSelect newShipClient' }).html("[ NEW CLIENT ]"));
			}
		} else {
			$('.clientShipNameDropdown').html('');
			hideShipNameDropdown();
		}
	}).on('keydown click', function(e) {
		if (!$('.shipNameIcon').hasClass('bi-backspace-fill')) {
			showShipNameDropdown();
		} else {
			$('.clientShipNameDropdown').html('');
			hideShipNameDropdown();
		}
	});
	$(document).on('click', '.clientShipDetailsSelect', function(t) { // onclick of search result
		var clientNo = $(this).data('client-no');
		if (clientNo.length > 0) {
			$.ajax({
				url: 'searchClientDetails',
				type: 'GET',
				dataType: 'JSON',
				data: { no: clientNo } ,
				success: function (response) {
					$('.shipNameIcon').addClass('bi-check-circle-fill text-success'); // change name icon
					if ($('.shipNameIcon').hasClass('bi-x-circle-fill')) {
						$('.shipNameIcon').removeClass('bi-x-circle-fill text-danger');
					} else if ($('.shipNameIcon').hasClass('bi-backspace-fill')) {
						$('.shipNameIcon').removeClass('bi-backspace-fill text-light');
					}

					$('.shipName').val(response.Name);
					$('.shipNo').val(response.ClientNo);
					$('.shipAddress').val(response.Address);
					$('.shipCity').val(response.CityStateProvinceZip);
					$('.shipCountry').val(response.Country);
					$('.shipContact').val(response.ContactNum);
					$('.shipTIN').val(response.TIN);
					$('.shipTerritory').val(response.TerritoryManager);
					$('.shipEmail').val(response.Email);

					$('.shipCategory option[value=' + response.Category + ']').prop('selected', true);

					$('#ShipToNo').val(response.ClientNo); // change client no input

					hideShipNameDropdown();

					if ($('#ShipToNo').val() != $('#BillToNo').val()) {
						$('.newShipInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
					} else {
						$('.newShipInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');
						// showAlert('info', 'Updating on shipping client details is disabled since shipping and billing clients are the same.');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	$(document).on('click', '.newShipClient', function(t) { // on clicking the new client button on dropdown
		$('.newShipInput').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
		// clear inputs
		$('.shipName').val('');
		$('.newShipInput').val('');
		$('.shipCategory option[value=0]').prop('selected', true);
		// change no value
		$('.shipNo').val('');
		$('#ShipToNo').val('newShipClient');
		
		hideShipNameDropdown();

		$('.shipNameIcon').addClass('bi-backspace-fill text-light'); // change name icon
		if ($('.shipNameIcon').hasClass('bi-x-circle-fill')) {
			$('.shipNameIcon').removeClass('bi-x-circle-fill text-danger');
		} else if ($('.shipNameIcon').hasClass('bi-check-circle-fill')) {
			$('.shipNameIcon').removeClass('bi-check-circle-fill text-success');
		}
	});
	$(document).on('click', '.shipNameIcon', function(t) { // onclick of backspace icon
		if ($('.shipNameIcon').hasClass('bi-backspace-fill')) {
			$('.newShipInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');
			// clear inputs
			$('.shipName').val('');
			$('.newShipInput').val('');
			$('.shipCategory option[value=0]').prop('selected', true);
			// change no value
			$('.shipNo').val('');
			$('#ShipToNo').val('');
			// change icon
			$('.shipNameIcon').removeClass('bi-backspace-fill text-light');
			$('.shipNameIcon').addClass('bi-x-circle-fill text-danger');
		}
		hideShipNameDropdown();
	});
	$(document).on('submit', '#formAddSalesOrder', function(t) { // check inputs before submitting
		let qty = 0;
		// check product added inputs
		$.each($('.orderProduct'), function(i, val) {
			if (typeof $(this).attr('data-stockid') !== typeof undefined && $(this).attr('data-stockid') !== false) {
				qty = $(this).find('.inpQty').val();

				if (qty <= 0) {
					return false;
				}
			}
		});

		if ($('#BillToNo').val().length < 1) {
			showAlert('warning', 'No billing client selected!');
			$('#AddSalesOrderModal').animate({ scrollTop: 0 }, 1000); // scroll to top
			t.preventDefault();
		} else if ($('#ShipToNo').val().length < 1) {
			showAlert('warning', 'No shipping client selected!');
			$('#AddSalesOrderModal').animate({ scrollTop: 0 }, 1000);
			t.preventDefault();
		} else if (parseInt($('#ProductsCount').val()) < 1 || $('#ProductsCount').val().length < 1) {
			showAlert('warning', 'Sales items list is empty!');
			t.preventDefault();
		} else if (qty <= 0) {
			showAlert('warning', 'Product/s dont have valid qty!');
			t.preventDefault();
		} else if (parseFloat($('.total').html()) <= 0) {
			showAlert('warning', 'Ordered Products Total must be more than 0!');
			t.preventDefault();
		}
	});
	$(document).on('click', '.shipToBillingClient', function(t) { // when pressed shipping to new client
		$('.shipName').addClass('viewonly').attr('readonly', '').removeAttr('required');
		$('.shipNameIcon').addClass('bi-check-circle-fill text-success'); // change name icon
		if ($('.shipNameIcon').hasClass('bi-x-circle-fill')) {
			$('.shipNameIcon').removeClass('bi-x-circle-fill text-danger');
		} else if ($('.shipNameIcon').hasClass('bi-backspace-fill')) {
			$('.shipNameIcon').removeClass('bi-backspace-fill text-light');
		}
		$('.newShipInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');

		$('.shipName').val('');
		$('.newShipInput').val('');

		hideShipNameDropdown();
		$('#ShipToNo').val('shipToBillingClient'); // change client no input

		$('.shipToBillingClient').hide();
		$('.shipToSelectClient').show();

		$('.shipToBillInput').change();
	});
	$(document).on('click', '.shipToSelectClient', function(t) {
		$('.shipToSelectClient').hide();
		if ($('#ShipToNo').val() == 'shipToBillingClient') {
			$('.shipToBillingClient').show();
		}
		$('.shipName').removeClass('viewonly').removeAttr('readonly').removeAttr('disabled').attr('required', '');
		$('.newShipInput').addClass('viewonly').attr('readonly', '').attr('disabled', '').removeAttr('required');
		// clear inputs
		$('.shipName').val('');
		$('.newShipInput').val('');
		$('.shipCategory option[value=0]').prop('selected', true);
		// change no value
		$('.shipNo').val('');
		$('#ShipToNo').val('');
		// change icon
		$('.shipNameIcon').removeClass('bi-check-circle-fill text-light');
		$('.shipNameIcon').addClass('bi-x-circle-fill text-danger');
	});
	$(document).on('change keyup', '.shipToBillInput', function(event) {
		if ($('#ShipToNo').val() == 'shipToBillingClient') {
			$('.shipName').val($('.billName').val());
			$('.shipNo').val($('.billNo').val());
			$('.shipAddress').val($('.billAddress').val());
			$('.shipCity').val($('.billCity').val());
			$('.shipCountry').val($('.billCountry').val());
			$('.shipContact').val($('.billContact').val());
			$('.shipTIN').val($('.billTIN').val());
			$('.shipTerritory').val($('.billTerritory').val());
			$('.shipEmail').val($('.billEmail').val());

			$('.shipCategory option[value=' + $('.billCategory').val() + ']').prop('selected', true);
			hideShipNameDropdown();
		}
	});

	$(document).on('change', '.billCategory', function(e) {
		switch ($(this).val()) {
			case '0':
				$('.dcCategory').html('CONFIRMED DISTRIBUTOR');
				$('.dcOutright').html('15');
				$('.dcVolume').html('10');
				$('.dcPBD').html('5');
				$('.dcManpower').html('5');
				break;
			case '1':
				$('.dcCategory').html('DISTRIBUTOR ON PROBATION');
				$('.dcOutright').html('12');
				$('.dcVolume').html('10');
				$('.dcPBD').html('5');
				$('.dcManpower').html('5');
				break;
			case '2':
				$('.dcCategory').html('DIRECT DEALER');
				$('.dcOutright').html('10');
				$('.dcVolume').html('10');
				$('.dcPBD').html('5');
				$('.dcManpower').html('0');
				break;
			case '3':
				$('.dcCategory').html('DIRECT END USER');
				$('.dcOutright').html('10');
				$('.dcVolume').html('10');
				$('.dcPBD').html('5');
				$('.dcManpower').html('0');
				break;
			default: break;
		}
		updProductCount();
	});

	$(document).on('change', '.cbDiscount', function(e) {
		updProductCount();
	});
	$(document).on('click', '.footerDiscount', function(e) {
		let discount = $(this).find('.cbDiscount');
		if (discount.prop('checked') == true) {
			discount.prop('checked', false);
		} else {
			discount.prop('checked', true);
		}
		updProductCount();
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
