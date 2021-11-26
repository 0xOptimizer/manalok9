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
$getAllProducts = $this->Model_Selects->GetAllProducts();
$getAllProductsv2 = $this->Model_Selects->GetAllProductsv2();

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
	/* Chrome, Safari, Edge, Opera */
	.num-noarrow::-webkit-outer-spin-button,
	.num-noarrow::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	.num-noarrow {
	  -moz-appearance: textfield;
	}
	.modal-content-custom  {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important; 
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
						<h3>Products
							<span class="text-center success-banner-sm">
								<i class="bi bi-bag-fill"></i> <?=$getAllProductsv2->num_rows();?> TOTAL
							</span>
							<?php if ($getAllProductsv2->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No products found.
								</span>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW</button> -->
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<!-- <button type="button" class="newproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW PRODUCT</button> -->
						<button type="button" class="addproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> ADD PRODUCT</button>
						|
						<!-- <button type="button" class="newtransaction-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cart-plus"></i> NEW TRANSACTION</button> -->
						<a href="<?=base_url() . 'admin/inventory';?>" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-folder-symlink-fill"></i> VIEW IN INVENTORY</a>
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
							<th>ID</th>
							<th>BARCODE</th>
							<th>CODE</th>
							<th>NAME</th>
							<th>CATEGORY</th>
							<th>DESCRIPTION</th>
							<th>IN STOCK</th>
							<th>RELEASED</th>
							<th></th>
						</thead>
						<tbody>
							<!-- TEMPORARY REMOVED -->
							<!-- data-code="<?=$row['Code'];?>" data-urlredirect="<?=base_url() . 'admin/viewproduct?code=' . $row['Code'];?>" -->
							<?php
							if ($getAllProductsv2->num_rows() > 0):
								foreach ($getAllProductsv2->result_array() as $row): ?>
									<tr>
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td width="100">
											<div class="p-2 text-center" style="background-color: white;">
												<img src="<?=base_url();?><?=$row['Barcode_Images']?>" width="95" alt="No image">
											</div>
										</td>
										<td>
											<?=$row['Code']?>
										</td>
										<td>
											<?=$row['Product_Name']?>
										</td>
										<td>
											<?=$row['Product_Category']?>
										</td>
										<td>
											<?=$row['Description']?>
										</td>
										<td>
											<?=$row['InStock']?>
										</td>
										<td>
											<?=$row['Released']?>
										</td>
										<td class="text-center">
											<span style="margin-right: 5px;">
												<a href="<?=base_url() . 'admin/viewproduct?code=' . $row['Code'];?>">
													<i class="bi bi-eye" style="color: #408AF7;"></i>
												</a>
											</span>
											<span style="margin-right: 5px;">
												<a href="#">
													<i class="bi bi-pencil" style="color: #229F4B;"></i>
												</a>
											</span>
											<span style="margin-right: 5px;">
												<a class="delete_product" href="#" data-value="<?php echo $row['Code'] ;?>">
													<i class="bi bi-trash" style="color: #CF3939;"></i>
												</a>
											</span>
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
<!-- New product modal -->
<?php $this->load->view('admin/modals/add_product.php'); ?>
<?php $this->load->view('admin/modals/add_productV2.php'); ?>
<!-- New transactions modal -->
<?php $this->load->view('admin/modals/add_transaction.php'); ?>
<!-- Prompts modal -->
<?php $this->load->view('admin/modals/prompts/prompt_delete.php'); ?>

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
		$('#productsTable').find("[data-code='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.newproduct-btn').on('click', function() {
		$('#newProductModal').modal('toggle');
	});
	$('.addproduct-btn').on('click', function() {
		$('#add_productModal').modal('toggle');
	});
	
	$('.newtransaction-btn').on('click', function() {
		$('#newTransactionModal').modal('toggle');
	});
	
	var table = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 3, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
	$("textarea").each(function () {
		this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
	}).on("input", function () {
		this.style.height = "auto";
		this.style.height = (this.scrollHeight) + "px";
	});

	// ADD NEW PRODUCT MODAL
	$('#generate_code').on('click', function() {
		var set_brand1 = $('.set_brand1').find('option:selected').val();
		var set_line = $('.set_line').find('option:selected').val();
		var set_type = $('.set_type').find('option:selected').val();
		var set_variant = $('.set_variant').find('option:selected').val();
		var set_size = $('.set_size').find('option:selected').val();
		var set_char = $('.set_char').find('option:selected').val();
		
		

		if (set_brand1 == "" || set_line == "" || set_type == "" || set_variant == "" || set_size == "" || set_char == "") {
			alert('Option not selected.');
		}
		else
		{
			$('.product_codegen').val(set_brand1 + set_char + set_line + set_type + set_variant + set_size);
			alert('ID generated : ' + set_brand1 + set_char + set_line + set_type + set_variant + set_size)
		}
	});
	// DELETE PRODUCT
	$('.delete_product').on('click', function() {
		$('#prompt_delete').modal('toggle');
		$('#item_id').text($(this).attr('data-value'));
		$('#movetoarchive').prop("href", '<?=base_url()?>admin/move_to_archive?code='+$(this).attr('data-value'));
		
	});
	$('#cancel_movetoarchive').on('click', function() {
		$('#prompt_delete').modal('toggle');
	});
	
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
