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


$beginning_inventory = $this->Model_Selects->GetStockHistoryTotalCostBefore($date_from);

$purchases_restocks = $this->Model_Selects->GetStockHistoryRestockedTotalCostRange($date_from, $date_to)['restocked_total_cost'];

$inventory_end = $this->Model_Selects->GetStockHistoryTotalCostRange($date_from, $date_to); // BALANCESHEET-Inventories

$sales_discounts = $this->Model_Selects->GetDiscountsTotalRange($date_from, $date_to);
$sales_returns = $this->Model_Selects->GetReturnsTotalRange($date_from, $date_to);

$sales_freebies = $this->Model_Selects->GetFreebiesTotalRange($date_from, $date_to);

$invoices_total = $this->Model_Selects->GetInvoicesTotalRange($date_from, $date_to);

// print_r($invoices_total); exit();

// print_r($beginning_inventory); echo "<br>";
// print_r($purchases_restocks); echo "<br>";
// print_r($sales_discounts); echo "<br>";

// exit();

$billExpenses = $this->Model_Selects->GetBillsRange($date_from, $date_to);

// print_r($billExpenses->result_array()); exit();



// $getStockHistoryTotalPriceBefore = $this->Model_Selects->GetStockHistoryTotalPriceBefore($date_from);
// if ($getStockHistoryTotalPriceBefore) {
// 	$previous_ending_inventory_total = $GetStockHistoryTotalPriceBefore['ending_inventory_total_price'];
// }

// $beginning_inventory_restocks_total = $this->Model_Selects->GetStockHistoryRestockedTotalPriceRange($date_from_beginning_inventory, $date_to_beginning_inventory)['restocked_total_price'];
// // BEGINNING INVENTORY
// // $beginning_inventory_total = $previous_ending_inventory_total + $beginning_inventory_restocks_total;
// $beginning_inventory_total = $beginning_inventory_restocks_total;

// // PURCHASES -restocks // TOTAL ACCOUNTING PERIOD RESTOCKS AND SUBTRACT BEGINING INVENTORY RESTOCKS
// $accounting_inventory_restocks_total = $this->Model_Selects->GetStockHistoryRestockedTotalPriceRange($date_from, $date_to)['restocked_total_price'] - $beginning_inventory_restocks_total;

// // ENDING INVENTORY
// // $accounting_ending_inventory_total = $this->Model_Selects->GetStockHistoryTotalPriceRange($date_from, $date_to)['ending_inventory_total_price'];


// // SALES - releases
// $accounting_inventory_releases_total = $this->Model_Selects->GetStockHistoryReleasedTotalPriceRange($date_from, $date_to)['released_total_price'];


