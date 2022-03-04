<?php if (!$this->session->userdata('UserRestrictions')['purchase_orders_accounting']) return; ?>
<div class="modal fade" id="AccountingModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-box-seam"></i> JOURNAL TRANSACTIONS FOR PURCHASE ORDER ID #<?=$purchaseOrder['OrderNo']?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<button type="button" class="newtransaction-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW TRANSACTION</button>
					</div>
				</div>
				<div class="row">
					<?php $getOrderJournals = $this->Model_Selects->GetJournalByOrderNo($purchaseOrder['OrderNo']); ?>
					<div class="col-sm-12 table-responsive">
						<table class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">DATE</th>
								<th class="text-center">DESCRIPTION</th>
								<th class="text-center">TOTAL</th>
								<th></th>
							</thead>
							<tbody>
								<?php
								if ($getOrderJournals->num_rows() > 0):
									foreach ($getOrderJournals->result_array() as $row): ?>
										<tr class="tr_class_modal" data-id="<?=$row['ID']?>">
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
											</td>
											<td class="text-center"><?=$row['Date']?></td>
											<td class="text-center"><?=$row['Description']?></td>
											<td class="text-center"><?=number_format($row['Total'], 2)?></td>
											<td class="text-center">
												<a href="<?=base_url() . 'admin/journals#J'. $row['ID']?>">
													<i class="bi bi-eye btn-view-journal" style="color: #408AF7;"></i>
												</a>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="AddJournalTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formAddJournal" action="<?php echo base_url() . 'FORM_addJournal';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-list-ul" style="font-size: 24px;"></i> NEW JOURNAL TRANSACTION FOR PURCHASE ORDER ID #<?=$purchaseOrder['OrderNo']?></h4>
				</div>
				<div class="modal-body mx-4">
					<div class="row">
						<input type="hidden" id="transactionsCount" name="transactions-count" value="0">
						<input type="hidden" name="order_no" value="<?=$purchaseOrder['OrderNo']?>">
						<div class="form-group col-12 col-md-8">
							<label class="input-label">DESCRIPTION</label>
							<textarea rows="4" class="form-control standard-input-pad" name="description" placeholder="Payment of rent / Purchase of supplies" required></textarea>
						</div>
						<div class="form-group col-12 col-md-4">
							<div class="row">
								<div class="form-group col-12">
									<label class="input-label">DATE</label>
									<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-12">
									<label class="input-label">TIME</label>
									<input type="time" class="form-control" name="time" value="<?=date("H:i");?>" required>
								</div>
							</div>
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
<?php if ($this->session->userdata('UserRestrictions')['journal_transactions_delete'] || $this->session->userdata('UserRestrictions')['purchase_orders_accounting']): ?>
	<form id="formDeleteJournal" action="<?php echo base_url() . 'FORM_deleteJournal';?>" method="POST" enctype="multipart/form-data">
		<input id="journalIDDelete" type="hidden" name="journal-id">
	</form>
<?php endif; ?>