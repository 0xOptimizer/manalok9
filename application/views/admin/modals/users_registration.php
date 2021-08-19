<div class="modal fade" id="userRegistration" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="bymyself-btn btn btn-sm-primary"><i class="bi bi-plus"></i> I WANT TO CREATE THE USER BY MYSELF INSTEAD</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="col-sm-12 col-md-8">
								<label class="input-label">ENTER EMAIL ADDRESS <span style="margin-left: 5px;"><i class="registration-email-icon spinner-border spinner-border-sm" style="color: #de940c; display: none;"></i></span></label>
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
							<div class="col-sm-12 col-md-8 email-banners-group">
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
				<!-- <div class="col-sm-12 col-md-8 send-email-banners-group">
				</div> -->
				<button type="button" class="send-registration-email-btn btn btn-success"><i class="bi bi-check-square"></i> Send Form to Email</button>
			</div>
		</div>
	</div>
</div>