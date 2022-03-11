<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery']) return; ?>
<div class="modal fade" id="DeliveryScheduling" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formScheduleDelivery" action="<?php echo base_url() . 'FORM_scheduleDelivery';?>" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-truck" style="font-size: 24px;"></i> SO Delivery Scheduling</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>" required>
					<div class="form-group col-sm-12 col-md-9 mx-auto">
						<label class="input-label">DATE</label>
						<input type="date" id="delivery_scheduling_date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Schedule for Delivery</button>
				</div>
			</div>
		</form>
	</div>
</div>