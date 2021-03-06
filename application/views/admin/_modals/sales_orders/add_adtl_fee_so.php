<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_adtl_fees']) return; ?>
<div class="modal fade" id="SalesAdtlFee" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formAddSOAdtlFee" action="<?php echo base_url() . 'FORM_addNewSOAdtlFee';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> SO Additional Fee</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="sales-order-no" value="<?=$salesOrderNo?>" required>
					<div class="row">
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DESCRIPTION</label>
							<input type="text" class="form-control" name="description" placeholder="Description" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">QTY</label>
							<input type="number" class="form-control" name="qty" min="0" placeholder="0" value="1" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">UNIT DISCOUNT (%)</label>
							<input type="number" class="form-control" name="unit-discount" min="0" placeholder="0" step="0.001" value="0" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">UNIT PRICE</label>
							<input type="number" class="form-control" name="unit-price" min="0" placeholder="0.00" step="0.000001" value="0" required>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Additional Fee</button>
				</div>
			</div>
		</form>
	</div>
</div>