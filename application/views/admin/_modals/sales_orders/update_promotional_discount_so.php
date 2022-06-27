<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_update']) return; ?>
<div class="modal fade" id="SOPromoDiscount" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formSOPromoDiscount" action="<?php echo base_url() . 'FORM_updateSOPromoTransactionDiscount';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-pencil-square" style="font-size: 24px;"></i> SO Promotional Discount</h4>
				</div>
				<div class="modal-body">
					<input id="sales_order_transaction_pd_id" type="hidden" name="tid" value="" required>

					<div class="form-group col-sm-12 col-md-12 mx-auto text-center">
						<h5 id="sales_order_promo_discount_label" class="rounded-pill p-3"></h5>
					</div>

					<div class="form-group col-sm-12 col-md-9 mx-auto">
						<label class="input-label">Promotional Discount (%)</label>
						<input id="sales_order_promotional_discount" type="number" min="0" class="form-control" name="pd" placeholder="*" required>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i> Update Promotional Discount</button>
				</div>
			</div>
		</form>
	</div>
</div>