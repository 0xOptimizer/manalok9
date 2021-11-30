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
								<select id="" class="form-control standard-input-pad select-first-gray" name="prd_brand2" required="">
									<option selected="" value="SDN">SDN</option>
									<option value="SDS">SDS</option>
									<option value="SCB">SCB</option>
									<option value="POT">POT</option>
									<option value="MK9">MK9</option>
								</select>
								<label class="input-label" for="">BRAND</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="" class="form-control standard-input-pad select-first-gray set_char" name="prd_char" required="">
									<option selected="" value="001">001</option>
									<option value="002">002</option>
									<option value="003">003</option>
									<option value="004">004</option>
									<option value="005">005</option>
								</select>
								<label class="input-label" for="">CHAR</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="" class="form-control standard-input-pad select-first-gray" name="prd_chartype" required="">
									<option selected="" value="DGFD">DOG FOOD</option>
									<option value="DGSP">DOG SOAP</option>
									<option value="DGPR">DOG POWDER</option>
									<option value="TS">TSHIRT</option>
									<option value="SD">SANDO</option>
								</select>
								<label class="input-label" for="">TYPE</label>
							</div>
						</div>
						<div class="row p-4">
							<h5 style="color: #C6C6C6;">
								Properties
							</h5>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select class="form-control standard-input-pad select-first-gray set_brand1" name="prd_brand1" required="">
									<option selected="" value="SND"> SDN </option>
									<option value="SDS"> SDS </option>
									<option value="SCB"> SCB </option>
									<option value="POT"> POWTECH </option>
									<option value="MK9"> MANALOK9 </option>
								</select>
								<label class="input-label" for="">BRAND</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="" class="form-control standard-input-pad select-first-gray set_line" name="prd_line" required="">
									<option selected="" value="DGFD">DOG FOOD</option>
									<option value="DGSP">DOG SOAP</option>
									<option value="DGPR">DOG POWDER</option>
									<option value="MDSE">MERCHANDISE</option>
								</select>
								<label class="input-label" for="">LINE</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="" class="form-control standard-input-pad select-first-gray set_type" name="prd_type" required="">
									<option selected="" value="PREM">PREMIUM</option>
									<option value="TS">TSHIRT</option>
									<option value="SD">SANDO</option>
									<option value="FM">FACEMASK</option>
									<option value="SJ">SPORTJUG</option>
									<option value="UBL">UMBRELLA</option>
								</select>
								<label class="input-label" for="">TYPE</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-8">
								<select id="" class="form-control standard-input-pad select-first-gray set_variant" name="prd_variant" required="">
									<option selected="" value="ORIG">ORIGINAL</option>
									<option value="BF">BEEF</option>
									<option value="LMB">LAMB</option>
									<option value="YP">YOUNG PUPPIES</option>
									<option value="MC">MINTY COOL</option>
									<option value="51ORIG">5 IN1 ORIGINAL</option>
								</select>
								<label class="input-label" for="">VARIANT / COLOR / PRINT / DESCRIPTION</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-4">
								<select id="" class="form-control standard-input-pad select-first-gray set_size" name="prd_size" required="">
									<option selected="" value="XS">Extra Small</option>
									<option value="S">Small</option>
									<option value="M">Medium</option>
									<option value="L">Large</option>
									<option value="XL">Extra Large</option>
									<option value="XXL">Double Extra Large</option>
									<option value="500G">500 G</option>
									<option value="1KG">1 KG</option>
									<option value="2KG">2 KG</option>
								</select>
								<label class="input-label" for="">SIZE</label>
							</div>
						</div>
						<div class="row p-4">
							<h5 style="color: #C6C6C6;">
								Details
							</h5>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad product_codegen" type="text" name="product_code" autocomplete="off" placeholder="">
								<label class="input-label">SKU</label>

							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad" type="text" name="product_name" autocomplete="off" placeholder="">
								<label class="input-label">ITEM NAME</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad num-noarrow" type="number" name="unit_cost" autocomplete="off" placeholder="PHP 100">
								<label class="input-label">UNIT COST</label>
							</div>
							<div class="form-group col-12 col-sm-12 col-md-6">
								<input class="form-control standard-input-pad num-noarrow" type="number" name="unit_price" autocomplete="off" placeholder="PHP 150">
								<label class="input-label">UNIT PRICE</label>
							</div>

							<div class="form-group col-12 col-sm-12 col-md-12 m-1">
								<textarea rows="10" class="form-control standard-input-pad" name="product_description"></textarea>
								<label class="input-label">DESCRIPTION</label>
							</div>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<a href="#" id="generate_code">Generate SKU</a>
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD NEW PRODUCT</button>
				</div>
			</div>
		</form>
	</div>
</div>