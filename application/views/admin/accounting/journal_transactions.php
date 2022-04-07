<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch vendors
if ($this->input->get('a_sort') != NULL && is_numeric($this->input->get('a_sort'))) {
	$getJournals = $this->Model_Selects->GetJournalsSortByAccountType($this->input->get('a_sort'));
} else {
	$getJournals = $this->Model_Selects->GetJournals();
}
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
						<h3><i class="bi bi-pen"></i> Journal Transactions
							<span class="text-center success-banner-sm">
								<i class="bi bi-list-ul"></i> <?=$getJournals->num_rows();?> TOTAL
							</span>
							<?php if ($getJournals->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-list-ul"></i> No journals found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-7 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['journal_transactions_add']): ?>
							<button type="button" class="newtransaction-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-pen"></i> NEW TRANSACTION</button>
						<?php endif; ?>
					</div>
					<div class="col-sm-12 col-md-3 pt-4 pb-2" style="margin-top: -15px;">
						<div class="form-group">
							<form id="journalTypeSortForm" method="GET">
								<input class="sortAccID" type="hidden" name="a_sort" value="0">
							</form>
							<select id="journalTypeSort" class="form-control w-100">
								<option value="" selected>NONE</option>
								<?php foreach ($accounts as $type => $accs): ?>
									<optgroup label="<?=$account_types[$type]?>">
										<?php foreach ($accs as $row): ?>
											<option value="<?=$row['ID']?>"
												<?php if ($this->input->get('a_sort')==$row['ID']) echo 'selected';?>>
												<?=$row['Name']?>
											</option>
										<?php endforeach; ?>
									</optgroup>
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
					<table id="transactionsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">JOURNAL NO</th>
							<th class="text-center">DATE</th>
							<th class="text-center">DESCRIPTION</th>
							<th class="text-center">TOTAL</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getJournals->num_rows() > 0):
								foreach ($getJournals->result_array() as $row): ?>
									<tr class="tr_class_modal" data-id="<?=$row['ID']?>">
										<td class="text-center"><?=$row['JournalNo']?></td>
										<td class="text-center"><?=$row['Date']?></td>
										<td class="text-center"><?=$row['Description']?></td>
										<td class="text-center"><?=number_format($row['Total'], 2)?></td>
										<td class="text-center">
											<i class="bi bi-eye btn-view-journal" style="color: #408AF7;"></i>
											<?php if ($this->session->userdata('UserRestrictions')['journal_transactions_delete']): ?>
												<i class="bi bi-trash text-danger btn-delete-journal"></i>
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

