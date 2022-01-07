$(document).ready(function () {
	/* BARCODE SCANNER ADD STOCK */
	function start_barcodescanner() {
		Quagga.init({
			inputStream : {
				name : "Live",
				type : "LiveStream",
				target: document.querySelector('#scanner_area'),
				constraints: {

					facingMode: "environment"
				},
			},
			decoder : {
				readers : ["code_128_reader"]
			}
		}, function(err) {
			if (err) {
				console.log(err);
				return
			}
			else
			{
				$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Barcode Scanner started.</p>');
			}
			Quagga.start();

		});
	}

	$('#add_stock_restocking').on('shown.bs.modal', function () {

		start_barcodescanner();

		Quagga.onDetected(function(result) {
			var uids = result.codeResult.code;

			$.ajax({
				url: "Get_Product_data",
				type: "POST",
				data: { uids : uids },
				success: function(response) {
					var data = $.parseJSON(response);
					if (data.prd_status.status == 'success') {
						$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Product found in database.</p>');

						$('#uids').val(data.prd_details.U_ID);
						$('#pre_sku').val(data.prd_details.Code);

						Quagga.stop();
					}
					else
					{
						$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Product doesn\'t exist.</p>');
					}
				}
			});
			return
		});
	});
	$('#add_stock_restocking').on('hidden.bs.modal',function () {
		Quagga.stop();
		$('.ajx_res_prompt').html('');
	});
	function clear_form_input() {
		$('#uids').val('');
		$('#pre_sku').val('');
		$('#quant').val('');
		$('#r_price').val('');
		$('#orig_price').val('');
		$('#manufacturer').val('');
		$('#expire_date').val('');
		$('#prd_descript').val('');
	}
	$('#scanner_area').on('click',function () {
		start_barcodescanner();
		clear_form_input();

	});
	$('#btn_addstocks').on('click',function () {
		var uids = $('#uids').val();
		var pre_sku = $('#pre_sku').val();
		var quant = $('#quant').val();
		var r_price = $('#r_price').val();
		var orig_price = $('#orig_price').val();
		var manufacturer = $('#manufacturer').val();
		var expire_date = $('#expire_date').val();
		var prd_descript = $('#prd_descript').val();

		$.ajax({
			url: "Add_stockto_cart",
			type: "POST",
			data: { uids : uids , pre_sku : pre_sku , quant : quant , r_price : r_price , orig_price : orig_price , manufacturer : manufacturer , expire_date : expire_date , prd_descript : prd_descript },
			success: function(response) {
				var data = $.parseJSON(response);
				switch (data.promptsss.status)
				{

					case 'uid_not_found':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> UID not found.</p>');
					break;
					case 'sku_not_found':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> SKU not found</p>');
					break;
					case 'empty_fields':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Please fill up all required data.</p>');
					break;
					case 'not_numbers':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
					break;
					case 'success':
					$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Stock added to cart.</p>');
					clear_form_input();
					break;
					case 'error':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Error adding stock, Please try again.</p>');
					break;
					default:
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
				}
			}
		});

	});

	/* ADD STOCK MANUAL INPUT SKU */
	function clear_form_input_manual() {
		$('#m_uids').val('');
		$('#m_pre_sku').val('');
		$('#m_quant').val('');
		$('#m_r_price').val('');
		$('#m_orig_price').val('');
		$('#m_manufacturer').val('');
		$('#m_expire_date').val('');
		$('#m_prd_descript').val('');
	}
	$('#add_stock_restocking_manual').on('shown.bs.modal',function () {
		$('.ajx_res_prompt').html('<p class="text-primary align-middle"><i class="bi bi-info-circle-fill"></i> This form is for manual stocking, Always check the Product SKU before submiting.</p>');
	});
	$('#add_stock_restocking_manual').on('hidden.bs.modal',function () {
		$('.ajx_res_prompt').html('');
		$('.sku_prompt').html('');
		clear_form_input_manual();
	});

	$('#m_pre_sku').on('change',function () {
		var pre_sku = $('#m_pre_sku').val();
		if (pre_sku === "") {
			$('.sku_prompt').html('');
		}
		else
		{
			$.ajax({
				url: "Get_uid_prd",
				type: "post",
				data: { pre_sku : pre_sku },
				success: function(result) {
					var data = $.parseJSON(result);
					if (data.status.code == 'sku_found') {
						$('.sku_prompt').html('<label class="input-label text-success"><i class="bi bi-check-circle-fill"></i> Product found.</label>');
						$('#m_uids').val(data.product.uid);
					}
					else
					{
						$('.sku_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Product doesn\'t exist.</label>');
					}
				}
			});
		}
	});
	$('#btn_addstocks_manual').on('click',function () {
		var uids = $('#m_uids').val();
		var pre_sku = $('#m_pre_sku').val();
		var quant = $('#m_quant').val();
		var r_price = $('#m_r_price').val();
		var orig_price = $('#m_orig_price').val();
		var manufacturer = $('#m_manufacturer').val();
		var expire_date = $('#m_expire_date').val();
		var prd_descript = $('#m_prd_descript').val();

		$.ajax({
			url: "Add_stockto_cart",
			type: "POST",
			data: { uids : uids , pre_sku : pre_sku , quant : quant , r_price : r_price , orig_price : orig_price , manufacturer : manufacturer , expire_date : expire_date , prd_descript : prd_descript },
			success: function(response) {
				var data = $.parseJSON(response);
				switch (data.promptsss.status)
				{

					case 'uid_not_found':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> UID not found! Review SKU.</p>');
					break;
					case 'sku_not_found':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> SKU not found.</p>');
					break;
					case 'empty_fields':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Please fill up all required data.</p>');
					break;
					case 'not_numbers':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
					break;
					case 'success':
					$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Stock added to cart.</p>');
					clear_form_input_manual();
					$('.sku_prompt').html('');
					break;
					case 'error':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Error adding stock, Please try again.</p>');
					break;
					default:
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
				}
			}
		});
	});
	/* CART MODAL */
	function Get_Cart_Details() {
		$('#fill_data_cart').html('');
		$.ajax({
			url: "get_cart_fill_table",
			type: "get",
			dataType: "html",
			success: function(result) {
				$('#fill_data_cart').html(result);
			}
		});
	}
	$('#restocking_cart_modal').on('shown.bs.modal' , function() {
		Get_Cart_Details();
	});
	$('#restocking_cart_modal').on('hidden.bs.modal' , function() {
		$('#fill_data_cart').html('');
	});
	$(document).on('click','.btn-cartitem-delete' , function () {
		var cart_id = $(this).attr('data-value');

		$.ajax({
			url: "Delete_cart_itemrestock",
			type: "POST",
			data : { cart_id : cart_id },
			success: function(result) {

				switch (result)
				{
					case 'deleted':
					$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Cart item deleted</p>');
					Get_Cart_Details();
					break;

					case 'error_deleting':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Error deleting item.</p>');
					break;

					case 'not_found':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Item doesn\'t exist.</p>');
					break;

					case 'error':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
					break;

					default:
					Get_Cart_Details();
				}

				setTimeout(function() { 
					$('.ajx_res_prompt').html('');
				}, 2000);

			}
		});
	});
});