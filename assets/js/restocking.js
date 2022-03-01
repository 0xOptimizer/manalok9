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
	/*  TABLE FUNCTIONS */
	function Get_Stock_Details(stock_id) {
		var stock_id = stock_id;
		$.ajax({
			url: "Get_Stock_UsingID",
			type: "post",
			data: { stock_id : stock_id },
			success: function(result) {
				var data = $.parseJSON(result);
				if (data.prompt.status == 'found') {
					$('#view_stock_modal').modal('show');
					$('#uid_lbl').text(data.stock_details.UID);
					$('#prd_sku_lbl').text(data.stock_details.Product_SKU);
					$('#org_stock').text(data.stock_details.Stocks);
					$('#rem_stock').text(data.stock_details.Current_Stocks);
					$('#rel_stock').text(data.stock_details.Released_Stocks);
					$('#ret_price').append(data.stock_details.Retail_Price);
					$('#original_price').append(data.stock_details.Price_PerItem);
					$('#manufact_lbl').text(data.stock_details.Manufactured_By);
					$('#exp_lbl').text(data.stock_details.Expiration_Date);
					$('#addat_lbl').text(data.stock_details.Date_Added);
					$('#descript_lbl').text(data.stock_details.Description);
				}
			}
		});
	}
	function Get_Stock_Details_for_update(stock_id) {
		var stock_id = stock_id;


		$.ajax({
			url: "Get_Stock_UsingID",
			type: "post",
			data: { stock_id : stock_id },
			success: function(result) {
				var data = $.parseJSON(result);
				if (data.prompt.status == 'found') {
					$('#update_stock_modal').modal('show');
					/* FILL UPDATE INPUTS */
					$('#up_id').val(data.stock_details.ID);
					$('#up_uids').val(data.stock_details.UID);
					$('#up_pre_sku').val(data.stock_details.Product_SKU);
					// $('#up_remaining').val(data.stock_details.Current_Stocks);
					
					$('#tp_stock').text(data.stock_details.Stocks);
					$('#rsp_stock').text(data.stock_details.Current_Stocks);
					$('#rp_stock').text(data.stock_details.Released_Stocks);

					$('#up_r_price').val(data.stock_details.Retail_Price);
					$('#up_orig_price').val(data.stock_details.Price_PerItem);
					$('#up_manufacturer').val(data.stock_details.Manufactured_By);
					$('#up_expire_date').val(data.stock_details.Expiration_Date.toString());
					$('#up_prd_descript').val(data.stock_details.Description);
					/* END FILL UPDATE INPUTS */
				}
			}
		});
	}
	function Clear_Labels() {
		$('#uid_lbl').text('');
		$('#prd_sku_lbl').text('');
		$('#org_stock').text('');
		$('#rem_stock').text('');
		$('#rel_stock').text('');
		$('#ret_price').text('');
		$('#original_price').text('');
		$('#manufact_lbl').text('');
		$('#exp_lbl').text('');
		$('#addat_lbl').text('');
		$('#descript_lbl').text('');
	}
	function Clear_Input() {
		$('#up_uids').val('');
		$('#up_pre_sku').val('');
		$('#up_quant').val('');
		$('#up_r_price').val('');
		$('#up_orig_price').val('');
		$('#up_manufacturer').val('');
		$('#up_expire_date').val('');
		$('#up_prd_descript').val('');
	}
	$('.modal_view').on('click',function () {
		var stock_id = $(this).data('id');
		Get_Stock_Details(stock_id);
	});
	$('#view_stock_modal').on('hidden.bs.modal', function () {
		Clear_Labels();
	});
	$('.modal_update').on('click',function () {
		var stock_id = $(this).data('id');
		Get_Stock_Details_for_update(stock_id)
	});
	$('.modal_update').on('hidden.bs.modal', function () {
		Clear_Input();
	});
	$('.modal_delete').on('click',function function_name() {
		if ($(this).data('id') > 0) {
			var stock_id = $(this).data('id');

			$('#Modal_DeleteStock').modal('show');
			$('#btn_deleteStock').data('id',stock_id);
		}
	});
	$('#btn_deleteStock').on('click',function () {
		if ($(this).data('id') > 0) {
			var stock_id = $(this).data('id');
			$.ajax({
				url: "Delete_Stock_row",
				type: "post",
				data: { stock_id : stock_id },
				success: function(result) {

					if (result == 'success') {
						$('.ajx_res_prompt').html('<label class="input-label text-success"><i class="bi bi-check-circle-fill"></i> Stock deleted.</label>');
						setTimeout(function() { 
							$('.ajx_res_prompt').html('');
							window.location = 'product_restockingv2';
						}, 2000);
					}
					else if (result == 'product_not_found') {
						$('.ajx_res_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Missing product in database.</label>');
					}
					else if (result == 'product_total_stock_low') {
						$('.ajx_res_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Product total stock is lower than stock to be deleted.</label>');
					}
					else if (result == 'not_deleted') {
						$('.ajx_res_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Error deleting stock! Please try again.</label>');
					}
					else if (result == 'stock_null') {
						$('.ajx_res_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Can\'t find stock.</label>');
					}
					else
					{
						$('.ajx_res_prompt').html('<label class="input-label text-warning"><i class="bi bi-check-circle-fill"></i> Something\'s wrong! Please try again.</label>');
					}
				}
			});
		}
	});
	$('#btn_stockUpdate').on('click',function () {
		var up_id  = $('#up_id').val();
		var up_uids  = $('#up_uids').val();
		var up_pre_sku  = $('#up_pre_sku').val();
		var up_radioUp = $('input[name="radioUp"]:checked').val();
		var up_quantity  = $('#up_quantity').val();
		var up_r_price  = $('#up_r_price').val();
		var up_orig_price  = $('#up_orig_price').val();
		var up_manufacturer  = $('#up_manufacturer').val();
		var up_expire_date  = $('#up_expire_date').val();
		var up_prd_descript  = $('#up_prd_descript').val();
		$.ajax({
			url : 'Update_stockdetails',
			type : 'post',
			data : { up_id : up_id , up_uids : up_uids ,up_pre_sku : up_pre_sku , up_radioUp : up_radioUp , up_quantity : up_quantity , up_r_price : up_r_price , up_orig_price : up_orig_price , up_manufacturer : up_manufacturer , up_expire_date : up_expire_date , up_prd_descript : up_prd_descript },
			success : function (result) {
				var data = $.parseJSON(result);
				switch (data.status.prompt)
				{
					case 'null_values':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> All fields is requred! Please try again.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');

					}, 3000);
					break;

					case 'stock_notfound':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Can\'t find stock details. Please try again.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');

					}, 3000);
					break;

					case 'product_notfound':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Can\'t find product details. Please try again.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');

					}, 3000);
					break;

					case 'stock_updated':
					$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Stock updated! Page will automatically refresh.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');
						window.location = 'product_restockingv2';
					}, 3000);
					break;

					case 'error_updating':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');
					}, 3000);
					break;

					case 'deduct_error':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Deduction failed stock is low.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');
					}, 3000);
					break;
					case 'quantity_exceed_current':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Quantity exceed remaining stocks.</p>');
					setTimeout(function() { 
						$('.ajx_res_prompt').html('');
					}, 3000);
					break;

					default:
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Something\'s wrong, Please try again.</p>');
				}
			}
		});
	});
});