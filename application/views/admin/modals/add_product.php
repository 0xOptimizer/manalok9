<div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewProduct';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> New Product</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-3 mb-5">
							<input id="in-productcode" type="text" class="form-control standard-input-pad" name="product-code" autocomplete="off" placeholder="ABCD200">
							<label class="input-label" for="in-productcode">ITEM CODE</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-7 offset-md-1 mb-5">
							<input id="in-productname" type="text" class="form-control standard-input-pad" name="product-name" placeholder="Dog Snacks 200G">
							<label class="input-label" for="in-productname">ITEM NAME</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 col-md-11 m-auto mb-5">
							<select id="in-productcategory" class="form-control standard-input-pad select-first-gray" name="product-category">
								<option selected>N/A</option>
								<option>Accessories</option>
								<option>Food</option>
								<option>Out wear</option>
							</select>
							<label class="input-label" for="in-productcategory">ITEM CATEGORY</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-11 m-auto mb-5">
							<textarea class="form-control standard-input-pad" name="product-description" rows="1" placeholder="A snack for dogs (200 grams)."></textarea>
							<label class="input-label">DESCRIPTION</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-2 m-auto mb-4">
							<input class="form-control standard-input-pad" type="text" name="pro_weight" autocomplete="off" placeholder="200">
							<label class="input-label">WEIGHT</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-1 mb-4" style="margin-left: -25px;">
							<select id="in-productcategory" class="form-control standard-input-pad" name="pro_weight_size">
								<option>kg</option>
								<option selected>g</option>
								<option>mg</option>
							</select>
							<label class="input-label">&nbsp;</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-3 m-auto mb-4">
							<input class="form-control standard-input-pad num-noarrow" type="number" name="prc_pitem" autocomplete="off" placeholder="PHP 100">
							<label class="input-label">PRICE</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-3 m-auto mb-4">
							<input class="form-control standard-input-pad num-noarrow" type="number" name="cst_pitem" autocomplete="off" placeholder="PHP 150">
							<label class="input-label">COST PER ITEM</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD NEW PRODUCT</button>
				</div>
			</div>
		</form>
	</div>
</div>