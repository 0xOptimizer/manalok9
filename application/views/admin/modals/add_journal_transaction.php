<div class="modal fade" id="AddJournalTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formAddJournal" action="<?php echo base_url() . 'FORM_addJournal';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-list-ul" style="font-size: 24px;"></i> New Transaction</h4>
				</div>
				<div class="modal-body mx-4">
					<div class="row">
						<input type="hidden" id="transactionsCount" name="transactions-count" value="0">
						<div class="form-group col-12 col-md-8">
							<label class="input-label">DESCRIPTION</label>
							<textarea rows="2" class="form-control standard-input-pad" name="description" placeholder="Payment of rent / Purchase of supplies"></textarea>
						</div>
						<div class="form-group col-12 col-md-4">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-12">
							<div class="table-responsive">
								<table id="newTransactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th>ACCOUNT</th>
										<th>DEBIT</th>
										<th>CREDIT</th>
										<th></th>
									</thead>
									<tbody>
										<tr class="font-weight-bold add-account-row">
											<td><i class="bi bi-plus"></i> New Account</td>
											<td colspan="3"></td>
										</tr>
										<tr style="border-color: #a7852d;">
											<td style="color: #a7852d;">Total</td>
											<td class="debitTotal">0</td>
											<td class="creditTotal">0</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add New Journal Transaction</button>
				</div>
			</div>
		</form>
	</div>
</div>