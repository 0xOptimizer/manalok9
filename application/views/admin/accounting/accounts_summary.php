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

// SORTING BY ACC TYPE
if ($this->input->get('a_sort') != NULL && is_numeric($this->input->get('a_sort'))) {
	$accType = $this->input->get('a_sort');
} else {
	$accType = '';
}

$getAccountsTotalRange = $this->Model_Selects->GetAccountsTotalRange($from,$to,$accType);

// if ($getAccountsTotalRange->num_rows() > 0) {

// 	foreach ($getAccountsTotalRange->result_array() as $key => $val) {
// 		print_r($val); echo '<br>';
// 	}
// }

// exit();
$getAccounts = $this->Model_Selects->GetAccountSelection();

$account_types = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITY');
$accounts = array(
	0 => array(),
	1 => array(),
	2 => array(),
	3 => array(),
	4 => array()
);
foreach ($getAccounts->result_array() as $acc) {
	array_push($accounts[$acc['Type']], $acc);
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
			<a href="<?=base_url() . 'admin/accounts'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO ACCOUNTS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-12">
						<h3><i class="bi bi-receipt"></i> Accounts Summary
							<?php if ($getAccountsTotalRange->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Accounts found.
								</span>
							<?php endif; ?>
							<span class="text-center info-banner-sm">
								<i class="bi bi-exclamation-triangle-fill"></i> <?=strtoupper($rangeText)?>
							</span>
						</h3>
					</div>
					<div class="col-sm-12 col-md-7 pt-4 pb-2">
						<button type="button" class="btn btn-sm-success" onclick="window.location.replace('<?=base_url()?>admin/view_purchase_summary');">
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
					<div class="col-sm-12 col-md-3 pt-4 pb-2" style="margin-top: -15px;">
						<div class="form-group">
							<form id="accountTypeSortForm" method="GET">
								<?php if ($from != NULL && $to != NULL): ?>
									<input type="hidden" name="sbdf" value="<?=$from?>">
									<input type="hidden" name="sbdt" value="<?=$to?>">
								<?php endif; ?>
								<input class="sortAccID" type="hidden" name="a_sort" value="0">
							</form>
							<select id="accountTypeSort" class="form-control w-100">
								<option value="" selected>NONE</option>
								<?php foreach ($account_types as $key => $name): ?>
									<option value="<?=$key?>"
										<?php if ($this->input->get('a_sort')==$key) echo 'selected';?>>
										<?=$name?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
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
					<table id="accountsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">DATE</th>
							<th class="text-center">ACCOUNT</th>
							<th class="text-center">DEBIT TOTAL</th>
							<th class="text-center">CREDIT TOTAL</th>
						</thead>
						<tbody>
							<?php
							if ($getAccountsTotalRange->num_rows() > 0):
								foreach ($getAccountsTotalRange->result_array() as $row): 
									$journal = $this->Model_Selects->GetJournalByID($row['JournalID']);
									$date = ($journal->num_rows() > 0 ? $journal->row_array()['Date'] : '');

									$account_name = $this->Model_Selects->GetAccountByID($row['AccountID'])->row_array()['Name'];
									?>
									<tr class="tr_class_modal" data-id="<?=$row['ID']?>">
										<td class="text-center"><?=$date?></td>
										<td class="text-center"><?=$account_name?></td>
										<td class="text-center"><?=number_format($row['totalDebit'], 2)?></td>
										<td class="text-center"><?=number_format($row['totalCredit'], 2)?></td>
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

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>

<script>
$('.sidebar-admin-accounting-accounts').addClass('active');
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
	var table = $('#accountsTable').DataTable( {
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
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});
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



	$('#accountTypeSort').on('change', function() {
		if ($.isNumeric($('.sortAccID').val())) {
			$('.sortAccID').val($(this).find('option:selected').val());
			$('#accountTypeSortForm').submit();
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
