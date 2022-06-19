<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_update']) return; ?>
<div class="modal fade" id="AddTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAddTransaction" action="<?php echo base_url() . 'FORM_addNewSOTransaction';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> Add New Transaction</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="sales-order-no" value="<?=$salesOrderNo?>" required>
					<input type="hidden" class="newTransactionSKU" name="product-sku" required>
					<input type="hidden" class="newTransactionStockID" name="product-stock-id" required>
					<div class="form-row d-flex flex-wrap justify-content-center">

						<div class="form-group col-12 col-md-6 text-center">
							<div class="card" style="background-color: #404040; ">
								<div class="card-body">
									<h6 class="card-title">SKU</h6>
									<button class="btn btn-primary" type="button">
										<i class="bi bi-plus newTransactionSKU-btn">SELECT PRODUCT</i>
									</button>
								</div>
								<div class="card-body">
									<h6 class="card-title">STOCK ID</h6>
									<p class="card-text text-primary newTransactionStockID-text">---</p>
								</div>
							</div>
						</div>
						<div class="form-group col-12 col-md-6 text-center">
							<div class="form-row d-flex flex-wrap justify-content-center p-1">
								<div class="form-group col-sm-12 col-md-12 text-center">
									
									<div class="form-check form-switch form-check-inline text-center">
										<input class="newTransactionFreebie form-check-input mx-auto" type="checkbox" name="freebie">&nbsp;<label class="input-label">FREEBIE</label>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-4 text-center px-2">
									<label class="input-label">DISCOUNT (%)</label>
									<input class="form-control newTransactionDiscount" type="number" value="0" min="0" name="discount" required>
								</div>
								<div class="form-group col-sm-12 col-md-4 text-center px-2">
									<label class="input-label">QTY</label>
									<input class="form-control newTransactionQty" type="number" value="0" min="0" max="0" name="qty" required>
								</div>
								<div class="form-group col-sm-12 col-md-12 text-center">
									<label class="input-label">UNIT COST</label><br>
									<span class="newTransactionCost" data-unitCost="0">0.00</span>
								</div>
								<div class="form-group col-sm-12 col-md-12 text-center">
									<label class="input-label">TOTAL</label><br>
									<span class="newTransactionTotalCost">0.00</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Transaction</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="AddTransactionSKUModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-box-seam"></i> PRODUCTS</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php $getStockedProducts = $this->Model_Selects->GetStockedProducts(); ?>
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableProductsTransactionSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="selectproductsTransactionTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">SKU</th>
								<th class="text-center">NAME</th>
								<th class="text-center">DESCRIPTION</th>
								<th class="text-center">STOCK</th>
							</thead>
							<tbody>
								<?php
								if ($getStockedProducts->num_rows() > 0):
									foreach ($getStockedProducts->result_array() as $row): ?>
										<tr class="select-product-transaction-row" data-sku="<?=$row['Code']?>" data-bs-dismiss="modal">
											<td class="text-center">
												<?=$row['Code']?>
											</td>
											<td class="text-center">
												<?=$row['Product_Name']?>
											</td>
											<td class="text-center">
												<?=$row['Description']?>
											</td>
											<td class="text-center">
												<?=$row['InStock']?>
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
<div class="modal fade" id="AddTransactionStockModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-box"></i> STOCKS</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableStocksTransactionSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="selectstocksTransactionTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">SKU</th>
								<th class="text-center">STOCK</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">DATE ADDED</th>
								<th class="text-center">EXPIRATION DATE</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>