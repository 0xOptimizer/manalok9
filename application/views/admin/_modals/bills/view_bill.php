<div class="modal fade" id="grpViewBillModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cash" style="font-size: 24px;"></i> View Bill Expense</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>DATE</h6>
						<label class="text-muted view_bill_date"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>NAME</h6>
						<label class="text-muted view_bill_name"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>TIN # VAT</h6>
						<label class="text-muted view_bill_tinvat"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>TIN # NON</h6>
						<label class="text-muted view_bill_tinnon"></label>
					</div>

					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>ADDRESS</h6>
						<label class="text-muted view_bill_address"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>SI# OR#</h6>
						<label class="text-muted view_bill_sinorn"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>REMARKS</h6>
						<label class="text-muted view_bill_remarks"></label>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto text-center">
						<h6>DEPARTMENT</h6>
						<label class="text-muted view_bill_department"></label>
					</div>

					<hr class="my-3" style="height: 5px;">

					<div class="form-group col-sm-12 col-md-12 mx-auto">
						<div class="table-responsive">
							<table id="billsViewTable" class="table table-hover">
								<thead style="font-size: 12px;">
									<th class="text-center">#</th>
									<th class="text-center">PARTICULARS</th>
									<th class="text-center">AMOUNT</th>
									<th class="text-center"></th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div class="form-group col-sm-12 col-md-12 mx-auto">
						<form id="formAddGroupBill" action="<?php echo base_url() . 'FORM_addGroupBill';?>" method="POST">
							<input id="addGroupBillNo" type="hidden" name="group_no">
							<div class="table-responsive">
								<table id="billsGroupAddTable" class="table table-hover">
									<thead style="font-size: 12px;">
										<th class="text-center">#</th>
										<th class="text-center">PARTICULARS</th>
										<th class="text-center">AMOUNT</th>
										<th class="text-center"></th>
									</thead>
									<tbody>
										<tr class="add-viewbill-row">
											<td class="text-center pt-3" role="button" colspan="4" style="background-color: rgba(167, 133, 45, 0.2);">
												<h6><i class="bi bi-plus-square"></i> ADD ROW</h6>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="text-end">
								<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Bills</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>