<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

$sbmf = $this->input->get('sbmf');
$sbmfy = $this->input->get('sbmfy');
$sbmt = $this->input->get('sbmt');
$sbmty = $this->input->get('sbmty');

$sbdf = $this->input->get('sbdf');
$sbdt = $this->input->get('sbdt');

if ($sbmf != NULL && $sbmfy != NULL && $sbmt != NULL && $sbmty != NULL) {
	$from = date('Y-m-d', strtotime($sbmfy	 .'-'. $sbmf));
	$to = date('Y-m-t', strtotime($sbmty	 .'-'. $sbmt));
	$rangeText = date('F Y', strtotime($from)) .' TO '. date('F Y', strtotime($to));
} elseif ($sbmf != NULL && $sbmfy == NULL && $sbmt != NULL && $sbmty == NULL) {
	$from = date('Y-m-d', strtotime($sbmf));
	$to = date('Y-m-t', strtotime($sbmt));
	$rangeText = date('F j, Y', strtotime($from)) .' TO '. date('F j, Y', strtotime($to));
} elseif ($sbdf != NULL && $sbdt != NULL) {
	$from = date('Y-m-d', strtotime($sbdf));
	$to = date('Y-m-d', strtotime($sbdt));
	$rangeText = date('F j, Y', strtotime($from)) .' TO '. date('F j, Y', strtotime($to));
} else {
	$from = NULL;
	$to = NULL;
	$rangeText = 'TOTAL';
}

$sbst = $this->input->get('sbst');
if ($sbst == NULL || $sbst == 'ALL') {
	$sbst = -1;
	$status = '';
} else {
	$status = $sbst;
}



// Fetch bills
$getBills = $this->Model_Selects->GetBillsGroupHeadRange($from, $to);

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}


$getAllBillDepartment = $this->Model_Selects->GetAllBillDepartment();


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
					<div class="col-12 col-md-8">
						<h3><i class="bi bi-cash"></i> Bill Expenses
							<span class="text-center success-banner-sm">
								<i class="bi bi-cash"></i> <?=$getBills->num_rows();?> TOTAL
							</span>
							<?php if ($getBills->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Bills found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['bills_add']): ?>
							<button type="button" class="newbill-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-cash"></i> NEW BILL</button>
							<!-- <button type="button" class="groupbill-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cash"></i> GROUP BILL</button> -->
							|
						<?php endif; ?>

						<button type="button" class="btn btn-sm-success" onclick="window.location.replace('<?=base_url()?>admin/bills');">
							<i class="bi bi-clock-fill"></i> TOTAL
						</button>
						<button type="button" class="btn btn-sm-success sortbymonth-btn">
							<i class="bi bi-calendar-fill"></i> MONTHLY
						</button>
						<button type="button" class="btn btn-sm-success sortbyday-btn">
							<i class="bi bi-calendar-fill"></i> CUSTOM DATE
						</button>
						<button type="button" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
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
					<table id="billsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<!-- <th class="text-center">BILL NO</th> -->
							<!-- <th class="text-center">DESCRIPTION</th>
							<th class="text-center">TYPE</th>
							<th class="text-center">PAYEE</th>
							<th class="text-center">CATEGORY</th>
							<th class="text-center">AMOUNT</th> -->
							<!-- <th class="text-center">MODE OF PAYMENT</th> -->
							<!-- <th class="text-center">ORDER NO</th> -->
							<th class="text-center">DATE</th>
							<th class="text-center">NAME</th>
							<th class="text-center">TIN # VAT</th>
							<th class="text-center">TIN # NON</th>
							<th class="text-center">ADDRESS</th>
							<th class="text-center">SI# OR#</th>
							<th class="text-center">REMARKS</th>
							<th class="text-center">DEPARTMENT</th>
							<th class="text-center"></th>
						</thead>
						<tbody>
							<?php if ($getBills->num_rows() > 0):
								foreach ($getBills->result_array() as $row): ?>
									<tr data-bill_id="<?=$row['ID']?>" data-bill_date="<?=$row['Date']?>" data-bill_name="<?=$row['Name']?>" data-bill_tinvat="<?=$row['TINVAT']?>" data-bill_tinnon="<?=$row['TINNON']?>" data-bill_address="<?=$row['Address']?>" data-bill_particulars="<?=$row['Particulars']?>" data-bill_amount="<?=$row['Amount']?>" data-bill_sinorn="<?=$row['SINORN']?>" data-bill_remarks="<?=$row['Remarks']?>" data-bill_department="<?=$row['Department']?>">
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
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
											<?php if ($row['SINORN'] != NULL): ?>
												<?=$row['SINORN']?>
											<?php else: ?>
												---
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($row['Remarks'] != NULL): ?>
												<?=$row['Remarks']?>
											<?php else: ?>
												---
											<?php endif; ?>
										</td>
										<td class="text-center">
											<?php if ($row['Department'] != NULL): ?>
												<?=$row['Department']?>
											<?php else: ?>
												---
											<?php endif; ?>
										</td>
										<td>
											<button type="button" class="btn showbill-btn" data-billno="<?=$row['BillNo']?>"><i class="bi bi-eye text-success"></i></button>
											<?php if ($this->session->userdata('UserRestrictions')['bills_add']): ?>
												<button type="button" class="btn updbill-btn"><i class="bi bi-pencil text-warning"></i></button>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['bills_delete']): ?>
												<a href="FORM_removeBill?bno=<?=$row['BillNo']?>">
													<button type="button" class="btn removeBill"><i class="bi bi-trash text-danger"></i></button>
												</a>
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
<datalist id="departments">
	<?php if ($getAllBillDepartment->num_rows() > 0): ?>
		<?php foreach ($getAllBillDepartment->result_array() as $row): ?>
			<option value="<?=$row['Department']?>">
		<?php endforeach; ?>
	<?php endif; ?>
