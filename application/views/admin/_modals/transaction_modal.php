<div class="modal fade" id="TransactionDetails" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_TransactionUpdate';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<div class="ml-auto">
						<span class="text-muted" style="font-size: 12px;">
							<i class="bi bi-journal-text"></i> <span class="m_transactionid"></span>
						</span>
					</div>
					<div class="mr-auto">
						<span class="text-muted" style="font-size: 12px;">
							<i class="bi bi-journal-text"></i> <span class="m_transactiondate"></span>
						</span>
					</div>
				</div>
				<div class="modal-body">
					<div class="row text-center d-flex flex-wrap justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 mt-3 mb-3">
							<b class="standard-tooltip-title">FOR PRODUCT</b>
							<p class="standard-tooltip-text transaction-product-name" style="font-size: 20px;">[loading...]</p>
						</div>
						<div class="col-12 col-sm-12 col-md-12 mt-3 mb-2">
							<p class="transaction-type text-success"><p>
							<p class="transaction-amount text-success"></p>
						</div>
						<div class="col-12 col-sm-12 col-md-12 mt-4 mb-2">
							<p class="transaction-status"></p>
							<p class="m_transactionid" style="font-size: 12px;"></p>
						</div>
					</div>
				</div>
				<div class="p-3 d-flex flex-wrap justify-content-between">
					<div class="">
						<a type="button" class="btn btn-danger" style="width: 110px;"><i class="bi bi-trash-fill"></i> Reject</a>
					</div>
					<div class="">
						<a type="button" class="btn btn-success" style="width: 110px;"><i class="bi bi-check2"></i> Track</a>
					</div>
					<?php if ($this->session->userdata('Privilege') > 1): ?>
						<div class="">
							<a id="Approve_TransactionBTN" type="button" class="btn btn-success" style="width: 110px;"><i class="bi bi-check2"></i> Approve</a>
						</div>
					<?php endif; ?>
					<!-- <div class="">
						<a type="button" class="btn_transactionM btn btn-secondary" style="width: 110px;"><i class="bi bi-x"></i>Exit</a>
					</div> -->
				</div>
			</div>
		</form>
	</div>
</div>