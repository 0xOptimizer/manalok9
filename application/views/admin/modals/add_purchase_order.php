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
									<input type="text" class="form-control viewonly" value="PO-<?=str_pad($this->db->count_all('purchase_orders') + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">PURCHASE ORDER DATE</label>
									<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
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
									<input type="text" class="form-control viewonly purchaseNo" readonly data-newvno="V-<?=str_pad($this->db->count_all('vendors') + 1, 6, '0', STR_PAD_LEFT)?>">
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
					<hr class="my-4">
					<label class="input-label">ACCOUNTING</label>
					<div class="row">
						<input type="hidden" id="transactionsCount" name="transactions-count" value="0">
						<div class="form-group col-12 col-md-8">
							<label class="input-label">DESCRIPTION</label>
							<textarea rows="2" class="form-control standard-input-pad" name="description" placeholder="Description" required>Purchases</textarea>
						</div>
						<div class="form-group col-12 col-md-4">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12">
							<div class="table-responsive">
								<table id="newTransactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th>ACCOUNT</th>
										<th>DEBIT</th>
										<th>CREDIT</th>
										<th></th>
									</thead>
									<tbody>
										<tr class="font-weight-bold add-account-row">
											<td><i class="bi bi-plus"></i> New Account</td>
											<td colspan="3"></td>
										</tr>
										<tr style="border-color: #a7852d;">
											<td style="color: #a7852d;">Total</td>
											<td class="debitTotal">0</td>
											<td class="creditTotal">0</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
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