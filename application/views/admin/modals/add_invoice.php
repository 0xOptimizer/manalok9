
<div class="modal fade" id="SalesInvoicing" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAddSOInvoice" action="<?php echo base_url() . 'FORM_addSOInvoice';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> SO Invoicing</h4>
				</div>
				<div class="modal-body">
					<?php
					$c_details = $this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array();
					?>
					<input type="hidden" name="sales-order-no" value="<?=$salesOrder['OrderNo']?>" required>
					<div class="row">
						<div class="col-12">
							<div class="mx-auto">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														CLIENT NAME
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$c_details['Name']?>
														</b>
													</span>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="row">
													<span class="head-text">
														CLIENT #
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=$c_details['ClientNo']?>
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
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Invoice</button>
				</div>
			</div>
		</form>
	</div>
</div>