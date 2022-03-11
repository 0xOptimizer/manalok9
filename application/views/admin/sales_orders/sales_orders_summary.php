<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

switch ($this->input->get('sortOrders')) {
	case 'rejected':
		$sort = '0';
		break;
	case 'pending':
		$sort = '1';
		break;
	case 'waitingForPayment':
		$sort = '2';
		break;
	
	default: break;
}
if (isset($sort)) {
	$getSalesOrders = $this->Model_Selects->GetSalesOrders($sort);
	$GetSalesOrderedTransactions = $this->Model_Selects->GetSalesOrderedTransactions($sort);
} else {
	$getSalesOrders = $this->Model_Selects->GetAllSalesOrders();
	$GetSalesOrderedTransactions = $this->Model_Selects->GetAllSalesOrderedTransactions();
}

// exit();
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
					<div class="col-12 col-md-8">
						<h3>Sales Order Summary
							<?php if ($getSalesOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Sales Orders found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-12 col-md-4">
						<form id="sortOrders" action="<?php echo base_url() . 'admin/view_sales_summary';?>" method="GET" enctype="multipart/form-data">
							<select id="sortSelect" name="sortOrders" class="form-control">
								<option selected>ALL</option>
								<option value="pending">PENDING</option>
								<option value="waitingForPayment">WAITING FOR PAYMENT</option>
								<option value="rejected">REJECTED</option>
							</select>
						</form>
					</div>
					<b>dd/mm/yyyy - <button type="button" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button></b>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="ordersTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">DATE</th>
							<th class="text-center">SALES ORDER #</th>
							<th class="text-center">AMOUNT</th>
							<th class="text-center">CLIENT'S NAME (BILLED)</th>
							<th class="text-center">ADDRESS</th>
							<?php
							$transactionProductCodes = array_unique(array_column($GetSalesOrderedTransactions->result_array(), 'Code'));
							foreach ($transactionProductCodes as $key => $val): ?>
								<th class="text-center"><?=$val?></th>
							<?php endforeach; ?>
						</thead>
						<tbody>
							<?php
							if ($getSalesOrders->num_rows() > 0):
								foreach ($getSalesOrders->result_array() as $row): ?>
									<tr>
										<?php
										$soTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo'])->result_array();
										$totalAmount = array_sum(array_column($soTransactions, 'Amount'));
										?>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<?=$row['OrderNo']?>
										</td>
										<td class="text-center">
											<?=$totalAmount?>
										</td>
										<td class="text-center">
											<?=$this->Model_Selects->GetClientByNo($row['BillToClientNo'])->row_array()['Name']?>
										</td>
										<td class="text-center">
											<?=$this->Model_Selects->GetClientByNo($row['ShipToClientNo'])->row_array()['Address']?>
										</td>
										<?php
										foreach ($transactionProductCodes as $key => $val):
											$qty = 0;
											foreach ($soTransactions as $row) {
												if ($val == $row['Code']) {
													$qty += $row['Amount'];
												}
											} ?>
											<td class="text-center">
												<?=$qty?>
											</td>
										<?php endforeach; ?>
									</tr>
							<?php endforeach;
							else: ?>
								<tr>
									<td class="text-center">
									</td>
									<td class="text-center">
									</td>
									<td class="text-center">
										<label class="input-label">
											[ EMPTY ]
										</label>
									</td>
									<td class="text-center">
									</td>
									<td class="text-center">
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
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>
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
	<?php if ($this->input->get('sortOrders')): ?>
		$('#sortSelect').find("[value='" + "<?=$this->input->get('sortOrders');?>" + "']").attr('selected', '');; 
	<?php endif; ?>

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
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4 ]
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
	                columns: [ 0, 1, 2, 3, 4 ]
	            }
	        },
	        {
	            extend: 'excelHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4 ]
	            }
	        },
	        {
	            extend: 'csvHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4 ]
	            }
	        },
	        {
	            extend: 'pdfHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4 ]
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
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