<?php $this->load->view('admin/_modals/journal_transactions/journal_modal.php'); ?>
<?php $this->load->view('admin/_modals/journal_transactions/add_journal_transaction.php'); ?>
<?php $this->load->view('admin/_modals/journal_transactions/delete_journal_transaction.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-accounting-journal-transactions').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#transactionsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	if(window.location.hash && window.location.hash.substring(0, 2) == '#J') {
		let journal_id = window.location.hash.substring(2);
		$('#JournalModal').modal('toggle');
		getJournalDetails(journal_id);
	}
	function showAlert(type, message) {
		if ($('.alertNotification').length > 0) {
			$('.alertNotification').remove();
		}
		$('body').append($('<div>')
			.attr({
				class: 'alert position-fixed bottom-0 end-0 alert-dismissible fade show alertNotification alert-' + type, 
				role: 'alert',
				'data-bs-dismiss': 'alert'
			}).css({ 'z-index': 9999, cursor: 'pointer' })
			.append($('<strong>').html(type[0].toUpperCase() + type.slice(1) + '! '))
			.append($('<span>').html(message))
			.append($('<button>')
				.attr({
					type: 'button', 
					class: 'btn-close',
					'data-bs-dismiss': 'alert',
					'aria-label': 'Close'
				}))
		);
	}
	
	var table = $('#transactionsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
		"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	$('.newtransaction-btn').on('click', function() {
		$('#AddJournalTransactionModal').modal('toggle');
	});

	var accounts_list = <?=json_encode($getAccounts->result_array())?>;
	var account_types = ['REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITY'];

	function updTransactionCount() {
		// update journal transaction count
		$('#transactionsCount').val($('.account_row').length);
		// update journal transaction input names
		$.each($('.account_row'), function(i, val) {
			$(this).find('.inpAccountID').attr('name', 'accountIDInput_' + i);
			$(this).find('.inpDebit').attr('name', 'debitInput_' + i);
			$(this).find('.inpCredit').attr('name', 'creditInput_' + i);
		});
		// total
		let debitTotal = 0;
		$.each($('.inpDebit'), function(i, val) {
			debitTotal += parseFloat($(this).val());
		});
		$('.debitTotal').html(debitTotal.toFixed(2));
		let creditTotal = 0;
		$.each($('.inpCredit'), function(i, val) {
			creditTotal += parseFloat($(this).val());
		});
		$('.creditTotal').html(creditTotal.toFixed(2));
	}
	$(document).on('click', '.add-account-row', function() {
		var this_row = 'ar_' + $('.account_row').length;
		$('.add-account-row').before($('<tr>')
			.attr({
				class: 'account_row highlighted ' + this_row,
			}).data('id', $('.account_row').length)
			.append($('<td>').attr({ // column-1
				class: ''
			}).append($('<select>').attr({
				class: 'select_accounts inpAccountID w-100'
			}).append($('<optgroup>').attr({
				class: 'type_0',
				label: 'REVENUES'
			})).append($('<optgroup>').attr({
				class: 'type_1',
				label: 'ASSETS'
			})).append($('<optgroup>').attr({
				class: 'type_2',
				label: 'LIABILITIES'
			})).append($('<optgroup>').attr({
				class: 'type_3',
				label: 'EXPENSES'
			})).append($('<optgroup>').attr({
				class: 'type_4',
				label: 'EQUITIES'
			}))))
			.append($('<td>').attr({ // column-2
				class: ''
			}).append($('<input>').attr({
				class: 'inpDebit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ // column-3
				class: ''
			}).append($('<input>').attr({
				class: 'inpCredit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
				type: 'button',
				class: 'btn remove-account-row'
			}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);

		for (var i = accounts_list.length - 1; i >= 0; i--) {
			$('.' + this_row + ' .type_' + accounts_list[i]['Type']).append($('<option>').attr({
				value: accounts_list[i]['ID']
			}).text(accounts_list[i]['Name']));
		}

		setTimeout(function() {
			$('.' + this_row).removeClass('highlighted');
		}, 2000);
		$('.' + this_row).fadeIn('2000');

		updTransactionCount();
	});

	// add two two transaction accounts
	$('.add-account-row').click(); $('.add-account-row').click();

	$(document).on('click', '.remove-account-row', function() {
		$(this).parents('tr').remove();

		updTransactionCount();
	});
	$(document).on('focus keyup change', '.inpDebit, .inpCredit', function() {
		updTransactionCount();
	});
	// disable other debit/credit on change
	$(document).on('focus keyup change', '.inpDebit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpCredit').val(0);
			$(this).parents('tr').find('.inpCredit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpCredit').removeAttr('disabled');
		}
	});
	$(document).on('focus keyup change', '.inpCredit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpDebit').val(0);
			$(this).parents('tr').find('.inpDebit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpDebit').removeAttr('disabled');
		}
	});

	// view JOURNAL
	function getJournalDetails(journal_id) {
		var debitTotal = 0;
		var creditTotal = 0;

		$.each($('.view_transaction_row'), function(i, val) {
			$(this).remove();
		});
		$.ajax({
			url: 'getJournalDetails',
			type: 'GET',
			dataType: 'JSON',
			data: { journal_id : journal_id } ,
			success: function (response) {
				$('.m_journalid').text(response.ID);
				$('.m_journalno').text(response.JournalNo);
				$('.m_date').text(response.Date);
				$('.m_description').text(response.Description);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
		$.ajax({
			url: 'getJournalTransactions',
			type: 'GET',
			dataType: 'JSON',
			data: { journal_id : journal_id } ,
			success: function (response) {
				for (var i = response.length - 1; i >= 0; i--) {
					let account = accounts_list.find(function(e) { return e.ID == response[i].AccountID; });
					$('.total-row').before($('<tr>').attr({ class: 'view_transaction_row' })
						.append($('<td>').text(account.Name))
						.append($('<td>').text(account_types[account.Type]))
						.append($('<td>').attr({ class: 'view_debit' }).text(response[i].Debit))
						.append($('<td>').attr({ class: 'view_credit' }).text(response[i].Credit))
					);
					if (parseFloat(response[i].Debit) > 0) {
						debitTotal += parseFloat(response[i].Debit);
					}
					if (parseFloat(response[i].Credit) > 0) {
						creditTotal += parseFloat(response[i].Credit);
					}
				}
				$('.debitTotalView').html(debitTotal);
				$('.creditTotalView').html(creditTotal);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});	
	}

	$('#formAddJournal').on('submit', function(e) {
		let totalDebit = parseFloat($('.debitTotal').html());
		let totalCredit = parseFloat($('.creditTotal').html());
		if (totalDebit != totalCredit) {
			showAlert('warning', 'Debit and Credit must be equal.');
			e.preventDefault();
		} else if (totalDebit <= 0 || totalCredit <= 0) {
			showAlert('warning', 'Total must be more than 0.');
			e.preventDefault();
		}
	});

	$('#journalTypeSort').on('change', function() {
		if ($.isNumeric($('.sortAccID').val())) {
			$('.sortAccID').val($(this).find('option:selected').val());
			$('#journalTypeSortForm').submit();
		}
	});

	$(document).on('click', '.btn-view-journal', function() {
		$('#JournalModal').modal('toggle');
		getJournalDetails($(this).parents('tr').data('id'));
	});
	$(document).on('click', '.btn-delete-journal', function() {
		let journal_id = $(this).parents('tr').data('id');
		if (!confirm('Delete Journal #'+ journal_id +'? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#journalIDDelete').val(journal_id);
			$('#formDeleteJournal').submit();
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>
</html>
