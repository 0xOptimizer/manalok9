<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
$date = date('M j, Y');

if ($this->input->get('date')) {
	$date = $this->input->get('date');
	$date = date('M j, Y', strtotime($date));
}
$isCurrentDate = false;
if ($date == date('M j, Y')) {
	$isCurrentDate = true;
}

// Fetch products
if ($this->session->userdata('Privilege') > 1) {
	$getAllTransactions = $this->Model_Selects->getAllTransactions();
} else {
	$getAllTransactions = $this->Model_Selects->GetTransactionsByUserID($this->session->userdata('UserID'));
}

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
						<h3>Transactions
							<span class="text-center success-banner-sm">
								<i class="bi bi-bag-fill"></i> <?=$getAllTransactions->num_rows();?> TOTAL
							</span>
							<?php if ($getAllTransactions->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No Transaction found.
								</span>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW</button> -->
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="newproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
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
					<table id="productsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">CODE</th>
							<th class="text-center">TRANSACTION ID</th>
							<th class="text-center">TYPE</th>
							<th class="text-center">AMOUNT</th>
							<th class="text-center">TRANSACTION DATE</th>
							<th class="text-center">STATUS</th>
						</thead>
						<tbody>
							<?php
							if ($getAllTransactions->num_rows() > 0):
								foreach ($getAllTransactions->result_array() as $row): ?>
									<tr class="tr_class_modal" id="<?=$row['TransactionID']?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['Code']?>
										</td>
										<td class="text-center">
											<?=$row['TransactionID']?>
										</td>
										<td class="text-center">
											<?php
											switch ($row['Type']) {
												case '0':
													echo '<span class="text-primary"><i class="bi bi-arrow-down-left-square"></i> Restock</span>';
													break;
												case '1':
													echo '<span class="text-info"><i class="bi bi-arrow-up-right-square"></i> Released</span>';
													break;

												default:
													echo "";
													break;
											}
											?>
										</td>
										<td class="text-center">
											<?=$row['Amount']?>
										</td>
										<td class="text-center">
											<?=$row['Date']?>
										</td>
										<td class="text-center">
											<?php
											switch ($row['Status']) {
												case '0':
												echo '<span><i class="bi bi-asterisk" style="color:#E4B55B;"></i> For Approval</span>';
												break;
												case '1':
												echo '<span><i class="bi bi-file-check" style="color:#55B73E;"></i> Approved</span>';
												break;

												default:
												echo "";
												break;
											}
											?>
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
<?php $this->load->view('admin/modals/transaction_modal'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-transactions').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#productsTable').find("[data-code='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	$('.tr_class_modal').on('click', function() {
		$('#TransactionDetails').modal('toggle');

		var transaction_id = $(this).attr('id');

		$.ajax({
			url: "getTransactionDetails",
			type: "GET",
			dataType: "JSON",
			data: { transaction_id : transaction_id } ,
			success: function (response) {
				$('.m_transactionid').text(response.TransactionID);
				if (response.Type == 0) {
					$('.m_Type').text('RESTOCK : ' + response.Amount);
				} else {
					$('.m_Type').text('RELEASE : ' + response.Amount);
				}
				$('.m_transactiondate').text(response.Date);
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	$('.btn_transactionM').on('click', function() {
		$('#TransactionDetails').modal('toggle');
	});
	$('#Approve_TransactionBTN').on('click', function() {
		var transaction_id = $('.m_transactionid').text();
     	$.ajax({
			url: "FORM_approveTransaction",
			type: "POST",
			
			data: { transaction_id : transaction_id } ,
			success: function (response) {
				if (response == 'NO_STOCK') {
					alert("Out of Stocks");
					window.location.replace("<?=base_url()?>admin/view_transactions");
				} else if (response == 'APPROVED') {
					alert("REDUNDANT TRANSACTION");
					window.location.replace("<?=base_url()?>admin/view_transactions");
				}
				else if (response == 'NEW_STOCK_ADDED') {
					alert("NEW STOCK ADDED");
					window.location.replace("<?=base_url()?>admin/view_transactions");
				}
				else if (response == 'STOCK_RELEASE') {
					alert("STOCK RELEASE");
					window.location.replace("<?=base_url()?>admin/view_transactions");
				}
				else if (response == 'ERROR') {
					alert("OUCH!");
					window.location.replace("<?=base_url()?>admin/view_transactions");
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(textStatus, errorThrown);
			}
		});
	});
	
	$('#TransactionDetails').modal({
	    backdrop: 'static',
	    keyboard: false
	});
	
	var table = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 3, "desc" ]],
    });
    $('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
