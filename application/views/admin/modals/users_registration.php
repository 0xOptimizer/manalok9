<div class="modal fade" id="userRegistration" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewUser';?>" method="POST" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="bymyself-btn btn btn-sm-primary"><i class="bi bi-plus"></i> I WANT TO CREATE THE USER BY MYSELF INSTEAD</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="col-sm-12 col-md-8">
								<label class="input-label">ENTER EMAIL ADDRESS <span style="margin-left: 5px;"><i class="spinner-border spinner-border-sm" style="color: #de940c;"></i></span></label>
								<input type="text" class="registration-email form-control">
							</div>
							<div class="col-sm-12 col-md-4">
								<label class="input-label">STATUS</label>
								<select class="form-control" name="userPrivilege">
									<option value="1" selected>User</option>
									<option value="2">Admin</option>
									<option value="3">Developer</option>
								</select>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-12 col-md-8">
								<span class="message-banners success-banner-sm" data-feedback="0" style="display: none;">
									<i class="bi bi-check-circle-fill"></i> Email valid
								</span>
								<span class="message-banners info-banner-sm" data-feedback="1" style="display: none;">
									<i class="bi bi-exclamation-triangle-fill"></i> No internet connection detected. Please check your internet and try again.
								</span>
								<span class="message-banners warning-banner-sm" data-feedback="2" style="display: none;">
									<i class="bi bi-exclamation-triangle-fill"></i> Invalid email format
								</span>
								<span class="message-banners warning-banner-sm" data-feedback="3" style="display: none;">
									<i class="bi bi-exclamation-triangle-fill"></i> Email already registered
								</span>
							</div>
							<div class="col-sm-12 col-md-4">
								<label class="input-label">EXPIRES IN</label>
								<select class="form-control" name="userPrivilege">
									<option value="0.125">3 hours</option>
									<option value="0.5">12 hours</option>
									<option value="1" selected>1 day</option>
									<option value="3">3 days</option>
									<option value="7">1 week</option>
									<option value="30">1 month</option>
									<option value="0">Never</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> Send Form to Email</button>
			</div>
		</div>
		</form>
	</div>
</div>