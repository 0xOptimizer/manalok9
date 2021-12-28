
<div class="modal fade" id="UpdateAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_updateAccount';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> Update Account #<span class="m_id"></span></h4>
				</div>
				<div class="modal-body mx-4">
					<input class="mi_id" type="hidden" name="upd-id">
					<div class="row">
						<div class="form-group col-sm-12">
							<label class="input-label">ACCOUNT NAME</label>
							<input type="text" class="form-control viewonly m_name" placeholder="Supplies / Accounts Payable / etc." name="upd-name" autocomplete="off">
						</div>
						<div class="form-group col-sm-12">
							<label class="input-label">ACCOUNT TYPE</label>
							<select class="form-control standard-input-pad m_type" name="upd-type" required="">
								<option selected="" value="0"> REVENUES </option>
								<option value="1"> ASSETS </option>
								<option value="2"> LIABILITIES </option>
								<option value="3"> EXPENSES </option>
								<option value="4"> EQUITY </option>
							</select>
						</div>
						<div class="form-group col-sm-12">
							<textarea rows="2" class="form-control standard-input-pad m_description" name="upd-description"></textarea>
							<label class="input-label">DESCRIPTION</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Update Account</button>
				</div>
			</div>
		</form>
	</div>
</div>