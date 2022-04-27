<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$date_from = date('M j, Y', strtotime('-1 month'));
$date_to = date('M j, Y');

$date_from_beginning_inventory = date('M j, Y', strtotime('-1 month'));
$date_to_beginning_inventory = date('M j, Y', strtotime('-1 month +1 day'));

if ($this->input->get('dfr')) {
	$date_from = $this->input->get('dfr');
	$date_from = date('M j, Y', strtotime($date_from));
}
if ($this->input->get('dto')) {
	$date_to = $this->input->get('dto');
	$date_to = date('M j, Y', strtotime($date_to));
}
if ($this->input->get('dfr_bi')) {
	$date_from_beginning_inventory = $this->input->get('dfr_bi');
	$date_from_beginning_inventory = date('M j, Y', strtotime($date_from_beginning_inventory));
}
if ($this->input->get('dto_bi')) {
	$date_to_beginning_inventory = $this->input->get('dto_bi');
	$date_to_beginning_inventory = date('M j, Y', strtotime($date_to_beginning_inventory));
}


// Fetch
$getJournals = $this->Model_Selects->GetJournalsRange($date_from, $date_to);
$getAccounts = $this->Model_Selects->GetAccountSelection();
$getTransactions = $this->Model_Selects->GetTransactionsRange($date_from, $date_to);

$accountTypes = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITIES');


