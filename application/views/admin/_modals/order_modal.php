<div class="modal fade" id="PurchaseOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> Purchase Order #<span class="m_orderid"></span></h4>
			</div>
			<div class="modal-body">
				<div class="row text-center d-flex flex-wrap justify-content-center">
					<div class="col-12 col-md-6">
						<h6>SERIES NO.</h6>
						<label class="m_seriesno"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>DATE CREATION</h6>
						<label class="m_datecreation"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>CLIENT NAME</h6>
						<label class="m_clientname"></label>
					</div>
					<div class="col-12 col-md-6">
						<h6>SHIP ADDRESS</h6>
						<label class="m_shipaddress"></label>
					</div>
					<hr class="mt-2">
					<div class="col-sm-12 table-responsive">
						<table id="orderTransactionsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">CODE</th>
								<th class="text-center">TRANSACTION ID</th>
								<th class="text-center">AMOUNT</th>
								<th class="text-center">TRANSACTION DATE</th>
								<th class="text-center">STATUS</th>
								<th class="text-center"></th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<form action="<?php echo base_url() . 'FORM_approvePurchaseOrder';?>" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="orderID" class="m_inp_orderid">
					<button type="submit" class="approvePurchaseOrder btn btn-success"><i class="bi bi-check2"></i> Approve</button>
				</form>
			</div>
		</div>
	</div>
</div>