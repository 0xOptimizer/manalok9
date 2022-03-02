<?php if (!$this->session->userdata('UserRestrictions')['purchase_orders_add']) return; ?>
<div class="modal fade" id="AddPurchaseOrderModal" tabindex="-1" role="dialog" aria-hidden="true" data-prevscroll="0">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formAddPurchaseOrder" action="<?php echo base_url() . 'FORM_addPurchaseOrder';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> New Purchase Order</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="productCount" id="ProductsCount" value="0" required>
					<input type="hidden" name="purchaseFromNo" id="PurchaseFromNo" required>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">PURCHASE ORDER #</label>
									<input type="text" class="form-control viewonly" value="PO<?=str_pad($this->db->count_all('purchase_orders') + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-3">
									<label class="input-label">PURCHASE ORDER DATE</label>
									<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
								</div>
								<div class="form-group col-sm-12 col-md-3">
									<label class="input-label">PURCHASE ORDER TIME</label>
									<input type="time" class="form-control" name="time" value="<?=date("H:i");?>" required>
								</div>
							</div>
						</div>
						<!-- Top Part -->
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">NAME</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-x-circle-fill text-danger h-100 w-100 purchaseNameIcon"></i></span>
										</div>
										<input type="text" class="form-control vendorPurchaseNameSearch purchaseName" name="vendor-name" placeholder="John Doe" autocomplete="off" data-toggle="dropdown" required>
										<div class="dropdown-menu dropdown-menu-left vendorPurchaseNameDropdown"></div>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">VENDOR #</label>
									<input type="text" class="form-control viewonly purchaseNo" readonly data-newvno="V<?=str_pad($this->db->count_all('vendors') + 1, 6, '0', STR_PAD_LEFT)?>">
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">TIN</label>
									<input type="text" class="form-control viewonly purchaseTIN newVendorInput" name="vendor-tin" placeholder="123 456 789 000" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">ADDRESS</label>
									<input type="text" class="form-control viewonly purchaseAddress newVendorInput" name="vendor-address" placeholder="M. Santos St., Brgy. San Jose, Antipolo City" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CONTACT #</label>
									<input type="text" class="form-control viewonly purchaseContactNum newVendorInput" name="vendor-contact-num" placeholder="09123456789" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">KIND OF PRODUCT/SERVICE</label>
									<input type="text" class="form-control viewonly purchaseKind newVendorInput" name="vendor-kind" placeholder="Soap" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">EMAIL</label>
									<input type="email" class="form-control viewonly purchaseEmail newVendorInput" name="vendor-email" placeholder="john@email.com" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">SHIP VIA</label>
									<input type="text" class="form-control" name="shipVia" placeholder="Ship" required>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">DELIVERY DATE</label>
									<input type="date" class="form-control" name="deliveryDate" value="<?=date("Y-m-d");?>" required>
								</div>
							</div>
						</div>
						<hr>
						<!-- Bottom Part -->
						<div class="col-sm-12 table-responsive add_table">
							<label class="input-label">PURCHASE ITEMS</label>
							<table class="table table-hover" id="purchaseOrderProducts">
								<thead>
									<tr>
										<th class="text-center">SKU</th>
										<th class="text-center">QTY</th>
										<th class="text-center">COST</th>
										<th class="text-center">PRICE</th>
										<th class="text-center">TOTAL COST</th>
										<th class="text-center">EXPIRATION</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr class="newProduct">
										<td class="font-weight-bold add-product-row" colspan="7" style="cursor: pointer;">
											<i class="bi bi-plus"></i> New Product
										</td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="font-weight-bold text-center" style="color: #a7852d;">TOTAL AMOUNT</td>
										<td colspan="3"></td>
										<td class="productsTotal text-center">0.00</td>
										<td colspan="3"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Purchase Order</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="SelectProductSKUModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-bag-fill" style="font-size: 24px;"></i> Products</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<input id="rowProductSelection" type="hidden">
					<?php $getAllProducts = $this->Model_Selects->GetAllProducts(); ?>
					<div class="col-sm-0 col-md-6">
						<label class="input-label">PRODUCTS</label>
					</div>
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableProductsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="selectproductsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">SKU</th>
								<th class="text-center">NAME</th>
								<th class="text-center">DESCRIPTION</th>
							</thead>
							<tbody>
								<?php
								if ($getAllProducts->num_rows() > 0):
									foreach ($getAllProducts->result_array() as $row): ?>
										<tr class="select-product-row" data-sku="<?=$row['Code']?>">
											<td class="text-center">
												<?=$row['Code']?>
											</td>
											<td class="text-center">
												<?=$row['Product_Name']?>
											</td>
											<td class="text-center">
												<?=$row['Description']?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>