if ($getAccounts->num_rows() > 0) {
	foreach ($getAccounts->result_array() as $row) {
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

if ($getTransactions->num_rows() > 0) { // use sql for faster exection
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
// foreach ($trialAccounts as $row) {
// 	echo "<br><br>";
// 	print_r($row);
// }
// print_r(''); exit();



$previous_ending_inventory_total = $this->Model_Selects->GetStockHistoryTotalPriceBefore($date_from)['ending_inventory_total_price'];
$beginning_inventory_restocks_total = $this->Model_Selects->GetStockHistoryRestockedTotalPriceRange($date_from_beginning_inventory, $date_to_beginning_inventory)['restocked_total_price'];
// BEGINNING INVENTORY
// $beginning_inventory_total = $previous_ending_inventory_total + $beginning_inventory_restocks_total;
$beginning_inventory_total = $beginning_inventory_restocks_total;

// PURCHASES -restocks // TOTAL ACCOUNTING PERIOD RESTOCKS AND SUBTRACT BEGINING INVENTORY RESTOCKS
$accounting_inventory_restocks_total = $this->Model_Selects->GetStockHistoryRestockedTotalPriceRange($date_from, $date_to)['restocked_total_price'] - $beginning_inventory_restocks_total;

// ENDING INVENTORY
// $accounting_ending_inventory_total = $this->Model_Selects->GetStockHistoryTotalPriceRange($date_from, $date_to)['ending_inventory_total_price'];


// SALES - releases
$accounting_inventory_releases_total = $this->Model_Selects->GetStockHistoryReleasedTotalPriceRange($date_from, $date_to)['released_total_price'];


$beginning_inventory_total = ($beginning_inventory_total != '' ? $beginning_inventory_total : 0);
$accounting_inventory_restocks_total = ($accounting_inventory_restocks_total != '' ? $accounting_inventory_restocks_total : 0);
$previous_ending_inventory_total = ($previous_ending_inventory_total != '' ? $previous_ending_inventory_total : 0);

?>
<style>
	.toggle_report_section {
		cursor: pointer;
	}
	.toggle_report_section.toggle_report_active, .report_section_container {
		background-color: rgba(80, 80, 80, 0.35);
		border-bottom: 2px solid #a7852d;
	}
	.toggle_report_section:hover {
		background-color: rgba(100, 100, 100, 0.35);
	}
	.button-default {
		display: none !important;
	}
</style>
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
					<div class="col-4 pt-2 px-4 toggle_report_section toggle_report_active" id="toggle_section_income_statement">
						<h3>Income Statement</h3>
					</div>
					<div class="col-4 pt-2 px-4 toggle_report_section" id="toggle_section_balance_sheet">
						<h3>Balance Sheet</h3>
					</div>
					<div class="col-4 pt-2 px-4 toggle_report_section" id="toggle_section_cash_flow">
						<h3>Cash Flow</h3>
					</div>
				</div>
			</div>

			<section class="section mb-3 report_section" id="section_income_statement">
				<div class="row">
					<div class="col-12 text-end">
						<button class="btn btn-success csv-export"><i class="bi bi-file-earmark-excel-fill"></i> EXPORT CSV</button>
					</div>
				</div>
				<div class="table-responsive">
					<table id="table_income_statement" class="standard-table table">
						<tbody>
							<tr>
								<td>
									Sales 
									<button type="button" class="sales-btn btn btn-sm-success export-exclude" style="font-size: 12px;">
										<i class="bi bi-eye-fill"></i> SHOW
									</button>
								</td>
								<td class="totalSales" data-totalsales="0">0.00</td>
							</tr>
							<tr>
								<td>
									Cost of Sales 
									<button type="button" class="costofsales-btn btn btn-sm-success export-exclude" style="font-size: 12px;">
										<i class="bi bi-eye-fill"></i> SHOW
									</button>
								</td>
								<td class="totalCostOfSales">
									0.00
								</td>
							</tr>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">GROSS PROFIT</td>
								<td id="totalGrossProfit" data-totalgrossprofit="0">0.00</td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="font-weight: bold; color: #a7852d;" colspan="3">OPERATING EXPENSES</td>
							</tr>

							<tr class="add-accounts-row add-operating_expense-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Operating Expenses Accounts</td>
							</tr>

							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL OPERATING EXPENSES</td>
								<td id="totalOperatingExpenses" data-totaloperatingexpenses="0">0.00</td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>NET PRE-OPERATING INCOME</td>
								<td id="totalNetPreOperatingIncome" data-totalnetpreoperatingincome="0">0.00</td>
							</tr>
							<tr>
								<td>OTHER COMPREHENSIVE INCOME</td>
								<td>
									<input id="totalOtherComprehensiveIncome" type="number" class="input" step="0.000001" min="0" value="0">
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

			<section class="section mb-3 d-none report_section" id="section_balance_sheet">
				<div class="row">
					<div class="col-12 text-end">
						<button class="btn btn-success csv-export"><i class="bi bi-file-earmark-excel-fill"></i> EXPORT CSV</button>
					</div>
				</div>
				<div class="table-responsive">
					<table id="table_balance_sheet" class="standard-table table">
						<tbody>
							<tr style="border-bottom-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;" colspan="2">ASSETS</td>
							</tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Current Assets</td>
							</tr>
							<tr>
								<td>INVENTORIES</td>
								<td class="inventories" data-inventories="0">0.00</td>
							</tr>
							<tr class="add-accounts-row add-current_assets-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Current Assets Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CURRENT ASSETS</td>
								<td id="totalCurrentAssets" data-totalcurrentassets="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Noncurrent Assets</td>
							</tr>
							<tr class="add-accounts-row add-noncurrent_assets-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Noncurrent Assets Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL NONCURRENT ASSETS</td>
								<td id="totalNoncurrentAssets" data-totalnoncurrentassets="0">0.00</td>
							</tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL ASSETS</td>
								<td id="totalAssets" data-totalassets="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>


							<tr style="border-bottom-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;" colspan="2">LIABILITIES AND EQUITY</td>
							</tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Current Liabilities</td>
							</tr>
							<tr class="add-accounts-row add-current_liabilities-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Current Liabilities Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CURRENT LIABILITIES</td>
								<td id="totalCurrentLiabilities" data-totalcurrentliabilities="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Noncurrent Liabilities</td>
							</tr>
							<tr class="add-accounts-row add-noncurrent_liabilities-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Noncurrent Liabilities Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL NONCURRENT LIABILITIES</td>
								<td id="totalNoncurrentLiabilities" data-totalnoncurrentliabilities="0">0.00</td>
							</tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL LIABILITIES</td>
								<td id="totalLiabilities" data-totalliabilities="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Equities</td>
							</tr>
							<tr>
								<td>NET INCOME</td>
								<td class="netIncome" data-netincome="0">0.00</td>
							</tr>
							<tr class="add-accounts-row add-equities-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Equity Accounts</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">TOTAL LIABILITIES AND EQUITY</td>
								<td id="totalLiabilitiesEquity" data-totalliabilitiesequity="0">0.00</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>

			<section class="section mb-3 d-none report_section" id="section_cash_flow">
				<div class="row">
					<div class="col-12 text-end">
						<button class="btn btn-success csv-export"><i class="bi bi-file-earmark-excel-fill"></i> EXPORT CSV</button>
					</div>
				</div>
				<div class="table-responsive">
					<table id="table_cash_flow" class="standard-table table">
						<tbody>
							<tr>
								<td>CASH BEGINNING</td>
								<td>
									<input id="totalCashBeginning" type="number" class="input" step="0.000001" min="0" value="0">
								</td>
							</tr>
							<tr>
								<td>NET INCOME</td>
								<td class="netIncome" data-netincome="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Flow - Operating</td>
							</tr>
							<tr class="add-accounts-row add-cashflowoperating-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH FLOW - OPERATING</td>
								<td id="totalCashFlowOperating" data-totalcashflowoperating="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Outflow - Investing</td>
							</tr>
							<tr class="add-accounts-row add-cashoutflowinvesting-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH OUTFLOW - INVESTING</td>
								<td id="totalCashOutflowInvesting" data-totalcashoutflowinvesting="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>

							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Outflow - Financing</td>
							</tr>
							<tr class="add-accounts-row add-cashoutflowfinancing-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH OUTFLOW - FINANCING</td>
								<td id="totalCashOutflowFinancing" data-totalcashoutflowfinancing="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>


							<tr style="border-width: 2px 0; border-style: double; border-color: #a7852d;">
								<td style="color: #a7852d; font-weight: bold;">INCREASE/(DECREASE) IN CASH FLOW</td>
								<td id="totalCashFlowIncrease" data-totalcashflowincrease="0">0.00</td>
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
				<!-- INCOME STATEMENT -->
					<div id="container_sls_sales" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>SALES EXPENSES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="slsSalesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_cos_expenses" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>COST OF SALES EXPENSES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cosExpensesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_operating_expenses" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>OPERATING EXPENSES</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="operatingExpensesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				<!-- BALANCE SHEET -->
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
									<th class="text-center">TOTAL</th>
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
									<th class="text-center">TOTAL</th>
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
									<th class="text-center">TOTAL</th>
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
									<th class="text-center">TOTAL</th>
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
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>

					<div id="container_cashflowoperating" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASH FLOW OPERATING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashflowoperatingTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_cashoutflowinvesting" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASHOUT FLOW INVESTING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashoutflowinvestingTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
									<th></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id="container_cashoutflowfinancing" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASHOUT FLOW FINANCING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashoutflowfinancingTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">ID</th>
									<th class="text-center">ACCOUNT</th>
									<th class="text-center">TOTAL</th>
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
<div class="modal fade" id="CostOfSalesModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Cost Of Sales</h4>
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<!-- <div class="col-6 text-end">
						<label>Previous Inventory</label>
					</div>
					<div class="col-3 text-end">
						<?=number_format($previous_ending_inventory_total, 2)?>
					</div> -->
					<div class="col-6 text-end">
						<label>Initial Restocks</label>
					</div>
					<div class="col-3 text-end">
						<?=number_format($beginning_inventory_restocks_total, 2)?>
					</div>
					<div class="col-6">
						<h6 class="text-end">Beginning Inventory</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosBeginningInventory" data-cosbeginninginventory="<?=(!empty($beginning_inventory_total) ? $beginning_inventory_total : 0)?>"><?=number_format($beginning_inventory_total, 2)?></h6>
					</div>
				</div>
				<div class="row text-center mb-3">
					<div class="col-6 text-end">
						<label>Restocks</label>
					</div>
					<div class="col-3 text-end cosRestocks" data-cosrestocks="<?=(!empty($accounting_inventory_restocks_total) ? $accounting_inventory_restocks_total : 0)?>">
						<?=number_format($accounting_inventory_restocks_total, 2)?>
					</div>
					<div class="col-6 text-end">
						<label>Expenses</label>
					</div>
					<div class="col-3 text-end cosExpenses" data-cosexpenses="0">
						0.00
					</div>
					<div class="col-3">
						<button type="button" class="cosexpenses-btn btn btn-sm-success" style="font-size: 12px;">
							<i class="bi bi-cash"></i> EXPENSES
						</button>
					</div>
					<div class="col-6">
						<h6 class="text-end">ADD: Purchases</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosPurchases" data-cospurchases="<?=(!empty($accounting_inventory_restocks_total) ? $accounting_inventory_restocks_total : 0)?>"><?=number_format($accounting_inventory_restocks_total, 2)?></h6>
					</div>
				</div>
				<div class="row text-center mb-2">
					<div class="col-6">
						<h6 class="text-end">LESS: Inventory End</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosEndInventory" data-cosendinventory="<?=(!empty($previous_ending_inventory_total) ? $previous_ending_inventory_total : 0)?>"><?=number_format($previous_ending_inventory_total, 2)?></h6>
					</div>
				</div>
				<hr class="my-1">
				<div class="row text-center my-2">
					<div class="col-6">
						<h6 class="text-end">COST OF SALES:</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end totalCostOfSales" data-totalcostofsales="0">0.00</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="SalesModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Sales</h4>
			</div>
			<div class="modal-body">
				<div class="row text-center mb-3">
					<div class="col-6 text-end">
						<label>Releases</label>
					</div>
					<div class="col-3 text-end slsReleases" data-slsreleases="<?=(!empty($accounting_inventory_releases_total) ? $accounting_inventory_releases_total : 0)?>">
						<?=number_format($accounting_inventory_releases_total, 2)?>
					</div>
					<div class="col-6 text-end">
						<label>Sales</label>
					</div>
					<div class="col-3 text-end slsSales" data-slssales="0">
						0.00
					</div>
					<div class="col-3">
						<button type="button" class="slssales-btn btn btn-sm-success" style="font-size: 12px;">
							<i class="bi bi-cash"></i> SALES
						</button>
					</div>
					<div class="col-6">
						<h6 class="text-end">SALES:</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end totalSales" data-totalsales="0">0.00</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-accounting-accounts').addClass('active');
$(document).ready(function() {
	var table = $('#accountsTable').DataTable({
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]]
    });
	$('#tableAccountsSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});

	$('.toggle_report_section').on('click', function() {
		$('.toggle_report_active').removeClass('toggle_report_active');
		$(this).addClass('toggle_report_active');

		$('.report_section').addClass('d-none');
	});
	$('#toggle_section_income_statement').on('click', function() {
		$('#section_income_statement').toggleClass('d-none');
	});
	$('#toggle_section_balance_sheet').on('click', function() {
		$('#section_balance_sheet').toggleClass('d-none');
	});
	$('#toggle_section_cash_flow').on('click', function() {
		$('#section_cash_flow').toggleClass('d-none');
	});


	$('.add-accounts-row').on('click', function() {
		$('#AddAccountModal').modal('toggle');
		$('.account_container').hide();
	});

// INCOME STATEMENT
	$('.costofsales-btn').on('click', function() {
		$('#CostOfSalesModal').modal('toggle');
	});
	$('.sales-btn').on('click', function() {
		$('#SalesModal').modal('toggle');
	});
	$('.add-operating_expense-row').on('click', function() {
		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();
		$('#container_operating_expenses').show();
		$('#accountsTable').data('account_add', 'operating_expense');
	});

// BALANCE SHEET
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

// COST OF SALES
	$('.cosexpenses-btn').on('click', function() {
		$('#CostOfSalesModal').modal('toggle');
		$('.account_container').hide();

		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();

		$('#container_cos_expenses').show();
		$('#accountsTable').data('account_add', 'cos_expenses');
	});
	$(document).on('hidden.bs.modal', '#CostOfSalesModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'cos_expenses') {
			$('#AddAccountModal').modal('toggle');
		}
	});



// CASH FLOW
	$('.add-cashflowoperating-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashflowoperating').show();
		$('#accountsTable').data('account_add', 'cashflowoperating');
	});
	$('.add-cashoutflowinvesting-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashoutflowinvesting').show();
		$('#accountsTable').data('account_add', 'cashoutflowinvesting');
	});
	$('.add-cashoutflowfinancing-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashoutflowfinancing').show();
		$('#accountsTable').data('account_add', 'cashoutflowfinancing');
	});

