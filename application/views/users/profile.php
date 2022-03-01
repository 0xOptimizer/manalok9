<?php
$globalHeader;

$image = '';
$firstName = '';
$middleName = '';
$lastName = '';
$nameExtension = '';
$dateOfBirth = '';
$contactNumber = '';
$address = '';

if ($getUserID->num_rows() > 0) {
	foreach($getUserID->result_array() as $row) {
		$image = $row['Image'];
		$firstName = $row['FirstName'];
		$middleName = $row['MiddleName'];
		$lastName = $row['LastName'];
		$nameExtension = $row['NameExtension'];
		$dateOfBirth = $row['DateOfBirth'];
		$contactNumber = $row['ContactNumber'];
		$address = $row['Address'];
	}
}

$email = '';

if ($getLoginCredentials->num_rows() > 0) {
	foreach($getLoginCredentials->result_array() as $row) {
		$email = $row['LoginEmail']; 
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
	<?php $this->load->view('main/template/sidebar') ?>
	<div id="main">
		<header class="mb-3">
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6 order-md-1 order-last">
						<h3><i class="bi bi-person-fill"></i> Your Profile</h3>
						<p class="text-subtitle text-muted">Customize your profile and login credentials.</p>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="card">
					<div class="card-body">
						<form action="<?php echo base_url() . 'FORM_selfUpdateUser';?>" method="POST" enctype="multipart/form-data">
						<input id="UpdateDefaultImage" type="hidden" name="defaultImage" value="<?=$image?>">
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
														<img class="image-hover" id="UpdatePFPInputPreview" src="<?=$image?>" width="192" height="192" alt="Image Preview" style="border-radius: 8px;" loading="lazy">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-6">
											<div class="form-row">
												<div class="form-group col-sm-12">
													<label class="input-label">FIRST NAME</label>
													<input id="UpdateFirstName" type="text" class="form-control" name="firstName" value="<?=$firstName?>">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">MIDDLE NAME</label>
													<input id="UpdateMiddleName" type="text" class="form-control" name="middleName" value="<?=$middleName?>">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">LAST NAME</label>
													<input id="UpdateLastName" type="text" class="form-control" name="lastName" value="<?=$lastName?>">
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="row">
												<div class="form-group col-sm-12 col-md-6">
													<label class="input-label">DATE OF BIRTH</label>
													<input id="UpdateDateOfBirth" type="date" class="form-control" name="birthDate" value="<?=$dateOfBirth?>">
												</div>
												<div class="form-group col-sm-12 col-md-6">
													<label class="input-label">NAME EXTENSION</label>
													<input id="UpdateNameExtension" type="text" class="form-control" name="nameExtension" value="<?=$nameExtension?>">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">CONTACT</label>
													<input id="UpdateContactNumber" type="text" class="form-control" name="contactNumber" value="<?=$contactNumber?>">
												</div>
												<div class="form-group col-sm-12">
													<label class="input-label">ADDRESS</label>
													<input id="UpdateAddress" type="text" class="form-control" name="locationAddress" value="<?=$address?>">
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
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-sm-12 text-center">
									<button type="submit" class="btn btn-success" style="width: 200px;"><i class="bi bi-check-square"></i> Save Changes</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.daterangepicker.min.js"></script>
<script>
$('.sidebar-profile').addClass('active');
$(document).ready(function() {
	$('#UpdatePFPInputPreview').click(function(){ $('#UpdatePFPInput').trigger('click'); });
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
	$("#UpdatePFPInput").change(function() {
		readURL(this, '#UpdatePFPInputPreview');
		$('#UpdatepImageChecker').val('1');
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
