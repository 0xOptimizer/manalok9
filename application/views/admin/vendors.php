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
						<h3>Vendors
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
						<button type="button" class="newvendor-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-shop-window"></i> NEW VENDOR</button>
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
							<th></th>
							<th>VENDOR #</th>
							<th>NAME</th>
							<th>TIN</th>
							<th>ADDRESS</th>
							<th>CONTACT #</th>
							<th>KIND</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getVendors->num_rows() > 0):
								foreach ($getVendors->result_array() as $row): ?>
									<tr class="tr_class_modal" data-id="<?=$row['ID']?>">
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td>
											<?=$row['VendorNo']?>
										</td>
										<td>
											<?=$row['Name']?>
										</td>
										<td>
											<?=$row['TIN']?>
										</td>
										<td>
											<?=$row['Address']?>
										</td>
										<td>
											<?=$row['ContactNum']?>
										</td>
										<td>
											<?=$row['ProductServiceKind']?>
										</td>
										<td>
											<i class="bi bi-pencil btn-update-vendor"></i>
											<i class="bi bi-trash text-danger"></i>
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
<!-- New vendor modal -->
<?php $this->load->view('admin/modals/add_vendor.php'); ?>
<?php $this->load->view('admin/modals/vendor_modal.php'); ?>
<?php $this->load->view('admin/modals/update_vendor.php'); ?>

<?php $this->load->view('admin/modals/generate_report')?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
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

	function getVendorDetails(vendor_id) {
		$.ajax({
			url: 'getVendorDetails',
			type: 'GET',
			dataType: 'JSON',
			data: { vendor_id : vendor_id } ,
			success: function (response) {
				$('.m_vendorid').text(response.ID).val(response.ID);
				$('.m_vendorno').text(response.VendorNo).val(response.VendorNo);
				$('.m_name').text(response.Name).val(response.Name);
				$('.m_tin').text(response.TIN).val(response.TIN);
				$('.m_address').text(response.Address).val(response.Address);
				$('.m_contactnum').text(response.ContactNum).val(response.ContactNum);
				$('.m_kind').text(response.ProductServiceKind).val(response.ProductServiceKind);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	$('.tr_class_modal').on('click', function() {
		$('#VendorModal').modal('toggle');
		getVendorDetails($(this).data('id'));
	}).on('click', 'i', function(e) {
		e.stopPropagation();
	});
	$('.btn-update-vendor').on('click', function() {
		$('#UpdateVendorModal').modal('toggle');
		getVendorDetails($(this).parents('tr').data('id'));
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
