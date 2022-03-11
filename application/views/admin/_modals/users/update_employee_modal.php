<?php if (!$this->session->userdata('UserRestrictions')['users_edit']) return; ?>
<div class="modal fade" id="UpdateEmployeeModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form action="<?php echo base_url() . 'FORM_updateUser';?>" method="POST" enctype="multipart/form-data">
		<input id="UpdateUserID" type="hidden" name="userID">
		<input id="UpdateDefaultImage" type="hidden" name="defaultImage">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;">
					<input class="form-check-input cursor-pointer" type="checkbox" value="" id="UpdateEmployeeToggle">
					<label class="form-check-label cursor-pointer" for="UpdateEmployeeToggle">
						Update Employee
					</label>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Left Part -->
					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="form-row">
									<div class="form-group col-sm-12 col-md-12">
										<div class="form-group col-sm-12 text-center">
											<input type="file" id="UpdatePFPInput" name="pImage" style="display: none;">
											<input type="hidden" id="UpdatepImageChecker" name="pImageChecker">
											<img class="image-hover" id="UpdatePFPInputPreview" src="<?php echo base_url() ?>assets/images/faces/1.jpg" width="192" height="192" alt="Image Preview" style="border-radius: 8px;" loading="lazy">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-row">
									<div class="form-group col-sm-12">
										<label class="input-label">FIRST NAME</label>
										<input id="UpdateFirstName" type="text" class="form-control" name="firstName" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">MIDDLE NAME</label>
										<input id="UpdateMiddleName" type="text" class="form-control" name="middleName" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">LAST NAME</label>
										<input id="UpdateLastName" type="text" class="form-control" name="lastName" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="row">
									<div class="form-group col-sm-12 col-md-6">
										<label class="input-label">DATE OF BIRTH</label>
										<input id="UpdateDateOfBirth" type="date" class="form-control" name="birthDate" readonly>
									</div>
									<div class="form-group col-sm-12 col-md-6">
										<label class="input-label">NAME EXTENSION</label>
										<input id="UpdateNameExtension" type="text" class="form-control" name="nameExtension" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">CONTACT</label>
										<input id="UpdateContactNumber" type="text" class="form-control" name="contactNumber" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">ADDRESS</label>
										<input id="UpdateAddress" type="text" class="form-control" name="locationAddress" readonly>
									</div>
									<div class="form-group col-sm-12 mt-2 employee-comment-input">
										<label class="input-label">COMMENT</label>
										<input id="UpdateComment" type="text" class="form-control" name="adminComment" readonly>
									</div>
									<div class="form-group col-sm-12 d-none">
										<label class="input-label">PRIVILEGE</label>
										<select id="UpdatePrivilege" class="form-control" name="userPrivilege" readonly disabled>
											<option value="0">None</option>
											<option value="1" selected>Normal</option>
											<option value="2">Admin</option>
											<option value="3">Developer</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Right Part -->
					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<label class="input-label">LATEST ACTIVITIES</label>
								<table class="table" id="attendanceLogTable">
									<thead style="display: none;">
									<tr>
										<th>Event</th>
										<th>Time</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<?php if ($this->session->userdata('UserRestrictions')['users_edit_login']): ?>
								<div class="col-sm-12">
									<label class="input-label">LOGIN CREDENTIALS</label>
									<div class="login-failed-banner my-2">
										<span class="text-center info-banner">
											<i class="bi bi-exclamation-diamond-fill"></i> No log in credentials set. This employee cannot log in.
										</span>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">EMAIL</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="bi bi-envelope-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
											</div>
											<input id="LoginEmail" type="text" class="form-control" name="loginEmail" readonly>
										</div>
									</div>
									<div class="form-group col-sm-12 currentpass-group">
										<label class="input-label">CURRENT PASSWORD (ENCRYPTED)<span class="newpass-btn-group" style="display: none;"> - <button type="button" class="newpass-btn btn btn-sm-primary"><i class="bi bi-brightness-high-fill"></i> set a new password</button></span></label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
											</div>
											<input id="LoginPassword" type="password" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group col-sm-12 newpass-group" style="display: none;">
										<label class="input-label">NEW PASSWORD</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
											</div>
											<input id="NewLoginPassword" type="password" class="form-control" name="newLoginPassword" readonly>
										</div>
									</div>
									<div class="form-group col-sm-12 newpass-group" style="display: none;">
										<label class="input-label">REPEAT NEW PASSWORD</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
											</div>
											<input id="RepeatNewLoginPassword" type="password" class="form-control" readonly>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<!-- BOTTOM PART -->
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-12 allowedActions_Update">
								<label class="input-label">ALLOWED ACTIONS</label>
								<div class="row mx-3">
									<?php $userRestrictions = $this->config->item('user_restrictions'); ?>
									<?php foreach ($userRestrictions as $key => $restriction): ?>
										<?php if (strlen($restriction) > 5 && 
													substr($restriction, -5) == '_view'): ?>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="<?=$restriction?>_update" id="<?=$restriction?>_Update" disabled="">
												<label class="form-check-label fw-bolder" for="<?=$restriction?>_Update"><?=strtoupper(str_replace('_', ' ', $restriction))?></label>
											</div>
										<?php else: ?>
											<?php if (substr($userRestrictions[$key - 1], -5) == '_view'): // if previous restriction was main action ?>
												<div class="col-sm-12 actionSub">
											<?php endif; ?>
											<div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" name="<?=$restriction?>_update" id="<?=$restriction?>_Update" disabled="">
												<label class="form-check-label" for="<?=$restriction?>_Update"><?=strtoupper(str_replace('_', ' ', $restriction))?></label>
											</div>
											<?php if (!isset($userRestrictions[$key + 1]) || 
														substr($userRestrictions[$key + 1], -5) == '_view'): // if next restriction is main action, or if it is the last restriction ?>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<span class="error-saving-banner text-center warning-banner-sm" style="display: none;">
					<i class="bi bi-exclamation-diamond-fill"></i> Repeat password does not match
				</span>
				<button type="submit" class="save-btn btn btn-success"><i class="bi bi-check-square"></i> Save Changes</button>
			</div>
		</div>
		</form>
	</div>
</div>