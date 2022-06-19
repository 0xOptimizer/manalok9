<div class="modal fade" id="SalesOrderViewModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-list" style="font-size: 24px;"></i> Sales Order #<span id="sales_order_no"></span></h4>
			</div>
			<div class="modal-body mx-4">
				<div class="row">
					<div class="table-responsive mb-3">
						<table id="transactionsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">TRANSACTION ID</th>
								<th class="text-center">PRODUCT STOCK ID</th>
								<th class="text-center">QTY</th>
								<th class="text-center">UNIT DISCOUNT</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center">FREEBIE</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="table-responsive mb-3">
						<table id="adtlfeesTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">DESCRIPTION</th>
								<th class="text-center">QTY</th>
								<th class="text-center">UNIT DISCOUNT</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">TOTAL</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-7">
						<h5 class="text-end">Gross Sales:</h5>
					</div>
					<div id="totalpriceundiscounted" class="col-5 pl-1">0.00</div>
				</div>
				<div class="row">
					<div class="col-7">
						<h5 class="text-end">Total Price (Discounted):</h5>
					</div>
					<div id="totalpricediscounted" class="col-5 pl-1">0.00</div>
				</div>
				<div class="row">
					<div class="col-7">
						<h5 class="text-end">Total Freebie Price:</h5>
					</div>
					<div id="totalfreebieprice" class="col-5 pl-1">0.00</div>
				</div>
				<div class="feedback-form modal-footer">
					<a id="btn-viewSO" href="">
						<button type="button" class="btn btn-success"><i class="bi bi-eye"></i> View Sales Order</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>