<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>

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
					<div class="col-12 col-md-12">
						<h3>Restock</h3>
					</div>
					<div class="col-12 col-md-12 pt-4 pb-2">
						<button type="button" class="scnrestock-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-upc-scan"></i> USE SCANNER</button>
						<button type="button" class="viewRestockCart-btn btn btn-sm-secondary ml-auto" style="font-size: 12px;"><i class="bi bi-cart"></i> CART</button>
					</div>
					<p class="text-subtitle text-muted">Approve or cancel product for restocking.
						<br>
						<small>Using scanner will approve request automatically.</small>
					</p>
				</div>
			</div>

			<section class="section">
				<div class="table-responsive">
					<table id="list_release" class="table">
						<thead>
							<tr>
								<th></th>
								<th>
									TRANSACTION ID
								</th>
								<th>
									ORDER #
								</th>
								<th>
									AMOUNT
								</th>
								<th>
									PRICE
								</th>
								<th>
									DATE ADDED
								</th>
								<th>
									ACTION
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($Filter_restockprod->result_array() as $row): ?>
								<tr scope="row">
									<td class="text-center">
										<?php if ($row['Status'] == 1) {
											print '<i style="font-size: 15px; color: #3EC328;" class="bi bi-check2"></i>';
										} else {
											print '<i style="font-size: 9px; color: #3596CE;" class="bi bi-circle-fill"></i>';
										}?>
									</td>
									<td>
										<?php print $row['TransactionID']; ?>
									</td>
									<td>
										<?php if (isset($row['OrderNo'])) {
											print '<span class="text-success">'.$row['OrderNo'].'</span>';
										} else {
											print '<span class="text-warning"></span>';
										}?>
									</td>
									<td>
										<?php print $row['Amount']; ?>
									</td>
									<td>
										<?php print $row['PriceUnit']; ?>
									</td>
									<td>
										<?php print $row['DateAdded']; ?>
									</td>
									<td width="100" class="text-center">
										<a style="color: #4081E3;" href="#">
											<span><i style="font-size: 18px;" class="bi bi-eye"></i></span>
										</a>
										<a style="color: #61B330;" href="#">
											<span><i style="font-size: 24px;" class="bi bi-check"></i></span>
										</a>
										<a style="color: #C84534 ;" href="<?=base_url()?>admin/remove_thisicode?uid=">
											<span><i style="font-size: 24px;" class="bi bi-x"></i></span>
										</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</section>
			
		</div>
	</div>
</div>
<!-- Release scanner modal -->
<?php $this->load->view('admin/modals/scan_restock'); ?>
<?php $this->load->view('admin/modals/restock_cart_modal'); ?>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<!-- <script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://serratus.github.io/quaggaJS/examples/js/quagga.min.js"></script>

<script>
$(document).ready(function() {

	//--------------- SIDEBAR ---------------//
	$('.sidebar-admin-restock_product').addClass('active');

	//--------------- TABLE ---------------//
	$('#list_release').DataTable();

	//--------------- SCANNER ---------------//
	$('.scnrestock-btn').on('click', function() {
		$('#scanrestock_modal').modal('toggle');
		startScanner();
		function startScanner() {
			Quagga.init({
				inputStream: {
					name: "Live",
					type: "LiveStream",
					target: document.querySelector('#scanner_area'),
					constraints: {
						width: 1280,
						height: 720,
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
							console.log(data.Status);
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
	$('#Restock_modalclose').on('click', function() {
		$('#scanrestock_modal').modal('toggle');
	});
	// CART
	function Get_Cardjson() {
		$('#carT_shop').empty();
		$.getJSON('get_Cartdata', function(data){
			$.each(data, function (index, value) {
				$('#carT_shop').append('<tr><td>'+ value.item_code +'</td><td>'+ value.qty +'</td><td></td><td><a href="#" class="remove_fm_cart" id="'+ value.item_code +'">Remove</a></td></tr>');
			});
		});
		return;
	}
	$('.viewRestockCart-btn').on('click', function() {
		$('#restock_cart_modals').modal('toggle');
		Get_Cardjson();
	});
	$('#Restockcart_modalclose').on('click', function() {
		$('#restock_cart_modals').modal('toggle');
		Get_Cardjson();
	});
	
	$(document).on("click", "#restock_submit", function() {

		var itCode = $('.code_prev').html();
		var qtyValue = $('.quantity_val').val();
		$.ajax({
			url: 'Add_idtoCart',
			type: "post",
			data: {
				item_code: itCode,
				qtyValue: qtyValue
			},
			success: function(response) {
				alert(response);
				Get_Cardjson();

			}
		});
	});
	$(document).on("click", ".remove_fm_cart", function() {

		var itCode = $(this).attr('id');
		$.ajax({
			url: 'remove_fromCart',
			type: "post",
			data: {
				item_code: itCode
			},
			success: function(response) {
				alert(response);
				Get_Cardjson();

			}

		});
	});

});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
