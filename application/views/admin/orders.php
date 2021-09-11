<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
// Fetch Purchase Orders
$getAllPurchaseOrders = $this->Model_Selects->GetAllOrders();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>
<style>
	.rotate-text {
		-webkit-transform:rotate(-75deg);
	}
	.card-container a {
		text-decoration: none;
	}
	.card-headers {
		border-radius: 3px 3px 0px 0px;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
		padding-left: 20px;
		color: #FFFFFF;
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
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6">
						<h3>Purchase Orders
							<span class="text-center success-banner-sm">
								<i class="bi bi-bag-fill"></i> <?=$getAllPurchaseOrders->num_rows();?> TOTAL
							</span>
							<?php if ($getAllPurchaseOrders->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Purchase Orders found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="neworder-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW PURCHASE ORDER</button>
						|
						<button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
						<a href="viewsummary">
							<button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-list"></i> SUMMARY</button>
						</a>
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
					<table id="ordersTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">SERIES NO</th>
							<th class="text-center">DATE</th>
							<th class="text-center">ITEMS</th>
							<th class="text-center">STATUS</th>
						</thead>
						<tbody>
							<?php
							if ($getAllPurchaseOrders->num_rows() > 0):
								foreach ($getAllPurchaseOrders->result_array() as $row): ?>
									<tr data-id="<?=$row['ID'];?>" class="tr_class_modal" id="<?=$row['SeriesNo']?>" data-seriesno="<?=$row['SeriesNo'];?>" data-datecreation="<?=$row['DateCreation'];?>" data-clientname="<?=$row['ClientName'];?>" data-shipaddress="<?=$row['ShipAddress'];?>" data-status="<?=$row['Status'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['SeriesNo']?>
										</td>
										<td class="text-center">
											<?=$row['DateCreation']?>
										</td>
										<?php $orderTransactions = $this->Model_Selects->GetOrderTransactions($row["ID"]); ?>
										<td class="text-center">
											<?=$orderTransactions->num_rows()?>
										</td>
										<td class="text-center">
											<?php if ($row['Status'] == '1'): ?>
												<span><i class="bi bi-asterisk" style="color:#E4B55B;"></i> For Approval</span>
											<?php elseif ($row['Status'] == '2'): ?>
												<span><i class="bi bi-cash" style="color:#E4B55B;"></i> Waiting For Payment</span>
											<?php else: ?>
												<span><i class="bi bi-trash text-danger"></i> Rejected</span>
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
<?php $this->load->view('admin/modals/add_order'); ?>
<?php $this->load->view('admin/modals/order_modal'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-orders').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#ordersTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>

	$(document).on('click', '.tr_class_modal', function() {
		$('#PurchaseOrderModal').modal('toggle');

		$('.m_inp_orderid').val($(this).data('id'));
		$('.m_orderid').text($(this).data('id'));
		$('.m_seriesno').text($(this).data('seriesno'));
		$('.m_datecreation').text($(this).data('datecreation'));
		$('.m_shipaddress').text($(this).data('shipaddress'));
		$('.m_clientname').text($(this).data('clientname'));
		if ($(this).data('status') < 1) {
			$('.approvePurchaseOrder').attr('disabled', '');
		} else {
			$('.approvePurchaseOrder').removeAttr('disabled');
		}

		// order transaction list
		var order_id = $(this).data('id');
		$('#orderTransactionsTable tbody').hide();
		$.get('getOrderDetails', { dataType: 'json', order_id: order_id })
		.done(function(data) {
			if ($.fn.dataTable.isDataTable('#orderTransactionsTable')) {
				$('#orderTransactionsTable').DataTable().destroy();
			}
			$('#orderTransactionsTable tbody').html('');

			var transactions = $.parseJSON(data);
			$.each(transactions, function(index, val) {
				$('#orderTransactionsTable tbody').append($('<tr>')
					.append($('<td>').attr({ class: 'text-center' }).append($('<span>').attr({ class: 'db-identifier' }).css({ 'font-style': 'italic', 'font-size': '12px' }).html(val['ID'])))
					.append($('<td>').attr({ class: 'text-center' }).html(val['Code']))
					.append($('<td>').attr({ class: 'text-center' }).html(val['TransactionID']))
					.append($('<td>').attr({ class: 'text-center' }).html(val['Amount']))
					.append($('<td>').attr({ class: 'text-center' }).html(val['Date']))
					.append($('<td>').attr({ class: 'text-center' }).html(
						(val['Status'] == '0' ? '<i class="bi bi-asterisk" style="color:#E4B55B;"></i>' : '<i class="bi bi-file-check" style="color:#55B73E;"></i>')
					))
					.append($('<td>').attr({ class: 'text-center removeot-btn' }).data('id', val['TransactionID']).html('<i class="bi bi-x-square text-danger"></i>'
					))
				);
			});

			$('#orderTransactionsTable').DataTable( {
				sDom: 'lrtip',
				'bLengthChange': false,
				'order': [[ 0, 'desc' ]],
			});
			$('#orderTransactionsTable tbody').show();
		});
	});
	$(document).on('click', '.removeot-btn', function() {
		if (!confirm('Remove Transaction from Purchase Order?') && $(this).data('id').length > 0) {
			event.preventDefault();
		} else {
			$.ajax({
				url: 'FORM_removePurchaseOrderTransaction',
				type: 'POST',
				
				data: { transaction_id : $(this).data('id') } ,
				success: function (response) {
					if (response == 'SUCCESS') {
						alert('Transaction removed.');
					} else {
						alert('ERROR');
					}
					location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert(textStatus, errorThrown);
				}
			});
		}
	});
	$('.neworder-btn').on('click', function() {
		$('#AddOrderModal').modal('toggle');
	});
	
	var table = $('#ordersTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
	var tableTransactions = $('#transactionsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableTransactionsSearch').on('keyup change', function(){
		tableTransactions.search($(this).val()).draw();
	});

	function updOTCount() {
		// update order transaction count
		$('#TransactionsCount').val($('.orderTransaction').length);
		// update order transsaction input names
		$.each($('.orderTransaction input'), function(i, val) {
			$(this).attr('name', 'tInput' + i);
		});
		// total
		let totalReleased = 0;
		$.each($('.toReleased'), function(i, val) {
			totalReleased += parseFloat($(this).html());
		});
		$('.transactionsTotal .released').html(totalReleased);
		// empty transaction
		if ($('.orderTransaction').length > 0) {
			$('.noTransaction').hide();
		} else {
			$('.noTransaction').show();
		}
	}
	$(document).on('click', '.add-transaction-row', function() {
		let trClassName = 'ot' + $(this).data('id');
		if ($('.' + trClassName).length < 1) {
			$('.transactionsTotal').before($('<tr>')
				.attr({
					'class': 'orderTransaction highlighted ' + trClassName
				}).css('display', 'none')
				.append($('<input>').attr({
					type: 'hidden',
					value: $(this).data('id')
				}))
				.append($('<td>').attr({ class: 'text-center' }).append($('<span>').attr({ class: 'db-identifier' }).css({ 'font-style': 'italic', 'font-size': '12px' }).html($(this).data('id'))))
				.append($('<td>').attr({ class: 'text-center' }).html($(this).children('.tCode').html()))
				.append($('<td>').attr({
					class: 'toReleased text-center'
				}).html($(this).children('.tReleased').html()))
				.append($('<td>').attr({ class: 'text-center' }).html($(this).children('.tDate').html()))
				.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
					type: 'button',
					class: 'btn remove-transaction-btn'
				}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
			);
			updOTCount();
			setTimeout(function() {
				$('.' + trClassName).removeClass('highlighted');
			}, 2000);
			$('.' + trClassName).fadeIn('2000');
		}
	});
	$(document).on('click', '.remove-transaction-btn', function() {
		$(this).parents('tr').remove();
		updOTCount();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
