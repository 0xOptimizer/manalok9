<?php
$globalHeader;

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>
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
	/* Chrome, Safari, Edge, Opera */
	.num-noarrow::-webkit-outer-spin-button,
	.num-noarrow::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	.num-noarrow {
	  -moz-appearance: textfield;
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
					<div class="col-12 col-md-6">
						<h3><i class="bi bi-trash-fill"></i> Trash
							<span class="text-center success-banner-sm">
								<i class="bi bi-bag-fill"></i> <?=$Trashed_Products->num_rows();?> TOTAL
							</span>
							<?php if ($Trashed_Products->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No products found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<small class="text-danger">
							Deleting a product will removed all data connected to it.
						</small>
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
					<table id="trash_table" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>BARCODE</th>
							<th>CODE</th>
							<th>NAME</th>
							<th>CATEGORY</th>
							<th>DESCRIPTION</th>
							<th>IN STOCK</th>
							<th>RELEASED</th>
							<th></th>
						</thead>
						<tbody>
							<!-- TEMPORARY REMOVED -->
							<?php
							if ($Trashed_Products->num_rows() > 0):
								foreach ($Trashed_Products->result_array() as $row): ?>
									<tr>
										<td width="100">
											<div class="p-2 text-center" style="background-color: white;">
												<img src="<?=base_url();?><?=$row['Barcode_Images']?>" width="95" alt="No image">
											</div>
										</td>
										<td>
											<?=$row['Code']?>
										</td>
										<td>
											<?=$row['Product_Name']?>
										</td>
										<td>
											<?=$row['Product_Category']?>
										</td>
										<td>
											<?=$row['Description']?>
										</td>
										<td>
											<?=$row['InStock']?>
										</td>
										<td>
											<?=$row['Released']?>
										</td>
										<td class="text-center">
											<?php if ($this->session->userdata('UserRestrictions')['trash_bin_retrieve']): ?>
												<span style="margin-right: 15px;">
													<a id="redo_archived" href="#" data-value="<?=$row['ID']?>">
														<i class="bi bi-arrow-counterclockwise" style="color: #408AF7;"></i>
													</a>
												</span>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['trash_bin_delete']): ?>
												<span style="margin-right: 15px;">
													<a id="deleted_product" href="#" data-value="<?=$row['ID']?>">
														<i class="bi bi-trash" style="color: #CF3939;"></i>
													</a>
												</span>
											<?php endif; ?>
										</td>
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
<?php $this->load->view('admin/modals/trash_bin/prompt_redo'); ?>
<?php $this->load->view('admin/modals/trash_bin/prompt_remove'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>



<script>
$('.sidebar-employee-trash').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#trash_table').find("[data-code='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	
	var table = $('#trash_table').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 3, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function(){
		table.search($(this).val()).draw();
	});
	$("textarea").each(function () {
		this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
	}).on("input", function () {
		this.style.height = "auto";
		this.style.height = (this.scrollHeight) + "px";
	});

	// -------------- REDO
	$('#redo_archived').on('click', function(){

		var prd_id = $(this).attr('data-value');

		$('#prompt_redo').modal('toggle');
		$('#retrieve_prd').attr('href', '<?=base_url()?>admin/redo_arch?prd_id='+prd_id);
	});

	$('#cancel_modalRetrive').on('click', function(){
		$('#prompt_redo').modal('toggle');
	});

	// -------------- DELETE
	$('#deleted_product').on('click', function(){
		var prd_id = $(this).attr('data-value');
		$('#prompt_remove').modal('toggle');
		$('#delete_prd').attr('href', '<?=base_url()?>admin/delete_prd?prd_id='+prd_id);
	});
	$('#cancel_modaldelete').on('click', function(){
		$('#prompt_remove').modal('toggle');
	});



});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
