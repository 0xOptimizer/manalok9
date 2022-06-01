<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_update']) return; ?>
<div class="modal fade" id="UpdateTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formUpdateTransaction" action="<?php echo base_url() . 'FORM_updateSOTransaction';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-pencil-square" style="font-size: 24px;"></i> Update Transaction</h4>
				</div>
				<div class="modal-body">
					<input id="sales_order_transaction_id" type="hidden" name="tid" value="" required>
					<div class="form-group col-sm-12 col-md-12 mx-auto text-center">
						<h5 id="sales_order_transaction_label" class="rounded-pill p-3"></h5>
					</div>
					<div class="form-group col-sm-12 col-md-6 mx-auto">
						<label class="input-label">QTY</label>
						<input id="sales_order_transaction_qty" type="number" min="1" class="form-control" name="qty" placeholder="*" required>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update Transaction</button>
				</div>
			</div>
		</form>
	</div>
</div>