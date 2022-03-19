<?php if (!$this->session->userdata('UserRestrictions')['replacements_approve']) return; ?>
<div class="modal fade" id="ApproveReplacementModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formApproveReplacement" action="<?php echo base_url() . 'FORM_approveReplacement';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-check" style="font-size: 24px;"></i> Approve Replacement?</h4>
				</div>
				<input type="hidden" name="sales-order-no" value="<?=$salesOrderNo?>" required>
				<input type="hidden" id="approveReplacementNo" name="replacement-no" required>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-danger" name="submit" value="reject"><i class="bi bi-x"></i> Reject</button>
					<button type="submit" class="btn btn-success" name="submit" value="approve"><i class="bi bi-check"></i> Approve</button>
				</div>
			</div>
		</form>
	</div>
</div>