</datalist>



<?php
if ($from == NULL && $to == NULL) {
	$from = date('Y-m-d');
	$to = date('Y-m-d');
}
?>
<?php $this->load->view('admin/_modals/bills/add_bill'); ?>
<?php $this->load->view('admin/_modals/bills/update_bill'); ?>
<?php $this->load->view('admin/_modals/bills/group_bill'); ?>
<?php $this->load->view('admin/_modals/bills/view_bill'); ?>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>
<?php $this->load->view('admin/_modals/generate_report')?>
<div class="modal fade" id="SortByMonthModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="" method="GET">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-calendar-fill" style="font-size: 24px;"></i> Sort By Month</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmf">
								<?php for ($i = 1; $i <= 12; $i++): ?>
									<option value="<?=$i?>" <?=(date('m', strtotime($from)) == $i ? 'selected' : '')?>><?=date('F', strtotime(date('Y') .'-'. $i .'-01'))?></option>
								<?php endfor; ?>
							</select>
							<label class="input-label">FROM</label>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmfy">
								<?php for ($i = date('Y'); $i >= 1990; $i--): ?>
									<option value="<?=$i?>" <?=(date('Y', strtotime($from)) == $i ? 'selected' : '')?>><?=$i?></option>
								<?php endfor; ?>
							</select>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmt">
								<?php for ($i = 1; $i <= 12; $i++): ?>
									<option value="<?=$i?>" <?=(date('m', strtotime($to)) == $i ? 'selected' : '')?>><?=date('F', strtotime(date('Y') ."-". $i ."-01"))?></option>
								<?php endfor; ?>
							</select>
							<label class="input-label">TO</label>
						</div>
						<div class="form-group col-12 col-md-6 mb-2">
							<select class="form-control" name="sbmty">
								<?php for ($i = date('Y'); $i >= 1990; $i--): ?>
									<option value="<?=$i?>" <?=(date('Y', strtotime($to)) == $i ? 'selected' : '')?>><?=$i?></option>
								<?php endfor; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="SortByDayModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<form action="" method="GET">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-calendar-fill" style="font-size: 24px;"></i> Sort By Day</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 mb-2">
							<input type="date" class="form-control" name="sbdf" value="<?=date('Y-m-d', strtotime($from))?>" required>
							<label class="input-label">FROM</label>
						</div>
						<div class="form-group col-12 mb-2">
							<input type="date" class="form-control" name="sbdt" value="<?=date('Y-m-d', strtotime($to))?>" required>
							<label class="input-label">TO</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-calendar-check-fill"></i> SORT</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?=base_url()?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>

