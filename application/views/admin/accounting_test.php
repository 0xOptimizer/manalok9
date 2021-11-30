<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch vendors
$getJournals = $this->Model_Selects->GetJournals();
$getAccounts = $this->Model_Selects->GetAccountSelection();
$getTransactions = $this->Model_Selects->GetTransactions();

$accountTypes = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES');

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
					<div class="col-12">
						<h3>Accounting
						</h3>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>ACCOUNT</th>
							<th>DEBIT</th>
							<th>CREDIT</th>
						</thead>
						<tbody>
							<?php
							if ($getAccounts->num_rows() > 0) {
								foreach ($getAccounts->result_array() as $row) {
									switch ($row['Type']) {
										case '0':
											$type = 0; break; // REVENUE
										case '1':
											$type = 2; break; // ASSETS
										case '2':
											$type = 3; break; // LIABILITIES
										case '3':
											$type = 1; break; // EXPENSES
									}

									$accounts[$row['ID']] = array(
										'name' => $row['Name'],
										'type' => $type,
										'debitTotal' => 0,
										'creditTotal' => 0
									);
								}
							}

							if ($getTransactions->num_rows() > 0) {
								foreach ($getTransactions->result_array() as $row) {
									$accounts[$row['AccountID']]['debitTotal'] += $row['Debit'];
									$accounts[$row['AccountID']]['creditTotal'] += $row['Credit'];
								}
							}

							function cmp($a, $b)
							{
								return strcmp($a['type'], $b['type']);
							}
							usort($accounts, 'cmp');

							$currentType = 0;
							$debitTotal = 0;
							$creditTotal = 0;
							foreach ($accounts as $key => $val): ?>
								<?php if ($val['type'] == 0 && $currentType == 0): $currentType = 1; ?>
									<tr><td style="font-weight: bold; color: #a7852d;" colspan="3">REVENUES</td></tr>
								<?php elseif ($val['type'] == 1 && $currentType == 1): $currentType = 2; ?>
									<tr><td style="font-weight: bold; color: #a7852d;" colspan="3">EXPENSES</td></tr>
								<?php elseif ($val['type'] == 2 && $currentType == 2): $currentType = 3; ?>
									<tr><td style="font-weight: bold; color: #a7852d;" colspan="3">ASSETS</td></tr>
								<?php elseif ($val['type'] == 3 && $currentType == 3): $currentType = 4; ?>
									<tr><td style="font-weight: bold; color: #a7852d;" colspan="3">LIABILITIES</td></tr>
								<?php endif; 
								if ($val['debitTotal'] > 0 || $val['creditTotal'] > 0): ?>
								<tr>
									<td><?=$val['name']?></td>
									<td><?=$val['debitTotal']?></td>
									<td><?=$val['creditTotal']?></td>
								</tr>
							<?php endif;
							$debitTotal += $val['debitTotal'];
							$creditTotal += $val['creditTotal'];
							endforeach;?>
							<tr class="total-row" style="border-color: #a7852d;">
								<td style="color: #a7852d;">Balance</td>
								<td class="debitTotal"><?=$debitTotal?></td>
								<td class="creditTotal"><?=$creditTotal?></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
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
	// test
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
