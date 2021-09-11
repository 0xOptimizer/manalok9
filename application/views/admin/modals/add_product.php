<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewProduct';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> New Product</h4>
				</div>
				<div class="modal-body">
					<div class="form-row text-center d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-11 mb-4">
							<input id="in-productcode" type="text" class="form-control text-center" name="product-code" autocomplete="off">
							<label class="input-label" for="in-productcode">ITEM CODE</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-11 mb-4">
							<input id="in-productname" type="text" class="form-control text-center" name="product-name" autocomplete="off">
							<label class="input-label" for="in-productname">ITEM NAME</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 col-md-11 m-auto mb-4">
							<select id="in-productcategory" class="form-control text-center" name="product-category" autocomplete="off">
								<option selected="">N/A</option>
								<option>Accessories</option>
								<option>Food</option>
								<option>Out wear</option>
							</select>
							<label class="input-label" for="in-productcategory">ITEM CATEGORY</label>
						</div>
					</div>
					<div class="form-row text-center d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-11 m-auto mb-4">
							<textarea class="form-control" name="product-description" rows="5" autocomplete="off"></textarea>
							<label class="input-label">DESCRIPTION</label>
						</div>
					</div>
					<div class="form-row text-center d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-3 m-auto mb-4">
							<input class="form-control text-center" type="text" name="pro_weight" autocomplete="off">
							<label class="input-label">WEIGHT</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-3 m-auto mb-4">
							<input class="form-control text-center num-noarrow" type="number" name="prc_pitem" autocomplete="off">
							<label class="input-label">PRICE</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-3 m-auto mb-4">
							<input class="form-control text-center num-noarrow" type="number" name="cst_pitem" autocomplete="off">
							<label class="input-label">COST PER ITEM</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD</button>
				</div>
			</div>
		</form>
	</div>
</div>