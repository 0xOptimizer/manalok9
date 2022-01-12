<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$date_from = date('M j, Y', strtotime('-1 month'));
$date_to = date('M j, Y');

if ($this->input->get('dfr')) {
	$date_from = $this->input->get('dfr');
	$date_from = date('M j, Y', strtotime($date_from));
}
if ($this->input->get('dto')) {
	$date_to = $this->input->get('dto');
	$date_to = date('M j, Y', strtotime($date_to));
}

// Fetch
$getJournals = $this->Model_Selects->GetJournalsRange($date_from, $date_to);
$getAccounts = $this->Model_Selects->GetAccountSelection();
$getTransactions = $this->Model_Selects->GetTransactionsRange($date_from, $date_to);

$accountTypes = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITIES');


if ($getAccounts->num_rows() > 0) {
	foreach ($getAccounts->result_array() as $row) {
		// switch ($row['Type']) {
		// 	case '0':
		// 		$type = 0; break; // REVENUE
		// 	case '1':
		// 		$type = 2; break; // ASSETS
		// 	case '2':
		// 		$type = 3; break; // LIABILITIES
		// 	case '3':
		// 		$type = 1; break; // EXPENSES
		// 	case '4':
		// 		$type = 4; break; // EQUITIES
		// }

		$accounts[$row['ID']] = array(
			'name' => $row['Name'],
			'type' => $row['Type'],
			'debitTotal' => 0,
			'creditTotal' => 0
		);
	}
}

$trialAccounts = array(
	0 => array(),
	3 => array(),
	1 => array(),
	2 => array(),
	4 => array(),
);

