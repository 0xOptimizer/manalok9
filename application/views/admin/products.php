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
	.alert {
		border-radius: 0px;
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
							<h3><i class="bi bi-bag-fill"></i> Products
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
							<?php if ($this->session->userdata('UserRestrictions')['products_add']): ?>
								<button type="button" class="addproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> ADD PRODUCT</button>
								|
							<?php endif; ?>
							<button type="button" class="generatereport-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE REPORT</button>
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
								<?php
								if ($getAllProductsv2->num_rows() > 0):
									foreach ($getAllProductsv2->result_array() as $row): ?>
										<tr>
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
												<?php if (strlen($row['Description']) > 50) {
													$str = substr($row['Description'], 0, 50) . '...';
													echo $str;
												} else {
													echo $row['Description'];
												}?>

											</td>
											<td>
												<?=$row['InStock']?>
											</td>
											<td>
												<?=$row['Released']?>
											</td>
											<td class="text-center"  width="150">
												<span style="margin-right: 5px;">
													<a href="<?=base_url() . 'admin/viewproduct?code=' . $row['Code'];?>">
														<i class="bi bi-eye" style="color: #408AF7;"></i>
													</a>
												</span>
												<?php if ($this->session->userdata('UserRestrictions')['products_edit']): ?>
													<span style="margin-right: 5px;">
														<a class="update_prd" href="#" data-value="<?=$row['ID']?>">
															<i class="bi bi-pencil" style="color: #229F4B;"></i>
														</a>
													</span>
												<?php endif; ?>
												<?php if ($this->session->userdata('UserRestrictions')['products_delete']): ?>
													<span style="margin-right: 5px;">
														<a class="delete_product" href="#" data-value="<?php echo $row['Code'] ;?>">
															<i class="bi bi-trash" style="color: #CF3939;"></i>
														</a>
													</span>
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

	<!-- New product modal -->
	<?php $this->load->view('admin/_modals/products/add_productV2.php'); ?>
	<!-- Prompts modal -->
	<?php $this->load->view('admin/_modals/products/prompt_delete.php'); ?>
	<!-- Update modal -->
	<?php $this->load->view('admin/_modals/products/update_product.php'); ?>

	<?php $this->load->view('admin/_modals/generate_report')?>

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
				'bLengthChange': false,
				'order': [[ 0, 'desc' ]],
				buttons: [
				{
					extend: 'print',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
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
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				},
				{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
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
	// $('.delete_product').on('click', function() {
	$(document).on('click', '.delete_product', function() {
		$('#prompt_delete').modal('toggle');
		$('#item_id').text($(this).attr('data-value'));
		$('#movetoarchive').prop("href", '<?=base_url()?>admin/move_to_archive?code='+$(this).attr('data-value'));
		
	});
	$('#cancel_movetoarchive').on('click', function() {
		$('#prompt_delete').modal('toggle');
	});
	// FILL SELECTS
	$('#sel_brandname').on('change', function() {
		var uid = $(this).find("option:selected").attr('data-value');

		$.ajax({
			url: '<?=base_url()?>Fill_Select_BrandData',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				
				var data = $.parseJSON(response);
				if (data['status_response'] == 0) {
					// CLEAR ALL SELECT
					$('#sel_brandchar').empty();
					$('#sel_brandtype').empty();
					$('#sel_brandnameabbr').empty();
					$('#sel_brandline').empty();
					$('#sel_brandtypess').empty();
					$('#sel_brandvariants').empty();
					$('#sel_brandsizes').empty();
				}
				else
				{
					$('#sel_brandchar').empty();
					$('#sel_brandtype').empty();
					$('#sel_brandnameabbr').empty();
					$('#sel_brandline').empty();
					$('#sel_brandtypess').empty();
					$('#sel_brandvariants').empty();
					$('#sel_brandsizes').empty();
					

					
					for (var i = 0; i < data['brand_category'].length; i++) {
						var brand_char = data['brand_category'][i].Brand_Char;
						var brand_type = data['brand_category'][i].Brand_Type;

						$('#sel_brandchar').append('<option value="'+brand_char+'">'+brand_char+'</option>');
						
						$('#sel_brandtype').append('<option value="'+brand_type+'">'+brand_type+'</option>');
					}
					for (var i = 0; i < data['brand_properties'].length; i++) {

						var Brand_Abbr = data['brand_properties'][i].Brand_Abbr;
						var prd_line = data['brand_properties'][i].Product_Line;
						var prd_lineabbr = data['brand_properties'][i].Product_line_Abbr;
						var prd_type = data['brand_properties'][i].Product_Type;
						var prd_typeabbr = data['brand_properties'][i].Product_Type_Abbr;

						$('#sel_brandnameabbr').append('<option value="'+Brand_Abbr+'">'+Brand_Abbr+'</option>');
						$('#sel_brandline').append('<option value="'+prd_lineabbr+'">'+prd_line+'</option>');
						$('#sel_brandtypess').append('<option value="'+prd_typeabbr+'">'+prd_type+'</option>');
					}
					for (var i = 0; i < data['brand_variants'].length; i++) {
						var vcpd = data['brand_variants'][i].Vcpd;
						var vcpd_abbr = data['brand_variants'][i].Vcpd_Abbr;
						$('#sel_brandvariants').append('<option value="'+vcpd_abbr+'">'+vcpd+'</option>');
					}
					for (var i = 0; i < data['brand_sizes'].length; i++) {
						var product_size = data['brand_sizes'][i].Product_Size;
						var product_size_Abbr = data['brand_sizes'][i].Product_Size_Abbr;
						$('#sel_brandsizes').append('<option value="'+product_size_Abbr+'">'+product_size+'</option>');
					}

				}
				
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	// UPDATE PRODUCT
	function Get_ProductJSON(prd_id) {

		$.ajax({
			url: '<?=base_url()?>Get_ProductJSON',
			type: 'post',
			data: { prd_id : prd_id } ,
			success: function (result) {
				var data = $.parseJSON(result);
				$('#txt_code').text(data['prd_details'].Code);
				$('#txt_id').val(data['prd_details'].ID);

				$('#unit_price_uid').val(data['prd_details'].Price_PerItem);
				$('#unit_cost_uid').val(data['prd_details'].Cost_PerItem);

				$('#prd_n').val(data['prd_details'].Product_Name);
				$('#prd_des').val(data['prd_details'].Description);
				
				
				$('#update_prdModal').modal('toggle');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}

	// $('.update_prd').on('click', function() {
	$(document).on('click', '.update_prd', function() {
		var prd_id = $(this).attr('data-value');
		Get_ProductJSON(prd_id)
	});

	$('#modal_dis').on('click', function() {
		$('#update_prdModal').modal('toggle');
	});
	(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		};
	}(jQuery));
	$("#unit_price_uid").inputFilter(function(value) {
		return /^-?\d*(\.\d{0,6})?$/.test(value);
	});
	$("#unit_cost_uid").inputFilter(function(value) {
		return /^-?\d*(\.\d{0,6})?$/.test(value);
	});
	$('.sel_checkss').on('change',function () {
		$('.product_codegen').val('');
	});
	$('#add_prd_close').on('click',function () {
		$('#add_productModal').modal('toggle');
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
