<div class="modal fade" id="restock_manually" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> Restock Product</h4>
				<a class="Modal_Close_custom" href="#">
					<i class="bi bi-x" style="font-size: 24px;"></i>
				</a>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row p-4">
						<div class="col-12 col-sm-12 col-md-6">
							<label>
								SKU
							</label>
							<input id="sku_Code" class="form-control standard-input-pad" type="text" name="">
						</div>
						<div class="col-12 col-sm-12 col-md-6">
							<label>
								QUANTITY
							</label>
							<input id="m_quantity" class="form-control standard-input-pad" type="text" name="">
						</div>
					</div>
					<div class="row p-4">
						<div class="col-12 mb-3">
							<h6>
								PRODUCT DETAILS
							</h6>
						</div>
						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Brand
							</label>
							<p id="man_prd_bname">
								N/A
							</p>
						</div>
						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Product Name
							</label>
							<p id="man_prd_name">
								N/A
							</p>
						</div>
						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Stock
							</label>
							<p id="man_prd_stock">
								N/A
							</p>
						</div>
						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Released
							</label>
							<p id="man_prd_rel">
								N/A
							</p>
						</div>

						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Unit Cost
							</label>
							<p id="man_prd_ucost">
								N/A
							</p>
						</div>
						<div class="col-12 col-sm-12 col-md-4">
							<label class="text-primary">
								Unit Price
							</label>
							<p id="man_prd_uprice">
								N/A
							</p>
						</div>
						
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button id="restock_submit_manual" type="button" class="btn btn-success"><i class="bi bi-cart-check"></i> Add to Cart</button>
			</div>
		</div>
	</div>
</div>