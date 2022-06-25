<?php if (!$this->session->userdata('UserRestrictions')['bills_add']) return; ?>
<div class="modal fade" id="grpBillModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formGroupBill" action="<?php echo base_url() . 'FORM_groupBill';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cash" style="font-size: 24px;"></i> Group Bill Expense</h4>
				</div>
				<div class="modal-body">
					<div class="row text-center">

						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">SEARCH BILL</label>
							<input id="groupbill_search" type="text" class="form-control" placeholder="Search Bill Expenses">
						</div>

						<div class="form-group col-12">
							<div class="table-responsive">
								<table id="grpBillsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">DATE</th>
										<th class="text-center">NAME</th>
										<th class="text-center">TIN # VAT</th>
										<th class="text-center">TIN # NON</th>
										<th class="text-center">ADDRESS</th>
										<th class="text-center">PARTICULARS</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center">SI# OR#</th>
										<th class="text-center">REMARKS</th>
										<th class="text-center">DEPARTMENT</th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>

						<hr>
						<div class="row">
							<h5>&bull; Bill Expense Group &bull;</h5>
						</div>
						<hr>

						<div class="form-group col-12">
							<div class="table-responsive">
								<table id="grpBillsTableAdd" class="standard-table table">
									<tbody>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Group Bills</button>
				</div>
			</div>
		</form>
	</div>
</div>