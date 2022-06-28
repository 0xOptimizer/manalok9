<?php if (!$this->session->userdata('UserRestrictions')['bills_add']) return; ?>
<div class="modal fade" id="newBillModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="formAddBill" action="<?php echo base_url() . 'FORM_addBill';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cash" style="font-size: 24px;"></i> Add Bill Expense</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<!-- <div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DESCRIPTION</label>
							<textarea rows="2" class="form-control standard-input-pad" name="description" placeholder="Payment of rent / Purchase of supplies"></textarea>
						</div> -->
						<!-- <div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="mode-payment">MODE OF PAYMENT</label>
							<input type="text" class="form-control" name="mode-payment" placeholder="Cash" required>
						</div> -->
						<!-- <div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="type">TYPE</label>
							<input type="text" class="form-control" name="type" placeholder="Type" list="types" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="payee">PAYEE</label>
							<input type="text" class="form-control" name="payee" placeholder="Payee" list="payees" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label" name="category">CATEGORY</label>
							<input type="text" class="form-control" name="category" placeholder="Category" list="categories" required>
						</div> -->
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">DATE</label>
							<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">NAME</label>
							<input type="text" class="form-control" name="name" placeholder="*Name" required>
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">TIN # VAT</label>
							<input type="text" class="form-control" name="tinvat" placeholder="TIN # VAT">
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">TIN # NON</label>
							<input type="text" class="form-control" name="tinnon" placeholder="TIN # NON">
						</div>

						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">ADDRESS</label>
							<input type="text" class="form-control" name="address" placeholder="*Address" required>
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">SI# OR#</label>
							<input type="text" class="form-control" name="sinorn" placeholder="*SI# OR#" required>
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">REMARKS</label>
							<input type="text" class="form-control" name="remarks" placeholder="*Remarks" required>
						</div>
						<div class="form-group col-sm-12 col-md-6 mx-auto">
							<label class="input-label">DEPARTMENT</label>
							<input type="text" class="form-control" name="department" placeholder="*Department" list="departments" required>
						</div>

						<hr class="my-3" style="height: 5px;">

						<div class="form-group col-sm-12 col-md-12 mx-auto">
							<div class="table-responsive">
								<table id="billsAddTable" class="table table-hover">
									<thead style="font-size: 12px;">
										<th class="text-center">#</th>
										<th class="text-center">PARTICULARS</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center"></th>
									</thead>
									<tbody>
										<tr class="add-bill-row">
											<td class="text-center pt-3" role="button" colspan="4" style="background-color: rgba(167, 133, 45, 0.2);">
												<h6><i class="bi bi-plus-square"></i> ADD ROW</h6>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Bill</button>
				</div>
			</div>
		</form>
	</div>
</div>