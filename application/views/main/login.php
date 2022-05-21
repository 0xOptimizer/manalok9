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
				<form action="<?php echo base_url() . 'FORM_loginValidation';?>" method="POST" enctype="multipart/form-data">
					<div class="form-group position-relative has-icon-left mt-2 mb-4">
						<input type="text" class="form-control form-control-xl" name="email" placeholder="Email">
						<div class="form-control-icon">
							<i class="bi bi-envelope" style="font-size: 18px;"></i>
						</div>
					</div>
					<div class="input-group form-group position-relative has-icon-left">
						<input type="password" class="form-control form-control-xl" name="password" id="password" placeholder="Password">
						<div class="form-control-icon">
							<i class="bi bi-shield-lock" style="font-size: 18px;"></i>
						</div>
						<button type="button" id="btn-show-password" class="input-group-button btn m-0 px-3" style="border-bottom: 2px solid #a7852d;">
							<i class="bi bi-eye" style="font-size: 18px; color: #fff;"></i>
							<!-- <i class="bi bi-eye-slash" style="font-size: 18px; color: #fff;"></i> -->
						</button>
					</div>
					<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3"><img src="<?=base_url() . 'assets/images/hosoinu.png'?>" width="40" height="32"> Log in</button>
				</form>
			</div>
		</div>
		<div class="col-lg-7 d-none d-lg-block" style="background-color: #222124;">
			<div>

			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
	var sp = document.getElementById('btn-show-password');
	var pw = document.getElementById('password');
	sp.onclick = function() {
		if (pw.type == 'password') {
			pw.type = 'text';
		} else {
			pw.type = 'password';
		}
	};
</script>
</body>
</html>
