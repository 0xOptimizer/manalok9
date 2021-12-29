<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch invoices
$getInvoices = $this->Model_Selects->GetInvoices();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
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
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-8">
						<h3>Invoices
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> <?=$getInvoices->num_rows();?> TOTAL
							</span>
							<?php if ($getInvoices->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Invoices found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-4 mr-auto pt-4 pb-2" style="margin-top: -15px;">
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
					<table id="invoicesTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">SO #</th>
							<th class="text-center">ORDER DATE</th>
							<th class="text-center">INVOICE DATE</th>
							<th class="text-center">CLIENT NAME</th>
							<th class="text-center">AMOUNT PAID</th>
							<th class="text-center">AMOUNT DUE</th>
							<th class="text-center">MODE OF PAYMENT</th>
						</thead>
						<tbody>
							<?php if ($getInvoices->num_rows() > 0):
								foreach ($getInvoices->result_array() as $row): ?>
									<tr data-urlredirect="<?=base_url() . 'admin/view_sales_order?orderNo=' . $row['OrderNo'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['OrderNo']?>
										</td>
										<?php
										$so_details = $this->Model_Selects->GetSalesOrderByNo($row['OrderNo'])->row_array();
										$client_details = $this->Model_Selects->GetClientByNo($so_details['BillToClientNo'])->row_array();
										$total_invoice_amount = $this->Model_Selects->GetTotalInvoicesBySONo($row['OrderNo'])->row_array()['Amount'];
										?>
										<td class="text-center">
											<?=$so_details['Date']?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<?=$client_details['Name']?>
										</td>
										<td class="text-center">
											<?=number_format($total_invoice_amount, 2)?>
										</td>
										<td class="text-center">
											<?php
											$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo']);
											if ($orderTransactions->num_rows() > 0) {
												$transactionsPriceTotal = 0;
												foreach ($orderTransactions->result_array() as $transaction) {
													$transactionsPriceTotal += $transaction['Amount'] * $transaction['PriceUnit'];
												}
												echo number_format($transactionsPriceTotal - $total_invoice_amount, 2);
											}
											?>
										</td>
										<td class="text-center">
											<?=$row['ModeOfPayment']?>
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

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-invoices').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#invoicesTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#invoicesTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	// $(document).on('click', '.tr_invoice_modal', function() {
	// 	$('.m_orderno').text($(this).children('.soNo').html());
	// 	$('.m_orderdate').text($(this).children('.oDate').html());
	// 	$('.m_vendorname').text($(this).children('.vName').html());
	// 	$('.m_amountdue').text($(this).children('.aDue').html());
	// 	$('.m_paymentdate').text($(this).children('.pDate').html());
	// 	$('.m_partialfull').text($(this).children('.partialFull').html());
	// 	$('.m_balance').text($(this).children('.balance').html());
	// 	$('.m_modepayment').text($(this).children('.modePayment').html());

	// 	$('#SalesOrderModal').modal('toggle');
	// });
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