// SALES
	$('.slssales-btn').on('click', function() {
		$('#SalesModal').modal('toggle');
		$('.account_container').hide();

		$('#tableAccountsSearch').val('REVENUES');
		table.search('REVENUES').draw();

		$('#container_sls_sales').show();
		$('#accountsTable').data('account_add', 'sls_sales');
	});
	$(document).on('hidden.bs.modal', '#SalesModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'sls_sales') {
			$('#AddAccountModal').modal('toggle');
		}
	});


	$(document).on('hidden.bs.modal', '#AddAccountModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'sls_sales') {
			$('#SalesModal').modal('toggle');
			$('#accountsTable').data('account_add', '');
		}
		if ($('#accountsTable').data('account_add') == 'cos_expenses') {
			$('#CostOfSalesModal').modal('toggle');
			$('#accountsTable').data('account_add', '');
		}
	});

	
	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}

	function getAccountTransactionDetails(from,to,account_id,account_name,type,table_id,row_class,row_code) {
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
				let total = 0;
				let debitTotal = 0;
				let creditTotal = 0;
				for (var i = response.length - 1; i >= 0; i--) {
					debitTotal += parseFloat(response[i].Debit);
					debitTotal -= parseFloat(response[i].Credit);

					creditTotal += parseFloat(response[i].Credit);
					creditTotal -= parseFloat(response[i].Debit);
				}

				if (type == 'ASSETS' || type == 'EXPENSES') {
					total = debitTotal;
				} else {
					total = creditTotal;
				}

				$('#' + table_id).append($('<tr>').data('total', total)
					.attr({ class: row_class + '_accounts_row ' + row_code + '_accounts_row_' + account_id })
					.append($('<td>').attr({ class: 'text-center' })
						.append($('<i>').attr({ class: 'text-center' })
							.text('#' + account_id)))
					.append($('<td>').attr({ class: 'text-center' })
						.text(account_name + ' (' + type + ')'))
					.append($('<td>').attr({ class: 'text-center' })
						.text(moneyFormat(total)))
					.append($('<td>').attr({ class: 'text-center' })
						.append($('<button>').attr({
							type: 'button',
							class: 'btn remove-account-row'
						}).data('id', account_id).data('row_code', row_code)
							.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
				);

				if ($('.add-' + row_class + '-row').length > 0) {
					$('.add-' + row_class + '-row').before($('<tr>').attr({ class: row_class + '_row ' + row_code + '_row_' + account_id })
						.append($('<td>').text(account_name))
						.append($('<td>').attr({ class: 'total' }) 
							.text(total.toFixed(2)))
					);
				}
				totalIncomeStatement();
				totalBalanceSheet();
				totalCashFlow();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
				return 0;
			}
		});
	}
	
	$(document).on('click', '.add-account-row', function() {

		let tableID = '';
		let rowClass = '';
		let rowCode = '';

		switch ($('#accountsTable').data('account_add')) {
		// INCOME STATEMENT
			case 'operating_expense':
				tableID = 'operatingExpensesTable';
				rowClass = 'operating_expense';
				rowCode = 'oe';
				break;
			case 'sls_sales':
				tableID = 'slsSalesTable';
				rowClass = 'sls_sales';
				rowCode = 'sls';
				break;
			case 'cos_expenses':
				tableID = 'cosExpensesTable';
				rowClass = 'cos_expenses';
				rowCode = 'cose';
				break;

		// BALANCE SHEET
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

		// BALANCE SHEET
			case 'cashflowoperating':
				tableID = 'cashflowoperatingTable';
				rowClass = 'cashflowoperating';
				rowCode = 'cfo';
				break;
			case 'cashoutflowinvesting':
				tableID = 'cashoutflowinvestingTable';
				rowClass = 'cashoutflowinvesting';
				rowCode = 'coi';
				break;
			case 'cashoutflowfinancing':
				tableID = 'cashoutflowfinancingTable';
				rowClass = 'cashoutflowfinancing';
				rowCode = 'cof';
				break;
		}

		if ($('.' + rowCode + '_accounts_row_' + $(this).data('id')).length < 1) {
			getAccountTransactionDetails(
				'<?=$date_from?>', 
				'<?=$date_to?>', 
				$(this).data('id'), 
				$(this).data('name'), 
				$(this).data('type'), 
				tableID, 
				rowClass, 
				rowCode
			);
		}
	});
	$(document).on('click', '.remove-account-row', function() {
		$('.' + $(this).data('row_code') + '_row_' + $(this).data('id')).remove();
		$('.' + $(this).data('row_code') + '_accounts_row_' + $(this).data('id')).remove();
		totalIncomeStatement();
		totalBalanceSheet();
		totalCashFlow();
	});

	$(document).on('keyup', '#totalOtherComprehensiveIncome, #totalCashBeginning', function() {
		totalIncomeStatement();
		totalBalanceSheet();
		totalCashFlow();
	});
	// $(document).on('keyup', '#totalCashBeginning', function() {
	// 	totalIncomeStatement();
	// 	totalBalanceSheet();
	// 	totalCashFlow();
	// });


