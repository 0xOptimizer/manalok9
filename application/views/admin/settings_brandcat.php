<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>

<style>
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
	.modal-content-custom  {
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important; 
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
					<div class="col-12 col-md-12">
						<h3><i class="bi bi-list-ol"></i> Brand Category</h3>
						
					</div>
					<div class="col-12 col-md-12 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['branding_add']): ?>
							<button type="button" class="addbrand-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> ADD BRAND</button>
						<?php endif; ?>
					</div>
					<p class="text-subtitle text-muted">Create or update Brand properties.</p>
				</div>
			</div>

			<?php if ($All_Brands->num_rows() > 0) { ?>
				<section class="section">
					<div class="table-responsive">
						<table id="brandsss" class="table">
							<thead>
								<tr>
									<th>
										BRAND
									</th>
									<th>
										CHAR
									</th>
									<th>
										TYPE
									</th>
									<th  width="150">
										ACTION
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($All_Brands->result_array() as $row) { ?>
									<tr>
										<td>
											<?php echo $row['Brand_Name']; ?>
										</td>
										<td>
											<?php echo $row['Brand_Char']; ?>
										</td>
										<td>
											<?php echo $row['Brand_Type']; ?>
										</td>
										<td class="d-flex flex-wrap justify-content-center">
											<a class="btn-viewbrand" style="margin-left: 6px; margin-right: 6px; color: #2E87EC;" href="#" data-value="<?php echo $row['UniqueID']; ?>"> <i class="bi bi-eye"></i> </a>
											<?php if ($this->session->userdata('UserRestrictions')['branding_edit']): ?>
												<a class="btn-updatebrand" style="margin-left: 6px; margin-right: 6px; color: #44BE9A;" href="#" data-value="<?php echo $row['UniqueID']; ?>"> <i class="bi bi-pencil-square"></i> </a>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['branding_delete']): ?>
												<a class="btn-removebrand" style="margin-left: 6px; margin-right: 6px; color: #E14A22;" href="<?=base_url()?>Del_brand?uid=<?php echo $row['UniqueID']; ?>" data-value="<?php echo $row['UniqueID']; ?>"> <i class="bi bi-trash"></i> </a>
											<?php endif; ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</section>
			<?php } ?>
		</div>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/modals/branding/view_brandcat.php'); ?>
<?php $this->load->view('admin/modals/branding/add_brandcat.php'); ?>
<?php $this->load->view('admin/modals/branding/add_brandvar.php'); ?>
<?php $this->load->view('admin/modals/branding/add_brandsize.php'); ?>
<?php $this->load->view('admin/modals/branding/update_brandcat.php'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<!-- <script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
	//--------------- SIDEBAR ---------------//
	$('.sidebar-admin-settings-bcat').addClass('active');
$(document).ready(function() {


	//--------------- TABLE ---------------//
	$('#brandsss').DataTable();

	//--------------- MODAL ---------------//
	$( ".addbrand-btn" ).click(function() {
		$('#add_brandcat').modal('toggle'); 
	});
	$( "#ModalDismisss" ).click(function() {
		$('#add_brandcat').modal('toggle');
	});

	//--------------- VIEW ---------------//
	$(document).on('click', '.btn-viewbrand', function() {
	// $( ".btn-viewbrand" ).click(function() {
		var uid = $(this).attr('data-value');
		$.ajax({
			url: '<?=base_url()?>GetBrand_data',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				var data = $.parseJSON(response);
				$('#view_brandcat').modal('toggle');
				$('.bname').html(data['Brand'].Brand_Name);
				$('.bchar').html(data['Brand'].Brand_Char);
				$('.btype').html(data['Brand'].Brand_Type);

				
				$('.bnameAbbr').html(data['Brand_Properties'].Brand_Abbr);
				$('.btAbbr').html(data['Brand_Properties'].Brand_Type_Abbr);
				$('.pline').html(data['Brand_Properties'].Product_Line);
				$('.plineAbbr').html(data['Brand_Properties'].Product_line_Abbr);
				$('.ptype').html(data['Brand_Properties'].Product_Type);
				$('.ptypeAbbr').html(data['Brand_Properties'].Product_Type_Abbr);

				$('.sizes_section').empty();
				$('.variants_section').empty();
				for (var i = 0; i < data['Brand_Sizes'].length; i++) {
					$('.sizes_section').append('<tr><td>'+ data['Brand_Sizes'][i].Product_Size +'</td> <td>'+ data['Brand_Sizes'][i].Product_Size_Abbr +'</td></tr>');
				}

				
				for (var i = 0; i < data['Brand_Variants'].length; i++) {
					
					$('.variants_section').append('<tr><td>'+ data['Brand_Variants'][i].Vcpd +'</td> <td>'+ data['Brand_Variants'][i].Vcpd_Abbr +'</td></tr>');
				}

				$('#add_brandvariants').attr('data-value' ,data['Brand'].UniqueID);
				$('#add_brandsizes').attr('data-value' ,data['Brand'].UniqueID);
				

				console.log(data);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	
	
	$( "#view_brandcatdismiss" ).click(function() {
		$('#view_brandcat').modal('toggle');
	});

	//--------------- UPDATE ---------------//
	$(document).on('click', '.btn-updatebrand', function() {
	// $( ".btn-updatebrand" ).click(function() {
		var uid = $(this).attr('data-value');
		$.ajax({
			url: '<?=base_url()?>GetBrand_data',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				var data = $.parseJSON(response);
				$('#update_brandcat').modal('toggle');

				
				$('.up_uid').val(data['Brand'].UniqueID);
				$('.up_brand_name').val(data['Brand'].Brand_Name);

				$('.up_brand_char').val(data['Brand'].Brand_Char);
				$('.up_brand_type').val(data['Brand'].Brand_Type);

				
				$('.up_brand_name_abbr').val(data['Brand_Properties'].Brand_Abbr);
				$('.up_brand_type_abbr').val(data['Brand_Properties'].Brand_Type_Abbr);

				$('.up_prod_line').val(data['Brand_Properties'].Product_Line);
				$('.up_prod_line_abbr').val(data['Brand_Properties'].Product_line_Abbr);
				$('.up_prod_type').val(data['Brand_Properties'].Product_Type);
				$('.up_prod_type_abbr').val(data['Brand_Properties'].Product_Type_Abbr);
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	$( "#update_brandcatdismiss" ).click(function() {
		$('#update_brandcat').modal('toggle');
	});


	//--------------- ADD VARIANTS ---------------//
	$('#add_brandvariants').click(function() {
		var uid = $(this).attr('data-value');
		$('#view_brandcat').modal('toggle');
		

		$.ajax({
			url: '<?=base_url()?>GetBrand_data',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				var data = $.parseJSON(response);
				$('#add_Brandvars').modal('toggle');

				$('#add_variud').val(data['Brand'].UniqueID);
				
				$('.variants_sectionsss').empty();
				for (var i = 0; i < data['Brand_Variants'].length; i++) {
					
					$('.variants_sectionsss').append('<tr class="row_varid" data-value="'+ data['Brand_Variants'][i].id +'"><td>'+ data['Brand_Variants'][i].Vcpd +'</td> <td>'+ data['Brand_Variants'][i].Vcpd_Abbr +'</td><td><a href="<?=base_url()?>remove_addVariants?id='+data['Brand_Variants'][i].id+'"><i class="bi bi-trash"></i></td></tr>');
				}
				
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	
	$('#add_varSubmit').click(function() {
		var add_variud = $('#add_variud').val();
		var add_vcpd = $('#add_vcpd').val();
		var add_vcpdabr = $('#add_vcpdabr').val();
		var uid = add_variud;
		$.ajax({
			url: '<?=base_url()?>Add_BrandVariant',
			type: 'post',
			data: { uid : add_variud , vcpd : add_vcpd , vcpdabr : add_vcpdabr } ,
			success: function (response) {
				alert(response);
				$.ajax({
					url: '<?=base_url()?>GetBrand_data',
					type: 'post',
					data: { uid : uid } ,
					success: function (response) {
						var data = $.parseJSON(response);
						// $('#add_Brandvars').modal('toggle');

						$('#add_variud').val(data['Brand'].UniqueID);

						$('.variants_sectionsss').empty();
						for (var i = 0; i < data['Brand_Variants'].length; i++) {

							$('.variants_sectionsss').append('<tr class="row_varid" data-value="'+ data['Brand_Variants'][i].id +'"><td>'+ data['Brand_Variants'][i].Vcpd +'</td> <td>'+ data['Brand_Variants'][i].Vcpd_Abbr +'</td><td><a href="<?=base_url()?>remove_addVariants?id='+data['Brand_Variants'][i].id+'"><i class="bi bi-trash"></i></td></tr>');
						}
						$('#add_vcpd').val("")
						$('#add_vcpdabr').val("")

					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});

	});

	$(document).on('click','tr.row_varid', function() {
		
		var uid = $('#add_variud').val();
		var id = $(this).attr('data-value');
		$.ajax({
			url: '<?=base_url()?>GetBrand_data',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				var data = $.parseJSON(response);
				$('#add_variud').val(data['Brand'].UniqueID);
				for (var i = 0; i < data['Brand_Variants'].length; i++) {
					if (data['Brand_Variants'][i].id == id) {
						
						$('[name="add_varid"]').val(data['Brand_Variants'][i].id);
						$('[name="vcpd"]').val(data['Brand_Variants'][i].Vcpd);
						$('[name="vcpd_abbr"]').val(data['Brand_Variants'][i].Vcpd_Abbr);
					}
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});

	$('#modaladddis').click(function() {
		$('#add_Brandvars').modal('toggle');
		// $('.btn-viewbrand').trigger('click');
		
	});
	//--------------- ADD SIZES ---------------//
	function Get_BrandSizes(uid) {
		var uid = uid;
		$.ajax({
			url: '<?=base_url()?>Add_BrandSizes',
			type: 'post',
			data: { uid : uid } ,
			success: function (response) {
				var data = $.parseJSON(response);
				$('.sizes_sectionsss').empty();
				for (var i = 0; i < data.length; i++) {

					$('.sizes_sectionsss').append('<tr class="row_sizeid" data-value="'+ data[i].id +'"><td>'+ data[i].Product_Size +'</td> <td>'+ data[i].Product_Size_Abbr +'</td><td><a href="<?=base_url()?>remove_addSizes?id='+data[i].id+'"><i class="bi bi-trash"></i></td></tr>');
				}
				
				console.log(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	$('#add_brandsizes').click(function() {
		var uid = $(this).attr('data-value');
		Get_BrandSizes(uid);
		$('#view_brandcat').modal('toggle');
		$('#add_brandsize').modal('toggle');
		$('#add_sizeiud').val(uid);
		

	});

	$('#modaldis_addsize').click(function() {
		
		$('#add_brandsize').modal('toggle');
		// $('.btn-viewbrand').trigger('click');

	});

	$('#add_sizeSubmit').click(function() {
		var uid = $('#add_sizeiud').val();
		var prd_size = $('#Add_prd_size').val();
		var prd_sizeabbr = $('#add_prd_sizeabbr').val();

		$.ajax({
			url: '<?=base_url()?>AddNew_BrandSizes',
			type: 'post',
			data: { uid : uid , prd_size : prd_size ,prd_sizeabbr : prd_sizeabbr } ,
			success: function (response) {
				alert(response);
				Get_BrandSizes(uid);
				$('#Add_prd_size').val("")
				$('#add_prd_sizeabbr').val("")
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	});
	

	//--------------- REMOVE ---------------//
	// $( ".btn-removebrand" ).click(function() {
	// 	var uid = $(this).attr('data-value');
	// 	$.ajax({
	// 		url: '<?=base_url()?>Delete_brand',
	// 		type: 'post',
	// 		data: { uid : uid } ,
	// 		success: function (response) {
	// 			alert(response);
	// 			Get_BrandSizes(uid);
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {
	// 			console.log(textStatus, errorThrown);
	// 		}
	// 	});
	// });
	$(document).on('click', '.btn-removebrand', function() {
		if (!confirm('Remove Brand?')) {
			event.preventDefault();
		}
	});
	


});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
