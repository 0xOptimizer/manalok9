<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch vendors
// $getVendors = $this->Model_Selects->GetVendors();

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
								<i class="bi bi-cash"></i> 2 TOTAL
							</span>
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
							<th>ID</th>
							<th>SO #</th>
							<th>ORDER DATE</th>
							<th>CLIENT NAME</th>
							<th>AMOUNT DUE</th>
							<th>PAYMENT DATE</th>
							<th>PARTIAL / FULL</th>
							<th>BALANCE</th>
							<th>MODE OF PAYMENT</th>
						</thead>
						<tbody>
							<tr class="tr_invoice_modal">
								<td>
									<span class="db-identifier" style="font-style: italic; font-size: 12px;">1</span>
								</td>
								<td class="soNo">
									SO-000001
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
								<td class="pDate">
									2021-11-15
								</td>
								<td class="partialFull">
									FULL
								</td>
								<td class="balance">
									18,000.00
								</td>
								<td class="modePayment">
									CASH
								</td>
							</tr>
							<tr class="tr_invoice_modal">
								<td>
									<span class="db-identifier" style="font-style: italic; font-size: 12px;">2</span>
								</td>
								<td class="soNo">
									SO-000002
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
								<td class="pDate">
									2021-11-25
								</td>
								<td class="partialFull">
									PARTIAL
								</td>
								<td class="balance">
									2,000.00
								</td>
								<td class="modePayment">
									CARD
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="modal fade" id="SalesOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
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
						<h6>AMOUNT DUE</h6>
						<label class="m_amountdue"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>PAYMENT DATE</h6>
						<label class="m_paymentdate"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>PARTIAL / FULL</h6>
						<label class="m_partialfull"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>BALANCE</h6>
						<label class="m_balance"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>MODE OF PAYMENT</h6>
						<label class="m_modepayment"></label>
					</div>
				</div>
			</div>
		</div>
	</div>
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

	$(document).on('click', '.tr_invoice_modal', function() {
		$('.m_orderno').text($(this).children('.soNo').html());
		$('.m_orderdate').text($(this).children('.oDate').html());
		$('.m_vendorname').text($(this).children('.vName').html());
		$('.m_amountdue').text($(this).children('.aDue').html());
		$('.m_paymentdate').text($(this).children('.pDate').html());
		$('.m_partialfull').text($(this).children('.partialFull').html());
		$('.m_balance').text($(this).children('.balance').html());
		$('.m_modepayment').text($(this).children('.modePayment').html());

		$('#SalesOrderModal').modal('toggle');
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
