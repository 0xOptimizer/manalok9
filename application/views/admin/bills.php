<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch bills
$getBills = $this->Model_Selects->GetBills();

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
						<h3>Bills
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> <?=$getBills->num_rows();?> TOTAL
							</span>
							<?php if ($getBills->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Bills found.
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
					<table id="billsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">PO #</th>
							<th class="text-center">ORDER DATE</th>
							<th class="text-center">BILL DATE</th>
							<th class="text-center">VENDOR NAME</th>
							<th class="text-center">AMOUNT PAID</th>
							<th class="text-center">AMOUNT DUE</th>
							<th class="text-center">MODE OF PAYMENT</th>
						</thead>
						<tbody>
							<?php if ($getBills->num_rows() > 0):
								foreach ($getBills->result_array() as $row): ?>
									<tr data-urlredirect="<?=base_url() . 'admin/view_purchase_order?orderNo=' . $row['OrderNo'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['OrderNo']?>
										</td>
										<?php
										$po_details = $this->Model_Selects->GetPurchaseOrderByNo($row['OrderNo'])->row_array();
										$v_details = $this->Model_Selects->GetVendorByNo($po_details['VendorNo'])->row_array();
										$total_bill_amount = $this->Model_Selects->GetTotalBillsByPONo($row['OrderNo'])->row_array()['Amount'];
										?>
										<td class="text-center">
											<?=$po_details['Date']?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<?=$v_details['Name']?>
										</td>
										<td class="text-center">
											<?=number_format($total_bill_amount, 2)?>
										</td>
										<td class="text-center">
											<?php
											$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo']);
											if ($orderTransactions->num_rows() > 0) {
												$transactionsPriceTotal = 0;
												foreach ($orderTransactions->result_array() as $transaction) {
													$transactionsPriceTotal += $transaction['Amount'] * $transaction['PriceUnit'];
												}
												echo number_format($transactionsPriceTotal - $total_bill_amount, 2);
											}
											?>
										</td>
										<td class="text-center">
											<?=$row['ModeOfPayment']?>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>

							<!-- <tr class="tr_bill_modal">
								<td>
									<span class="db-identifier" style="font-style: italic; font-size: 12px;">1</span>
								</td>
								<td class="poNo">
									PO-000001
								</td>
								<td class="oDate">
									2021-10-20
								</td>
								<td class="vName">
									John Doe
								</td>
								<td class="aDue">
									22,000.00
								</td>
								<td class="balance">
									18,000.00
								</td>
							</tr>
							<tr class="tr_bill_modal">
								<td>
									<span class="db-identifier" style="font-style: italic; font-size: 12px;">2</span>
								</td>
								<td class="poNo">
									PO-000002
								</td>
								<td class="oDate">
									2021-10-21
								</td>
								<td class="vName">
									Jane Doe
								</td>
								<td class="aDue">
									15,000.00
								</td>
								<td class="balance">
									2,000.00
								</td>
							</tr> -->
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="PurchaseOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> <span class="m_orderno"></span></h4>
			</div>
			<div class="modal-body">
				<div class="row text-center d-flex flex-wrap justify-content-center">
					<div class="col-12 col-md-6">
						<h6>ORDER DATE</h6>
						<label class="m_orderdate"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>VENDOR NAME</h6>
						<label class="m_vendorname"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>AMOUNT PAID</h6>
						<label class="m_amountpaid"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>AMOUNT DUE</h6>
						<label class="m_amountdue"></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-bills').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#billsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#billsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	// $(document).on('click', '.tr_bill_modal', function() {
	// 	$('.m_orderno').text($(this).children('.poNo').html());
	// 	$('.m_orderdate').text($(this).children('.oDate').html());
	// 	$('.m_vendorname').text($(this).children('.vName').html());
	// 	$('.m_amountpaid').text($(this).children('.aPaid').html());
	// 	$('.m_amountdue').text($(this).children('.aDue').html());

	// 	$('#PurchaseOrderModal').modal('toggle');
	// });
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
