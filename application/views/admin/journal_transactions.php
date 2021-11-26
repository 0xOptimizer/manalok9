<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch vendors
$getJournals = $this->Model_Selects->GetJournals();
$getAccounts = $this->Model_Selects->GetAccountSelection();

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
						<h3>Journal Transactions
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> 2 TOTAL
							</span>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="newtransaction-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW TRANSACTION</button>
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
							<th>DATE</th>
							<th>DESCRIPTION</th>
						</thead>
						<tbody>
							<?php
							if ($getJournals->num_rows() > 0):
								foreach ($getJournals->result_array() as $row): ?>
									<tr class="tr_class_modal" data-id="<?=$row['ID']?>">
										<td><?=$row['Date']?></td>
										<td><?=$row['Description']?></td>
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
<?php $this->load->view('admin/modals/add_journal_transaction'); ?>
<?php $this->load->view('admin/modals/journal_modal.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
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
	
	var table = $('#transactionsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
		"order": [[ 0, "asc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	$('.newtransaction-btn').on('click', function() {
		$('#AddJournalTransactionModal').modal('toggle');
	});

	var accounts_list = <?=json_encode($getAccounts->result_array())?>;
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
			.append($('<td>').attr({
				class: ''
			}).append($('<select>').attr({
				class: 'select_accounts inpAccountID w-100'
			})))
			.append($('<td>').attr({
				class: ''
			}).append($('<input>').attr({
				class: 'inpDebit  w-100',
				type: 'number',
				value: 0
			})))
			.append($('<td>').attr({
				class: ''
			}).append($('<input>').attr({
				class: 'inpCredit  w-100',
				type: 'number',
				value: 0
			})))
			.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
				type: 'button',
				class: 'btn remove-account-row'
			}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);

		for (var i = accounts_list.length - 1; i >= 0; i--) {
			$('.' + this_row + ' .select_accounts').append($('<option>').attr({
				value: accounts_list[i]['ID']
			}).text(accounts_list[i]['Name']));
		}

		setTimeout(function() {
			$('.' + this_row).removeClass('highlighted');
		}, 2000);
		$('.' + this_row).fadeIn('2000');

		updTransactionCount();
	});
	$(document).on('click', '.remove-account-row', function() {
		$(this).parents('tr').remove();

		updTransactionCount();
	});
	$(document).on('focus keyup change', '.inpDebit, .inpCredit', function() {
		updTransactionCount();
	});

	$(document).on('focus keyup change', '.inpDebit', function() {
		if ($(this).val() > 0) {
			$(this).parents('td').siblings('td').children('.inpCredit').attr('disabled', '');
		} else {
			$(this).parents('td').siblings('td').children('.inpCredit').removeAttr('disabled');
		}
	});
	$(document).on('focus keyup change', '.inpCredit', function() {
		if ($(this).val() > 0) {
			$(this).parents('td').siblings('td').children('.inpDebit').attr('disabled', '');
		} else {
			$(this).parents('td').siblings('td').children('.inpDebit').removeAttr('disabled');
		}
	});

	// view JOURNAL
	<?php
	foreach ($getAccounts->result_array() as $key => $val) {
		$accountsGet[$val['ID']] = $val['Description'];
	}
	?>
	var accounts_get = <?=json_encode($accountsGet)?>;

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
					$('.total-row').before($('<tr>').attr({ class: 'view_transaction_row' })
						.append($('<td>').text(accounts_get[response[i].ID]))
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
	$('.tr_class_modal').on('click', function() {
		$('#JournalModal').modal('toggle');
		getJournalDetails($(this).data('id'));
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>
</html>
