<?php if (!$this->session->userdata('UserRestrictions')['invoice_add']) return; ?>
<div class="modal fade" id="newInvoiceModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAddInvoice" action="<?php echo base_url() . 'FORM_addInvoice';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cash" style="font-size: 24px;"></i> Add Invoice</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DESCRIPTION</label>
							<textarea rows="2" class="form-control standard-input-pad" name="description" placeholder="Payment of rent / Purchase of supplies"></textarea>
						</div>
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