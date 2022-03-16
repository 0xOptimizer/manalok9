<?php if (!$this->session->userdata('UserRestrictions')['returns_add']) return; ?>
<!-- ADD RETURN MODAL -->
<div class="modal fade" id="NewReturnModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<form id="formAddReturn" action="<?php echo base_url() . 'FORM_addNewReturn';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-reply-fill" style="font-size: 24px;"></i> NEW RETURN</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="sopCount" id="ProductsCount" required>
					<input type="hidden" name="salesOrderNo" id="SalesOrderNo" required>
					<div class="form-row">
						<div class="form-group col-sm-12">
							<label class="input-label">CLIENT</label>
							<button id="select-client-btn" type="button" class="btn btn-info form-control">
								<i class="bi bi-people-fill"></i> <span>SELECT CLIENT</span>
							</button>
						</div>
						<div class="form-group col-sm-12">
							<label class="input-label">SALES ORDER</label>
							<button id="select-salesorder-btn" type="button" class="btn btn-info form-control" disabled>
								<i class="bi bi-receipt"></i> <span>SELECT CLIENT FIRST</span>
							</button>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Return</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- SELECT CLIENT MODAL -->
<div class="modal fade" id="SelectClientModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-people-fill"></i> CLIENTS</h4>
			</div>
			<div class="modal-body">
				<?php $getClients = $this->Model_Selects->GetClientsWithSO(); ?>
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableClientsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="clientsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">CLIENT #</th>
								<th class="text-center">NAME</th>
								<th class="text-center">TIN</th>
								<th class="text-center">CONTACT #</th>
								<th class="text-center">CATEGORY</th>
								<th class="text-center">TERRITORY MANAGER</th>
							</thead>
							<tbody>
								<?php if ($getClients->num_rows() > 0):
									foreach ($getClients->result_array() as $row): ?>
										<tr class="select-client-row" data-no="<?=$row['ClientNo']?>">
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['ID']?></span>
											</td>
											<td class="text-center">
												<?=$row['ClientNo']?>
											</td>
											<td class="text-center">
												<?=$row['Name']?>
											</td>
											<td class="text-center">
												<?=$row['TIN']?>
											</td>
											<td class="text-center">
												<?=$row['ContactNum']?>
											</td>
											<td class="text-center">
												<?php switch ($row['Category']) {
													case '0': echo 'Confirmed Distributor'; break;
													case '1': echo 'Distributor On Probation'; break;
													case '2': echo 'Direct Dealer'; break;
													case '3': echo 'Direct End User'; break;
													default: echo 'NONE'; break;
												} ?>
											</td>
											<td class="text-center">
												<?=$row['TerritoryManager']?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- SELECT SALES ORDER MODAL -->
<div class="modal fade" id="SelectSalesOrdersModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt"></i> SALES ORDERS <span class="selectedClient"></span></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSalesOrdersSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="salesOrdersTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">SO #</th>
								<th class="text-center">DATE</th>
								<th class="text-center">ITEMS</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>