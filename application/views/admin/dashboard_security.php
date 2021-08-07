<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');
$date = date('M j, Y');

if ($this->input->get('date')) {
	$date = $this->input->get('date');
	$date = date('M j, Y', strtotime($date));
}
$isCurrentDate = false;
if ($date == date('M j, Y')) {
	$isCurrentDate = true;
}

// Fetch products
$getAllSecurityLogs = $this->Model_Selects->GetAllSecurityLogs();

// Highlighting new recorded entry
$highlightID = 'N/A';
if ($this->session->flashdata('highlight-id')) {
	$highlightID = $this->session->flashdata('highlight-id');
}
?>
<style>
	body {
		background-color: #121b11 !important;
	}
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
							<i class="bi bi-shield-fill"></i> Security Overview
						</h3>
					</div>
					<div class="col-sm-12">
						<!-- <button type="button" class="newproduct-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-bag-plus"></i> NEW PRODUCT</button>
						|
						<button type="button" class="newtransaction-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-cart-plus"></i> NEW TRANSACTION</button>
						<a href="<?=base_url() . 'admin/inventory';?>" class="btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-folder-symlink-fill"></i> VIEW IN INVENTORY</a> -->
					</div>
				</div>
			</div>
			<section class="section">
				<div class="table-responsive">
					<table id="productsTable" class="table">
						<thead style="font-size: 12px;">
							<th></th>
							<th>USER</th>
							<th>AGENT</th>
							<th>PLATFORM</th>
							<th>COUNTRY</th>
							<th>PAGE</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getAllSecurityLogs->num_rows() > 0):
								foreach ($getAllSecurityLogs->result_array() as $row): ?>
									<tr>
										<td>
											<span style="color: #198754;"><i class="bi bi-check-circle"></i></span>
										</td>
										<td>
											<?=$row['UserID'];?>
										</td>
										<td>
											<?=$row['Agent'];?>
										</td>
										<td>
											<?=$row['Platform'];?>
										</td>
										<td>
											<?=$row['IPAddress']?> (<?=$row['Country'];?>)
										</td>
										<td>
											<?=$row['PageURL'];?>
										</td>
										<td>
											<span class="text-muted"><?=$row['DateAdded'];?></span>
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
<!-- New product modal -->
<?php $this->load->view('admin/modals/add_product.php'); ?>
<!-- New transactions modal -->
<?php $this->load->view('admin/modals/add_transaction.php'); ?>

<?php $this->load->view('main/globals/scripts.php'); ?>
<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/main.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-dashboard').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#productsTable').find("[data-code='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.newproduct-btn').on('click', function() {
		$('#newProductModal').modal('toggle');
	});
	$('.newtransaction-btn').on('click', function() {
		$('#newTransactionModal').modal('toggle');
	});
	/*
	var table = $('#productsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 1, "desc" ]],
    	buttons: [
        {
            extend: 'print',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            },
            customize: function ( doc ) {
            	$(doc.document.body).find('h1').prepend('<img src="<?=base_url()?>assets/img/wercher_logo.png" width="63px" height="56px" />');
				$(doc.document.body).find('h1').css('font-size', '24px');
				$(doc.document.body).find('h1').css('text-align', 'center'); 
			}
        },
        {
            extend: 'copyHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'excelHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'csvHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        },
        {
            extend: 'pdfHtml5',
            exportOptions: {
                columns: [ 1, 3, 4, 6 ]
            }
        }
    ]});
	$('#ExportPrint').on('click', function () {
        table.button('0').trigger();
    });
    $('#ExportCopy').on('click', function () {
        table.button('1').trigger();
    });
    $('#ExportExcel').on('click', function () {
        table.button('2').trigger();
    });
    $('#ExportCSV').on('click', function () {
        table.button('3').trigger();
    });
    $('#ExportPDF').on('click', function () {
        table.button('4').trigger();
    });
    */
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>