// INCOME STATEMENT
	function totalIncomeStatement() {
		totalSLS();

		totalCOSE();
		totalCOS();

		totalGP();

		totalOE();
		totalNPOI();
		totalCI();
	}
	totalIncomeStatement();

	function totalSLS() {
		let totSLSS = 0;
		$.each($('.sls_sales_accounts_row'), function(i, val) {
			totSLSS += parseFloat($(this).data('total'));
		});
		$('.slsSales').text(moneyFormat(totSLSS)).data('slssales', totSLSS);
		let totSales = parseFloat($('.slsReleases').data('slsreleases')) + totSLSS;
		$('.totalSales').text(moneyFormat(totSales)).data('totalsales', totSales);

		console.log(totSLSS);
		console.log(totSales);
	}

	function totalCOSE() {
		let totCOSE = 0;
		$.each($('.cos_expenses_accounts_row'), function(i, val) {
			totCOSE += parseFloat($(this).data('total'));
		});
		$('.cosExpenses').text(moneyFormat(totCOSE)).data('cosexpenses', totCOSE);
		let totPurchases = parseFloat($('.cosRestocks').data('cosrestocks')) + totCOSE;
		$('.cosPurchases').text(moneyFormat(totPurchases)).data('cospurchases', totPurchases);
	}
	function totalCOS() {
		let totCostOfSales = parseFloat($('.cosBeginningInventory').data('cosbeginninginventory')) + 
							 parseFloat($('.cosPurchases').data('cospurchases')) -
							 parseFloat($('.cosEndInventory').data('cosendinventory'));
		$('.totalCostOfSales').text(moneyFormat(totCostOfSales)).data('totalcostofsales', totCostOfSales);
		$('.inventories').text(moneyFormat(totCostOfSales)).data('inventories', totCostOfSales);
	}

	function totalGP() { // GROSS PROFIT
		let totGrossProfit = parseFloat($('.totalSales').data('totalsales')) -
							 parseFloat($('.totalCostOfSales').data('totalcostofsales'));
		$('#totalGrossProfit').text(moneyFormat(totGrossProfit)).data('totalgrossprofit', totGrossProfit);
	}

	function totalOE() { // OPERATING EXPENSES
		let totOE = 0;
		$.each($('.operating_expense_accounts_row'), function(i, val) {
			totOE += parseFloat($(this).data('total'));
		});
		$('#totalOperatingExpenses').text(moneyFormat(totOE)).data('totaloperatingexpenses', totOE);
	}
	function totalNPOI() { // NET PRE-OPERATING INCOME
		let totGP = parseFloat($('#totalGrossProfit').data('totalgrossprofit'));
		let totOE = parseFloat($('#totalOperatingExpenses').data('totaloperatingexpenses'));

		let totNPOI = parseFloat(totGP) - parseFloat(totOE);
		$('#totalNetPreOperatingIncome').text(moneyFormat(totNPOI)).data('totalnetpreoperatingincome', totNPOI);
	}
	function totalCI() { // COMPREHENSIVE INCOME
		let totNPOI = parseFloat($('#totalNetPreOperatingIncome').data('totalnetpreoperatingincome'));
		let totOCI = parseFloat($('#totalOtherComprehensiveIncome').val());

		let totCI = parseFloat(totNPOI) - parseFloat(totOCI);
		$('#totalComprehensiveIncome').text(moneyFormat(totCI)).data('totalcomprehensiveincome', totCI);
		$('.netIncome').text(moneyFormat(totCI)).data('netincome', totCI);
	}