// $beginning_inventory_total = ($beginning_inventory_total != '' ? $beginning_inventory_total : 0);
// $accounting_inventory_restocks_total = ($accounting_inventory_restocks_total != '' ? $accounting_inventory_restocks_total : 0);
// $previous_ending_inventory_total = ($previous_ending_inventory_total != '' ? $previous_ending_inventory_total : 0);

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
	.add-accounts-row {
		background-color: rgba(100, 100, 100, 0.15);
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
								<td class="inventories" data-inventories="<?=(!empty($inventory_end) ? $inventory_end : 0)?>"><?=number_format($inventory_end, 2)?></h6>
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

							<!-- ================ OPERATING ================ -->
							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Inflow - Operating</td>
							</tr>
							<tr class="add-accounts-row add-cashinflowoperating-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH INFLOW - OPERATING</td>
								<td id="totalCashInflowOperating" data-totalcashinflowoperating="0">0.00</td>
							</tr>
							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Outflow - Operating</td>
							</tr>
							<tr class="add-accounts-row add-cashoutflowoperating-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH OUTFLOW - OPERATING</td>
								<td id="totalCashOutflowOperating" data-totalcashoutflowoperating="0">0.00</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>

							<!-- ================ INVESTING ================ -->
							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Inflow - Investing</td>
							</tr>
							<tr class="add-accounts-row add-cashinflowinvesting-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH INFLOW - INVESTING</td>
								<td id="totalCashInflowInvesting" data-totalcashinflowinvesting="0">0.00</td>
							</tr>
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

							<!-- ================ FINANCING ================ -->
							<tr>
								<td style="color: #a7852d;" colspan="2">Cash Inflow - Financing</td>
							</tr>
							<tr class="add-accounts-row add-cashinflowfinancing-row export-exclude">
								<td colspan="2"><i class="bi bi-plus"></i> Add/Remove Accounts</td>
							</tr>
							<tr class="total-row" style="border-top-width: 2px; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL CASH INFLOW - FINANCING</td>
								<td id="totalCashInflowFinancing" data-totalcashinflowfinancing="0">0.00</td>
							</tr>
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
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Add/Remove Accounts</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				<!-- ACCOUNTS LIST -->
					<div class="col-sm-12 col-md-6 pt-4 pb-2">
						<h4>ACCOUNTS</h4>
					</div>
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
				<!-- BILL EXPENSES LIST -->
					<div class="col-sm-12 col-md-6 pt-4 pb-2">
						<h4>BILL EXPENSES</h4>
					</div>
					<div class="col-sm-12 col-md-6 pt-4 pb-2" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableBillExpensesSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="billExpensesTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">DATE</th>
								<th class="text-center">NAME</th>
								<th class="text-center">TIN # VAT</th>
								<th class="text-center">TIN # NON</th>
								<th class="text-center">ADDRESS</th>
								<th class="text-center">PARTICULARS</th>
								<th class="text-center">AMOUNT</th>
							</thead>
							<tbody>
								<?php
								if ($billExpenses->num_rows() > 0):
									foreach ($billExpenses->result_array() as $row): ?>
										<tr class="add-billexpenses-row" data-id="<?=$row['ID']?>" data-amount="<?=$row['Amount']?>">
											<td class="text-center">
												<?=$row['Date']?>
											</td>
											<td class="text-center name" data-val="<?=$row['Name']?>">
												<?php if ($row['Name'] != NULL): ?>
													<?=$row['Name']?>
												<?php else: ?>
													---
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?php if ($row['TINVAT'] != NULL): ?>
													<?=$row['TINVAT']?>
												<?php else: ?>
													---
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?php if ($row['TINNON'] != NULL): ?>
													<?=$row['TINNON']?>
												<?php else: ?>
													---
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?php if ($row['Address'] != NULL): ?>
													<?=$row['Address']?>
												<?php else: ?>
													---
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?php if ($row['Particulars'] != NULL): ?>
													<?=$row['Particulars']?>
												<?php else: ?>
													---
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?=number_format($row['Amount'], 2)?>
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
							<table id="cosAdtlCostsTable" class="standard-table table">
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

					<div id="container_cashinflowoperating" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASH INFLOW - OPERATING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashinflowoperatingTable" class="standard-table table">
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
					<div id="container_cashoutflowoperating" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASH OUTFLOW - OPERATING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashoutflowoperatingTable" class="standard-table table">
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
					<div id="container_cashinflowinvesting" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASH INFLOW - INVESTING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashinflowinvestingTable" class="standard-table table">
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
							<h3>CASH OUTFLOW - INVESTING</h3>
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
					<div id="container_cashinflowfinancing" class="account_container" style="display: none;">
						<hr class="my-3">
						<div class="col-sm-12">
							<h3>CASH INFLOW - FINANCING</h3>
						</div>
						<div class="col-sm-12 table-responsive mb-3">
							<table id="cashinflowfinancingTable" class="standard-table table">
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
							<h3>CASH OUTFLOW - FINANCING</h3>
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
					<div class="col-6">
						<h6 class="text-end">Beginning Inventory</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosBeginningInventory" data-cosbeginninginventory="<?=(!empty($beginning_inventory) ? $beginning_inventory : 0)?>"><?=number_format($beginning_inventory, 2)?></h6>
					</div>
				</div>
				<div class="row text-center mb-3">
					<div class="col-6 text-end">
						<label>Restocks</label>
					</div>
					<div class="col-3 text-end cosRestocks" data-cosrestocks="<?=(!empty($purchases_restocks) ? $purchases_restocks : 0)?>">
						<?=number_format($purchases_restocks, 2)?>
					</div>
					<div class="col-6 text-end">
						<label>Adtl Costs</label>
					</div>
					<div class="col-3 text-end cosAdtlCosts" data-cosadtlcosts="0">
						0.00
					</div>
					<div class="col-3">
						<button type="button" class="cosadtlcosts-btn btn btn-sm-success" style="font-size: 12px;">
							<i class="bi bi-cash"></i> ADTL COSTS
						</button>
					</div>
					<div class="col-6">
						<h6 class="text-end">Purchases</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosPurchases" data-cospurchases="<?=(!empty($purchases_restocks) ? $purchases_restocks : 0)?>"><?=number_format($purchases_restocks, 2)?></h6>
					</div>
				</div>
				<div class="row text-center mb-2">
					<div class="col-6">
						<h6 class="text-end">Freebies</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosFreebies" data-cosfreebies="<?=(!empty($sales_freebies) ? $sales_freebies : 0)?>"><?=number_format($sales_freebies, 2)?></h6>
					</div>
				</div>
				<div class="row text-center mb-2">
					<div class="col-6">
						<h6 class="text-end">LESS: Inventory End</h6>
					</div>
					<div class="col-3">
						<h6 class="text-end cosEndInventory" data-cosendinventory="<?=(!empty($inventory_end) ? $inventory_end : 0)?>"><?=number_format($inventory_end, 2)?></h6>
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
						<label>Invoices</label>
					</div>
					<div class="col-3 text-end slsInvoices" data-slsinvoices="<?=(!empty($invoices_total) ? $invoices_total : 0)?>">
						<?=number_format($invoices_total, 2)?>
					</div>
					<div class="col-6 text-end">
						<h6>Revenue/Sales</h6>
					</div>
					<div class="col-3 text-end slsSales" data-slssales="0">
						0.00
					</div>
					<div class="col-3">
						<button type="button" class="slssales-btn btn btn-sm-success" style="font-size: 12px;">
							<i class="bi bi-cash"></i> SALES
						</button>
					</div>
				</div>
				<div class="row text-center mb-2">
					<div class="col-6 text-end">
						<h6>LESS: Discounts</h6>
					</div>
					<div class="col-3 text-end slsDiscounts" data-slsdiscounts="<?=(!empty($sales_discounts) ? $sales_discounts : 0)?>">
						<?=number_format($sales_discounts, 2)?>
					</div>
				</div>
				<div class="row text-center mb-2">
					<div class="col-6 text-end">
						<h6>LESS: Returns</h6>
					</div>
					<div class="col-3 text-end slsReturns" data-slsreturns="<?=(!empty($sales_returns) ? $sales_returns : 0)?>">
						<?=number_format($sales_returns, 2)?>
					</div>
				</div>
				<hr class="my-1">
				<div class="row text-center my-2">
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
	var tableBillExpenses = $('#billExpensesTable').DataTable({
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]]
    });
	$('#tableBillExpensesSearch').on('keyup change', function(){
		tableBillExpenses.search($(this).val()).draw();
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
		$('#accountsTable, #billExpensesTable').data('account_add', 'operating_expense');
	});

