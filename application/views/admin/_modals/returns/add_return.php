<?php if (!$this->session->userdata('UserRestrictions')['returns_add']) return; ?>
<!-- ADD RETURN MODAL -->
<div class="modal fade" id="NewReturnModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formAddReturn" action="<?php echo base_url() . 'FORM_addNewReturn';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-reply-fill" style="font-size: 24px;"></i> NEW RETURN</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="sopCount" id="ProductsCount" required>
					<input type="hidden" name="salesOrderNo" id="SalesOrderNo" required>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CLIENT</label>
									<button id="select-client-btn" type="button" class="btn btn-info form-control">
										<i class="bi bi-people-fill"></i> <span>SELECT CLIENT</span>
									</button>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">SALES ORDER</label>
									<button id="select-salesorder-btn" type="button" class="btn btn-info form-control" disabled>
										<i class="bi bi-receipt"></i> <span>SELECT CLIENT FIRST</span>
									</button>
								</div>
							</div>
						</div>
						<!-- Bottom Part -->
						<div class="col-sm-12 table-responsive">
							<label class="input-label">RETURN ITEMS</label>
							<table class="table table-hover" id="salesOrderReturnProducts">
								<thead>
									<tr>
										<th class="text-center">FREEBIE</th>
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">QTY</th>
										<th class="text-center">PRICE</th>
										<th class="text-center">TOTAL PRICE</th>
										<th class="text-center">REMARKS</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr class="newProduct">
										<td class="font-weight-bold add-salesorderproduct-row" colspan="8" style="cursor: pointer;">
											<i class="bi bi-plus"></i> Add Return
										</td>
									</tr>
									<tr class="productsTotal" style="border-color: #a7852d;">
										<td></td>
										<td class="font-weight-bold text-center" style="color: #a7852d;">FREEBIES TOTAL</td>
										<td class="totalFreebies text-center">0.00</td>
										<td class="font-weight-bold text-center" style="color: #a7852d;">TOTAL</td>
										<td class="total text-center">0.00</td>
										<td colspan="2"></td>
									</tr>
								</tbody>
							</table>
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
<!-- SELECT SALES ORDER PRODUCTS MODAL -->
<div class="modal fade" id="SelectSOProductsModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-box"></i> SALES ORDER <span class="selectedSalesOrder"></span> PRODUCTS</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableSalesOrderProductsSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="salesOrderProductsTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">TRANSACTION ID</th>
								<th class="text-center">PRODUCT CODE</th>
								<th class="text-center">AMOUNT</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center">FREEBIE</th>
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