<?php if (!$this->session->userdata('UserRestrictions')['return_product_add']) return; ?>
<?php
$salesOrderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($return['SalesOrderNo']);
?>
<!-- ADD RETURN PRODUCT MODAL -->
<div class="modal fade" id="AddReturnProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewReturnProduct';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-reply" style="font-size: 24px;"></i> New Return</h4>
				</div>
				<div class="modal-body text-center">
					<input type="hidden" name="returnNo" value="<?=$return['ReturnNo']?>" id="addReturnNo" required>
					<input type="hidden" name="transactionID" id="addTransactionID" required>
					<div class="form-group col-sm-12 text-center">
						<h5><?=$return['ReturnNo']?></h5>
					</div>
					<div class="form-group col-sm-12 text-center">
						<button type="button" class="btn btn-info select-transaction-btn">
							<i class="bi bi-plus">SELECT TRANSACTION</i>
						</button>
					</div>
					<div class="form-group col-12 col-md-6 text-center p-1 mx-auto">
						<div class="card" style="background-color: #404040; ">
							<div class="card-body">
								<h6 class="card-title">ORDERED QUANTITY REMAINING</h6>
								<p class="card-text text-primary" id="pt_quantityorderedremaining">---</p>
							</div>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap">
						<div class="col-12 col-md-4 text-center p-1">
							<div class="card" style="background-color: #404040; ">
								<div class="card-body">
									<h6 class="card-title">GOOD</h6>
									<p class="card-text text-primary" id="rt_good">---</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 text-center p-1">
							<div class="card" style="background-color: #404040; ">
								<div class="card-body">
									<h6 class="card-title">DAMAGED</h6>
									<p class="card-text text-primary" id="rt_damaged">---</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 text-center p-1">
							<div class="card" style="background-color: #404040; ">
								<div class="card-body">
									<h6 class="card-title">RETURNED</h6>
									<p class="card-text text-primary" id="rt_returned">---</p>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-8 col-md-5 mb-3">
							<select id="returnRemarks" class="form-control standard-input-pad text-center" name="remarks">
								<option value="GOOD" selected>GOOD RETURN</option>
								<option value="DAMAGED">DAMAGED</option>
								<option value="RETURNED">RETURNED TO INVENTORY</option>
							</select>
							<label class="input-label">REMARK</label>
						</div>
						<div class="form-group col-12 col-sm-4 col-md-2  offset-md-1 mb-3">
							<input id="newReturnQty" class="form-control text-center" type="number" name="qty" min="0" value="0" placeholder="---" required>
							<label class="input-label">QTY</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- SELECT SALES ORDER PRODUCTS MODAL -->
<div class="modal fade" id="SelectSOProductsModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-box"></i> SALES ORDER <span class="selectedSalesOrder"></span> PRODUCTS</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSalesOrderProductsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="salesOrderProductsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">TRANSACTION ID</th>
								<th class="text-center">PRODUCT CODE</th>
								<th class="text-center">AMOUNT</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center">FREEBIE</th>
							</thead>
							<tbody>
								<?php if ($salesOrderTransactions->num_rows() > 0):
									foreach ($salesOrderTransactions->result_array() as $row): ?>
										<tr class="select-transaction-row" data-id="<?=$row['TransactionID']?>">
											<td class="text-center">
												<?=$row['TransactionID']?>
											</td>
											<td class="text-center">
												<?=$row['Code']?>
											</td>
											<td class="text-center">
												<?=$row['Amount']?>
											</td>
											<td class="text-center">
												<?=number_format($row['PriceUnit'], 2)?>
											</td>
											<td class="text-center">
												<?=number_format($row['Amount'] * $row['PriceUnit'], 2)?>
											</td>
											<td class="text-center">
												<?php if ($row['Freebie'] == 1): ?>
													<i class="bi bi-check-circle text-success"></i>
												<?php else: ?>
													<i class="bi bi-x-circle text-danger"></i>
												<?php endif; ?>
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