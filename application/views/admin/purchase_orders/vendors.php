<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch vendors
$getVendors = $this->Model_Selects->GetVendors();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>

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
						<h3><i class="bi bi-shop-window"></i> Vendors
							<span class="text-center success-banner-sm">
								<i class="bi bi-shop-window"></i> <?=$getVendors->num_rows();?> TOTAL
							</span>
							<?php if ($getVendors->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No vendors found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['vendors_add']): ?>
							<button type="button" class="newvendor-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-shop-window"></i> NEW VENDOR</button>
						<?php endif; ?>
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
					<table id="vendorsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center">ID</th>
							<th class="text-center">VENDOR #</th>
							<th class="text-center">NAME</th>
							<th class="text-center">ADDRESS</th>
							<th class="text-center">CONTACT #</th>
							<th class="text-center">KIND OF PRODUCT / SERVICE</th>
							<th class="text-center">EMAIL</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getVendors->num_rows() > 0):
								foreach ($getVendors->result_array() as $row): ?>
									<tr class="tr_class_modal" data-no="<?=$row['VendorNo']?>">
										<td class="text-center">
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td class="text-center">
											<?=$row['VendorNo']?>
										</td>
										<td class="text-center">
											<?=$row['Name']?>
										</td>
										<td class="text-center">
											<?=$row['Address']?>
										</td>
										<td class="text-center">
											<?=$row['ContactNum']?>
										</td>
										<td class="text-center">
											<?=$row['ProductServiceKind']?>
										</td>
										<td class="text-center">
											<?=($row['Email'] ? $row['Email'] : '---')?>
										</td>
										<td class="text-center">
											<i class="bi bi-eye btn-view-vendor" style="color: #408AF7;"></i>
											<?php if ($this->session->userdata('UserRestrictions')['vendors_edit']): ?>
												<i class="bi bi-pencil btn-update-vendor" style="color: #229F4B;"></i>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['vendors_delete']): ?>
												<i class="bi bi-trash text-danger btn-delete-vendor"></i>
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
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/vendors/add_vendor.php'); ?>
<?php $this->load->view('admin/_modals/vendors/vendor_modal.php'); ?>
<?php $this->load->view('admin/_modals/vendors/update_vendor.php'); ?>
<?php $this->load->view('admin/_modals/vendors/delete_vendor.php'); ?>

<?php $this->load->view('admin/_modals/generate_report')?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_buttons.html5.min.js"></script>

<script>
$('.sidebar-admin-vendors').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#vendorsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.newvendor-btn').on('click', function() {
		$('#newVendorModal').modal('toggle');
	});

	if(window.location.hash && window.location.hash.substring(0, 2) == '#V') {
		var vendor_no = window.location.hash.substring(1);
		$('#VendorModal').modal('toggle');
		getVendorDetails(vendor_no);
	}

	
	var table = $('#vendorsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
    	buttons: [
            {
	            extend: 'print',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	            },
	            customize: function ( doc ) {
	            	$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/images/manalok9_logo.png" width="200px" height="55px" />');
					$(doc.document.body).find('h1').css('font-size', '24px');
					$(doc.document.body).find('h1').css('text-align', 'center'); 
				}
	        },
	        {
	            extend: 'copyHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	            }
	        },
	        {
	            extend: 'excelHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	            }
	        },
	        {
	            extend: 'csvHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	            }
	        },
	        {
	            extend: 'pdfHtml5',
	            exportOptions: {
	                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
	            }
	        }
    ]});
    $('body').on('click', '#generateReport-Print', function () {
        table.button('0').trigger();
    });
    $('body').on('click', '#generateReport-Copy', function () {
        table.button('1').trigger();
    });
    $('body').on('click', '#generateReport-Excel', function () {
        table.button('2').trigger();
    });
    $('body').on('click', '#generateReport-CSV', function () {
        table.button('3').trigger();
    });
    $('body').on('click', '#generateReport-PDF', function () {
        table.button('4').trigger();
    });
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	function getVendorDetails(vendor_no) {
		$.ajax({
			url: 'getVendorDetails',
			type: 'GET',
			dataType: 'JSON',
			data: { vendor_no : vendor_no } ,
			success: function (response) {
				$('.m_vendorid').text(response.ID).val(response.ID);
				$('.m_vendorno').text(response.VendorNo).val(response.VendorNo);
				$('.m_name').text(response.Name).val(response.Name);
				$('.m_tin').text(response.TIN).val(response.TIN);
				$('.m_address').text(response.Address).val(response.Address);
				$('.m_contactnum').text(response.ContactNum).val(response.ContactNum);
				$('.m_kind').text(response.ProductServiceKind).val(response.ProductServiceKind);
				$('.m_email').text(response.Email).val(response.Email);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	$(document).on('click', '.btn-view-vendor', function() {
		$('#VendorModal').modal('toggle');
		getVendorDetails($(this).parents('tr').data('no'));
	});
	$(document).on('click', '.btn-update-vendor', function() {
		$('#UpdateVendorModal').modal('toggle');
		getVendorDetails($(this).parents('tr').data('no'));
	});
	$(document).on('click', '.btn-delete-vendor', function() {
		let vendor_no = $(this).parents('tr').data('no');
		if (!confirm('Delete Vendor #'+ vendor_no +'? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#vendorNoDelete').val(vendor_no);
			$('#formDeleteVendor').submit();
		}
	});
});
</script>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
