<?php if (!$this->session->userdata('UserRestrictions')['return_product_return_to_inventory']) return; ?>
<!-- RETURN TO INVENTORY -->
<div class="modal fade" id="InventoryReturnProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="updateReturnProductToInventory" action="<?php echo base_url() . 'FORM_updateReturnProductToInventory';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-reply-all" style="font-size: 24px;"></i> Return To Inventory</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="returnNo" value="<?=$return['ReturnNo']?>" required>
					<input type="hidden" name="transactionID" id="inventoryReturnTransactionID" required>
					<div class="form-group col-sm-12 text-center">
						<h5><?=$return['ReturnNo']?></h5>
					</div>
					<div class="form-group col-sm-12 text-center">
						<h5 class="text-secondary inventoryReturnTransactionID"></h5>
					</div>
					<hr>
					<div class="form-group col-sm-12 text-center">
						<input class="form-control inventoryReturnQty text-center" type="number" name="qty" min="1" max="1" required>
						<label class="input-label">QTY</label>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>