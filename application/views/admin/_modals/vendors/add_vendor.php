<?php if (!$this->session->userdata('UserRestrictions')['vendors_add']) return; ?>
<div class="modal fade" id="newVendorModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewVendor';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-shop-window" style="font-size: 24px;"></i> New Vendor</h4>
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
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<input id="in-address" type="text" class="form-control standard-input-pad" name="add-address" placeholder="M. Santos St., Brgy. San Jose, Antipolo City" required>
							<label class="input-label" for="in-address">ADDRESS</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-4 mb-3">
							<input id="in-contact-num" type="text" class="form-control standard-input-pad" name="add-contact-num" placeholder="09123456789" required>
							<label class="input-label" for="in-contact-num">CONTACT #</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-6 offset-md-1 mb-3">
							<input id="in-kind" type="text" class="form-control standard-input-pad" name="add-kind" placeholder="Soap" required>
							<label class="input-label" for="in-kind">KIND OF PRODUCT/SERVICE</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-6 mb-3">
							<input id="in-email" type="text" class="form-control standard-input-pad" name="add-email" placeholder="john@email.com" required>
							<label class="input-label" for="in-email">EMAIL</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD NEW VENDOR</button>
				</div>
			</div>
		</form>
	</div>
</div>