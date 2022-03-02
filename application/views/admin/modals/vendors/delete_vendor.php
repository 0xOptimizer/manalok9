<?php if (!$this->session->userdata('UserRestrictions')['vendors_delete']) return; ?>
<form id="formDeleteVendor" action="<?php echo base_url() . 'FORM_deleteVendor';?>" method="POST" enctype="multipart/form-data">
	<input id="vendorNoDelete" type="hidden" name="vendor-no">
</form>