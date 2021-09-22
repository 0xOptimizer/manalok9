<style type="text/css">
#barcode-scanner video, canvas {
	width: 100%;
	height: auto;
}

#barcode-scanner video.drawingBuffer, canvas.drawingBuffer {
	display: none;
}
</style>
<div class="modal fade" id="scanrelease_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewProduct';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> Release Product</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row text-center">
							<div class="col-12 mb-4 scanner-area" id="scanner_area">
							</div>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> RELEASE PRODUCT</button>
				</div>
			</div>
		</form>
	</div>
</div>