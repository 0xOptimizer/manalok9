<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
$code = 'N/A';

if ($this->input->get('code')) {
	$code = $this->input->get('code');
}
$productDescription = 'No product found with that code';
$productCode = 'N/A';
$inStocks = 0;
$doesProductExist = false;
$getProductByCode = $this->Model_Selects->GetProductByCode($code);
if ($getProductByCode->num_rows() > 0) {
	$doesProductExist = true;
	foreach($getProductByCode->result_array() as $row) {
		$productDescription = $row['Description'];
		$productCode = $row['Code'];
		$inStocks = $row['InStock'];
	}
}
$getTransactionsByCode = $this->Model_Selects->GetTransactionsByCode($code);

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
			<a href="<?=base_url() . 'admin/products'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO ALL PRODUCTS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6">
						<h3><?=$productDescription;?>
							<span class="text-center info-banner-sm">
								<?=$productCode;?>
							</span>
							<span class="text-center success-banner-sm">
								<i class="bi bi-bag-fill"></i> <?=$inStocks;?> IN STOCK
							</span>
							<!-- <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW</button> -->
						</h3>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="row">
					<div class="col-sm-12 col-lg-8">
						<b>LATEST TRANSACTIONS - <button type="button" class="btn btn-sm-primary">GENERATE REPORT</button></b>
						<div class="table-responsive">
							<table id="productsTable" class="table">
								<thead style="font-size: 12px;">
									<th>TRANSACTION ID</th>
									<th>TYPE</th>
									<th>AMOUNT</th>
									<th>IN STOCK</th>
									<th>DATE</th>
								</thead>
								<tbody>
									<?php
									if ($getProductByCode->num_rows() > 0):
										if ($getTransactionsByCode->num_rows() > 0):
											foreach ($getTransactionsByCode->result_array() as $row):
												$typeText = '<i class="bi bi-arrow-down-left-square"></i> Restock';
												if ($row['Type'] == 1) {
													$typeText = '<i class="bi bi-arrow-up-right-square"></i> Released';
												}?>
												<tr data-transactionid="<?=$row['TransactionID'];?>">
													<td>
														<?=$row['TransactionID'];?>
													</td>
													<td>
														<?=$typeText;?>
													</td>
													<td>
														<?=$row['Amount'];?>
													</td>
													<td>
														<?=$row['InStock'];?>
													</td>
													<td>
														<?=$row['Date'];?>
													</td>
												</tr>
											<?php endforeach;
										else: ?>
											<tr>
												<td>
													<span class="info-banner-sm">
														<i class="bi bi-exclamation-diamond-fill"></i> No transaction records found for this product.
													</span>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
												<td>
												</td>
											</tr>
										<?php endif;
									endif; ?>
									<!-- <tr>
										<td>
											<button type="button" class="btn btn-sm-primary"><i class="bi bi-caret-down"></i> LOAD MORE</button>
										</td>
										<td>
											--
										</td>
										<td>
											--
										</td>
										<td>
											--
										</td>
										<td>
											--
										</td>
									</tr> -->
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-12 col-lg-4">
						<b>MONITORING</b>
						<div class="row">
							<div class="col-sm-12 mt-2">
								<button type="button" class="newtransaction-btn btn btn-primary"><i class="bi bi-cart-plus"></i> ADD A NEW TRANSACTION</button>
							</div>
							<div class="col-sm-12 mt-4">
								<span style="font-size: 12px;">THIS WEEK</span>
							</div>
							<div class="col-sm-12 mt-1" style="font-size: 14px;">
								<span style="font-size: 20px;"><b>123</b></span> total stocks were moved:
							</div>
							<div class="col-sm-12 mt-1" style="font-size: 14px;">
								<span style="font-size: 17px;"><b>123</b></span> stocks were added,
							</div>
							<div class="col-sm-12 mt-1" style="font-size: 14px;">
								<span style="font-size: 17px;"><b>123</b></span> stocks were released,
							</div>
							<div class="col-sm-12 mt-1" style="font-size: 14px;">
								in <span style="font-size: 20px;"><b>123</b></span> transactions
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- New transactions modal -->
<?php $this->load->view('admin/modals/add_transaction.php'); ?>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-products').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#productsTable').find("[data-transactionid='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	var productCode = "<?=$code;?>";
	$('.newtransaction-btn').on('click', function() {
		$('#newTransactionModal').modal('toggle');
		$('#transaction-code').val(productCode);
	});
	/*
	var table = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 1, "desc" ]],
    	buttons: [
        {
            extend: 'print',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            },
            customize: function ( doc ) {
            	$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/img/wercher_logo.png" width="63px" height="56px" />');
				$(doc.document.body).find('h1').css('font-size', '24px');
				$(doc.document.body).find('h1').css('text-align', 'center'); 
			}
        },
        {
            extend: 'copyHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'excelHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'csvHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        }
    ]});
	$('#ExportPrint').on('click', function () {
        table.button('0').trigger();
    });
    $('#ExportCopy').on('click', function () {
        table.button('1').trigger();
    });
    $('#ExportExcel').on('click', function () {
        table.button('2').trigger();
    });
    $('#ExportCSV').on('click', function () {
        table.button('3').trigger();
    });
    $('#ExportPDF').on('click', function () {
        table.button('4').trigger();
    });
    */
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
