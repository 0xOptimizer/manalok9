<?php if (!$this->session->userdata('UserRestrictions')['purchase_orders_add_manual_transaction']) return; ?>
<div class="modal fade" id="PurchaseManualTransaction" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formAddPOManualTransaction" action="<?php echo base_url() . 'FORM_addNewManualTransaction';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-plus-square" style="font-size: 24px;"></i> PO Manual Transaction</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="purchase-order-no" value="<?=$purchaseOrderNo?>" required>
					<div class="row">
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">ITEM NO</label>
							<input type="text" class="form-control" name="item-no" placeholder="Item No" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">DESCRIPTION</label>
							<input type="text" class="form-control" name="description" placeholder="Description" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">QTY</label>
							<input type="number" class="form-control" name="qty" value="0" min="0" required>
						</div>
						<div class="form-group col-sm-12 col-md-9 mx-auto">
							<label class="input-label">UNIT COST</label>
							<input type="number" class="form-control" name="unit-cost" min="0" placeholder="0.00" step="0.000001" value="0" required>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Manual Transaction</button>
				</div>
			</div>
		</form>
	</div>
</div>