// BALANCE SHEET
	$('.add-current_assets-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_current_assets').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'current_assets');
	});
	$('.add-noncurrent_assets-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_noncurrent_assets').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'noncurrent_assets');
	});
	$('.add-current_liabilities-row').on('click', function() {
		$('#tableAccountsSearch').val('LIABILITIES');
		table.search('LIABILITIES').draw();
		$('#container_current_liabilities').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'current_liabilities');
	});
	$('.add-noncurrent_liabilities-row').on('click', function() {
		$('#tableAccountsSearch').val('LIABILITIES');
		table.search('LIABILITIES').draw();
		$('#container_noncurrent_liabilities').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'noncurrent_liabilities');
	});
	$('.add-equities-row').on('click', function() {
		$('#tableAccountsSearch').val('EQUITIES');
		table.search('EQUITIES').draw();
		$('#container_equities').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'equities');
	});

// COST OF SALES
	$('.cosadtlcosts-btn').on('click', function() {
		$('#CostOfSalesModal').modal('toggle');
		$('.account_container').hide();

		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();

		$('#container_cos_expenses').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cos_expenses');
	});
	$(document).on('hidden.bs.modal', '#CostOfSalesModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'cos_expenses') {
			$('#AddAccountModal').modal('toggle');
		}
	});



