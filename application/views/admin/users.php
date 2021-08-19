<?php

$globalHeader;

?>
<style>

	#salutation {
		font-size: 2.2rem;
	}
	.employee-card-hover:hover {
		margin-top: 2px;
		opacity: 0.6;
		cursor: pointer;
		transition: 0.08s;
	}
	.employee-add-new .card-title {
		color: #a7852d;
	}
	.employee-add-new .card-body {
		background-image: linear-gradient(135deg, #282828 10%, #2c2c2c 10%, #2c2c2c 50%, #282828 50%, #282828 60%, #2c2c2c 60%, #2c2c2c 100%);
		background-size: 70.71px 70.71px;
	}
	.image-hover:hover {
		opacity: 0.6;
		cursor: pointer;
		transition: 0.01s;
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
						<h3>Users</h3>
						<p class="text-subtitle text-muted">Create, view, or manage all current and past users here.</p>
					</div>
					<!-- <div class="col-12 col-md-6 order-md-2 order-first">
						<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
							<ol class="breadcrumb">
								<li class="breadcrumb-item active"><a href="<?=base_url();?>admin">Admin</a></li>
							</ol>
						</nav>
					</div> -->
				</div>
			</div>
			<section class="section">
				<table class="w-100">
					<thead style="display: none;">
						<th>Data</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-3">
										<div class="card employee-card-hover employee-add-new">
											<div class="card-body text-center">
												<p><img class="img-fluid rounded-circle border-gold" src="<?php echo base_url() ?>assets/images/plus.png" width="128" height="128" alt="card image"></p>
												<h4 class="card-title">Create a New User</h4>
												<p class="card-text">Add a new user to manage.</p>
											</div>
										</div>
									</div>
									<?php
									$getAllUsers = $this->Model_Selects->GetAllUsers();
									if ($getAllUsers->num_rows() > 0):
										foreach($getAllUsers->result_array() as $row):
											// Info Handler
											// ~ name
											$fullName = '';
											$fullNameHover = '';
											$isFullNameHoverable = false;
											$lastName = $row['LastName'];
											$firstName = $row['FirstName'];
											$middleName = $row['MiddleName'];
											$nameExtension = $row['NameExtension'];
											if ($lastName) {
												$fullName = $fullName . $lastName . ', ';
												$fullNameHover = $fullNameHover . $lastName . ', ';
											} else {
												$fullNameHover = $fullNameHover . '[<i>No Last Name</i>], ';
												$isFullNameHoverable = true;
											}
											if ($firstName) {
												$fullName = $fullName . $firstName . ' ';
												$fullNameHover = $fullNameHover . $firstName . ' ';
											} else {
												$fullNameHover = $fullNameHover . '[<i>No First Name</i>] ';
												$isFullNameHoverable = true;
											}
											if ($middleName) {
												$fullName = $fullName . $middleName[0] . '.';
												$fullNameHover = $fullNameHover . $middleName[0] . '.';
											} else {
												$fullNameHover = $fullNameHover . '[<i>No MI</i>].';
												$isFullNameHoverable = true;
											}
											if ($nameExtension) {
												$fullName = $fullName . ', ' . $nameExtension;
												$fullNameHover = $fullNameHover . ', ' . $nameExtension;
											}
											if (strlen($fullName) > 90) {
												$fullName = substr($fullName, 0, 90);
												$fullName = $fullName . '...';
												$isFullNameHoverable = true;
											}
											// ~ check if info exists
											$hasDateOfBirth = false;
											$hasContactNumber = false;
											$hasAddress = false;
											$hasLoginCredentials = false;
											$loginEmail = '';
											$loginPassword = '';
											if ($row['DateOfBirth']) {
												$hasDateOfBirth = true;
											}
											if ($row['ContactNumber']) {
												$hasContactNumber = true;
											}
											if ($row['Address']) {
												$hasAddress = true;
											}
											$getLoginInfo = $this->Model_Selects->GetUserID($row['UserID'], 'users_login');
											if ($getLoginInfo->num_rows() > 0) {
												foreach($getLoginInfo->result_array() as $loginRow) {
													$loginEmail = $loginRow['LoginEmail'];
													$loginPassword = $loginRow['LoginPassword'];
													if ($loginRow['LoginEmail'] && $loginRow['LoginPassword']) {
														$hasLoginCredentials = true;
													}
												}
											}
											?>
											<div class="col-xs-12 col-sm-6 col-md-3" style="height: 21em;">
												<div class="card employee-standard-card employee-card-hover" data-userid="<?=$row['UserID'];?>" data-image="<?=$row['Image'];?>" data-firstname="<?=$row['FirstName'];?>" data-middlename="<?=$row['MiddleName'];?>" data-lastname="<?=$row['LastName'];?>" data-nameextension="<?=$row['NameExtension'];?>" data-dateofbirth="<?=$row['DateOfBirth'];?>" data-contactnumber="<?=$row['ContactNumber'];?>" data-address="<?=$row['Address'];?>" data-comment="<?=$row['Comment'];?>" data-privilege="<?=$row['Privilege'];?>" data-loginemail="<?=$loginEmail;?>" data-loginpassword="<?=$loginPassword;?>" style="height: 19em;">
													<div class="card-body text-center">
														<p><img class="img-fluid rounded-circle" src="<?=base_url().$row['Image'];?>" width="128" height="128" alt="card image"></p>
														<h4 class="card-title"<?php if($isFullNameHoverable): ?> data-toggle="tooltip" data-placement="top" data-html="true" title="<?=$fullNameHover;?>"<?php endif; ?>><?=$fullName?></h4>
														<p class="card-text"><?php if ($row['ContactNumber']): ?><i class="bi bi-telephone-fill"></i> <?=$row['ContactNumber'];?><?php endif; ?></p>
														<?php if(!$hasContactNumber): ?>
														<p class="card-text info-banner-sm"><i class="bi bi-exclamation-diamond-fill"></i> No contact number</p>
														<?php endif; ?>
														<?php if(!$hasAddress): ?>
														<p class="card-text info-banner-sm"><i class="bi bi-exclamation-diamond-fill"></i> No address</p>
														<?php endif; ?>
														<?php if(!$hasLoginCredentials): ?>
														<p class="card-text info-banner-sm"><i class="bi bi-exclamation-diamond-fill"></i> No login credentials</p>
														<?php endif; ?>
														<!-- <button type="button" class="btn btn-primary btn-sm mt-2">Profile</button>
														<button type="button" class="btn btn-primary btn-sm mt-2">Role</button>
														<button type="button" class="btn btn-primary btn-sm mt-2">Account</button> -->
													</div>
												</div>
											</div>
										<?php endforeach;
									endif; ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
	</div>
</div>
<!-- New user prompt -->
<?php $this->load->view('admin/modals/users_registration.php'); ?>
<!-- Create a new employee modal -->
<?php $this->load->view('admin/modals/create_employee_modal.php'); ?>
<!-- Update employee modal -->
<?php $this->load->view('admin/modals/update_employee_modal.php'); ?>
<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<script src="<?=base_url()?>/assets/js/moment.min.js"></script>
<script type="text/javascript">
$('.sidebar-admin-employees').addClass('active');
$(document).ready(function() {
	var toggle = false;
	$('.bymyself-btn').on('click', function() {
		$('#NewEmployeeModal').modal('toggle');
		$('#userRegistration').modal('hide');
	});
	$('.employee-add-new').on('click', function() {
		$('#userRegistration').modal('toggle');
	});
	$('.employee-standard-card').on('click', function() {
		$('#UpdateDefaultImage').val($(this).data('image'));
		$('#UpdateUserID').val($(this).data('userid'));
		$('#UpdatePFPInputPreview').attr('src', "<?=base_url();?>" + $(this).data('image'));
		$('#UpdateFirstName').val($(this).data('firstname'));
		$('#UpdateMiddleName').val($(this).data('middlename'));
		$('#UpdateLastName').val($(this).data('lastname'));
		$('#UpdateNameExtension').val($(this).data('nameextension'));
		$('#UpdateDateOfBirth').val($(this).data('dateofbirth'));
		$('#UpdateContactNumber').val($(this).data('contactnumber'));
		$('#UpdateAddress').val($(this).data('address'));
		$('#UpdateComment').val($(this).data('comment'));
		console.log($(this).data('privilege'));
		$('#UpdatePrivilege option[value=' + (($(this).data('privilege').length < 1) ? 0 : $(this).data('privilege')) + ']').prop('selected', true);
		let loginEmail = $(this).data('loginemail');
		let loginPassword = $(this).data('loginpassword');
		$('#LoginEmail').val(loginEmail);
		$('#LoginPassword').val(loginPassword);
		if (loginEmail == '' || loginPassword == '') {
			$('.login-failed-banner').show();
		} else {
			$('.login-failed-banner').hide();
		}
		if (toggle) {
			$('#UpdateEmployeeToggle').trigger('click');
		}
		$('.currentpass-group').show();
		$('.newpass-group').hide();
		$('#NewLoginPassword').val('');
		$('#RepeatNewLoginPassword').val('');
		$('.error-saving-banner').fadeOut('fast');
		$('.save-btn').removeClass('btn-secondary');
		$('.save-btn').addClass('btn-success');
		$('.save-btn').removeAttr('disabled');
		$('.save-btn').html('<i class="bi bi-check-square"></i> Save Changes');
		$('#UpdateEmployeeModal').modal('toggle');

		// get user logs
		$('#attendanceLogTable tbody').html('');
		var id = $('#UpdateUserID').val();
		if ($(this).html().length > 0) {
			$.get('getUserLogs', { dataType: 'json', userID: id })
			.done(function(data) {
				var userLogs = $.parseJSON(data);
				$.each(userLogs, function(index, val) {
					var dateNow = new Date();
					var date = val['DateAdded'].split(' ');
					var time = date[1].split(':');
					if (time[0] == 12) {
						time[0] = 0;
					}
					if (date[2] == 'PM') {
						time[0] = parseInt(time[0]) + 12;
					}
					var dateLog = new Date(date[0] + ' ' + time[0] + ':' + time[1] + ':' + time[2]);
					var diff = dateNow.getTime() - dateLog.getTime();
					timeDiff = [ Math.floor(diff / 86400000), Math.floor(diff / 3600000), Math.floor(diff / 60000) ];
					$('#attendanceLogTable tbody').append($('<tr>').append(
						$('<td>').html('Visited ' + val['PageURL'].replace(window.location.origin + '/', '') + '.')).append(
						$('<td>').attr({ class: 'text-muted' }).html(timeDiff[0] + 'd' + (timeDiff[1] - (timeDiff[0] * 24)) + 'h' + 
							(timeDiff[2] - ((timeDiff[1]  * 60))) + 'm ago'))
					)
				});
			}).fail(function () {
				alert(id);
			});
		}
	});
	$('#PFPInputPreview').click(function(){ $('#PFPInput').trigger('click'); });
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
	$("#PFPInput").change(function() {
		readURL(this, '#PFPInputPreview');
		$('#pImageChecker').val('1');
	});
	$("#UpdatePFPInput").change(function() {
		readURL(this, '#UpdatePFPInputPreview');
		$('#UpdatepImageChecker').val('1');
	});
	$('.employee-add-new-comment-btn').on('click', function() {
		$(this).attr('disabled', 'true');
		$('.employee-comment-input').fadeIn('fast');
	});
	$('#UpdateEmployeeToggle').on('change', function() {
		toggle = $('#UpdateEmployeeToggle').prop('checked');
		if (toggle) {
			$('#UpdateEmployeeModal').find('.modal-body').find('input').each(function() {
				$(this).attr('readonly', false);
			});
			$('#UpdateEmployeeModal').find('.modal-body').find('select').each(function() {
				$(this).attr('readonly', false);
				$(this).attr('disabled', false);
			});
			$('#LoginPassword').attr('readonly', true);
			$('.newpass-btn-group').fadeIn('fast');
		} else {
			$('#UpdateEmployeeModal').find('.modal-body').find('input').each(function() {
				$(this).attr('readonly', true);
			$('#UpdateEmployeeModal').find('.modal-body').find('select').each(function() {
				$(this).attr('readonly', true);
				$(this).attr('disabled', true);
			});
			});
			$('.newpass-btn-group').fadeOut('fast');
		}
	});
	$('.newpass-btn').on('click', function() {
		$('.currentpass-group').hide();
		$('.newpass-group').fadeIn('fast');
		$('.error-saving-banner').fadeIn('fast');
		$('.save-btn').addClass('btn-secondary');
		$('.save-btn').removeClass('btn-success');
		$('.save-btn').attr('disabled', 'true');
		$('.save-btn').html('<i class="bi bi-lock"></i> Save Changes');
	});
	$('#NewLoginPassword, #RepeatNewLoginPassword').bind('input', function() {
		let newLoginPass = $('#NewLoginPassword').val();
		let repeatLoginPass = $('#RepeatNewLoginPassword').val();
		if (newLoginPass.length > 0 && repeatLoginPass.length > 0) {
			if (newLoginPass == repeatLoginPass) {
				$('.error-saving-banner').fadeOut('fast');
				$('.save-btn').removeClass('btn-secondary');
				$('.save-btn').addClass('btn-success');
				$('.save-btn').removeAttr('disabled');
				$('.save-btn').html('<i class="bi bi-check-square"></i> Save Changes');
			} else {
				$('.error-saving-banner').fadeIn('fast');
				$('.save-btn').addClass('btn-secondary');
				$('.save-btn').removeClass('btn-success');
				$('.save-btn').attr('disabled', 'true');
				$('.save-btn').html('<i class="bi bi-lock"></i> Save Changes');
			}
		} else {
			$('.error-saving-banner').fadeIn('fast');
			$('.save-btn').addClass('btn-secondary');
			$('.save-btn').removeClass('btn-success');
			$('.save-btn').attr('disabled', 'true');
			$('.save-btn').html('<i class="bi bi-lock"></i> Save Changes');
		}
	});
	$('body').on('input', '.registration-email', function() {
		let value = $(this).val();
		$('.registration-email-icon').show();
		$('.email-banners-group').addClass('.opacity-4');
		$.ajax({
			url: "<?php echo base_url() . 'AJAX_validateEmailRegistration';?>",
			method: "POST",
			data: {email: value},
			dataType: "html",
			success: function(response){
				$('.email-banners-group').removeClass('.opacity-4');
				$('.email-banners-group').html(response);
				$('.registration-email-icon').hide();
			},
			error: function(xhr, textStatus, error){
				$('.email-banners-group').removeClass('.opacity-4');
				$('.email-banners-group').html('<span class="registration-message-banners info-banner-sm" data-feedback="1"><i class="bi bi-exclamation-triangle-fill"></i> No internet connection detected. Please check your internet and try again.</span>');
				$('.registration-email-icon').hide();
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
				// $('.comment-pen_' + id).html('<i class="bi bi-pen-fill"></i>');
			}
		});
	});
	$('body').on('click', '.send-registration-email-btn', function() {
		let email = $('.registration-email').val();
		$(this).html('<i class="spinner-border spinner-border-sm"></i> Sending...');
		$(this).attr('disabled', true);
		$.ajax({
			url: "<?php echo base_url() . 'AJAX_sendRegistrationEmail';?>",
			method: "POST",
			data: {email: email},
			dataType: "html",
			success: function(response){
				$('.send-registration-email-btn').html('<i class="bi bi-redo"></i> Resend');
				$('.send-registration-email-btn').attr('disabled', false);
				$('.send-email-banners-group').removeClass('.opacity-4');
				$('.send-email-banners-group').html(response);
				$('.registration-email-icon').hide();
			},
			error: function(xhr, textStatus, error){
				$('.send-registration-email-btn').html('<i class="bi bi-check-square"></i> Send Form to Email');
				$('.send-registration-email-btn').attr('disabled', false);
				$('.send-email-banners-group').removeClass('.opacity-4');
				$('.send-email-banners-group').html('<span class="registration-message-banners info-banner-sm" data-feedback="1"><i class="bi bi-exclamation-triangle-fill"></i> No internet connection detected. Please check your internet and try again.</span>');
				$('.registration-email-icon').hide();
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
				// $('.comment-pen_' + id).html('<i class="bi bi-pen-fill"></i>');
			}
		});
	});
});
</script>
</body>

</html>
