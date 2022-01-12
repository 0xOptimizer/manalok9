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
$getAccounts = $this->Model_Selects->GetAccountSelection();
$getTransactions = $this->Model_Selects->GetTransactionsRange($date_from, $date_to);

// $accountTypes = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITIES');

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}


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

if ($getTransactions->num_rows() > 0) {
	foreach ($getTransactions->result_array() as $row) {
		$accounts[$row['AccountID']]['debitTotal'] += $row['Debit'];
		$accounts[$row['AccountID']]['creditTotal'] += $row['Credit'];

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
						<h3>Trial Balance
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
								if ($key == 0 && count($rows) > 0): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">REVENUES</td>
									</tr>
								<?php elseif ($key == 3 && count($rows) > 0): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">EXPENSES</td>
									</tr>
								<?php elseif ($key == 1 && count($rows) > 0): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">ASSETS</td>
									</tr>
								<?php elseif ($key == 2 && count($rows) > 0): ?>
									<tr>
										<td style="font-weight: bold; color: #a7852d;" colspan="3">LIABILITIES</td>
									</tr>
								<?php elseif ($key == 4 && count($rows) > 0): ?>
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
	
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
