<?php if (!$this->session->userdata('UserRestrictions')['journal_transactions_delete']) return; ?>
<form id="formDeleteJournal" action="<?php echo base_url() . 'FORM_deleteJournal';?>" method="POST" enctype="multipart/form-data">
	<input id="journalIDDelete" type="hidden" name="journal-id">
</form>