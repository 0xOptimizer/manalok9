<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$sbmf = $this->input->get('sbmf');
$sbmfy = $this->input->get('sbmfy');
$sbmt = $this->input->get('sbmt');
$sbmty = $this->input->get('sbmty');

$sbdf = $this->input->get('sbdf');
$sbdt = $this->input->get('sbdt');

if ($sbmf != NULL && $sbmfy != NULL && $sbmt != NULL && $sbmty != NULL) {
	$from = date('Y-m-d', strtotime($sbmfy	 .'-'. $sbmf));
	$to = date('Y-m-t', strtotime($sbmty	 .'-'. $sbmt));
	$rangeText = date('F Y', strtotime($from)) .' TO '. date('F Y', strtotime($to));
} elseif ($sbmf != NULL && $sbmfy == NULL && $sbmt != NULL && $sbmty == NULL) {
	$from = date('Y-m-d', strtotime($sbmf));
	$to = date('Y-m-t', strtotime($sbmt));
	$rangeText = date('F j, Y', strtotime($from)) .' TO '. date('F j, Y', strtotime($to));
} elseif ($sbdf != NULL && $sbdt != NULL) {
	$from = date('Y-m-d', strtotime($sbdf));
	$to = date('Y-m-d', strtotime($sbdt));
	$rangeText = date('F j, Y', strtotime($from)) .' TO '. date('F j, Y', strtotime($to));
} else {
	$from = NULL;
	$to = NULL;
	$rangeText = 'TOTAL';
}

$sbst = $this->input->get('sbst');
if ($sbst == NULL || $sbst == 'ALL') {
	$sbst = -1;
	$status = '';
} else {
	$status = $sbst;
}

$soNoArr = array_column($this->Model_Selects->GetAllSalesOrdersNo($status,$from,$to)->result_array(), 'OrderNo');
$getSalesOrders = $this->Model_Selects->GetSalesOrdersInOrderNo($soNoArr);