// BALANCE SHEET
	function totalBalanceSheet() {
		totalCA();
		totalNCA();
		totalCL();
		totalNCL();
		totalAssets();
		totalLiabilities();
		totalLiabilitiesEquity();
	}
	totalBalanceSheet();

	function totalCA() { // CURRENT ASSETS
		let totCA = 0;
		totCA += parseFloat($('.inventories').data('inventories'));
		$.each($('.current_assets_accounts_row'), function(i, val) {
			totCA += parseFloat($(this).data('total'));
		});
		$('#totalCurrentAssets').text(moneyFormat(totCA)).data('totalcurrentassets', totCA);
	}
	function totalNCA() { // NONCURRENT ASSETS
		let totNCA = 0;
		$.each($('.noncurrent_assets_accounts_row'), function(i, val) {
			totNCA += parseFloat($(this).data('total'));
		});
		$('#totalNoncurrentAssets').text(moneyFormat(totNCA)).data('totalnoncurrentassets', totNCA);
	}
	function totalCL() { // CURRENT LIABILITIES
		let totCL = 0;
		$.each($('.current_liabilities_accounts_row'), function(i, val) {
			totCL += parseFloat($(this).data('total'));
		});
		$('#totalCurrentLiabilities').text(moneyFormat(totCL)).data('totalcurrentliabilities', totCL);
	}
	function totalNCL() { // NONCURRENT LIABILITIES
		let totNCL = 0;
		$.each($('.noncurrent_liabilities_accounts_row'), function(i, val) {
			totNCL += parseFloat($(this).data('total'));
		});
		$('#totalNoncurrentLiabilities').text(moneyFormat(totNCL)).data('totalnoncurrentliabilities', totNCL);
	}
	function totalAssets() { // ASSETS TOTAL
		let totCA = parseFloat($('#totalCurrentAssets').data('totalcurrentassets'));
		let totNCA = parseFloat($('#totalNoncurrentAssets').data('totalnoncurrentassets'));
		let totAssets = parseFloat(totCA) + parseFloat(totNCA);
		$('#totalAssets').text(moneyFormat(totAssets)).data('totalassets', totAssets);
	}
	function totalLiabilities() { // LIABILITIES TOTAL
		let totCL = parseFloat($('#totalCurrentLiabilities').data('totalcurrentliabilities'));
		let totNCL = parseFloat($('#totalNoncurrentLiabilities').data('totalnoncurrentliabilities'));
		let totLiabilities = parseFloat(totCL) + parseFloat(totNCL);
		$('#totalLiabilities').text(moneyFormat(totLiabilities)).data('totalliabilities', totLiabilities);
	}
	function totalLiabilitiesEquity() { // LIABILITIES AND EQUITY TOTAL
		let totEQ = 0;
		totEQ += parseFloat($('.netIncome').data('netincome'));
		$.each($('.equities_accounts_row'), function(i, val) {
			totEQ += parseFloat($(this).data('total'));
		});

		let totLiabilities = parseFloat($('#totalLiabilities').data('totalliabilities'));
		let totLiabilitiesEquity = parseFloat(totLiabilities) + parseFloat(totEQ);
		$('#totalLiabilitiesEquity').text(moneyFormat(totLiabilitiesEquity)).data('totalliabilitiesequity', totLiabilitiesEquity);
	}

