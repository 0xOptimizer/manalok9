<?php
$globalHeader;
?>
<style>
	/*body {
		background-color: #121b11 !important;
	}*/
	.rotate-text {
		-webkit-transform:rotate(-75deg);
	}
	.card-container a {
		text-decoration: none;
	}
	.card-headers {
		border-radius: 3px 3px 0px 0px;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
		padding-left: 20px;
		color: #FFFFFF;
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
					<div class="col-12 col-md-6">
						<h3>
							<i class="bi bi-envelope"></i> Mail
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<button type="button" class="newmail-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW MAIL</button>
					</div>
					<div class="col-sm-12 col-md-2 mr-auto pt-4 pb-2" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="mail_table" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>SENT TO</th>
							<th>SUBEJCT</th>
							<th>MESSAGE</th>
							<th>ATTACHMENT</th>
							<!-- <th></th> -->
						</thead>
						<tbody>
							<?php
							if ($GetAll_Mail->num_rows() > 0):
								foreach ($GetAll_Mail->result_array() as $row): ?>
									<tr>

										<td>
											<?=$row['sent_to']?>
										</td>
										<td>
											<?=$row['subject']?>
										</td>
										<td>
											<?=$row['message']?>
										</td>
										<td>
											<?=$row['attachment']?>
										</td>
										<!-- <td class="text-center"  width="150">
											<span style="margin-right: 5px;">
												<a href="<?=base_url() . 'admin/viewproduct?code=' . $row['id'];?>">
													<i class="bi bi-eye" style="color: #408AF7;"></i>
												</a>
											</span>
											<span style="margin-right: 5px;">
												<a class="update_prd" href="#" data-value="<?=$row['id']?>">
													<i class="bi bi-pencil" style="color: #229F4B;"></i>
												</a>
											</span>
											<span style="margin-right: 5px;">
												<a class="delete_product" href="#" data-value="<?php echo $row['id'] ;?>">
													<i class="bi bi-trash" style="color: #CF3939;"></i>
												</a>
											</span>
										</td> -->
									</tr>
								<?php endforeach;
							endif; ?>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/modals/add_mail.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>

$(document).ready(function() {
	$('.sidebar-employee-mail').addClass('active');

	var table = $('#mail_table').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 3, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});

	$('.newmail-btn').on('click', function() {
		$('#add_mailtosend').modal('toggle');
	});
	$('#submit_formsend').on('click', function() {
		$('#form_emailsend').submit();
	});

});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
