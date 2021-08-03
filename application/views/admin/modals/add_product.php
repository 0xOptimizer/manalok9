<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewProduct';?>" method="POST" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> New Product</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-4">
								<label class="input-label">ITEM CODE</label>
								<input type="text" class="form-control" name="product-code">
							</div>
							<div class="form-group col-sm-8">
								<label class="input-label">DESCRIPTION</label>
								<input type="text" class="form-control" name="product-description">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> Create</button>
			</div>
		</div>
		</form>
	</div>
</div>