<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch manual transactions
$getManualTransactions = $this->Model_Selects->GetManualTransactions();

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
						<h3><i class="bi bi-pencil"></i> Manual Purchases
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> <?=$getManualTransactions->num_rows();?> TOTAL
							</span>
							<?php if ($getManualTransactions->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Manual Purchases found.
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
					<table id="manualTransactionsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">MANUAL TRANSACTION NO</th>
							<th class="text-center">ITEM NO</th>
							<th class="text-center">DESCRIPTION</th>
							<th class="text-center">QTY</th>
							<th class="text-center">PRICE</th>
							<th class="text-center">TOTAL</th>
							<th class="text-center">DATE</th>
							<th class="text-center">ORDER NO</th>
						</thead>
						<tbody>
							<?php if ($getManualTransactions->num_rows() > 0):
								foreach ($getManualTransactions->result_array() as $row): ?>
									<tr data-urlredirect="<?=base_url() . 'admin/view_purchase_order?orderNo=' . $row['OrderNo'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['ManualTransactionNo']?>
										</td>
										<td class="text-center">
											<?=$row['ItemNo']?>
										</td>
										<td class="text-center">
											<?=$row['Description']?>
										</td>
										<td class="text-center">
											<?=$row['Qty']?>
										</td>
										<td class="text-center">
											<?=number_format($row['UnitCost'], 2)?>
										</td>
										<td class="text-center">
											<?=number_format($row['Qty'] * $row['UnitCost'], 2)?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<span class="text-primary">
												<i class="bi bi-eye"></i> <?=$row['OrderNo']?>
											</span>
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
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-manual-purchases').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#manualTransactionsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#manualTransactionsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