if ($getTransactions->num_rows() > 0) {
	foreach ($getTransactions->result_array() as $row) {
		$accounts[$row['AccountID']]['debitTotal'] += $row['Debit'];
		$accounts[$row['AccountID']]['creditTotal'] += $row['Credit'];

		// $trialAccounts[$row['AccountID']] = $accounts[$row['AccountID']];

		$aType = $accounts[$row['AccountID']]['type']; // typeid

		$trialAccounts[$aType][$row['AccountID']] = $accounts[$row['AccountID']];

		if (strtolower($accounts[$row['AccountID']]['name']) == 'sales') {
			$sales = &$trialAccounts[$aType][$row['AccountID']];
		} elseif (strtolower($accounts[$row['AccountID']]['name']) == 'purchases') {
			$purchases = &$trialAccounts[$aType][$row['AccountID']];
		}
	}

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
			<div class="page-title mb-4">
				<div class="row">
					<div class="col-12">
						<h3>Balance Sheet
						</h3>
					</div>
					<div class="col-sm-12 pb-2">
						<form action="" method="GET">
							<div class="row justify-content-left">
								<div class="col-4 col-md-3">
									<input class="form-control" type="date" name="dfr" value="<?=date('Y-m-d', strtotime($date_from))?>">
								</div>
								<div class="col-1 col-md-1 text-center">
									TO
								</div>
								<div class="col-4 col-md-3">
									<input class="form-control" type="date" name="dto" value="<?=date('Y-m-d', strtotime($date_to))?>">
								</div>
								<div class="col-1 col-md-3 text-center">
									<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<section class="section mb-3">
				<div class="table-responsive">
					<table id="" class="standard-table table">
						<tbody>
							<tr style="border-bottom-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;" colspan="2">ASSETS</td>
							</tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Current Assets</td>
							</tr>
							<tr class="add-accounts-row add-current_assets-row">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Current Assets Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CURRENT ASSETS</td>
								<td id="totalCurrentAssets">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Noncurrent Assets</td>
							</tr>
							<tr class="add-accounts-row add-noncurrent_assets-row">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Noncurrent Assets Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL NONCURRENT ASSETS</td>
								<td id="totalNoncurrentAssets">0.00</td>
							</tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL ASSETS</td>
								<td id="totalAssets">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>


							<tr style="border-bottom-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;" colspan="2">LIABILITIES AND EQUITY</td>
							</tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Current Liabilities</td>
							</tr>
							<tr class="add-accounts-row add-current_liabilities-row">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Current Liabilities Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CURRENT LIABILITIES</td>
								<td id="totalCurrentLiabilities">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Noncurrent Liabilities</td>
							</tr>
							<tr class="add-accounts-row add-noncurrent_liabilities-row">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Noncurrent Liabilities Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL NONCURRENT LIABILITIES</td>
								<td id="totalNoncurrentLiabilities">0.00</td>
							</tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL LIABILITIES</td>
								<td id="totalLiabilities">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Equities</td>
							</tr>
							<tr class="add-accounts-row add-equities-row">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Equity Accounts</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL LIABILITIES AND EQUITY</td>
								<td id="totalLiabilitiesEquity">0.00</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="modal fade" id="AddAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Add/Remove Accounts</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-md-6 pt-4 pb-2" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableAccountsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="accountsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">NAME</th>
								<th class="text-center">TYPE</th>
							</thead>
							<tbody>
								<?php
								if ($getAccounts->num_rows() > 0):
									foreach ($getAccounts->result_array() as $row): ?>
										<tr class="add-account-row" data-id="<?=$row['ID']?>" data-name="<?=$row['Name']?>" data-type="<?=$accountTypes[$row['Type']]?>">
											<td class="text-center">
												<i>#<?=$row['ID']?></i>
											</td>
											<td class="text-center">
												<?=$row['Name']?>
											</td>
											<td class="text-center">
												<?=$accountTypes[$row['Type']]?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
					<div id="container_current_assets" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CURRENT ASSETS</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="currentAssetsTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_noncurrent_assets" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>NONCURRENT ASSETS</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="noncurrentAssetsTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_current_liabilities" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CURRENT LIABILITIES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="currentLiabilitiesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_noncurrent_liabilities" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>NONCURRENT LIABILITIES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="noncurrentLiabilitiesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_equities" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>EQUITIES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="equitiesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
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
$(document).ready(function() {
	var table = $('#accountsTable').DataTable({
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]]
    });
	$('#tableAccountsSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
	$('.add-accounts-row').on('click', function() {
		$('#AddAccountModal').modal('toggle');
		$('.account_container').hide();
	});

	$('.add-current_assets-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_current_assets').show();
		$('#accountsTable').data('account_add', 'current_assets');
	});
	$('.add-noncurrent_assets-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_noncurrent_assets').show();
		$('#accountsTable').data('account_add', 'noncurrent_assets');
	});
	$('.add-current_liabilities-row').on('click', function() {
		$('#tableAccountsSearch').val('LIABILITIES');
		table.search('LIABILITIES').draw();
		$('#container_current_liabilities').show();
		$('#accountsTable').data('account_add', 'current_liabilities');
	});
	$('.add-noncurrent_liabilities-row').on('click', function() {
		$('#tableAccountsSearch').val('LIABILITIES');
		table.search('LIABILITIES').draw();
		$('#container_noncurrent_liabilities').show();
		$('#accountsTable').data('account_add', 'noncurrent_liabilities');
	});
	$('.add-equities-row').on('click', function() {
		$('#tableAccountsSearch').val('EQUITIES');
		table.search('EQUITIES').draw();
		$('#container_equities').show();
		$('#accountsTable').data('account_add', 'equities');
	});

	function getAccountTransactionDetails(from,to,account_id,account_name,row_class,row_code) {
		$.ajax({
			url: 'getAccountTransactionsRange',
			type: 'GET',
			dataType: 'JSON',
			data: {
				account_id : account_id,
				date_from : from,
				date_to : to
			} ,
			success: function (response) {
				let debitTotal = 0;
				for (var i = response.length - 1; i >= 0; i--) {
					debitTotal += parseFloat(response[i].Debit);
					debitTotal -= parseFloat(response[i].Credit);
				}
				$('.add-' + row_class + '-row').before($('<tr>').attr({ class: row_class + '_row ' + row_code + '_row_' + account_id })
					.append($('<td>').text(account_name))
					.append($('<td>').attr({ class: 'total' }) 
						.text(debitTotal.toFixed(2)))
				);
				totalAll();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}

	function totalAll() {
		totalCA();
		totalNCA();
		totalCL();
		totalNCL();
		totalAssets();
		totalLiabilities();
		totalLiabilitiesEquity();
	}

	function totalCA() { // CURRENT ASSETS
		let totCA = 0;
		$.each($('.current_assets_row'), function(i, val) {
			totCA += parseFloat($(this).find('.total').text());
		});
		$('#totalCurrentAssets').text(totCA.toFixed(2));
	}
	function totalNCA() { // NONCURRENT ASSETS
		let totNCA = 0;
		$.each($('.noncurrent_assets_row'), function(i, val) {
			totNCA += parseFloat($(this).find('.total').text());
		});
		$('#totalNoncurrentAssets').text(totNCA.toFixed(2));
	}
	function totalCL() { // CURRENT LIABILITIES
		let totCL = 0;
		$.each($('.current_liabilities_row'), function(i, val) {
			totCL += parseFloat($(this).find('.total').text());
		});
		$('#totalCurrentLiabilities').text(totCL.toFixed(2));
	}
	function totalNCL() { // NONCURRENT LIABILITIES
		let totNCL = 0;
		$.each($('.noncurrent_liabilities_row'), function(i, val) {
			totNCL += parseFloat($(this).find('.total').text());
		});
		$('#totalNoncurrentLiabilities').text(totNCL.toFixed(2));
	}
	// function totalEQ() { // EQUITIES
	// 	$('#totalEquities').text(totEQ.toFixed(2));
	// }
	function totalAssets() { // ASSETS TOTAL
		let totCA = parseFloat($('#totalCurrentAssets').text()).toFixed(2);
		let totNCA = parseFloat($('#totalNoncurrentAssets').text()).toFixed(2);
		let totAssets = parseFloat(totCA) + parseFloat(totNCA);
		$('#totalAssets').text(parseFloat(totAssets).toFixed(2));
	}
	function totalLiabilities() { // LIABILITIES TOTAL
		let totCL = parseFloat($('#totalCurrentLiabilities').text()).toFixed(2);
		let totNCL = parseFloat($('#totalNoncurrentLiabilities').text()).toFixed(2);
		let totLiabilities = parseFloat(totCL) + parseFloat(totNCL);
		$('#totalLiabilities').text(parseFloat(totLiabilities).toFixed(2));
	}
	function totalLiabilitiesEquity() { // LIABILITIES AND EQUITY TOTAL
		let totEQ = 0;
		$.each($('.equities_row'), function(i, val) {
			totEQ += parseFloat($(this).find('.total').text());
		});

		let totLiabilities = parseFloat($('#totalLiabilities').text()).toFixed(2);
		let totLiabilitiesEquity = parseFloat(totLiabilities) + parseFloat(totEQ);
		$('#totalLiabilitiesEquity').text(parseFloat(totLiabilitiesEquity).toFixed(2));
	}

	$(document).on('click', '.add-account-row', function() {

		let tableID = '';
		let rowClass = '';
		let rowCode = '';

		switch ($('#accountsTable').data('account_add')) {
			case 'current_assets':
				tableID = 'currentAssetsTable';
				rowClass = 'current_assets';
				rowCode = 'ca';
				break;
			case 'noncurrent_assets':
				tableID = 'noncurrentAssetsTable';
				rowClass = 'noncurrent_assets';
				rowCode = 'nca';
				break;
			case 'current_liabilities':
				tableID = 'currentLiabilitiesTable';
				rowClass = 'current_liabilities';
				rowCode = 'cl';
				break;
			case 'noncurrent_liabilities':
				tableID = 'noncurrentLiabilitiesTable';
				rowClass = 'noncurrent_liabilities';
				rowCode = 'ncl';
				break;
			case 'equities':
				tableID = 'equitiesTable';
				rowClass = 'equities';
				rowCode = 'eq';
				break;
		}

		if ($('.' + rowCode + '_accounts_row_' + $(this).data('id')).length < 1) {
			getAccountTransactionDetails(
				'<?=$date_from?>', 
				'<?=$date_to?>', 
				$(this).data('id'), 
				$(this).data('name'), 
				rowClass, 
				rowCode
			);

			$('#' + tableID).append($('<tr>').attr({ class: rowClass + '_accounts_row ' + rowCode + '_accounts_row_' + $(this).data('id') })
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<i>').attr({ class: 'text-center' })
						.text('#' + $(this).data('id'))))
				.append($('<td>').attr({ class: 'text-center' })
					.text($(this).data('name') + ' (' + $(this).data('type') + ')'))
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<button>').attr({
						type: 'button',
						class: 'btn remove-account-row'
					}).data('id', $(this).data('id')).data('row_code', rowCode)
						.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
			);
		}
	});
	$(document).on('click', '.remove-account-row', function() {
		$('.' + $(this).data('row_code') + '_row_' + $(this).data('id')).remove();
		$('.' + $(this).data('row_code') + '_accounts_row_' + $(this).data('id')).remove();
		totalAll();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
