<?php if (!$this->session->userdata('UserRestrictions')['bills_add']) return; ?>
<div class="modal fade" id="updBillModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formUpdateBill" action="<?php echo base_url() . 'FORM_updateBill';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cash" style="font-size: 24px;"></i> Update Bill Expense</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="hidden" id="bill_id" name="bill_id" required>

						<div class="form-group col-sm-12 col-md-4 mx-auto">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" id="bill_date" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">NAME</label>
							<input type="text" class="form-control" id="bill_name" name="name" placeholder="Name" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">TIN # VAT</label>
							<input type="text" class="form-control" id="bill_tinvat" name="tinvat" placeholder="TIN # VAT">
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">TIN # NON</label>
							<input type="text" class="form-control" id="bill_tinnon" name="tinnon" placeholder="TIN # NON">
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">ADDRESS</label>
							<input type="text" class="form-control" id="bill_address" name="address" placeholder="Address" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">PARTICULARS</label>
							<input type="text" class="form-control" id="bill_particulars" name="particulars" placeholder="Particulars" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">AMOUNT</label>
							<input type="number" class="form-control" id="bill_amount" name="amount" placeholder="0.00" step="0.000001" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">SI# OR#</label>
							<input type="text" class="form-control" id="bill_sinorn" name="sinorn" placeholder="SI# OR#" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">REMARKS</label>
							<input type="text" class="form-control" id="bill_remarks" name="remarks" placeholder="Remarks" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DEPARTMENT</label>
							<input type="text" class="form-control" id="bill_department" name="department" placeholder="Department" required>
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