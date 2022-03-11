<?php if (!$this->session->userdata('UserRestrictions')['products_add']) return; ?>
<div class="modal fade" id="add_productModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="<?php echo base_url() . 'Add_newProductV2';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> New Product</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row p-4">
							<h5>
								BRAND
							</h5>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandname" class="form-control standard-input-pad select-first-gray sel_checkss" name="prd_brand2" required="">
									<option selected="" value=""></option>
									<?php foreach ($Get_Brand_Data->result_array() as $row): ?>
										<option value="<?php echo $row['Brand_Name']; ?>" data-value="<?php echo $row['UniqueID']; ?>"><?php echo $row['Brand_Name']; ?></option>
									<?php endforeach ?>
								</select>
								<label class="input-label" for="">BRAND</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandchar" class="form-control standard-input-pad select-first-gray set_char sel_brandchar sel_checkss" name="prd_char" required="">
									
								</select>
								<label class="input-label" for="">CHAR</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandtype" class="form-control standard-input-pad select-first-gray sel_checkss" name="prd_chartype" required="">
									
								</select>
								<label class="input-label" for="">TYPE</label>
							</div>
						</div>
						<div class="row p-4">
							<h5 style="color: #C6C6C6;">
								Properties
							</h5>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandnameabbr" class="form-control standard-input-pad select-first-gray set_brand1 sel_checkss" name="prd_brand1" required="">
									
								</select>
								<label class="input-label" for="">BRAND (ABBR)</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandline" class="form-control standard-input-pad select-first-gray set_line sel_checkss" name="prd_line" required="">
									
								</select>
								<label class="input-label" for="">LINE</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandtypess" class="form-control standard-input-pad select-first-gray set_type sel_checkss" name="prd_type" required="">
									
								</select>
								<label class="input-label" for="">TYPE</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-8">
								<select id="sel_brandvariants" class="form-control standard-input-pad select-first-gray set_variant sel_checkss" name="prd_variant" required="">
									
								</select>
								<label class="input-label" for="">VARIANT / COLOR / PRINT / DESCRIPTION</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="sel_brandsizes" class="form-control standard-input-pad select-first-gray set_size sel_checkss" name="prd_size" required="">
									
								</select>
								<label class="input-label" for="">SIZE</label>
							</div>
						</div>
						<div class="row p-4">
							<h5 style="color: #C6C6C6;">
								Details
							</h5>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad product_codegen" type="text" name="product_code" autocomplete="off" placeholder="" readonly>
								<label class="input-label">SKU</label>

							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad " type="text" name="product_name" autocomplete="off" placeholder="">
								<label class="input-label">ITEM NAME</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad num-noarrow " type="number" name="unit_cost" autocomplete="off" placeholder="PHP 100" step="0.000001">
								<label class="input-label">UNIT COST</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad num-noarrow " type="number" name="unit_price" autocomplete="off" placeholder="PHP 150" step="0.000001">
								<label class="input-label">UNIT PRICE</label>
							</div>

							<div class="form-group col-12 col-sm-12 col-md-12 m-1">
								<textarea rows="10" class="form-control standard-input-pad " name="product_description"></textarea>
								<label class="input-label">DESCRIPTION</label>
							</div>
							
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					
					<a href="#" id="generate_code">Generate SKU</a>
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD NEW PRODUCT</button>
					<button id="add_prd_close" type="button" class="btn btn-secondary"><i class="bi bi-check-square"></i> CLOSE</button>
				</div>
			</div>
		</form>
	</div>
</div>