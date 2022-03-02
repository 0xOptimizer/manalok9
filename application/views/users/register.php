<?php
$globalHeader;

$token = $this->input->get('token');
$email = '';

$getToken = $this->Model_Selects->GetToken($token);
if ($getToken->num_rows() > 0) {
	foreach($getToken->result_array() as $row) {
		$email = $row['Email']; 
	}
}

?>
<style>
	.image-hover:hover {
		opacity: 0.6;
		cursor: pointer;
		transition: 0.1s;
	}
</style>
</head>
<body>
<div id="app">
	<div class="mt-2" style="margin-left: 80px; width: 80rem">
		<div class="page-heading mr-auto ml-auto">
			<div class="page-title">
				<div class="row">
					<div class="logo col-12 col-md-4">
						<a href="index.html"><img src="<?=base_url() . 'assets/images/manalok9_logo.png'?>"></a>
					</div>
					<div class="col-12 col-md-8 order-md-1 order-last mt-3">
						<h3>New Account Registration</h3>
						<p class="text-subtitle text-muted">Have an account already? <a href="<?=base_url();?>login">Log in here instead.</a></p>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="card">
					<div class="card-body">
						<form action="<?php echo base_url() . 'FORM_selfAddNewUser';?>" method="POST" enctype="multipart/form-data">
							<div class="row">
								<!-- Left Part -->
								<div class="col-sm-12 col-md-6">
									<div class="row">
										<div class="col-sm-12 col-md-6">
											<div class="form-row">
												<div class="form-group col-sm-12 col-md-12">
													<div class="form-group col-sm-12 text-center">
														<input type="file" id="PFPInput" name="pImage" style="display: none;">
														<input type="hidden" id="pImageChecker" name="pImageChecker">
														<img class="image-hover" id="UpdatePFPInputPreview" src="<?=base_url();?>assets/images/faces/2.jpg" width="192" height="192" alt="Image Preview" style="border-radius: 8px;" loading="lazy">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-6">
											<div class="form-row">
												<div class="form-group col-sm-12">
													<label class="input-label">FIRST NAME</label>
													<input type="text" class="form-control" name="firstName">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">MIDDLE NAME</label>
													<input type="text" class="form-control" name="middleName">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">LAST NAME</label>
													<input type="text" class="form-control" name="lastName">
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="row">
												<div class="form-group col-sm-12 col-md-6">
													<label class="input-label">DATE OF BIRTH</label>
													<input type="date" class="form-control" name="birthDate">
												</div>
												<div class="form-group col-sm-12 col-md-6">
													<label class="input-label">NAME EXTENSION</label>
													<input type="text" class="form-control" name="nameExtension">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">CONTACT</label>
													<input type="text" class="form-control" name="contactNumber">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">ADDRESS</label>
													<input type="text" class="form-control" name="locationAddress">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- Right Part -->
								<div class="col-sm-12 col-md-6">
									<div class="row">
										<div class="col-sm-12">
											<label class="input-label">LOGIN CREDENTIALS</label>
											<div class="form-group col-sm-12">
												<label class="input-label">EMAIL</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="bi bi-envelope-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
													</div>
													<input id="LoginEmail" type="text" class="form-control" name="loginEmail" value="<?=$email?>">
												</div>
											</div>
											<div class="form-group col-sm-12 newpass-group">
												<label class="input-label">PASSWORD</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
													</div>
													<input id="LoginPassword" type="password" class="form-control" name="loginPassword">
												</div>
											</div>
											<div class="form-group col-sm-12 newpass-group">
												<label class="input-label">REPEAT PASSWORD</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
													</div>
													<input id="RepeatLoginPassword" type="password" class="form-control">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-sm-12 text-center">
									<button type="submit" class="save-btn btn btn-success" style="width: 200px;"><i class="bi bi-check-square"></i> Register</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.daterangepicker.min.js"></script>
<script>
$('.sidebar-profile').addClass('active');
$(document).ready(function() {
	$('#PFPInputPreview').click(function(){ $('#PFPInput').trigger('click'); });
	function readURL(input, previewID) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(previewID).attr('src', e.target.result);
				// localStorage.setItem('profileImage', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#PFPInput").change(function() {
		readURL(this, '#UpdatePFPInputPreview');
		$('#pImageChecker').val('1');
	});
	$('#LoginPassword, #RepeatLoginPassword').bind('input', function() {
		let loginPass = $('#LoginPassword').val();
		let repeatLoginPass = $('#RepeatLoginPassword').val();
		if (loginPass.length > 0 && repeatLoginPass.length > 0) {
			if (loginPass == repeatLoginPass) {
				$('.error-saving-banner').fadeOut('fast');
				$('.save-btn').removeClass('btn-secondary');
				$('.save-btn').addClass('btn-success');
				$('.save-btn').removeAttr('disabled');
				$('.save-btn').html('<i class="bi bi-check-square"></i> Register');
			} else {
				$('.error-saving-banner').fadeIn('fast');
				$('.save-btn').addClass('btn-secondary');
				$('.save-btn').removeClass('btn-success');
				$('.save-btn').attr('disabled', 'true');
				$('.save-btn').html('<i class="bi bi-lock"></i> Register');
			}
		} else {
			$('.error-saving-banner').fadeIn('fast');
			$('.save-btn').addClass('btn-secondary');
			$('.save-btn').removeClass('btn-success');
			$('.save-btn').attr('disabled', 'true');
			$('.save-btn').html('<i class="bi bi-lock"></i> Register');
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
