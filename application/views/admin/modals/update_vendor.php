<div class="modal fade" id="UpdateVendorModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_updateVendor';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-shop-window" style="font-size: 24px;"></i> Update Vendor #<span class="m_vendorid"></span></h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="upd-vendor-id" class="m_vendorid">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="upd-vendor-no" type="text" class="form-control standard-input-pad m_vendorno" readonly>
							<label class="input-label" for="upd-vendor-no">VENDOR #</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<input id="upd-name" type="text" class="form-control standard-input-pad m_name" name="upd-name" placeholder="John Doe">
							<label class="input-label" for="upd-name">NAME</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="upd-tin" type="text" class="form-control standard-input-pad m_tin" name="upd-tin" placeholder="123 456 789 000">
							<label class="input-label" for="upd-tin">TIN</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<input id="upd-address" type="text" class="form-control standard-input-pad m_address" name="upd-address" placeholder="M. Santos St., Brgy. San Jose, Antipolo City">
							<label class="input-label" for="upd-address">ADDRESS</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-4 mb-3">
							<input id="upd-contact-num" type="text" class="form-control standard-input-pad m_contactnum" name="upd-contact-num" placeholder="09123456789">
							<label class="input-label" for="upd-contact-num">CONTACT #</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-6 offset-md-1 mb-3">
							<input id="upd-kind" type="text" class="form-control standard-input-pad m_kind" name="upd-kind" placeholder="Soap">
							<label class="input-label" for="upd-kind">KIND OF PRODUCT/SERVICE</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> UPDATE VENDOR DETAILS</button>
				</div>
			</div>
		</form>
	</div>
</div>