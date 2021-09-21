<div class="modal fade" id="AddPurchaseOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form action="<?php echo base_url() . 'FORM_addPurchaseOrder';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> New Purchase Order</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="productCount" id="ProductsCount" required>
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
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">NAME</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-x-circle-fill text-danger h-100 w-100 purchaseNameIcon"></i></span>
										</div>
										<input type="text" class="form-control vendorPurchaseNameSearch viewonly purchaseName" placeholder="John Doe" autocomplete="off" data-toggle="dropdown">
										<div class="dropdown-menu dropdown-menu-left vendorPurchaseNameDropdown"></div>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">VENDOR #</label>
									<input type="text" class="form-control viewonly purchaseNo" readonly>
								</div>
							</div>
						</div>
						<hr>
						<!-- Bottom Part -->
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="col-sm-12 table-responsive">
									<label class="input-label">PURCHASE ITEMS</label>
									<table class="table" id="purchaseOrderProducts">
										<thead>
											<tr>
												<th class="text-center">QTY</th>
												<th class="text-center">CODE</th>
												<th class="text-center">UNIT PRICE</th>
												<th class="text-center">TOTAL</th>
												<th class="text-center"></th>
											</tr>
										</thead>
										<tbody>
											<tr class="noProduct">
												<td class="text-center" colspan="5">
													<label class="input-label">
														[ EMPTY ]
													</label>
												</td>
											</tr>
											<tr class="productsTotal" style="border-color: #a7852d;">
												<td></td>
												<td></td>
												<td class="font-weight-bold text-center" style="color: #a7852d;">TOTAL AMOUNT</td>
												<td class="subTotal text-center">0.00</td>
												<td></td>
											</tr>
											<!-- <tr style="border-color: #a7852d;">
												<td class="text-center" rowspan="4" colspan="2">
													<span class="footerHead">
														MEMO:
													</span><br>
													<span class="text-center">
														NONE
													</span>
												</td>
												<td class="footerHead">Freight</td>
												<td class="text-center">0.00</td>
												<td></td>
											</tr>
											<tr style="border-color: #a7852d;">
												<td class="footerHead">Sales Tax</td>
												<td class="text-center">0.00</td>
												<td></td>
											</tr>
											<tr style="border-color: #a7852d;">
												<td class="footerHead">Less Deposit</td>
												<td class="text-center">0.00</td>
												<td></td>
											</tr>
											<tr style="border-color: #a7852d;">
												<td class="footerHead">Balance Due</td>
												<td class="text-center">0.00</td>
												<td></td>
											</tr> -->
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<?php $getAllProducts = $this->Model_Selects->GetStockedProducts(); ?>
								<div class="col-sm-0 col-md-6">
									<label class="input-label">PRODUCTS</label>
								</div>
								<div class="col-sm-12 col-md-6 pt-4 pb-2" style="margin-top: -15px;">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
										</div>
										<input type="text" id="tableProductsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
									</div>
								</div>
								<div class="col-sm-12 table-responsive">
									<table id="productsTable" class="standard-table table">
										<thead style="font-size: 12px;">
											<th class="text-center">ID</th>
											<th class="text-center">CODE</th>
											<th class="text-center">CATEGORY</th>
											<th class="text-center">STOCK</th>
											<th class="text-center">UNIT PRICE</th>
										</thead>
										<tbody>
											<?php
											if ($getAllProducts->num_rows() > 0):
												foreach ($getAllProducts->result_array() as $row): ?>
													<tr class="add-product-row" data-id="<?=$row['ID']?>">
														<td class="text-center">
															<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
														</td>
														<td class="text-center pCode">
															<?=$row['Code']?>
														</td>
														<td class="text-center">
															<?=$row['Product_Category']?>
														</td>
														<td class="text-center pStock">
															<?=$row['InStock']?>
														</td>
														<td class="text-center pPrice">
															<?=number_format($row['PriceSelling'], 2)?>
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
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Purchase Order</button>
				</div>
			</div>
		</form>
	</div>
</div>