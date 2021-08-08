<?php
$globalHeader;

?>
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/pages/auth.css">
</head>

<body>
<div id="auth" style="background-color: rgba(0, 0, 0, 0.08);">

	<div class="row h-100">
		<div class="col-lg-5 col-sm-12" style="height: 100%; background-color: #2c2c2c;">
			<div id="auth-left">
				<h1 class="text-center mb-4"><img src="<?=base_url() . 'assets/images/manalok9_logo.png'?>"></h1>
				<?=$this->session->flashdata('prompt');?>
				<div class="row mb-1">
					<span class="text-center success-banner">
						<i class="bi bi-exclamation-diamond-fill"></i> [DEMO] Email: admin | Password: admin
					</span>
				</div>
				<form action="<?php echo base_url() . 'FORM_loginValidation';?>" method="POST" enctype="multipart/form-data">
					<div class="form-group position-relative has-icon-left mt-2 mb-4">
						<input type="text" class="form-control form-control-xl" name="email" placeholder="Email">
						<div class="form-control-icon">
							<i class="bi bi-envelope" style="font-size: 18px;"></i>
						</div>
					</div>
					<div class="form-group position-relative has-icon-left">
						<input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
						<div class="form-control-icon">
							<i class="bi bi-shield-lock" style="font-size: 18px;"></i>
						</div>
					</div>
					<!-- <div class="form-check form-check-lg d-flex align-items-end">
						<input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
						<label class="form-check-label text-gray-600" for="flexCheckDefault">
							Keep me logged in
						</label>
					</div> -->
					<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3"><img src="<?=base_url() . 'assets/images/hosoinu.png'?>" width="40" height="32"> Log in</button>
				</form>
				<!-- <div class="text-center mt-5 text-lg fs-4">
					<p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a></p>
				</div> -->
			</div>
		</div>
		<div class="col-lg-7 d-none d-lg-block" style="background-color: #222124;">
			<div>

			</div>
		</div>
	</div>

</div>
</body>

</html>
