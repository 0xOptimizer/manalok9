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
	}
	.footerHead {
		color: #a7852d;
		font-size: 0.9rem;
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
						<h3>Sales Orders
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
						<?php if ($this->session->userdata('UserRestrictions')['sales_orders_add'] == 1): ?>
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
							<th class="text-center">TOTAL PRICE</th>
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
												<span><i class="bi bi-cash" style="color:#E4B55B;"></i> For Invoicing</span>
											<?php elseif ($row['Status'] == '3'): ?>
												<span><i class="bi bi-truck" style="color:#E4B55B;"></i> For Delivery</span>
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
<?php if ($this->session->userdata('UserRestrictions')['sales_orders_add'] == 1): ?>
<?php $this->load->view('admin/modals/add_sales_order'); ?>
<?php endif; ?>

<?php $this->load->view('admin/modals/generate_report')?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
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
	var tableProducts = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableProductsSearch').on('keyup change', function(){
		tableProducts.search($(this).val()).draw();
	});

	function updProductCount() {
		// update order transaction count
		$('#ProductsCount').val($('.orderProduct').length);
		// update order transsaction input names
		$.each($('.orderProduct'), function(i, val) {
			$(this).find('.inpCode').attr('name', 'productCodeInput_' + i);
			$(this).find('.inpPrice').attr('name', 'productPriceInput_' + i);
			$(this).find('.inpQty').attr('name', 'productQtyInput_' + i);
		});
		// total
		let subTotal = 0;
		$.each($('.productTotal'), function(i, val) {
			subTotal += parseFloat($(this).data('product-total'));
		});
		$('.productsTotal .subTotal').html(subTotal.toFixed(2));
		// empty transaction
		if ($('.orderProduct').length > 0) {
			$('.noProduct').hide();
		} else {
			$('.noProduct').show();
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

		$('.total').html((subTotal - totalDiscount).toFixed(2));
	}
	$(document).on('click', '.add-product-row', function() {
		let opClassName = 'op' + $(this).data('id');
		if ($('.' + opClassName).length < 1) {
			$('.productsTotal').before($('<tr>')
				.attr({
					class: 'orderProduct highlighted ' + opClassName
				})
				.append($('<td>').attr({ // qty
					class: 'productQty text-center'
				}).append($('<input>').attr({ // qty input
					class: 'inpQty ' + opClassName + '_qty',
					type: 'number',
					value: 0,
					min: '0',
					max: parseInt($(this).children('.pStock').html())
				})))
				.append($('<td>').attr({ // code
					class: 'text-center'
				}).html($(this).children('.pCode').html())
				.append($('<input>').attr({ // create hidden input for product id
					class: 'inpCode',
					type: 'hidden',
					value: $(this).children('.pCode').html()
				})))
				.append($('<td>').attr({ // unit price
					class: 'productPrice text-center'
				}).html($(this).children('.pPrice').html()).append($('<input>').attr({ // create hidden input for unit price
					class: 'inpPrice',
					type: 'hidden',
					value: parseFloat($(this).children('.pPrice').data('price'))
				})))
				.append($('<td>').attr({ // total
					class: 'productTotal text-center'
				}).html('0.00').data('product-total', 0))
				.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
					type: 'button',
					class: 'btn remove-product-btn'
				}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
			);
			updProductCount();
			setTimeout(function() {
				$('.' + opClassName).removeClass('highlighted');
			}, 2000);
			$('.' + opClassName).fadeIn('2000');
		}
	});
	$(document).on('click', '.remove-product-btn', function() {
		$(this).parents('tr').remove();
		updProductCount();
	});
	$(document).on('focus keyup change', '.productQty input', function() {
		let td = $(this).parent('.productQty');
		if ($(this).val().length > 0) {
			let productTotal = parseInt($(this).val()) * parseFloat(td.siblings('.productPrice').children('.inpPrice').val());
			td.siblings('.productTotal').html(productTotal.toFixed(2)).data('product-total', productTotal);
		} else {
			td.siblings('.productTotal').html(0).data('product-total', 0);
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
	$(document).on('click', '.clientBillDetailsSelect', function(t) {
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
						$('.newBillInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
					}

					$('.billName').val(response.Name);
					$('.billNo').val(response.ClientNo);
					$('.billAddress').val(response.Address);
					$('.billCity').val(response.CityStateProvinceZip);
					$('.billCountry').val(response.Country);
					$('.billContact').val(response.ContactNum);
					$('.billTIN').val(response.TIN);
					$('.billTerritory').val(response.TerritoryManager);

					$('.billCategory option[value=' + response.Category + ']').prop('selected', true);
					$('.billCategory').change();

					$('#BillToNo').val(response.ClientNo); // change client no input

					hideBillNameDropdown();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	$(document).on('click', '.newBillClient', function(t) { // on clicking the new vendor button on dropdown
		$('.newBillInput').removeClass('viewonly').removeAttr('readonly').attr('required', '');
		$('.billCategory').removeAttr('disabled');
		// clear inputs
		$('.billName').val('');
		$('.billNo').val('');
		$('.billAddress').val('');
		$('.billCity').val('');
		$('.billCountry').val('');
		$('.billContact').val('');
		$('.billTIN').val('');
		$('.billTerritory').val('');
		$('.billCategory option[value=0]').prop('selected', true);
		$('.billCategory').change();
		// change no value
		$('.billNo').val($('.billNo').data('newcno'));
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
	});
	$(document).on('click', '.billNameIcon', function(t) { // onclick of backspace icon
		if ($('.billNameIcon').hasClass('bi-backspace-fill')) {
			$('.newBillInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
			// clear inputs
			$('.billName').val('');
			$('.billNo').val('');
			$('.billAddress').val('');
			$('.billCity').val('');
			$('.billCountry').val('');
			$('.billContact').val('');
			$('.billTIN').val('');
			$('.billTerritory').val('');
			$('.billCategory option[value=0]').prop('selected', true);
			$('.billCategory').change();
			// change no value
			$('.billNo').val('');
			$('#BillToNo').val('');
			// change icon
			$('.billNameIcon').removeClass('bi-backspace-fill text-light');
			$('.billNameIcon').addClass('bi-x-circle-fill text-danger');
			$('.billCategory').attr('disabled', '');
		}
		hideBillNameDropdown();
		// hide ship to bill button
		$('.shipToBillingClient').hide();
		if ($('#ShipToNo').val() == 'shipToBillingClient') {
			// $('.newShipInput').removeClass('viewonly').removeAttr('readonly').attr('required', '');
			$('.shipName').removeClass('viewonly').removeAttr('readonly').attr('required', '');
			// $('.shipName').addClass('viewonly').attr('readonly', '').removeAttr('required');
			// clear inputs
			$('.shipName').val('');
			$('.shipNo').val('');
			$('.shipAddress').val('');
			$('.shipCity').val('');
			$('.shipCountry').val('');
			$('.shipContact').val('');
			$('.shipTIN').val('');
			$('.shipTerritory').val('');
			$('.shipCategory option[value=0]').prop('selected', true);
			// change no value
			$('.shipNo').val('');
			$('#ShipToNo').val('');
			// change icon
			$('.shipNameIcon').addClass('bi-x-circle-fill text-danger'); // change name icon
			$('.shipNameIcon').removeClass('bi-check-circle-fill text-success');
			hideShipNameDropdown();
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
	$('.clientShipNameSearch').on('focus keyup', function() {
		if (!$('.shipNameIcon').hasClass('bi-backspace-fill')) {
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
	$(document).on('click', '.clientShipDetailsSelect', function(t) {
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
						$('.newShipInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
					}

					$('.shipName').val(response.Name);
					$('.shipNo').val(response.ClientNo);
					$('.shipAddress').val(response.Address);
					$('.shipCity').val(response.CityStateProvinceZip);
					$('.shipCountry').val(response.Country);
					$('.shipContact').val(response.ContactNum);
					$('.shipTIN').val(response.TIN);
					$('.shipTerritory').val(response.TerritoryManager);

					$('.shipCategory option[value=' + response.Category + ']').prop('selected', true);

					$('#ShipToNo').val(response.ClientNo); // change client no input

					hideShipNameDropdown();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});

	$(document).on('click', '.newShipClient', function(t) { // on clicking the new vendor button on dropdown
		$('.newShipInput').removeClass('viewonly').removeAttr('readonly').attr('required', '');
		$('.shipCategory').removeAttr('disabled');
		// clear inputs
		$('.shipName').val('');
		$('.shipNo').val('');
		$('.shipAddress').val('');
		$('.shipCity').val('');
		$('.shipCountry').val('');
		$('.shipContact').val('');
		$('.shipTIN').val('');
		$('.shipTerritory').val('');
		$('.shipCategory option[value=0]').prop('selected', true);
		// change no value
		$('.shipNo').val($('.shipNo').data('newcno'));
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
			$('.newShipInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
			// clear inputs
			$('.shipName').val('');
			$('.shipNo').val('');
			$('.shipAddress').val('');
			$('.shipCity').val('');
			$('.shipCountry').val('');
			$('.shipContact').val('');
			$('.shipTIN').val('');
			$('.shipTerritory').val('');
			$('.shipCategory option[value=0]').prop('selected', true);
			// change no value
			$('.shipNo').val('');
			$('#ShipToNo').val('');
			// change icon
			$('.shipNameIcon').removeClass('bi-backspace-fill text-light');
			$('.shipNameIcon').addClass('bi-x-circle-fill text-danger');
			$('.shipCategory').attr('disabled', '');
		}
		hideShipNameDropdown();
	});
	$(document).on('submit', '#formAddSalesOrder', function(t) { // check inputs before submitting
		if ($('#BillToNo').val().length < 1) {
			alert('NO BILLING CLIENT SELECTED');
			$('#AddSalesOrderModal').animate({ scrollTop: 0 }, 1000); // scroll to top
			t.preventDefault();
		} else if ($('#ShipToNo').val().length < 1) {
			alert('NO SHIPPING CLIENT SELECTED');
			$('#AddSalesOrderModal').animate({ scrollTop: 0 }, 1000);
			t.preventDefault();
		} else if (parseInt($('#ProductsCount').val()) < 1 || $('#ProductsCount').val().length < 1) {
			alert('SALES ITEMS LIST IS EMPTY');
			t.preventDefault();
		}
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
	$(document).on('click', '.shipToBillingClient', function(t) { // when pressed shipping to new client
		$('.shipName').addClass('viewonly').attr('readonly', '').removeAttr('required');
		$('.shipNameIcon').addClass('bi-check-circle-fill text-success'); // change name icon
		if ($('.shipNameIcon').hasClass('bi-x-circle-fill')) {
			$('.shipNameIcon').removeClass('bi-x-circle-fill text-danger');
		} else if ($('.shipNameIcon').hasClass('bi-backspace-fill')) {
			$('.shipNameIcon').removeClass('bi-backspace-fill text-light');
			$('.newShipInput').addClass('viewonly').attr('readonly', '').removeAttr('required');
		}
		hideShipNameDropdown();
		$('#ShipToNo').val('shipToBillingClient'); // change client no input
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
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
