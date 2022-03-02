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
		$Prd_Name = $row['Product_Name'];
		$productDescription = $row['Description'];
		$productCode = $row['Code'];
		$inStocks = $row['InStock'];
	}
}
$prd_det = $getProductByCode->row_array();
$skuCode = $productCode;
$GetProductDetails = $this->Model_Selects->GetProductDetails($skuCode);
$getTransactionsByCode = $this->Model_Selects->GetTransactionsByCode($code);

$prd_details = $GetProductDetails->row_array();

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
							<h3><?=$Prd_Name;?>
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
					<div class="col-sm-12 col-lg-12">
						<button type="button" class="generatereport-btn btn btn-sm-primary">GENERATE REPORT</button>
					</div>
					<div class="col-12 col-sm-12 my-4">
						<h6>
							PRODUCT
						</h6>
						<div class="p-3">
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2">
									BARCODE IMAGE
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<div class="p-2">
										<a href="<?php echo base_url().''.$prd_det['Barcode_Images']; ?>" target="_blank">
											<img src="<?php echo base_url().''.$prd_det['Barcode_Images']; ?>">
										</a>
									</div>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									UID
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['U_ID'] == '') ? '-----' : $prd_det['U_ID']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									PRODUCT SKU
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['Code'] == '') ? '-----' : $prd_det['Code']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									PRODUCT NAME
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['Product_Name'] == '') ? '-----' : $prd_det['Product_Name']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									TOTAL STOCK
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['InStock'] == '') ? '-----' : $prd_det['InStock']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									TOTAL RELEASED
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['Released'] == '') ? '-----' : $prd_det['Released']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									CATEGORY
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['Product_Category'] == '') ? '-----' : $prd_det['Product_Category']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									PRICE PER ITEM
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									&#8369; <?php echo ($prd_det['Price_PerItem'] == '') ? '-----' : $prd_det['Price_PerItem']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									COST PER ITEM
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									&#8369; <?php echo ($prd_det['Cost_PerItem'] == '') ? '-----' : $prd_det['Cost_PerItem']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									DATE ADDED
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['DateAdded'] == '') ? '-----' : $prd_det['DateAdded']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									DESCRIPTION
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_det['Description'] == '') ? '-----' : $prd_det['Description']; ?>
								</dd>
							</dl>
						</div>
					</div>
					<div class="col-12 col-sm-12 my-4">
						<h6>
							PRODUCT DETAILS
						</h6>
						<div class="p-3">
							<dl class="row">
								<dt class="col-12 col-sm-12 col-md-2">
									BRAND
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_details['Second_brand'] == '') ? '-----' : $prd_details['Second_brand']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									CHAR
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_details['prd_char'] == '') ? '-----' : $prd_details['prd_char']; ?>
								</dd>
								<dt class="col-12 col-sm-12 col-md-2">
									TYPE
								</dt>
								<dd class="col-12 col-sm-12 col-md-10">
									<?php echo ($prd_details['char_type'] == '') ? '-----' : $prd_details['char_type']; ?>
								</dd>
							</dl>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12">
						<h6>
							TRANSACTIONS
						</h6>
						<div class="table-responsive">
							<table id="productsTable" class="table">
								<thead style="font-size: 12px;">
									<th>TRANSACTION ID</th>
									<th>TYPE</th>
									<th>AMOUNT</th>
									<th>DATE</th>
									<TH>STATUS</TH>
								</thead>
								<tbody>
									<?php
									if ($getProductByCode->num_rows() > 0):
										if ($getTransactionsByCode->num_rows() > 0):
											foreach ($getTransactionsByCode->result_array() as $row):
												$typeText = '<span class="text-primary"><i class="bi bi-arrow-down-left-square"></i> Restock</span>';
												if ($row['Type'] == 1) {
													$typeText = '<span class="text-info"><i class="bi bi-arrow-up-right-square"></i> Released</span>';
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
														<?=$row['Date'];?>
													</td>
													<td>
														<?php
														switch ($row['Status']) {
															case '0':
															echo '<span class="text-center info-banner-sm">
															Pending Approval
															</span>';
															break;
															case '1':
															echo '<span class="text-center success-banner-sm">
															Approved
															</span>';
															break;
															
															default:
															echo "";
															break;
														}
														?>
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
					<!-- <div class="col-sm-12 col-lg-4">
						<b>MONITORING</b>
						<div class="row">
							<div class="col-sm-12 mt-2">
								<button type="button" class="newtransaction-btn btn btn-info"><i class="bi bi-cart-plus"></i> ADD A NEW TRANSACTION</button>
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
					</div> -->
				</div>
			</section>
		</div>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>
<!-- New transactions modal -->
<?php $this->load->view('admin/modals/add_newTransaction.php'); ?>

<?php $this->load->view('admin/modals/generate_report')?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>

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

		var table = $('#productsTable').DataTable( {
			sDom: 'lrtip',
			'bLengthChange': false,
			'order': [[ 0, 'desc' ]],
			buttons: [
			{
				extend: 'print',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
				},
				customize: function ( doc ) {
					$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
					$(doc.document.body).find('h1').css('font-size', '24px');
					$(doc.document.body).find('h1').css('text-align', 'center'); 
				},
				title: function(){
					var printTitle = productCode;
					return printTitle
				}
			},
			{
				extend: 'copyHtml5',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'excelHtml5',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'csvHtml5',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
				}
			},
			{
				extend: 'pdfHtml5',
				exportOptions: {
					columns: [ 0, 1, 2, 3, 4 ]
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

    // NEW TRANSACTION
    var skuCode = '<?=$code;?>';
    $('.btn-add_transaction').on('click', function() {
    	$('#new_transactionModal').modal('toggle');

    	$('#transaction-code').val(skuCode);
    	$('#transaction-codes').html(skuCode);
    });
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