<script>
$('.sidebar-admin-bills').addClass('active');
$(document).ready(function() {
	<?php if (!isset($highlightID) && $highlightID != 'N/A'): ?>
		$('#billsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.sortbymonth-btn').on('click', function() {
		$('#SortByMonthModal').modal('toggle');
	});
	$('.sortbyday-btn').on('click', function() {
		$('#SortByDayModal').modal('toggle');
	});
	
	var table = $('#billsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		buttons: [
		{
			extend: 'print',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			},
			customize: function ( doc ) {
				$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
				$(doc.document.body).find('h1').css('font-size', '24px');
				$(doc.document.body).find('h1').css('text-align', 'center'); 
			}
		},
		{
			extend: 'copyHtml5',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			}
		},
		{
			extend: 'excelHtml5',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			}
		},
		{
			extend: 'csvHtml5',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			}
		},
		{
			extend: 'pdfHtml5',
			exportOptions: {
				columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
			}
		}
		]});
	$('body').on('click', '#generateReport-Print', function () {
		table.button('0').trigger();
	});
	$('body').on('click', '#generateReport-Copy', function () {
		table.button('1').trigger();
	});
	$('body').on('click', '#generateReport-Excel', function () {
		table.button('2').trigger();
	});
	$('body').on('click', '#generateReport-CSV', function () {
		table.button('3').trigger();
	});
	$('body').on('click', '#generateReport-PDF', function () {
		table.button('4').trigger();
	});
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});

	$('.newbill-btn').on('click', function() {
		$('#newBillModal').modal('toggle');
	});
	$(document).on('click', '.removeBill', function() {
		if (!confirm('Remove Bill?')) {
			event.preventDefault();
		}
	});

	$(document).on('click', '.updbill-btn', function() {
		$('#updBillModal').modal('toggle');
		let tr = $(this).parents('tr');

		$('#bill_id').val(tr.attr('data-bill_id'));

		$('#bill_date').val(tr.attr('data-bill_date'));
		$('#bill_name').val(tr.attr('data-bill_name'));
		$('#bill_tinvat').val(tr.attr('data-bill_tinvat'));
		$('#bill_tinnon').val(tr.attr('data-bill_tinnon'));
		$('#bill_address').val(tr.attr('data-bill_address'));
		$('#bill_sinorn').val(tr.attr('data-bill_sinorn'));
		$('#bill_remarks').val(tr.attr('data-bill_remarks'));
		$('#bill_department').val(tr.attr('data-bill_department'));
	});

	// BILL GROUPING
	$(document).on('click', '.groupbill-btn', function(e) {
		$('#grpBillModal').modal('toggle');
	});

	$(document).on('click', '.groupbilladd-row', function() {
		// console.log($('.groupbilladd-row-' + $(this).data('groupbilladd-id')).length);
		if ($('.groupbilladded-row-' + $(this).data('groupbilladd-id')).length < 1) {
			let tr_added = $('<tr>').attr('class', 'groupbilladded-row-' + $(this).data('groupbilladd-id'))
				.append($('<td>').html($(this).find('.td_Date').html()))
				.append($('<td>').html($(this).find('.td_Name').html()))
				.append($('<td>').html($(this).find('.td_TINVAT').html()))
				.append($('<td>').html($(this).find('.td_TINNON').html()))
				.append($('<td>').html($(this).find('.td_Address').html()))
				.append($('<td>').html($(this).find('.td_Particulars').html()))
				.append($('<td>').html($(this).find('.td_Amount').html()))
				.append($('<td>').html($(this).find('.td_SINORN').html()))
				.append($('<td>').html($(this).find('.td_Remarks').html()))
				.append($('<td>').html($(this).find('.td_Department').html()))
				.append($('<td>')
					.append($('<button>').attr('class', 'btn btn-danger groupbilladded-remove').attr('type', 'button').html('X').data('groupbilladded-id', $(this).data('groupbilladd-id'))));
			$('#grpBillsTableAdd tbody').append(tr_added);

			$('#formGroupBill').append($('<input>').attr('class', 'groupbilladded-input-' + $(this).data('groupbilladd-id')).attr('type', 'hidden').attr('name', 'group_bills[]').val($(this).data('groupbilladd-id')));
		}
	});
	$(document).on('click', '.groupbilladded-remove', function() {
		$('.groupbilladded-input-' + $(this).data('groupbilladded-id')).remove();
		$(this).parents('tr').remove();
	});

	$('#groupbill_search').on('keyup change', function(){
		if ($(this).val().length > 0) {
			$.ajax({
				url: "searchBillExpenses",
				type: "POST",
				data: { search: $(this).val() },
				success: function(response) {
					var data = $.parseJSON(response);

					$('#grpBillsTable tbody').html('');
					$.each(data, function(index, val) {
						$('#grpBillsTable tbody').append(
							$('<tr>').attr('class', 'groupbilladd-row').data('groupbilladd-id', val.ID)
							.append($('<td>').attr('class', 'td_Date').html(val.Date))
							.append($('<td>').attr('class', 'td_Name').html(val.Name))
							.append($('<td>').attr('class', 'td_TINVAT').html(val.TINVAT))
							.append($('<td>').attr('class', 'td_TINNON').html(val.TINNON))
							.append($('<td>').attr('class', 'td_Address').html(val.Address))
							.append($('<td>').attr('class', 'td_Particulars').html(val.Particulars))
							.append($('<td>').attr('class', 'td_Amount').html(val.Amount))
							.append($('<td>').attr('class', 'td_SINORN').html(val.SINORN))
							.append($('<td>').attr('class', 'td_Remarks').html(val.Remarks))
							.append($('<td>').attr('class', 'td_Department').html(val.Department))
						);
					});
				}
			});
		}
	});


	// BILL GROUP ADD
	$(document).on('click', '.add-bill-row', function(e) {
		$(this).before(
			$('<tr>').attr({ 'class': 'bill-row' })
				.append($('<td>').attr('class', 'text-center bill-row-num').append($('<i>').html($('.bill-row').length + 1)))
				.append($('<td>').attr('class', 'text-center').append($('<input>').attr({
					'type': 		'text',
					'class': 		'form-control',
					'name': 		'particulars[]',
					'placeholder': 	'Particulars',
					'required': 	''
				})))
				.append($('<td>').attr('class', 'text-center').append($('<input>').attr({
					'type': 		'number',
					'class': 		'form-control',
					'name': 		'amount[]',
					'placeholder': 	'0.00',
					'step': 		'0.000001',
					'required':		''
				})))
				.append($('<td>').attr('class', 'text-center').append($('<button>').attr('class', 'btn btn-danger remove-bill-row').html('X')))

		);
	});
	$(document).on('click', '.remove-bill-row', function(e) {
		$(this).parents('tr').remove();

		$.each($('.bill-row-num'), function(index, val) {
			$(this).html('').append($('<i>').html(index + 1))
		});
	});

	// BILL SHOW
	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}
	$(document).on('click', '.showbill-btn', function(e) {
		let billno = $(this).data('billno');

		if (billno.length > 0) {
			$.ajax({
				url: 'getBillGroupData',
				type: 'GET',
				dataType: 'JSON',
				data: { bill_no : billno } ,
				success: function (response) {
					if (response.bills.length > 0) {
						$('.viewbill-row').remove();

						let bill = response.bill;
						let bills = response.bills;

						$('#addGroupBillNo').val(bill.GroupNo);

						$('.view_bill_date').html(bill.Date);
						$('.view_bill_name').html(bill.Name);
						$('.view_bill_tinvat').html(bill.TINVAT);
						$('.view_bill_tinnon').html(bill.TINNON);
						$('.view_bill_address').html(bill.Address);
						$('.view_bill_sinorn').html(bill.SINORN);
						$('.view_bill_remarks').html(bill.Remarks);
						$('.view_bill_department').html(bill.Department);

						$('#billsViewTable tbody').html('');
						let total_bill_amount = 0;
						$.each(bills, function(index, val) {
							total_bill_amount += parseFloat(val.Amount);
							$('#billsViewTable tbody').append($('<tr>')
								.append($('<td>').attr('class', 'text-center').append($('<i>').html(index + 1)))
								.append($('<td>').attr('class', 'text-center').html(val.Particulars))
								.append($('<td>').attr('class', 'text-center').html(moneyFormat(parseFloat(val.Amount))))
								.append($('<td>').attr('class', 'text-center')
									.append($('<a>').attr('class', 'btn btn-danger removeBill').attr('href', 'FORM_removeBill?bno=' + val.BillNo).html('X')))
							);
						});
						$('#billsViewTable tbody').append($('<tr>')
							.append($('<td>').attr('colspan', '2').attr('class', 'fw-bold text-end').html('TOTAL:'))
							.append($('<td>').attr('class', 'text-center').html(moneyFormat(parseFloat(total_bill_amount))))
							.append($('<td>').html(''))
						);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
		}

		$('#grpViewBillModal').modal('toggle');
	});
	$(document).on('click', '.add-viewbill-row', function(e) {
		$(this).before(
			$('<tr>').attr({ 'class': 'viewbill-row' })
				.append($('<td>').attr('class', 'text-center viewbill-row-num').append($('<i>').html($('.viewbill-row').length + 1)))
				.append($('<td>').attr('class', 'text-center').append($('<input>').attr({
					'type': 		'text',
					'class': 		'form-control',
					'name': 		'particulars[]',
					'placeholder': 	'Particulars',
					'required': 	''
				})))
				.append($('<td>').attr('class', 'text-center').append($('<input>').attr({
					'type': 		'number',
					'class': 		'form-control',
					'name': 		'amount[]',
					'placeholder': 	'0.00',
					'step': 		'0.000001',
					'required':		''
				})))
				.append($('<td>').attr('class', 'text-center').append($('<button>').attr('class', 'btn btn-danger remove-viewbill-row').html('X')))

		);
	});
	$(document).on('click', '.remove-viewbill-row', function(e) {
		$(this).parents('tr').remove();

		$.each($('.viewbill-row-num'), function(index, val) {
			$(this).html('').append($('<i>').html(index + 1))
		});
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>assets/js/main.js"></script>
</body>

</html>
