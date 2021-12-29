<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

// Fetch clients
$getClients = $this->Model_Selects->GetClients();

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
						<h3>Clients
							<span class="text-center success-banner-sm">
								<i class="bi bi-people-fill"></i> <?=$getClients->num_rows();?> TOTAL
							</span>
							<?php if ($getClients->num_rows() <= 0): ?>
								<span class="info-banner-sm">
									<i class="bi bi-exclamation-diamond-fill"></i> No clients found.
								</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-sm-12 col-md-10 pt-4 pb-2">
						<?php if ($this->session->userdata('UserRestrictions')['clients_add'] == 1): ?>
						<button type="button" class="newclient-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-people-fill"></i> NEW CLIENT</button>
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
					<table id="clientsTable" class="standard-table table">
						<thead style="font-size: 12px;">
							<th>ID</th>
							<th>CLIENT #</th>
							<th>NAME</th>
							<th>TIN</th>
							<th>CONTACT #</th>
							<th>CATEGORY</th>
							<th>TERRITORY MANAGER</th>
							<th></th>
						</thead>
						<tbody>
							<?php
							if ($getClients->num_rows() > 0):
								foreach ($getClients->result_array() as $row): ?>
									<tr class="tr_class_modal" data-no="<?=$row['ClientNo']?>">
										<td>
											<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
										</td>
										<td>
											<?=$row['ClientNo']?>
										</td>
										<td>
											<?=$row['Name']?>
										</td>
										<td>
											<?=$row['TIN']?>
										</td>
										<td>
											<?=$row['ContactNum']?>
										</td>
										<td>
											<?php switch ($row['Category']) {
												case '0': echo 'Confirmed Distributor'; break;
												case '1': echo 'Distributor On Probation'; break;
												case '2': echo 'Direct Dealer'; break;
												case '3': echo 'Direct End User'; break;
												default: echo 'NONE'; break;
											} ?>
										</td>
										<td>
											<?=$row['TerritoryManager']?>
										</td>
										<td>
											<i class="bi bi-eye btn-view-client" style="color: #408AF7;"></i>
											<?php if ($this->session->userdata('UserRestrictions')['clients_edit'] == 1): ?>
											<i class="bi bi-pencil btn-update-client" style="color: #229F4B;"></i>
											<?php endif; ?>
											<?php if ($this->session->userdata('UserRestrictions')['clients_delete'] == 1): ?>
											<i class="bi bi-trash text-danger btn-delete-client"></i>
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
<?php if ($this->session->userdata('UserRestrictions')['clients_add'] == 1): ?>
<!-- New client modal -->
<?php $this->load->view('admin/modals/add_client.php'); ?>
<?php endif; ?>
<?php $this->load->view('admin/modals/client_modal.php'); ?>
<?php if ($this->session->userdata('UserRestrictions')['clients_edit'] == 1): ?>
<?php $this->load->view('admin/modals/update_client.php'); ?>
<?php endif; ?>
<?php if ($this->session->userdata('UserRestrictions')['clients_delete'] == 1): ?>
	<form id="formDeleteClient" action="<?php echo base_url() . 'FORM_deleteClient';?>" method="POST" enctype="multipart/form-data">
		<input id="clientNoDelete" type="hidden" name="client-no">
	</form>
<?php endif; ?>

<script src="<?=base_url()?>assets/clients/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="<?=base_url()?>assets/js/jquery.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-clients').addClass('active');
$(document).ready(function() {
	<?php if ($highlightID != 'N/A'): ?>
		$('#clientsTable').find("[data-id='" + "<?=$highlightID;?>" + "']").addClass('highlighted'); 
	<?php endif; ?>
	$('.newclient-btn').on('click', function() {
		$('#newClientModal').modal('toggle');
	});

	if(window.location.hash && window.location.hash.substring(0, 3) == '#C-') {
		var client_no = window.location.hash.substring(1, 9);
		$('#ClientModal').modal('toggle');
		getClientDetails(client_no);
	}
	
	var table = $('#clientsTable').DataTable( {
		sDom: 'lrtip',
		"bLengthChange": false,
    	"order": [[ 0, "desc" ]],
	});
	$('#tableSearch').on('keyup change', function() {
		table.search($(this).val()).draw();
	});

	function getClientDetails(client_no) {
		$.ajax({
			url: 'getClientDetails',
			type: 'GET',
			dataType: 'JSON',
			data: { client_no : client_no } ,
			success: function (response) {
				$('.m_clientid').text(response.ID).val(response.ID);
				$('.m_clientno').text(response.ClientNo).val(response.ClientNo);
				$('.m_name').text(response.Name).val(response.Name);
				$('.m_tin').text(response.TIN).val(response.TIN);
				$('.m_address').text(response.Address).val(response.Address);
				$('.m_citystateprovincezip').text(response.CityStateProvinceZip).val(response.CityStateProvinceZip);
				$('.m_country').text(response.Country).val(response.Country);
				$('.m_contactnum').text(response.ContactNum).val(response.ContactNum);
				let category = null;
				switch (response.Category) {
					case '0': category = 'Confirmed Distributor'; break;
					case '1': category = 'Distributor On Probation'; break;
					case '2': category = 'Direct Dealer'; break;
					case '3': category = 'Direct End User'; break;
				}
				$('.m_category').text(category);
				$('.ms_category option[value=' + response.Category + ']').prop('selected', true);
				$('.m_territorymanager').text(response.TerritoryManager).val(response.TerritoryManager);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});
	}
	$(document).on('click', '.btn-view-client', function() {
		$('#ClientModal').modal('toggle');
		getClientDetails($(this).parents('tr').data('no'));
	});
	$(document).on('click', '.btn-update-client', function() {
		$('#UpdateClientModal').modal('toggle');
		getClientDetails($(this).parents('tr').data('no'));
	});
	$(document).on('click', '.btn-delete-client', function() {
		let client_no = $(this).parents('tr').data('no');
		if (!confirm('Delete Client #'+ client_no +'? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#clientNoDelete').val(client_no);
			$('#formDeleteClient').submit();
		}
	});
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>
</body>

</html>
