<?php if (!$this->session->userdata('UserRestrictions')['releasing_edit']) return; ?>
<div class="modal fade" id="UpdateReleaseModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formUpdateReleaseModal" action="<?php echo base_url() . 'admin/FORM_updateRelease';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-pencil-square" style="font-size: 24px;"></i> Update Release</h4>
				</div>
				<div class="modal-body">
					<input id="releaseID" type="hidden" name="release_id" required>
					<div class="form-group col-sm-12 col-md-9 mx-auto">
						<label class="input-label">Released To</label> 
						<input id="released_to" class="form-control" type="text" name="release_to" placeholder="*">
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update Release</button>
				</div>
			</div>
		</form>
	</div>
</div>