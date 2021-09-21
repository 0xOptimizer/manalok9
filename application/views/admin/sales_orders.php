<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
// Fetch Sales Orders
$getAllSalesOrders = $this->Model_Selects->GetAllSalesOrders();

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

	.clientSelect {
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
					<div class="col-12 col-md-6">
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
						<button type="button" class="newsalesorder-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW SALES ORDER</button>
						|
						<button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
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
												<span><i class="bi bi-cash" style="color:#E4B55B;"></i> Waiting For Payment</span>
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
<?php $this->load->view('admin/modals/add_sales_order'); ?>
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
		$('.productsTotal .subTotal, .total').html(subTotal.toFixed(2));
		// empty transaction
		if ($('.orderProduct').length > 0) {
			$('.noProduct').hide();
		} else {
			$('.noProduct').show();
		}
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
					value: parseFloat($(this).children('.pPrice').html().replace(',', ''))
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
			let productTotal = parseInt($(this).val()) * parseFloat(td.siblings('.productPrice').html().replace(',', ''));
			td.siblings('.productTotal').html(productTotal.toFixed(2)).data('product-total', productTotal);
		} else {
			td.siblings('.productTotal').html(0).data('product-total', 0);
		}
		updProductCount();
	});

	// NAME SEARCH - BILL TO
	$('.clientBillNameSearch').on('focus keyup', function() {
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
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		} else {
			$('.clientBillNameDropdown').html('');
		}
	}).on('keydown', function(e) {
		if (!$('.clientBillNameDropdown').hasClass('show')) {
			$('.clientBillNameSearch').dropdown('show');
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
					$('.billNameIcon').removeClass('bi-x-circle-fill text-danger').addClass('bi-check-circle-fill text-success');

					$('.billName').val(response.Name);
					$('.billNo').val(response.ClientNo);
					$('.billAddress').val(response.Address);
					$('.billCity').val(response.CityStateProvinceZip);
					$('.billCountry').val(response.Country);
					$('.billContact').val(response.ContactNum);
					let category = null;
					switch (response.Category) {
						case '0': category = 'CONFIRMED DISTRIBUTOR'; break;
						case '1': category = 'DISTRIBUTOR ON PROBATION'; break;
						case '2': category = 'DIRECT DEALER'; break;
						case '3': category = 'DIRECT END USER'; break;
					}
					$('.billCategory').val(category).html(category);

					$('#BillToNo').val(response.ClientNo);

					if ($('.clientBillNameDropdown').hasClass('show')) {
						$('.clientBillNameSearch').dropdown('hide');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
	// NAME SEARCH - SHIP TO
	$('.clientShipNameSearch').on('focus keyup', function() {
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
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		} else {
			$('.clientShipNameDropdown').html('');
		}
	}).on('keydown', function(e) {
		if (!$('.clientShipNameDropdown').hasClass('show')) {
			$('.clientShipNameSearch').dropdown('show');
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
					$('.shipNameIcon').removeClass('bi-x-circle-fill text-danger').addClass('bi-check-circle-fill text-success');

					$('.shipName').val(response.Name);
					$('.shipNo').val(response.ClientNo);
					$('.shipAddress').val(response.Address);
					$('.shipCity').val(response.CityStateProvinceZip);
					$('.shipCountry').val(response.Country);
					$('.shipContact').val(response.ContactNum);

					$('#ShipToNo').val(response.ClientNo);

					if ($('.clientShipNameDropdown').hasClass('show')) {
						$('.clientShipNameSearch').dropdown('hide');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
