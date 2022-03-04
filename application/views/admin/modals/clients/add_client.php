<?php if (!$this->session->userdata('UserRestrictions')['clients_add']) return; ?>
<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewClient';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-people-fill" style="font-size: 24px;"></i> New Client</h4>
				</div>
				<div class="modal-body">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-9 mb-3">
							<input id="in-name" type="text" class="form-control standard-input-pad" name="add-name" placeholder="John Doe" required>
							<label class="input-label" for="in-name">NAME</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="in-tin" type="text" class="form-control standard-input-pad" name="add-tin" placeholder="123 456 789 000" required>
							<label class="input-label" for="in-tin">TIN</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5  offset-md-1 mb-3">
							<input id="in-address" type="text" class="form-control standard-input-pad" name="add-address" placeholder="M. Santos St." required>
							<label class="input-label" for="in-address">ADDRESS</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="in-city-state-province-zip" type="text" class="form-control standard-input-pad" name="add-city-state-province-zip" placeholder="Antipolo, Rizal, 1870" required>
							<label class="input-label" for="in-city-state-province-zip">CITY, STATE/PROVINCE, ZIP</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5  offset-md-1 mb-3">
							<input id="in-country" type="text" class="form-control standard-input-pad" name="add-country" placeholder="Philippines">
							<label class="input-label" for="in-country" required>COUNTRY</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="in-contact-num" type="text" class="form-control standard-input-pad" name="add-contact-num" placeholder="09123456789" required>
							<label class="input-label" for="in-contact-num">CONTACT #</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<select id="in-category" class="form-control standard-input-pad" name="add-category">
								<option value="0" selected>Confirmed Distributor</option>
								<option value="1">Distributor On Probation</option>
								<option value="2">Direct Dealer</option>
								<option value="3">Direct End User</option>
							</select>
							<label class="input-label" for="in-category">CATEGORY</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="in-territory-manager" type="text" class="form-control standard-input-pad" name="add-territory-manager" placeholder="Jane Doe"  required>
							<label class="input-label" for="in-territory-manager">TERRITORY MANAGER</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5  offset-md-1 mb-3">
							<input id="in-email" type="email" class="form-control standard-input-pad" name="add-email" placeholder="john@gmail.com">
							<label class="input-label" for="in-email" required>EMAIL</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD NEW CLIENT</button>
				</div>
			</div>
		</form>
	</div>
</div>