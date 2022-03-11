<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_view']) return; ?>
<div class="modal fade" id="LogModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-list" style="font-size: 24px;"></i> LOGS FOR SALES ORDER ID #<?=$salesOrder['OrderNo']?></h4>
			</div>
			<div class="modal-body mx-4">
				<div class="row">
					<div class="table-responsive">
						<table id="newTransactionsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">DATE</th>
								<th class="text-center">ACTION</th>
							</thead>
							<tbody>
								<tr>
									<td class="text-center"><?=$salesOrder['DateCreation']?></td>
									<td class="text-center">CREATION DATE</td>
								</tr>
								<?php if ($salesOrder['MarkDateInvoicing'] != NULL): ?>
									<tr>
										<td class="text-center"><?=$salesOrder['MarkDateInvoicing']?></td>
										<td class="text-center">MARKED FOR INVOICING</td>
									</tr>
								<?php endif; ?>
								<?php if ($salesOrder['MarkDateDelivery'] != NULL): ?>
									<tr>
										<td class="text-center"><?=$salesOrder['MarkDateDelivery']?></td>
										<td class="text-center">MARKED FOR DELIVERY</td>
									</tr>
								<?php endif; ?>
								<?php if ($salesOrder['MarkDateDelivered'] != NULL): ?>
									<tr>
										<td class="text-center"><?=$salesOrder['MarkDateDelivered']?></td>
										<td class="text-center">MARKED AS DELIVERED</td>
									</tr>
								<?php endif; ?>
								<?php if ($salesOrder['MarkDateReceived'] != NULL): ?>
									<tr>
										<td class="text-center"><?=$salesOrder['MarkDateReceived']?></td>
										<td class="text-center">MARKED AS RECEIVED</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>