// CASH FLOW
	function totalCashFlow() {
		totalCFO();
		totalCOI();
		totalCOF();

		totalCFI();
	}
	totalCashFlow();

	function totalCFO() {
		let totCFO = 0;
		$.each($('.cashflowoperating_accounts_row'), function(i, val) {
			totCFO += parseFloat($(this).data('total'));
		});
		$('#totalCashFlowOperating').text(moneyFormat(totCFO)).data('totalcashflowoperating', totCFO);
	}
	function totalCOI() {
		let totCOI = 0;
		$.each($('.cashoutflowinvesting_accounts_row'), function(i, val) {
			totCOI += parseFloat($(this).data('total'));
		});
		$('#totalCashOutflowInvesting').text(moneyFormat(totCOI)).data('totalcashoutflowinvesting', totCOI);
	}
	function totalCOF() {
		let totCOF = 0;
		$.each($('.cashoutflowfinancing_accounts_row'), function(i, val) {
			totCOF += parseFloat($(this).data('total'));
		});
		$('#totalCashOutflowFinancing').text(moneyFormat(totCOF)).data('totalcashoutflowfinancing', totCOF);
	}


	function totalCFI() {
		let totCB = parseFloat($('#totalCashBeginning').val());
		let totNI = parseFloat($('.netIncome').data('netincome'));

		let totCFO = parseFloat($('#totalCashFlowOperating').data('totalcashflowoperating'));
		let totCOI = parseFloat($('#totalCashOutflowInvesting').data('totalcashoutflowinvesting'));
		let totCOF = parseFloat($('#totalCashOutflowFinancing').data('totalcashoutflowfinancing'));

		let totCFI = parseFloat(totCB) + parseFloat(totNI) - parseFloat(totCFO) - parseFloat(totCOI) - parseFloat(totCOF);
		$('#totalCashFlowIncrease').text(moneyFormat(totCFI)).data('totalcashflowincrease', totCFI);
	}


