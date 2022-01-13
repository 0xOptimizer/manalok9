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
});