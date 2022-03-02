<?php if (!$this->session->userdata('UserRestrictions')['clients_delete']) return; ?>
<form id="formDeleteClient" action="<?php echo base_url() . 'FORM_deleteClient';?>" method="POST" enctype="multipart/form-data">
	<input id="clientNoDelete" type="hidden" name="client-no">
</form>