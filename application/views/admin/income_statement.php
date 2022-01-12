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

// foreach ($trialAccounts as $type => $accounts) {
// 	echo "<hr><br>".$type."<hr><br>";
// 	foreach ($accounts as $key => $val) {
// 		print_r($val);
// 		echo "<br>";
// 	}
// }

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
						<h3>Income Statement
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
							<?php
							// $sales = $trialAccounts[0][array_search('Sales', array_column($trialAccounts[0], 'name'))];
							// $purchases = $trialAccounts[3][array_search('Purchases', array_column($trialAccounts[3], 'name'))];



							// $costOfSales = ($inventoryBeginning + ($purchases['debitTotal'] - $purchases['creditTotal'])) - $inventoryEnd;

							// $grossProfit = ($sales['creditTotal'] - $sales['debitTotal']) + $costOfSales;
							// $totalOE = 0;
							?>
							<tr>
								<td>
									<?=$sales['name']?>
								</td>
								<td>
									<?=$sales['creditTotal'] - $sales['debitTotal']?>
								</td>
							</tr>
							<tr>
								<td>
									Cost of Sales (BI=<?=""//$inventoryBeginning?> + P=<?=""//($purchases['debitTotal'] - $purchases['creditTotal'])?> - EI=<?=""//$inventoryEnd?>)
								</td>
								<td>
									<?=""//$costOfSales?>
								</td>
							</tr>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">GROSS PROFIT</td>
								<td id="totalGrossProfit">0.00</td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="font-weight: bold; color: #a7852d;" colspan="3">OPERATING EXPENSES</td>
							</tr>

							<tr class="add-operating_expense-row">
								<td><i class="bi bi-plus" colspan="2"></i> Add/Remove Operating Expenses Accounts</td>
							</tr>

							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL OPERATING EXPENSES</td>
								<td id="totalOperatingExpenses">0.00</td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<?php
							// $netIncome = $grossProfit - $totalOE;
							?>
							<tr>
								<td>NET PRE-OPERATING INCOME</td>
								<td id="totalNetPreOperatingIncome">0.00</td>
							</tr>
							<tr>
								<td>OTHER COMPREHENSIVE INCOME</td>
								<td>
									<input id="totalOtherComprehensiveIncome" type="number" step="0.000001" min="0" value="0">
								</td>
							</tr>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL COMPREHENSIVE INCOME</td>
								<td id="totalComprehensiveIncome">0.00</td>
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
										<tr class="add-oe-account-row" data-id="<?=$row['ID']?>" data-name="<?=$row['Name']?>" data-type="<?=$accountTypes[$row['Type']]?>">
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
					<hr class="my-3">
					<div class="col-sm-12">
						<h3>OPERATING EXPENSES</h3>
					</div>
					<div class="col-sm-12 table-responsive mb-3">
						<table id="operatingExpensesTable" class="standard-table table">
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
	$('.add-operating_expense-row').on('click', function() {
		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();
		$('#AddAccountModal').modal('toggle');
	});

	function getAccountTransactionDetails(from,to,account_id,account_name) {
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
				$('.add-operating_expense-row').before($('<tr>').attr({ class: 'operating_expense_row oe_row_' + account_id })
					.append($('<td>').text(account_name))
					.append($('<td>').attr({ class: 'total' }) 
						.text(debitTotal.toFixed(2)))
				);
				totalOE();
				totalNPOI();
				totalCI();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}

	function totalOE() { // OPERATING EXPENSES
		let totOE = 0;
		$.each($('.operating_expense_row'), function(i, val) {
			totOE += parseFloat($(this).find('.total').text());
		});
		$('#totalOperatingExpenses').text(totOE.toFixed(2));
	}
	function totalNPOI() { // NET PRE-OPERATING INCOME
		let totGP = parseFloat($('#totalGrossProfit').text()).toFixed(2);
		let totOE = parseFloat($('#totalOperatingExpenses').text()).toFixed(2);
		let totNPOI = parseFloat(totGP) - parseFloat(totOE);
		$('#totalNetPreOperatingIncome').text(parseFloat(totNPOI).toFixed(2));
	}
	function totalCI() { // COMPREHENSIVE INCOME
		let totNPOI = parseFloat($('#totalNetPreOperatingIncome').text()).toFixed(2);
		let totOCI = parseFloat($('#totalOtherComprehensiveIncome').val()).toFixed(2);
		let totCI = parseFloat(totNPOI) - parseFloat(totOCI);
		$('#totalComprehensiveIncome').text(parseFloat(totCI).toFixed(2));
	}
	
	$(document).on('click', '.add-oe-account-row', function() {
		if ($('.oe_row_' + $(this).data('id')).length < 1) {
			getAccountTransactionDetails('<?=$date_from?>', '<?=$date_to?>', $(this).data('id'), $(this).data('name'));

			$('#operatingExpensesTable').append($('<tr>').attr({ class: 'operating_expense_accounts_row oe_accounts_row_' + $(this).data('id') })
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<i>').attr({ class: 'text-center' })
						.text('#' + $(this).data('id'))))
				.append($('<td>').attr({ class: 'text-center' })
					.text($(this).data('name') + ' (' + $(this).data('type') + ')'))
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<button>').attr({
						type: 'button',
						class: 'btn remove-oe-account-row'
					}).data('id', $(this).data('id'))
						.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
			);
		}
	});
	$(document).on('click', '.remove-oe-account-row', function() {
		$('.oe_row_' + $(this).data('id')).remove();
		$('.oe_accounts_row_' + $(this).data('id')).remove();
		totalOE();
		totalNPOI();
		totalCI();
	});

	$(document).on('keyup', '#totalOtherComprehensiveIncome', function() {
		totalOE();
		totalNPOI();
		totalCI();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
