<div class="modal fade" id="AddOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form action="<?php echo base_url() . 'FORM_addPurchaseOrder';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> New Purchase Order</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<!-- Left Part -->
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<div class="row">
										<input type="hidden" name="transactionsCount" id="TransactionsCount">
										<div class="form-group col-sm-12 col-md-6">
											<label class="input-label">SERIES NO.</label>
											<input type="text" class="form-control" value="POSAMPLE-<?=str_pad($this->Model_Selects->MaxOrderID() + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
										</div>
										<div class="form-group col-sm-12 col-md-6">
											<label class="input-label">DATE OF CREATION</label>
											<input type="date" class="form-control" name="dateCreated" value="<?=date("Y-m-d");?>" required>
										</div>
										<div class="form-group col-sm-12 col-md-6">
											<label class="input-label">CLIENT NAME</label>
											<input type="text" class="form-control" name="clientName" autocomplete="off" required>
										</div>
										<div class="form-group col-sm-12 col-md-6">
											<label class="input-label">SHIP ADDRESS</label>
											<input type="text" class="form-control" name="shipAddress" autocomplete="off" required>
										</div>
										<div class="col-sm-12 table-responsive">
											<label class="input-label">TRANSACTIONS</label>
											<table class="table" id="orderTransactions">
												<thead>
													<tr>
														<th class="text-center">ID</th>
														<th class="text-center">CODE</th>
														<th class="text-center">RELEASED</th>
														<th class="text-center">TRANSACTION DATE</th>
														<th class="text-center"></th>
													</tr>
												</thead>
												<tbody>
													<tr class="noTransaction">
														<td class="text-center" colspan="4">
															<label class="input-label">
																[ EMPTY ]
															</label>
														</td>
													</tr>
													<tr class="transactionsTotal" style="border-color: #a7852d;">
														<td class="font-weight-bold" style="color: #a7852d;">TOTAL</td>
														<td></td>
														<td class="released text-center">0</td>
														<td></td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Right Part -->
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<?php $getAllTransactions = $this->Model_Selects->GetTransactionsReleasedUnordered(); ?>
								<div class="col-sm-0 col-md-6"></div>
								<div class="col-sm-12 col-md-6 pt-4 pb-2" style="margin-top: -15px;">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
										</div>
										<input type="text" id="tableTransactionsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
									</div>
								</div>
								<div class="col-sm-12 table-responsive">
									<table id="transactionsTable" class="standard-table table">
										<thead style="font-size: 12px;">
											<th class="text-center">ID</th>
											<th class="text-center">CODE</th>
											<th class="text-center">TRANSACTION ID</th>
											<th class="text-center">RELEASED</th>
											<th class="text-center">DATE</th>
											<th class="text-center">USER</th>
										</thead>
										<tbody>
											<?php
											if ($getAllTransactions->num_rows() > 0):
												foreach ($getAllTransactions->result_array() as $row): ?>
													<tr class="add-transaction-row transaction-<?=$row['ID']?>" data-id="<?=$row['ID']?>">
														<td class="text-center">
															<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
														</td>
														<td class="text-center tCode">
															<?=$row['Code']?>
														</td>
														<td class="text-center">
															<?=$row['TransactionID']?>
														</td>
														<td class="text-center tReleased">
															<?=$row['Amount']?>
														</td>
														<td class="text-center tDate">
															<?=$row['Date']?>
														</td>
														<td class="text-center tDate">
															<?=$row['UserID']?>
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
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Purchase Order</button>
				</div>
			</div>
		</form>
	</div>
</div>