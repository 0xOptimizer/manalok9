$(document).ready(function () {
	function Start_QuaggaScanner() {
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
	function Get_Stock_data(uid,prd_sku) {
		$.ajax({
			url : 'Get_Stock_details',
			type : 'POST',
			data : { uid : uid , prd_sku : prd_sku },
			success : function(response) {
				var data = $.parseJSON(response);
				
				$('#s_uid').html(data.product_stocks.uids);
				$('#s_sku').html(data.product_stocks.prd_sku);
				$('#c_stocks').html(data.product_stocks.c_stocks);
				$('#r_stocks').html(data.product_stocks.r_stocks);
				$('#r_price').html(data.product_stocks.r_price);
				$('#or_price').html(data.product_stocks.org_price);
				$('#total_pricesss').html(data.product_stocks.total_price);
				$('#manufacturer_name').html(data.product_stocks.manufacturer);
				$('#exp_date').html(data.product_stocks.exp_date);
				$('#descrpts').html(data.product_stocks.description);
				$('#btn_release_stock').data('id',data.product_stocks.id);
				$('#btn_release_stock').data('uid',data.product_stocks.uids);
				$('#btn_release_stock').data('sku',data.product_stocks.prd_sku);
				$('#btn_release_stock').data('quantity',data.product_stocks.c_stocks);
				
			}
		});
	}
	$('#modal_scan_releasing').on('shown.bs.modal',function() {
		/* START QUAGGA */
		Start_QuaggaScanner();

		/* BARCODE DETECTED */
		Quagga.onDetected(function(result) {
			var uids = result.codeResult.code;

			Quagga.stop();

			$.ajax({
				url: "Get_Product_data",
				type: "POST",
				data: { uids : uids },
				success: function(response) {
					var data = $.parseJSON(response);
					if (data.prd_status.status == 'success') {
						$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Product found in database.</p>');

						var uid = data.prd_details.U_ID;
						var prd_sku = data.prd_details.Code;

						

						setTimeout(function() {

							Get_Stock_data(uid,prd_sku);
							$('.ajx_res_prompt').html('');
							$('#modal_scan_releasing').modal('hide');

						}, 3000);
						
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
	$('#modal_scan_releasing').on('hidden.bs.modal' , function () {
		/* CODE FOR MODAL CLOSING */
		Quagga.stop();
	});

	$('#modal_manual_releasing').on('shown.bs.modal',function () {
		$('.ajx_res_prompt').html('<p class="text-primary align-middle"><i class="bi bi-info-circle-fill"></i> This form is for manual releasing, Always check the Product SKU before submiting.</p>');
	});
	$('#modal_manual_releasing').on('hidden.bs.modal' , function () {
		/* CODE FOR MODAL CLOSING */
		$('.ajx_res_prompt').html('');
		$('#inp_sku').val('');
	});
	$('#inp_sku').on('change',function () {
		var prd_sku = $(this).val();
		if (prd_sku !== "") {
			$.ajax({
				url: "Getprd_stocks",
				type: "POST",
				data: { prd_sku : prd_sku },
				success : function (response) {
					var data = $.parseJSON(response);
					switch (data.prompt.status)
					{
						case 'product_found_with_stock':
						$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Product found in database with stocks available.</p>');
						break;

						case 'product_found_no_stock':
						$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Product found in database. No stock available.</p>');
						break;

						case 'product_notfound':
						$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Product doesn\'t exist.</p>');
						break;

						default:
					}
				}
			});
		}
		else
		{
			$('.ajx_res_prompt').html('<p class="text-primary align-middle"><i class="bi bi-info-circle-fill"></i> This form is for manual releasing, Always check the Product SKU before submiting.</p>');
		}
		
	});
	$('#btn_restock_manual').on('click',function () {
		/* SUBMIT SKU GET PRODUCT STOCK */
		var prd_sku = $('#inp_sku').val();
		$.ajax({
			url: "submit_get_prdstocks",
			type: "POST",
			data: { prd_sku : prd_sku },
			success : function(response) {
				
				var data = $.parseJSON(response);

				switch (data.prompt.status)
				{
					case 'sku_input_null':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Enter SKU.</p>');
					break;

					case 'stock_found':
					$('.ajx_res_prompt').html('<p class="text-success align-middle"><i class="bi bi-check-circle-fill"></i> Stock found.</p>');
					$('#s_uid').html(data.product_stocks.uids);
					$('#s_sku').html(data.product_stocks.prd_sku);
					$('#c_stocks').html(data.product_stocks.c_stocks);
					$('#r_stocks').html(data.product_stocks.r_stocks);
					$('#r_price').html(data.product_stocks.r_price);
					$('#or_price').html(data.product_stocks.org_price);
					$('#total_pricesss').html(data.product_stocks.total_price);
					$('#manufacturer_name').html(data.product_stocks.manufacturer);
					$('#exp_date').html(data.product_stocks.exp_date);
					$('#descrpts').html(data.product_stocks.description);
					$('#modal_manual_releasing').modal('hide');
					$('#btn_release_stock').data('id',data.product_stocks.id);
					$('#btn_release_stock').data('uid',data.product_stocks.uids);
					$('#btn_release_stock').data('sku',data.product_stocks.prd_sku);
					$('#btn_release_stock').data('quantity',data.product_stocks.c_stocks);
					
					$('#action_section').html('');
					break;

					case 'product_found_no_stock':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> No stock available.</p>');
					break;

					case 'product_notfound':
					$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> This product doesn\'t exist.</p>');
					break;

					default:
					$('.ajx_res_prompt').html('<p class="text-primary align-middle"><i class="bi bi-info-circle-fill"></i> This form is for manual releasing, Always check the Product SKU before submiting.</p>');
				}
			}
		});
	});
	$('#btn_release_stock').on('click', function () {

		if ($(this).data('id') !== "" && $(this).data('uid') !== "" && $(this).data('sku') !== "" && $(this).data('quantity') !== "") {

			$('#modal_releasing_quantity').modal('show');

			$('#modal_releasing_quantity').on('shown.bs.modal',function () {
				$('#c_stockstext').text('Current stock available : '+$('#btn_release_stock').data('quantity'));
				$('#inp_quantity').attr({
					type : 'number',
					max : $('#btn_release_stock').data('quantity'),
					min : 1,
					value : 1
				});
				$('#submit_releasesend').data('id',$('#btn_release_stock').data('id'));
				$('#submit_releasesend').data('uid',$('#btn_release_stock').data('uid'));
				$('#submit_releasesend').data('sku',$('#btn_release_stock').data('sku'));
				$('#submit_releasesend').data('quantity',$('#btn_release_stock').data('quantity'));

			});

		}

	});
	$('#modal_releasing_quantity').on('hidden.bs.modal',function () {
	});
	$('#inp_quantity').on('change',function () {
		var quant_val = parseInt($(this).val());
		var quant_max = parseInt($(this).attr('max'));
		var quant_min = parseInt($(this).attr('min'));
		if (isNaN(quant_val) || isNaN(quant_max) || isNaN(quant_min)) {
			$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Input should be numbers.</p>');
		}
		else if (quant_min > quant_val) {
			$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Value should be greater or equal to '+quant_min+'</p>');
			$(this).val(quant_min);
		}
		else if (quant_max < quant_val)
		{
			$('.ajx_res_prompt').html('<p class="text-warning align-middle"><i class="bi bi-exclamation-circle-fill"></i> Value should be less or equal to '+quant_max+'</p>');
			$(this).val(quant_max);
		}
		else
		{
			$('.ajx_res_prompt').html('');
		}

	});
	$('#submit_releasesend').on('click',function () {
		var id = $(this).data('id');
		var uid = $(this).data('uid');
		var sku = $(this).data('sku');
		var quantity = $('#inp_quantity').val();

		$.ajax({
			url: "submit_releasestockss",
			type: "POST",
			data: { id : id , uid : uid , sku : sku , quantity : quantity , },
			success : function (response) {
				window.location = 'product_releasingv2';
			}
		});
	});
});