// CASH FLOW
	$('.add-cashinflowoperating-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashinflowoperating').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashinflowoperating');
	});
	$('.add-cashoutflowoperating-row').on('click', function() {
		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();
		$('#container_cashoutflowoperating').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashoutflowoperating');
	});
	$('.add-cashinflowinvesting-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashinflowinvesting').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashinflowinvesting');
	});
	$('.add-cashoutflowinvesting-row').on('click', function() {
		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();
		$('#container_cashoutflowinvesting').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashoutflowinvesting');
	});
	$('.add-cashinflowfinancing-row').on('click', function() {
		$('#tableAccountsSearch').val('ASSETS');
		table.search('ASSETS').draw();
		$('#container_cashinflowfinancing').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashinflowfinancing');
	});
	$('.add-cashoutflowfinancing-row').on('click', function() {
		$('#tableAccountsSearch').val('EXPENSES');
		table.search('EXPENSES').draw();
		$('#container_cashoutflowfinancing').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'cashoutflowfinancing');
	});

// SALES
	$('.slssales-btn').on('click', function() {
		$('#SalesModal').modal('toggle');
		$('.account_container').hide();

		$('#tableAccountsSearch').val('REVENUES');
		table.search('REVENUES').draw();

		$('#container_sls_sales').show();
		$('#accountsTable, #billExpensesTable').data('account_add', 'sls_sales');
	});
	$(document).on('hidden.bs.modal', '#SalesModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'sls_sales') {
			$('#AddAccountModal').modal('toggle');
		}
	});


	$(document).on('hidden.bs.modal', '#AddAccountModal', function (event) {
		if ($('#accountsTable').data('account_add') == 'sls_sales') {
			$('#SalesModal').modal('toggle');
			$('#accountsTable, #billExpensesTable').data('account_add', '');
		}
		if ($('#accountsTable').data('account_add') == 'cos_expenses') {
			$('#CostOfSalesModal').modal('toggle');
			$('#accountsTable, #billExpensesTable').data('account_add', '');
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
				tableID = 'cosAdtlCostsTable';
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
			case 'cashinflowoperating':
				tableID = 'cashinflowoperatingTable';
				rowClass = 'cashinflowoperating';
				rowCode = 'cifo';
				break;
			case 'cashoutflowoperating':
				tableID = 'cashoutflowoperatingTable';
				rowClass = 'cashoutflowoperating';
				rowCode = 'cofo';
				break;

			case 'cashinflowinvesting':
				tableID = 'cashinflowinvestingTable';
				rowClass = 'cashinflowinvesting';
				rowCode = 'cifi';
				break;
			case 'cashoutflowinvesting':
				tableID = 'cashoutflowinvestingTable';
				rowClass = 'cashoutflowinvesting';
				rowCode = 'cofi';
				break;

			case 'cashinflowfinancing':
				tableID = 'cashinflowfinancingTable';
				rowClass = 'cashinflowfinancing';
				rowCode = 'ciff';
				break;
			case 'cashoutflowfinancing':
				tableID = 'cashoutflowfinancingTable';
				rowClass = 'cashoutflowfinancing';
				rowCode = 'coff';
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

		let totInvoices = parseFloat($('.slsInvoices').data('slsinvoices'));
		$('.cosInvoices').text(moneyFormat(totInvoices)).data('cosinvoices', totInvoices);

		$.each($('.sls_sales_accounts_row'), function(i, val) {
			totSLSS += parseFloat($(this).data('total'));
		});
		$.each($('.sls_sales_billexpenses_row'), function(i, val) {
			totSLSS += parseFloat($(this).data('total'));
		});
		$('.slsSales').text(moneyFormat(totSLSS)).data('slssales', totSLSS);
		let totSales = totSLSS
						- (parseFloat($('.slsDiscounts').data('slsdiscounts')) + parseFloat($('.slsReturns').data('slsreturns')))
						+ totInvoices;
		$('.totalSales').text(moneyFormat(totSales)).data('totalsales', totSales);
	}

	function totalCOSE() {
		let totCOSE = 0;
		$.each($('.cos_expenses_accounts_row'), function(i, val) {
			totCOSE += parseFloat($(this).data('total'));
		});
		$.each($('.cos_expenses_billexpenses_row'), function(i, val) {
			totCOSE += parseFloat($(this).data('total'));
		});
		$('.cosAdtlCosts').text(moneyFormat(totCOSE)).data('cosadtlcosts', totCOSE);
		let totPurchases = parseFloat($('.cosRestocks').data('cosrestocks')) + totCOSE;
		$('.cosPurchases').text(moneyFormat(totPurchases)).data('cospurchases', totPurchases);
	}
	function totalCOS() {
		let totCostOfSales = parseFloat($('.cosBeginningInventory').data('cosbeginninginventory')) + 
							 parseFloat($('.cosPurchases').data('cospurchases')) + 
							 parseFloat($('.cosFreebies').data('cosfreebies')) -
							 parseFloat($('.cosEndInventory').data('cosendinventory')
							 	);
		$('.totalCostOfSales').text(moneyFormat(totCostOfSales)).data('totalcostofsales', totCostOfSales);
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
		$.each($('.operating_expense_billexpenses_row'), function(i, val) {
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
		$.each($('.current_assets_billexpenses_row'), function(i, val) {
			totCA += parseFloat($(this).data('total'));
		});
		$('#totalCurrentAssets').text(moneyFormat(totCA)).data('totalcurrentassets', totCA);
	}
	function totalNCA() { // NONCURRENT ASSETS
		let totNCA = 0;
		$.each($('.noncurrent_assets_accounts_row'), function(i, val) {
			totNCA += parseFloat($(this).data('total'));
		});
		$.each($('.noncurrent_assets_billexpenses_row'), function(i, val) {
			totNCA += parseFloat($(this).data('total'));
		});
		$('#totalNoncurrentAssets').text(moneyFormat(totNCA)).data('totalnoncurrentassets', totNCA);
	}
	function totalCL() { // CURRENT LIABILITIES
		let totCL = 0;
		$.each($('.current_liabilities_accounts_row'), function(i, val) {
			totCL += parseFloat($(this).data('total'));
		});
		$.each($('.current_liabilities_billexpenses_row'), function(i, val) {
			totCL += parseFloat($(this).data('total'));
		});
		$('#totalCurrentLiabilities').text(moneyFormat(totCL)).data('totalcurrentliabilities', totCL);
	}
	function totalNCL() { // NONCURRENT LIABILITIES
		let totNCL = 0;
		$.each($('.noncurrent_liabilities_accounts_row'), function(i, val) {
			totNCL += parseFloat($(this).data('total'));
		});
		$.each($('.noncurrent_liabilities_billexpenses_row'), function(i, val) {
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
		$.each($('.equities_billexpenses_row'), function(i, val) {
			totEQ += parseFloat($(this).data('total'));
		});

		let totLiabilities = parseFloat($('#totalLiabilities').data('totalliabilities'));
		let totLiabilitiesEquity = parseFloat(totLiabilities) + parseFloat(totEQ);
		$('#totalLiabilitiesEquity').text(moneyFormat(totLiabilitiesEquity)).data('totalliabilitiesequity', totLiabilitiesEquity);
	}

// CASH FLOW
	function totalCashFlow() {
		totalCIFO();
		totalCOFO();

		totalCIFI();
		totalCOFI();

		totalCIFF();
		totalCOFF();

		totalCFI();
	}
	totalCashFlow();

	function totalCIFO() { // cashinflowoperating
		let totCIFO = 0;
		$.each($('.cashinflowoperating_accounts_row'), function(i, val) {
			totCIFO += parseFloat($(this).data('total'));
		});
		$.each($('.cashinflowoperating_billexpenses_row'), function(i, val) {
			totCIFO += parseFloat($(this).data('total'));
		});
		$('#totalCashInflowOperating').text(moneyFormat(totCIFO)).data('totalcashinflowoperating', totCIFO);
	}
	function totalCOFO() { // cashoutflowoperating
		let totCOFO = 0;
		$.each($('.cashoutflowoperating_accounts_row'), function(i, val) {
			totCOFO += parseFloat($(this).data('total'));
		});
		$.each($('.cashoutflowoperating_billexpenses_row'), function(i, val) {
			totCOFO += parseFloat($(this).data('total'));
		});
		$('#totalCashOutflowOperating').text(moneyFormat(totCOFO)).data('totalcashoutflowoperating', totCOFO);
	}
	function totalCIFI() { // cashinflowinvesting
		let totCIFI = 0;
		$.each($('.cashinflowinvesting_accounts_row'), function(i, val) {
			totCIFI += parseFloat($(this).data('total'));
		});
		$.each($('.cashinflowinvesting_billexpenses_row'), function(i, val) {
			totCIFI += parseFloat($(this).data('total'));
		});
		$('#totalCashInflowInvesting').text(moneyFormat(totCIFI)).data('totalcashinflowinvesting', totCIFI);
	}
	function totalCOFI() { // cashoutflowinvesting
		let totCOFI = 0;
		$.each($('.cashoutflowinvesting_accounts_row'), function(i, val) {
			totCOFI += parseFloat($(this).data('total'));
		});
		$.each($('.cashoutflowinvesting_billexpenses_row'), function(i, val) {
			totCOFI += parseFloat($(this).data('total'));
		});
		$('#totalCashOutflowInvesting').text(moneyFormat(totCOFI)).data('totalcashoutflowinvesting', totCOFI);
	}
	function totalCIFF() { // cashinflowfinancing
		let totCIFF = 0;
		$.each($('.cashinflowfinancing_accounts_row'), function(i, val) {
			totCIFF += parseFloat($(this).data('total'));
		});
		$.each($('.cashinflowfinancing_billexpenses_row'), function(i, val) {
			totCIFF += parseFloat($(this).data('total'));
		});
		$('#totalCashInflowFinancing').text(moneyFormat(totCIFF)).data('totalcashinflowfinancing', totCIFF);
	}
	function totalCOFF() { // cashoutflowfinancing
		let totCOFF = 0;
		$.each($('.cashoutflowfinancing_accounts_row'), function(i, val) {
			totCOFF += parseFloat($(this).data('total'));
		});
		$.each($('.cashoutflowfinancing_billexpenses_row'), function(i, val) {
		totCOFF += parseFloat($(this).data('total'));
	});
		$('#totalCashOutflowFinancing').text(moneyFormat(totCOFF)).data('totalcashoutflowfinancing', totCOFF);
	}


	function totalCFI() {
		let totCB = parseFloat($('#totalCashBeginning').val());
		let totNI = parseFloat($('.netIncome').data('netincome'));

		let totCIFO = parseFloat($('#totalCashInflowOperating').data('totalcashinflowoperating'));
		let totCOFO = parseFloat($('#totalCashOutflowOperating').data('totalcashoutflowoperating'));
		let totCIFI = parseFloat($('#totalCashInflowInvesting').data('totalcashinflowinvesting'));
		let totCOFI = parseFloat($('#totalCashOutflowInvesting').data('totalcashoutflowinvesting'));
		let totCIFF = parseFloat($('#totalCashInflowFinancing').data('totalcashinflowfinancing'));
		let totCOFF = parseFloat($('#totalCashOutflowFinancing').data('totalcashoutflowfinancing'));

		let totCFI = parseFloat(totCB) + parseFloat(totNI)
						 + (parseFloat(totCIFO) + parseFloat(totCIFI) + parseFloat(totCIFF))
						 - (parseFloat(totCOFO) + parseFloat(totCOFI) + parseFloat(totCOFF));
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







	$(document).on('click', '.add-billexpenses-row', function() {

		let beID = $(this).data('id');
		let beName = $(this).find('.name').data('val');
		let beAmount = $(this).data('amount');


		let tableID = 'be_';
		let rowClass = 'be_';
		let rowCode = 'be_';

		switch ($('#billExpensesTable').data('account_add')) {
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
				tableID = 'cosAdtlCostsTable';
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
			case 'cashinflowoperating':
				tableID = 'cashinflowoperatingTable';
				rowClass = 'cashinflowoperating';
				rowCode = 'cifo';
				break;
			case 'cashoutflowoperating':
				tableID = 'cashoutflowoperatingTable';
				rowClass = 'cashoutflowoperating';
				rowCode = 'cofo';
				break;

			case 'cashinflowinvesting':
				tableID = 'cashinflowinvestingTable';
				rowClass = 'cashinflowinvesting';
				rowCode = 'cifi';
				break;
			case 'cashoutflowinvesting':
				tableID = 'cashoutflowinvestingTable';
				rowClass = 'cashoutflowinvesting';
				rowCode = 'cofi';
				break;

			case 'cashinflowfinancing':
				tableID = 'cashinflowfinancingTable';
				rowClass = 'cashinflowfinancing';
				rowCode = 'ciff';
				break;
			case 'cashoutflowfinancing':
				tableID = 'cashoutflowfinancingTable';
				rowClass = 'cashoutflowfinancing';
				rowCode = 'coff';
				break;
		}


		if ($('.' + rowCode + '_billexpenses_row_' + $(this).data('id')).length < 1) {
			$('#' + tableID).append($('<tr>').data('total', beAmount)
				.attr({ class: rowClass + '_billexpenses_row ' + rowCode + '_billexpenses_row_' + beID })
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<i>').attr({ class: 'text-center' })
						.text('BILL EXPENSES')))
				.append($('<td>').attr({ class: 'text-center' })
					.text(beName))
				.append($('<td>').attr({ class: 'text-center' })
					.text(moneyFormat(beAmount)))
				.append($('<td>').attr({ class: 'text-center' })
					.append($('<button>').attr({
						type: 'button',
						class: 'btn remove-billexpenses-row'
					}).data('id', beID).data('row_code', rowCode)
						.append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
			);

			if ($('.add-' + rowClass + '-row').length > 0) {
				$('.add-' + rowClass + '-row').before($('<tr>').attr({ class: rowClass + '_row ' + rowCode + '_row_' + beID })
					.append($('<td>').text(beName))
					.append($('<td>').attr({ class: 'total' }) 
						.text(beAmount.toFixed(2)))
				);
			}
			totalIncomeStatement();
			totalBalanceSheet();
			totalCashFlow();
		}

	});

	$(document).on('click', '.remove-billexpenses-row', function() {
		$('.' + $(this).data('row_code') + '_row_' + $(this).data('id')).remove();
		$('.' + $(this).data('row_code') + '_billexpenses_row_' + $(this).data('id')).remove();
		totalIncomeStatement();
		totalBalanceSheet();
		totalCashFlow();
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/FileSaver.js-1.3.6/FileSaver.js"></script>
<script src="<?=base_url()?>/assets/js/TableExport-5.2.0/dist/js/tableexport.js"></script>
</body>
</html>
