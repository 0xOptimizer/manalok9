<div class="modal fade" id="TransactionDetails" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_TransactionUpdate';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> New Product</h4>
				</div>
				<div class="modal-body">
					<div class="row text-center d-flex flex-wrap justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 mt-3 mb-4">
							<h6>Transaction ID</h6>
							<label class="m_transactionid"></label>
						</div>
						<div class="col-12 col-sm-12 col-md-12 mt-3 mb-2">
							<h5 class="m_Type text-success"></h5>
						</div>
						<div class="col-12 col-sm-12 col-md-12 mt-4 mb-2">
							<h6>DATE OF TRANSACTION</h6>
							<label class="m_transactiondate"></label>
						</div>
					</div>
				</div>
				<div class="p-3 d-flex flex-wrap justify-content-between">
					<div class="">
						<a id="Approve_TransactionBTN" type="button" class="btn btn-success" style="width: 110px;"><i class="bi bi-check2"></i> Approve</a>
					</div>
					<div class="">
						<a type="button" class="btn btn-success" style="width: 110px;"><i class="bi bi-check2"></i> Track</a>
					</div>
					<div class="">
						<a type="button" class="btn btn-danger" style="width: 110px;"><i class="bi bi-trash-fill"></i> Reject</a>
					</div>
					<div class="">
						<a type="button" class="btn_transactionM btn btn-secondary" style="width: 110px;"><i class="bi bi-x"></i>Exit</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>