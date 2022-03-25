<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_remarks']) return; ?>
<div class="modal fade" id="SORemarks" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formSORemarks" action="<?php echo base_url() . 'FORM_updateSORemarks';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-pencil-square" style="font-size: 24px;"></i> SO Remarks</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>" required>
					<div class="form-group col-sm-12 col-md-9 mx-auto">
						<label class="input-label">REMARKS</label>
						<textarea id="sales_order_remarks" rows="2" class="form-control" name="remarks" placeholder="REMARKS"></textarea>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update Remarks</button>
				</div>
			</div>
		</form>
	</div>
</div>