<style type="text/css">
	.scanner-area video, canvas {
		width: 100% !important;
		height: auto;
	}

	.scanner-area video.drawingBuffer, canvas.drawingBuffer {
		display: none;
	}
	.img-product
	{
		max-width: 90%;
	}
</style>
<div class="modal fade" id="scanrelease_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> Release Product</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row stacksss">
						<div class="col-12 col-sm-12 col-md-7 col-lg-7 m-auto scanner-area" id="scanner_area">
						</div>
						<div class="col-12 col-sm-5">
							<p>
								<input class="release_num form-control quantity_val" type="number" name="" placeholder="Quantity">
							</p>
						</div>


						<div class="col-12 mt-5">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>CODE : </span><span class="code_prev"></span>
							</p>
						</div>
						<div class="col-12">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>NAME : </span><span class="name_prev"></span>
							</p>
						</div>
						<div class="col-12">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>DESCRIPTION : </span><span class="descrip_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>STOCK : </span><span class="InStock_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>RELEASED : </span><span class="Released_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>CATEGORY : </span><span class="Product_Category_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>WEIGHT : </span><span class="Product_Weight_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>PRICE : </span><span class="Price_PerItem_prev"></span>
							</p>
						</div>
						<div class="col-6">
							<p style="border-left: 2px solid #D1C246; padding-left: 10px;">
								<span>TOTAL PRICE : </span><span class="Total_PerItem_prev"></span>
							</p>
						</div>

					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button id="release_submit" type="button" class="btn btn-success"><i class="bi bi-check-square"></i> RELEASE PRODUCT</button>
			</div>
		</div>
	</div>
</div>