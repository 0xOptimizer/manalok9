<div class="modal fade" id="JournalModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-list-ul" style="font-size: 24px;"></i> Journal #<span class="m_journalid"></span></h4>
			</div>
			<div class="modal-body">
				<div class="row text-center d-flex flex-wrap justify-content-center mb-1">
					<div class="col-12 col-md-6 my-3">
						<h6>ID</h6>
						<label class="m_journalid"></label>
					</div>
					<div class="col-12 col-md-6 my-3">
						<h6>DATE</h6>
						<label class="m_date"></label>
					</div>
					<div class="col-12 my-3">
						<h6>DESCRIPTION</h6>
						<label class="m_description"></label>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-12">
						<div class="table-responsive">
							<table id="viewTransactionsTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th>ACCOUNT</th>
									<th>DEBIT</th>
									<th>CREDIT</th>
									<th></th>
								</thead>
								<tbody>
									<tr class="total-row" style="border-color: #a7852d;">
										<td style="color: #a7852d;">Total</td>
										<td class="debitTotalView">0</td>
										<td class="creditTotalView">0</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>