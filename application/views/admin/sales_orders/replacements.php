<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch replacements
$getReplacements = $this->Model_Selects->GetReplacements();

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
						<h3><i class="bi bi-arrow-left-right"></i> Replacements
							<span class="text-center success-banner-sm">
								<i class="bi bi-arrow-left-right"></i> <?=$getReplacements->num_rows();?> TOTAL
							</span>
							<?php if ($getReplacements->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Replacements found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
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
					<table id="replacementsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">REPLACEMENT NO</th>
							<th class="text-center">TRANSACTION NO</th>
							<th class="text-center">QTY</th>
							<th class="text-center">DESCRIPTION</th>
							<th class="text-center">DATE ADDED</th>
							<th class="text-center">ORDER NO</th>
						</thead>
						<tbody>
							<?php if ($getReplacements->num_rows() > 0):
								foreach ($getReplacements->result_array() as $row): ?>
									<tr>
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['ReplacementNo']?>
										</td>
										<td class="text-center">
											<?=$row['TransactionNo']?>
										</td>
										<td class="text-center">
											<?=$row['Quantity']?>
										</td>
										<td class="text-center">
											<?php if ($row['Description'] != NULL): ?>
												<?=$row['Description']?>
											<?php else: ?>
												---
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?=$row['DateAdded']?>
										</td>
										<td class="text-center">
											<?php if ($row['OrderNo'] != NULL): ?>
												<a href="<?=base_url() . 'admin/view_sales_order?orderNo='. $row["OrderNo"]?>">
													<i class="bi bi-eye"></i> <?=$row['OrderNo']?>
												</a>
											<?php else: ?>
												N/A
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

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-replacements').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#replacementsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#replacementsTable').DataTable( {
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
