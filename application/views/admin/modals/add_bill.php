<div class="modal fade" id="PurchaseBilling" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAddPOBill" action="<?php echo base_url() . 'FORM_addPOBill';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> PO Bills</h4>
				</div>
				<div class="modal-body">
					<?php
					$v_details = $this->Model_Selects->GetVendorByNo($purchaseOrder['VendorNo'])->row_array();
					?>
					<input type="hidden" name="purchase-order-no" value="<?=$purchaseOrder['OrderNo']?>" required>
					<div class="row">
						<div class="col-12">
							<div class="mx-auto">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														VENDOR NAME
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$v_details['Name']?>
														</b>
													</span>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														VENDOR #
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$v_details['VendorNo']?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">AMOUNT</label>
							<input type="number" class="form-control" name="amount" placeholder="0.00" step="0.000001" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="mode-payment">MODE OF PAYMENT</label>
							<input type="text" class="form-control" name="mode-payment" placeholder="Cash" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">TIME</label>
							<input type="time" class="form-control" name="time" value="<?=date("H:i");?>" required>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Bill</button>
				</div>
			</div>
		</form>
	</div>
</div>