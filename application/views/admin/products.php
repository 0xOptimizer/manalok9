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
								<i class="bi bi-bag-fill"></i> <?=$getAllProducts->num_rows();?> TOTAL
							</span>
							<?php if ($getAllProducts->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No products found.
								</span>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW</button> -->
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="newproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW PRODUCT</button>
						|
						<!-- <button type="button" class="newtransaction-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cart-plus"></i> NEW TRANSACTION</button> -->
						<a href="<?=base_url() . 'admin/inventory';?>" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-folder-symlink-fill"></i> VIEW IN INVENTORY</a>
						|
						<button type="button" class="scnrelease-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-upc-scan"></i> RELEASE USING SCANNER</button>
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
							<?php
							if ($getAllProducts->num_rows() > 0):
								foreach ($getAllProducts->result_array() as $row): ?>
									<tr data-code="<?=$row['Code'];?>" data-urlredirect="<?=base_url() . 'admin/viewproduct?code=' . $row['Code'];?>">
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
										<td>
											<a href="<?=base_url() . 'admin/viewproduct?code=' . $row['Code'];?>"><i class="bi bi-eye" style="color: #a7852d;"></i></a>
											<i class="bi bi-pencil"></i>
											<i class="bi bi-trash text-danger"></i>
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
<!-- New transactions modal -->
<?php $this->load->view('admin/modals/add_transaction.php'); ?>
<!-- Release scanner modal -->
<?php $this->load->view('admin/modals/scan_release.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script src="https://serratus.github.io/quaggaJS/examples/js/quagga.min.js"></script>



<script>
$('.sidebar-admin-products').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#productsTable').find("[data-code='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.newproduct-btn').on('click', function() {
		$('#newProductModal').modal('toggle');
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
	$('.scnrelease-btn').on('click', function() {
		$('#scanrelease_modal').modal('toggle');
		startScanner();
		function startScanner() {
			Quagga.init({
				inputStream: {
					name: "Live",
					type: "LiveStream",
					target: document.querySelector('#scanner_area'),
					constraints: {
						width: 480,
						height: 320,
						facingMode: "environment"
					},
				},
				decoder: {
					readers: [
					"code_128_reader"
					],
				},

			}, function (err) {
				if (err) {
					console.log(err);
					return;
				}
				Quagga.start();
			});

			Quagga.onDetected(function(result) {
				var p_id = result.codeResult.code;
				$.ajax({
					url: "get_productDetails",
					type: "POST",
					data: { product_code: p_id },
					success: function(response) {
						var data = $.parseJSON(response);
						if (data.Status == "success") {
							$('.code_prev').html(data.Code);
							$('.name_prev').html(data.Product_Name);
							$('.descrip_prev').html(data.Description);
							$('.InStock_prev').html(data.InStock);
							$('.Released_prev').html(data.Released);
							$('.Product_Category_prev').html(data.Product_Category);
							$('.Product_Weight_prev').html(data.Product_Weight);
							$('.Price_PerItem_prev').html(data.Price_PerItem);
						}
						else
						{
							alert(data.Status);
						}
					}
				});
				return;
			});
		}
	});
	$('.release_num').on('keyup change', function() {
		$calPriceAmount = $('.Price_PerItem_prev').text() * $(this).val(); 
		$('.Total_PerItem_prev').html($calPriceAmount);
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
