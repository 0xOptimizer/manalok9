<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch
$getJournals = $this->Model_Selects->GetJournals();
$getAccounts = $this->Model_Selects->GetAccountSelection();
$getTransactions = $this->Model_Selects->GetTransactions();

// $accountTypes = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITIES');

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}

$date_1 = date('Y-m-d', strtotime('2021-12-10'));
$date_2 = date('Y-m-d');
// echo $date_1;
// $inventoryBeginning = $this->Model_Selects->GetTotalInventoryValueUntil($date_1);
// $inventoryEnd = $this->Model_Selects->GetTotalInventoryValueRange($date_1,$date_2);
// print_r($inventoryBeginning);
// echo "<br>";
// print_r($inventoryEnd);


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
			<div class="page-title showTrialBalance" style="cursor: pointer;">
				<div class="row">
					<div class="col-12">
						<h3>Trial Balance</h3>
					</div>
				</div>
			</div>
			<section class="section mb-3 sectionTrialBalance" style="display: none;">
				<div class="table-responsive">
					<table id="" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>ACCOUNT</th>
							<th>DEBIT</th>
							<th>CREDIT</th>
						</thead>
						<tbody>
							<?php

							$currentType = 0;
							$debitTotal = 0;
							$creditTotal = 0;

							foreach ($trialAccounts as $key => $rows): 
								if ($key == 0): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">REVENUES</td>
									</tr>
								<?php elseif ($key == 3): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">EXPENSES</td>
									</tr>
								<?php elseif ($key == 1): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">ASSETS</td>
									</tr>
								<?php elseif ($key == 2): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">LIABILITIES</td>
									</tr>
								<?php elseif ($key == 4): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">EQUITIES</td>
									</tr>
								<?php endif; 
								foreach ($rows as $row):
									if ($row['debitTotal'] > 0 || $row['creditTotal'] > 0): ?>
										<tr>
											<td><?=$row['name']?></td>
											<td><?=$row['debitTotal']?></td>
											<td><?=$row['creditTotal']?></td>
										</tr>
								<?php endif;
									$debitTotal += $row['debitTotal'];
									$creditTotal += $row['creditTotal'];
								endforeach;
							endforeach;

							?>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">BALANCE</td>
								<td><?=$debitTotal?></td>
								<td><?=$creditTotal?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>

			<div class="page-title showIncomeStatement" style="cursor: pointer;">
				<div class="row">
					<div class="col-12">
						<h3>Income Statement</h3>
					</div>
				</div>
			</div>
			<section class="section mb-3 sectionIncomeStatement" style="display: none;">
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
								<td><?=""//$grossProfit?></td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="font-weight: bold; color: #a7852d;" colspan="3">OPERATING EXPENSES</td>
							</tr>
							<?php foreach ($trialAccounts[3] as $row):
								if ($row['debitTotal'] > 0 || $row['creditTotal'] > 0): ?>
									<tr>
										<td><?=$row['name']?></td>
										<td><?=$row['debitTotal'] - $row['creditTotal']?></td>
									</tr>
							<?php endif; 
								// $totalOE += $row['debitTotal'] - $row['creditTotal'] ;
							endforeach;?>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL OPERATING EXPENSES</td>
								<td><?=""//$totalOE?></td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<?php
							// $netIncome = $grossProfit - $totalOE;
							?>
							<tr>
								<td>NET PRE-OPERATING INCOME</td>
								<td><?=""//$netIncome?></td>
							</tr>
							<tr>
								<td>OTHER COMPREHENSIVE INCOME</td>
								<td>-</td>
							</tr>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL COMPREHENSIVE INCOME</td>
								<td><?=""//$netIncome?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>

			<div class="page-title showBalanceSheet" style="cursor: pointer;">
				<div class="row">
					<div class="col-12">
						<h3>Balance Sheet</h3>
					</div>
				</div>
			</div>
			<section class="section mb-3 sectionBalanceSheet" style="display: none;">
				<div class="table-responsive">
					<table id="" class="standard-table table">
						<tbody>
							<?php

							$currentType = 0;

							$assetsTotal = 0;
							$liabilitiesTotal = 0;

							foreach ($trialAccounts[1] as $key => $row): 
									if ($row['debitTotal'] > 0 || $row['creditTotal'] > 0): ?>
										<tr>
											<td><?=$row['name']?></td>
											<td><?=$row['debitTotal'] - $row['creditTotal']?></td>
										</tr>
								<?php endif;
								$assetsTotal += ($row['debitTotal'] - $row['creditTotal']);
							endforeach; ?>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL</td>
								<td class="debitTotal"><?=$assetsTotal?></td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="font-weight: bold; color: #a7852d;" colspan="2">LIABILITIES</td>
							</tr>
							<?php foreach ($trialAccounts[2] as $key => $row): 
									if ($row['debitTotal'] > 0 || $row['creditTotal'] > 0): ?>
										<tr>
											<td><?=$row['name']?></td>
											<td><?=$row['creditTotal'] - $row['debitTotal']?></td>
										</tr>
								<?php endif;
								$liabilitiesTotal = $row['creditTotal'] - $row['debitTotal'];
							endforeach;?>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL</td>
								<td class="debitTotal"><?=$liabilitiesTotal?></td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td style="font-weight: bold; color: #a7852d;" colspan="2">EQUITIES</td>
							</tr>
							<?php foreach ($trialAccounts[4] as $key => $row): 
									if ($row['debitTotal'] > 0 || $row['creditTotal'] > 0): ?>
										<tr>
											<td><?=$row['name']?></td>
											<td><?=$row['creditTotal'] - $row['debitTotal']?></td>
										</tr>
								<?php endif;
								$equitiesTotal = $row['creditTotal'] - $row['debitTotal'];
							endforeach;?>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td>Net Income</td>
								<td><?=$netIncome?></td>
							</tr>

							<tr><td colspan="2">&nbsp;</td></tr>
							<tr class="total-row" style="border-width: 2px 0; border-style: solid; border-color: #a7852d;">
								<td style="color: #a7852d;">TOTAL</td>
								<td><?=$liabilitiesTotal + $netIncome?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>

<script src="<?=base_url()?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="<?=base_url()?>assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$(document).ready(function() {
	$('body').on('click', '.showTrialBalance', function(e) {
		if ($('.sectionTrialBalance').css('display') == 'block') {
			$('.sectionTrialBalance').hide();
		} else {
			$('.sectionTrialBalance').show();
		}
	});
	$('body').on('click', '.showIncomeStatement', function(e) {
		if ($('.sectionIncomeStatement').css('display') == 'block') {
			$('.sectionIncomeStatement').hide();
		} else {
			$('.sectionIncomeStatement').show();
		}
	});
	$('body').on('click', '.showBalanceSheet', function(e) {
		if ($('.sectionBalanceSheet').css('display') == 'block') {
			$('.sectionBalanceSheet').hide();
		} else {
			$('.sectionBalanceSheet').show();
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