$soCodesArr = array_column($this->Model_Selects->GetProductTransactionsInSalesOrderNo($soNoArr,$status)->result_array(), 'Code');

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
			<a href="<?=base_url() . 'admin/sales_orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO SALES ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-12">
						<h3><i class="bi bi-receipt"></i> Sales Order Summary
							<?php if ($getSalesOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Sales Orders found.
								</span>
							<?php endif; ?>
							<span class="text-center info-banner-sm">
								<i class="bi bi-exclamation-triangle-fill"></i> <?=strtoupper($rangeText)?>
							</span>
						</h3>
					</div>
					<div class="col-sm-12 col-md-8 pt-4 pb-2">
						<button type="button" class="btn btn-sm-success" onclick="window.location.replace('<?=base_url()?>admin/view_sales_summary');">
							<i class="bi bi-clock-fill"></i> TOTAL
						</button>
						<button type="button" class="btn btn-sm-success sortbymonth-btn">
							<i class="bi bi-calendar-fill"></i> MONTHLY
						</button>
						<button type="button" class="btn btn-sm-success sortbyday-btn">
							<i class="bi bi-calendar-fill"></i> CUSTOM DATE
						</button>
						<?php if ($this->session->userdata('Privilege') > 1): ?>
							|
							<button type="button" class="generatereport-btn btn btn-sm-primary">
								<i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT
							</button>
						<?php endif; ?>
					</div>
					<div class="col-12 col-md-4">
						<form id="sortOrders" action="<?php echo base_url() . 'admin/view_sales_summary';?>" method="GET">
							<?php if ($from != NULL && $to != NULL): ?>
								<input type="hidden" name="sbdf" value="<?=$from?>">
								<input type="hidden" name="sbdt" value="<?=$to?>">
							<?php endif; ?>
							<select id="sortSelect" name="sbst" class="form-control">
								<option <?=($sbst == -1 ? 'selected' : '')?>>ALL</option>
								<option value="0" <?=($sbst == 0 ? 'selected' : '')?>>REJECTED</option>
								<option value="1" <?=($sbst == 1 ? 'selected' : '')?>>PENDING / FOR APPROVAL</option>
								<option value="2" <?=($sbst == 2 ? 'selected' : '')?>>FOR INVOICING / APPROVED</option>
								<option value="3" <?=($sbst == 3 ? 'selected' : '')?>>DELIVERY SCHEDULED</option>
								<option value="4" <?=($sbst == 4 ? 'selected' : '')?>>DELIVERED</option>
								<option value="5" <?=($sbst == 5 ? 'selected' : '')?>>FULFILLED</option>
							</select>
						</form>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="ordersTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">DATE CREATED</th>
							<th class="text-center">SALES ORDER #</th>
							<th class="text-center">STATUS</th>
							<th class="text-center">QTY TOTAL</th>
							<th class="text-center">REMAINING PAYMENT</th>
							<th class="text-center">LAST PAYMENT</th>
							<th class="text-center">CLIENT NAME (BILLED)</th>
							<?php if ($getSalesOrders->num_rows() > 0): 
								foreach ($soCodesArr as $productCode): ?>
								<th class="text-center"><?=$productCode?></th>
							<?php endforeach;
							endif; ?>
						</thead>
						<tbody>
							<?php
							if ($getSalesOrders->num_rows() > 0):
								foreach ($getSalesOrders->result_array() as $row): ?>
									<tr class="view-sales-transactions" data-orderno="<?=$row['OrderNo']?>" data-totalcategory="<?=$row['discountOutright'] + $row['discountVolume'] + $row['discountPBD'] + $row['discountManpower']?>">
										<?php
										$soTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo'])->result_array();
										$totalAmount = array_sum(array_column($soTransactions, 'Amount'));
										?>
										<td class="text-center">
											<?=$row['DateCreation']?>
										</td>
										<td class="text-center">
											<?=$row['OrderNo']?>
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
										<td class="text-center">
											<?=$totalAmount?>
										</td>
										<td class="text-center">
											<?=number_format($row['TotalRemainingPayment'], 2)?>
										</td>
										<td class="text-center">
											<?php
											$lastInvoice = $this->Model_Selects->GetLastInvoiceBySONo($row['OrderNo']);
											if ($lastInvoice->num_rows() > 0) {
												if ($lastInvoice->row_array()['date'] != '') {
													echo $lastInvoice->row_array()['date'];
												} else {
													echo 'N/A';
												}
											}
											?>
										</td>
										<td class="text-center">
											<?=$this->Model_Selects->GetClientByNo($row['BillToClientNo'])->row_array()['Name']?>
										</td>
										<?php
										foreach ($soCodesArr as $productCode):
											$qty = 0;
											foreach ($soTransactions as $row) {
												if ($productCode == $row['Code']) {
													$qty += $row['Amount'];
												}
											} ?>
											<td class="text-center product_qty" product_code>
												<?=$qty?>
											</td>
										<?php endforeach; ?>
									</tr>
							<?php endforeach;
							else: ?>
								<tr>
									<td class="text-center" colspan="5">
										<label class="input-label">
											[ EMPTY ]
										</label>
									</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<?php
if ($from == NULL && $to == NULL) {
	$from = date('Y-m-d');
	$to = date('Y-m-d');
}
?>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>
<?php $this->load->view('admin/_modals/generate_report')?>
<div class="modal fade" id="SortByMonthModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="" method="GET">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-calendar-fill" style="font-size: 24px;"></i> Sort By Month</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmf">
								<?php for ($i = 1; $i <= 12; $i++): ?>
									<option value="<?=$i?>" <?=(date('m', strtotime($from)) == $i ? 'selected' : '')?>><?=date('F', strtotime(date('Y') .'-'. $i .'-01'))?></option>
								<?php endfor; ?>
							</select>
							<label class="input-label">FROM</label>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmfy">
								<?php for ($i = date('Y'); $i >= 1990; $i--): ?>
									<option value="<?=$i?>" <?=(date('Y', strtotime($from)) == $i ? 'selected' : '')?>><?=$i?></option>
								<?php endfor; ?>
							</select>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmt">
								<?php for ($i = 1; $i <= 12; $i++): ?>
									<option value="<?=$i?>" <?=(date('m', strtotime($to)) == $i ? 'selected' : '')?>><?=date('F', strtotime(date('Y') ."-". $i ."-01"))?></option>
								<?php endfor; ?>
							</select>
							<label class="input-label">TO</label>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmty">
								<?php for ($i = date('Y'); $i >= 1990; $i--): ?>
									<option value="<?=$i?>" <?=(date('Y', strtotime($to)) == $i ? 'selected' : '')?>><?=$i?></option>
								<?php endfor; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="SortByDayModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<form action="" method="GET">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-calendar-fill" style="font-size: 24px;"></i> Sort By Day</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 mb-2">
							<input type="date" class="form-control" name="sbdf" value="<?=date('Y-m-d', strtotime($from))?>" required>
							<label class="input-label">FROM</label>
						</div>
						<div class="form-group col-12 mb-2">
							<input type="date" class="form-control" name="sbdt" value="<?=date('Y-m-d', strtotime($to))?>" required>
							<label class="input-label">TO</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php $this->load->view('admin/_modals/sales_orders/sales_order_summary_view'); ?>

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
	<?php if ($this->input->get('sortOrders')): ?>
		$('#sortSelect').find("[value='" + "<?=$this->input->get('sortOrders');?>" + "']").attr('selected', '');; 
	<?php endif; ?>
	$('.sortbymonth-btn').on('click', function() {
		$('#SortByMonthModal').modal('toggle');
	});
	$('.sortbyday-btn').on('click', function() {
		$('#SortByDayModal').modal('toggle');
	});

	$("#sortSelect").on('change', function(event) {
		$("#sortOrders").submit();
	});
	var table = $('#ordersTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		buttons: [
            {
	            extend: 'print',
	            customize: function ( doc ) {
	            	$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
					$(doc.document.body).find('h1').css('font-size', '24px');
					$(doc.document.body).find('h1').css('text-align', 'center'); 
				}
	        },
	        {
	            extend: 'copyHtml5',
	        },
	        {
	            extend: 'excelHtml5',
	        },
	        {
	            extend: 'csvHtml5',
	        },
	        {
	            extend: 'pdfHtml5',
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


	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}

	$(document).on('click', '.view-sales-transactions', function(e) {
		let orderno = $(this).data('orderno');
		let totalCategory = $(this).data('totalcategory');

		let totalPrice = 0;
		let totalPriceAdtlFee = 0;
		let totalFreebiesPrice = 0;
		let totalUnitDiscount = 0;
		$('#sales_order_no').html(orderno);
		if (orderno.length > 0) {
			$.ajax({
				url: 'getSODetails',
				type: 'GET',
				dataType: 'JSON',
				data: { sales_order_no : orderno } ,
				success: function (response) {
					if (response.transactions.length > 0) {
						$('#transactionsTable tbody').html('');
						$.each(response.transactions, function(index, val) {
							let price = val.PriceUnit;
							let unitDiscountPriceTotal = price * (val.UnitDiscount / 100);

							// apply discount
							price -= unitDiscountPriceTotal;

							if (val.Freebie == 0) {
								totalPrice += (price * val.Amount);
								totalUnitDiscount += (unitDiscountPriceTotal * val.Amount);
							} else {
								totalFreebiesPrice += (price * val.Amount);
							}
							$('#transactionsTable tbody').append(
									'<tr>\
										<td class="text-center">'+
											val.TransactionID+
										'</td>\
										<td class="text-center">\
											<span class="db-identifier" style="font-style: italic; font-size: 12px;">'+
												val.stockID+
										'</span>\
										</td>\
										<td class="text-center">'+
											val.Amount+
										'</td>\
										<td class="text-center">'+
											val.UnitDiscount+'%\
										</td>\
										<td class="text-center">'+
											moneyFormat(price)+
										'</td>\
										<td class="text-center">'+
											moneyFormat(price * val.Amount)+
										'</td>\
										<td class="text-center">'+
											(val.Freebie == 1 ?
												'<i class="bi bi-check-circle text-success"></i>'
											:
												'<i class="bi bi-x-circle text-danger"></i>'
											)+
										'</td>\
									</tr>'
								);
						});
					}
					if (response.adtlfees.length > 0) {
						$('#adtlfeesTable tbody').html('');
						$.each(response.adtlfees, function(index, val) {
							let price = val.UnitPrice;
							let unitDiscountPriceTotal = price * (val.UnitDiscount / 100);

							// apply discount
							price -= unitDiscountPriceTotal;
							totalPriceAdtlFee += (price * val.Qty);
							totalUnitDiscount += (unitDiscountPriceTotal * val.Qty);
							$('#adtlfeesTable tbody').append(
									'<tr>\
										<td class="text-center">'+
											val.Description+
										'</td>\
										</td>\
										<td class="text-center">'+
											val.Qty+
										'</td>\
										<td class="text-center">'+
											val.UnitDiscount+'%\
										</td>\
										<td class="text-center">'+
											moneyFormat(price)+
										'</td>\
										<td class="text-center">'+
											moneyFormat(price * val.Qty)+
										'</td>\
									</tr>'
								);
						});
					}
					$('#totalpriceundiscounted').html(moneyFormat(totalPrice + totalPriceAdtlFee));
					$('#totalpricediscounted').html(moneyFormat((totalPrice + totalPriceAdtlFee) - (totalUnitDiscount + (totalPrice * (totalCategory / 100)))));
					$('#totalfreebieprice').html(moneyFormat(totalFreebiesPrice));

					$('#btn-viewSO').attr('href', '<?=base_url()?>admin/view_sales_order?orderNo='+ orderno);
					$('#SalesOrderViewModal').modal('toggle');
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
