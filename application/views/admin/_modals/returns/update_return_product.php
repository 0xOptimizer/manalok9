<?php if (!$this->session->userdata('UserRestrictions')['return_product_edit']) return; ?>
<!-- UPDATE RETURN ITEM -->
<div class="modal fade" id="UpdateReturnProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form action="<?php echo base_url() . 'FORM_updateReturnProduct';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-reply" style="font-size: 24px;"></i> Update Return</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="returnNo" value="<?=$return['ReturnNo']?>" required>
					<input type="hidden" name="transactionID" id="updateTransactionID" required>
					<div class="form-group col-sm-12 text-center">
						<h5><?=$return['ReturnNo']?></h5>
					</div>
					<div class="form-group col-sm-12 text-center">
						<h5 class="text-secondary updateTransactionID"></h5>
					</div>
					<hr>
					<div class="form-group col-sm-12 text-center mt-2">
						<textarea rows="2" class="form-control standard-input-pad updateRemarks text-center" name="remarks"></textarea>
						<label class="input-label">REMARKS</label>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>