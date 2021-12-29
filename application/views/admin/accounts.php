<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

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
						<h3>Accounts
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
					<?php if ($this->session->userdata('UserRestrictions')['accounts_add'] == 1): ?>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="newaccount-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW ACCOUNT</button>
					</div>
					<?php endif; ?>
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
											<?php if ($this->session->userdata('UserRestrictions')['accounts_edit'] == 1): ?>
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
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>
<?php if ($this->session->userdata('UserRestrictions')['accounts_add'] == 1): ?>
<?php $this->load->view('admin/modals/add_account'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('UserRestrictions')['accounts_edit'] == 1): ?>
<?php $this->load->view('admin/modals/update_account'); ?>
<?php endif; ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
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
