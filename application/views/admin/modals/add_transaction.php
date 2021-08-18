<div class="modal fade" id="newTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewTransaction';?>" method="POST" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-journal-text" style="font-size: 24px;"></i> New Transaction Record</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<!-- <div class="col-sm-12">
								<label for="transaction-id" style="font-size: 12px;">ID</label>
								<input id="transaction-id" type="text" class="form-control w-50">
							</div> -->
							<div class="col-sm-12">
								<label for="transaction-code" style="font-size: 12px;">FOR PRODUCT CODE</label>
								<input id="transaction-code" name="transaction-code" type="text" class="form-control">
							</div>
							<div class="col-sm-12 mt-2">
								<label for="transaction-type" style="font-size: 12px;">TYPE</label>
								<select id="transaction-type" name="transaction-type" class="form-control" <?=($this->session->userdata('Privilege') < 2 ? 'readonly disabled' : '')?>>
									<option value="0">Restock</option>
									<option value="1">Released</option>
								</select>
							</div>
							<div class="col-sm-12 mt-2">
								<label for="transaction-amount" style="font-size: 12px;">AMOUNT OF STOCKS</label>
								<input id="transaction-amount" name="transaction-amount" type="text" class="form-control">
							</div>
							<div class="col-sm-12 mt-2">
								<label for="transaction-date" style="font-size: 12px;">DATE</label>
								<input id="transaction-date" name="transaction-date" type="date" class="form-control" value="<?=date("Y-m-d");?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button type="submit" class="btn btn-success"><i class="bi bi-save"></i> PROCESS</button>
			</div>
		</div>
		</form>
	</div>
</div>