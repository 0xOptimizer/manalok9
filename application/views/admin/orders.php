<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
// $date = date('M j, Y');

// if ($this->input->get('date')) {
// 	$date = $this->input->get('date');
// 	$date = date('M j, Y', strtotime($date));
// }
// $isCurrentDate = false;
// if ($date == date('M j, Y')) {
// 	$isCurrentDate = true;
// }

// Fetch Purchase Orders
$getAllPurchaseOrders = $this->Model_Selects->GetOrders();

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
						</thead>
						<tbody>
							<?php
							if ($getAllPurchaseOrders->num_rows() > 0):
								foreach ($getAllPurchaseOrders->result_array() as $row): ?>
									<tr data-id="<?=$row['ID'];?>" class="tr_class_modal" id="<?=$row['SeriesNo']?>" data-seriesno="<?=$row['SeriesNo'];?>" data-datecreation="<?=$row['DateCreation'];?>" data-clientname="<?=$row['ClientName'];?>" data-shipaddress="<?=$row['ShipAddress'];?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['SeriesNo']?>
										</td>
										<td class="text-center">
											<?=$row['DateCreation']?>
										</td>
										<td class="text-center">
											<?=$this->Model_Selects->GetOrderTransactions($row["ID"])->num_rows()?>
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
	
	$('.tr_class_modal').on('click', function() {
		$('#PurchaseOrderModal').modal('toggle');

		$('.m_orderid').text($(this).data('id'));
		$('.m_seriesno').text($(this).data('seriesno'));
		$('.m_datecreation').text($(this).data('datecreation'));
		$('.m_shipaddress').text($(this).data('shipaddress'));
		$('.m_clientname').text($(this).data('clientname'));

		// order transaction list
		var order_id = $(this).data('id');
		$.ajax({
			url: 'getOrderDetails',
			type: 'GET',
			dataType: 'JSON',
			data: { order_id : order_id } ,
			success: function (response) {
				if ($.fn.dataTable.isDataTable('#orderTransactionsTable')) {
					$('#orderTransactionsTable').DataTable().destroy();
				}
				$('#orderTransactionsTable').DataTable( {
					'aaData': response,
					'columns': [
						{ data: 'ID', title: 'ID' },
						{ data: 'Code', title: 'CODE' },
						{ data: 'TransactionID', title: 'TRANSACTION ID' },
						{ data: 'Type', title: 'TYPE' },
						{ data: 'Amount', title: 'AMOUNT' },
						{ data: 'DateAdded', title: 'TRANSACTION DATE' },
						{ data: 'Status', title: 'STATUS' },
					],
					sDom: 'lrtip',
					'bLengthChange': false,
			    	'order': [[ 0, 'desc' ]],
			    });
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
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
	console.log(table.rows().data());
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
	$('.add-transaction-row').on('click', function() {
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
				.append($('<td>').attr({
					class: 'toCode'
				}).html($(this).children('.tCode').html()))
				.append($('<td>').attr({
					class: 'toReleased'
				}).html($(this).children('.tReleased').html()))
				.append($('<td>').attr({
					class: 'toDate'
				}).html($(this).children('.tDate').html()))
				.append($('<td>').append($('<button>').attr({
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
	$(document).on("click", ".remove-transaction-btn", function() {
		$(this).parents("tr").remove();
		updOTCount();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
