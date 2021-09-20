<div class="modal fade" id="UpdateClientModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_updateClient';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-shop-window" style="font-size: 24px;"></i> Update Client #<span class="m_clientid"></span></h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="upd-client-id" class="m_clientid">
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="upd-name" type="text" class="form-control standard-input-pad m_name" name="upd-name" placeholder="John Doe">
							<label class="input-label" for="upd-name">NAME</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<input id="upd-tin" type="text" class="form-control standard-input-pad m_tin" name="upd-tin" placeholder="123 456 789 000">
							<label class="input-label" for="upd-tin">TIN</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-11 m-auto mb-3">
							<input id="upd-address" type="text" class="form-control standard-input-pad m_address" name="upd-address" placeholder="M. Santos St., Brgy. San Jose, Antipolo City">
							<label class="input-label" for="upd-address">ADDRESS</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap justify-content-center">
						<div class="form-group col-12 col-sm-12 col-md-5 mb-3">
							<input id="upd-contact-num" type="text" class="form-control standard-input-pad m_contactnum" name="upd-contact-num" placeholder="09123456789">
							<label class="input-label" for="upd-contact-num">CONTACT #</label>
						</div>
						<div class="form-group col-12 col-sm-12 col-md-5 offset-md-1 mb-3">
							<input id="upd-category" type="text" class="form-control standard-input-pad m_category" name="upd-category" placeholder="Category">
							<label class="input-label" for="upd-category">CATEGORY</label>
						</div>
					</div>
					<div class="form-row d-flex flex-wrap">
						<div class="form-group col-12 col-sm-12 col-md-11 m-auto mb-3">
							<input id="upd-territory-manager" type="text" class="form-control standard-input-pad m_territorymanager" name="upd-territory-manager" placeholder="Jane Doe">
							<label class="input-label" for="upd-territory-manager">TERRITORY MANAGER</label>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> UPDATE CLIENT DETAILS</button>
				</div>
			</div>
		</form>
	</div>
</div>