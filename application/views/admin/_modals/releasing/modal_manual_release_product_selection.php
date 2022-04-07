<div class="modal fade" id="SelectProductSKUModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-bag-fill" style="font-size: 24px;"></i> Products</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php $getAllProducts = $this->Model_Selects->GetStockedProducts(); ?>
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
								<th class="text-center">COST</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">STOCKS</th>
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
											<td class="text-center pCost" data-cost="<?=$row['Cost_PerItem']?>">
												<?=number_format($row['Cost_PerItem'], 2)?>
											</td>
											<td class="text-center pPrice" data-price="<?=$row['Price_PerItem']?>">
												<?=number_format($row['Price_PerItem'], 2)?>
											</td>
											<?php
											$product_stocks = $this->Model_Selects->product_stocks_total($row['Code']);
											?>
											<td class="text-center">
												<?php if ($product_stocks->num_rows() > 0) {
													$total_stocks = $product_stocks->row_array()['total_stocks'];
													if ($total_stocks > 0) {
														echo $total_stocks;
													} else {
														echo 0;
													}
												} else {
													echo 0;
												} ?>
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