// TABLE EXPORTING

	function hideTableExcludes(table) {
		$.each($('#' + table + ' .export-exclude'), function(i, val) {
			$(this).data('html', $(this).html()).html('');
		});
		$.each($('#' + table + ' input'), function(i, val) {
			let tempVal = $('<span>').attr('class', 'tempVal').html(parseFloat($(this).val()));
			$(this).parents('td').append(tempVal);
			$(this).hide();
		});
	}
	function showTableExcludes(table) {
		$('.tempVal').remove();
		$.each($('#' + table + ' .export-exclude'), function(i, val) {
			$(this).html($(this).data('html'));
		});
		$('#' + table + ' input').show();
	}

	var table_income_statement = $('#table_income_statement').tableExport({
		formats: ['csv']
	});
	$('#section_income_statement .csv-export').on('click', function() {
		$.when(hideTableExcludes('table_income_statement')).done(function() {
			$.when(table_income_statement.reset()).done(function() {
				$.when($('#section_income_statement .button-default.csv').click()).done(function() {
					showTableExcludes('table_income_statement');
				});
			});
		});
	});
	var table_balance_sheet = $('#table_balance_sheet').tableExport({
		formats: ['csv']
	});
	$('#section_balance_sheet .csv-export').on('click', function() {
		$.when(hideTableExcludes('table_balance_sheet')).done(function() {
			$.when(table_balance_sheet.reset()).done(function() {
				$.when($('#section_balance_sheet .button-default.csv').click()).done(function() {
					showTableExcludes('table_balance_sheet');
				});
			});
		});
	});
	var table_cash_flow = $('#table_cash_flow').tableExport({
		formats: ['csv']
	});
	$('#section_cash_flow .csv-export').on('click', function() {
		$.when(hideTableExcludes('table_cash_flow')).done(function() {
			$.when(table_cash_flow.reset()).done(function() {
				$.when($('#section_cash_flow .button-default.csv').click()).done(function() {
					showTableExcludes('table_cash_flow');
				});
			});
		});
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/FileSaver.js-1.3.6/FileSaver.js"></script>
<script src="<?=base_url()?>/assets/js/TableExport-5.2.0/dist/js/tableexport.js"></script>
</body>
</html>
