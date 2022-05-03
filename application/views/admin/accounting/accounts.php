<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$date_from = date('M j, Y', strtotime('-1 month'));
$date_to = date('M j, Y');

$date_from_beginning_inventory = date('M j, Y', strtotime('-1 month'));
$date_to_beginning_inventory = date('M j, Y', strtotime('-1 month +1 day'));


// Fetch Accounts
$getAccounts = $this->Model_Selects->GetAccounts();

$account_types = array('REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITY');

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
						<h3><i class="bi bi-list-ul"></i> Accounts
							<span class="text-center success-banner-sm">
								<i class="bi bi-list-ul"></i> <?=$getAccounts->num_rows();?> TOTAL
							</span>
							<?php if ($getAccounts->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-list-ul"></i> No accounts found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['accounts_add']): ?>
							<button type="button" class="newaccount-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-list-ul"></i> NEW ACCOUNT</button>
							|
						<?php endif; ?>
						<a href="<?=base_url() . 'admin/trial_balance';?>" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-circle"></i> TRIAL BALANCE</a>
						<button class="btn btn-sm-primary accountingreports-btn" style="font-size: 12px;"><i class="bi bi-circle"></i>
							REPORTS
						</button>
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
							<th>ID</th>
							<th>NAME</th>
							<th>TYPE</th>
							<th>DESCRIPTION</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getAccounts->num_rows() > 0):
								foreach ($getAccounts->result_array() as $row): ?>
									<tr data-id="<?=$row['ID']?>" data-name="<?=$row['Name']?>" data-type="<?=$row['Type']?>" data-description="<?=$row['Description']?>">
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td><?=$row['Name']?></td>
										<td><?=$account_types[$row['Type']]?></td>
										<td><?=$row['Description']?></td>
										<td>
											<?php if ($this->session->userdata('UserRestrictions')['accounts_edit']): ?>
												<i class="bi bi-pencil btn-update-account" style="color: #229F4B;"></i>
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
<div class="modal fade" id="AccountingReports" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Accounting Reports</h4>
			</div>
			<form action="<?=base_url()?>admin/income_statement" method="GET">
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap">
						<h6>Accounting Period</h6>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-6 mb-2">
							<input class="form-control" type="date" name="dfr" value="<?=date('Y-m-d', strtotime($date_from))?>">
							<label class="input-label">FROM</label>
						</div>
						<div class="form-group col-6 mb-2">
							<input class="form-control" type="date" name="dto" value="<?=date('Y-m-d', strtotime($date_to))?>">
							<label class="input-label">TO</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/accounts/add_account'); ?>
<?php $this->load->view('admin/_modals/accounts/update_account'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-accounting-accounts').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#accountsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#accountsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
		"order": [[ 0, "asc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	$('.accountingreports-btn').on('click', function() {
		$('#AccountingReports').modal('toggle');
	});

	$('.newaccount-btn').on('click', function() {
		$('#AddAccountModal').modal('toggle');
	});
	$(document).on('click', '.btn-update-account', function() {
		$('#UpdateAccountModal').modal('toggle');
		let acc_row = $(this).parents('tr');
		$('.mi_id').val(acc_row.data('id'));
		$('.m_id').text(acc_row.data('id'));
		$('.m_name').val(acc_row.data('name'));
		$('.m_type option[value=' + acc_row.data('type') + ']').prop('selected', true);
		$('.m_description').val(acc_row.data('description'));
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
