<div class="modal fade" id="AddSalesOrderModal" tabindex="-1" role="dialog" aria-hidden="true" data-prevscroll="0">
	<div class="modal-dialog modal-xl" role="document">
		<form id="formAddSalesOrder" action="<?php echo base_url() . 'FORM_addSalesOrder';?>" method="POST" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> New Sales Order</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="productCount" id="ProductsCount" required>
					<input type="hidden" name="billToNo" id="BillToNo" required>
					<input type="hidden" name="shipToNo" id="ShipToNo" required>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">SALES ORDER #</label>
									<input type="text" class="form-control viewonly" value="SO<?=str_pad($this->db->count_all('sales_orders') + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-3">
									<label class="input-label">SALES ORDER DATE</label>
									<input type="date" class="form-control" name="date" value="<?=date("Y-m-d");?>" required>
								</div>
								<div class="form-group col-sm-12 col-md-3">
									<label class="input-label">SALES ORDER TIME</label>
									<input type="time" class="form-control" name="time" value="<?=date("H:i");?>" required>
								</div>
							</div>
						</div>
						<!-- Top Part -->
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="form-group col-sm-12">
									BILL TO:
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">NAME</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-x-circle-fill text-danger h-100 w-100 billNameIcon"></i></span>
										</div>
										<input type="text" class="form-control clientBillNameSearch billName shipToBillInput" name="bill-name" placeholder="John Doe" autocomplete="off" data-toggle="dropdown" required>
										<div class="dropdown-menu dropdown-menu-left clientBillNameDropdown"></div>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CLIENT #</label>
									<input type="text" class="form-control viewonly billNo shipToBillInput" data-newcno="C<?=str_pad($this->db->count_all('clients') + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
								</div>
								<div class="form-group col-sm-12">
									<label class="input-label">ADDRESS</label>
									<input type="text" class="form-control viewonly billAddress newBillInput shipToBillInput" name="bill-address" placeholder="M. Santos St." readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CITY, STATE/PROVINCE, ZIP</label>
									<input type="text" class="form-control viewonly billCity newBillInput shipToBillInput" name="bill-city-state-province-zip" placeholder="Antipolo, Rizal, 1870" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">COUNTRY</label>
									<input type="text" class="form-control viewonly billCountry newBillInput shipToBillInput" name="bill-country" placeholder="Philippines" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CONTACT NUMBER</label>
									<input type="text" class="form-control viewonly billContact newBillInput shipToBillInput" name="bill-contact-num" placeholder="09123456789" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CATEGORY</label>
									<select class="form-control viewonly billCategory newBillInput shipToBillInput" name="bill-category" readonly disabled>
										<option value="0" selected>CONFIRMED DISTRIBUTOR</option>
										<option value="1">DISTRIBUTOR ON PROBATION</option>
										<option value="2">DIRECT DEALER</option>
										<option value="3">DIRECT END USER</option>
									</select>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">TIN #</label>
									<input type="text" class="form-control viewonly billTIN newBillInput shipToBillInput" name="bill-tin" placeholder="123 456 789 000" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">TERRITORY MANAGER</label>
									<input type="text" class="form-control viewonly billTerritory newBillInput shipToBillInput" name="bill-territory-manager" placeholder="Jane Doe" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">EMAIL</label>
									<input type="email" class="form-control viewonly billEmail newBillInput shipToBillInput" name="bill-email" placeholder="john@email.com" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="row">
								<div class="form-group col-sm-12">
									SHIP TO: <button type="button" class="btn btn-sm-primary shipToBillingClient" style="font-size: 12px; display: none;">SHIP TO NEW BILLING CLIENT</button>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">NAME</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-x-circle-fill text-danger h-100 w-100 shipNameIcon"></i></span>
										</div>
										<input type="text" class="form-control clientShipNameSearch shipName" name="ship-name" placeholder="John Doe" autocomplete="off" data-toggle="dropdown" required>
										<div class="dropdown-menu dropdown-menu-left clientShipNameDropdown"></div>
									</div>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CLIENT #</label>
									<input type="text" class="form-control viewonly shipNo" data-newcno="C<?=str_pad($this->db->count_all('clients') + 1, 6, '0', STR_PAD_LEFT)?>" readonly>
								</div>
								<div class="form-group col-sm-12">
									<label class="input-label">ADDRESS</label>
									<input type="text" class="form-control viewonly shipAddress newShipInput" name="ship-address" placeholder="M. Santos St." readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CITY, STATE/PROVINCE, ZIP</label>
									<input type="text" class="form-control viewonly shipCity newShipInput" name="ship-city-state-province-zip" placeholder="Antipolo, Rizal, 1870" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">COUNTRY</label>
									<input type="text" class="form-control viewonly shipCountry newShipInput" name="ship-country" placeholder="Philippines" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CONTACT NUMBER</label>
									<input type="text" class="form-control viewonly shipContact newShipInput" name="ship-contact-num" placeholder="09123456789" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">CATEGORY</label>
									<select class="form-control viewonly shipCategory newShipInput" name="ship-category" readonly disabled>
										<option value="0" selected>CONFIRMED DISTRIBUTOR</option>
										<option value="1">DISTRIBUTOR ON PROBATION</option>
										<option value="2">DIRECT DEALER</option>
										<option value="3">DIRECT END USER</option>
									</select>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">TIN #</label>
									<input type="text" class="form-control viewonly shipTIN newShipInput" name="ship-tin" placeholder="123 456 789 000" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">TERRITORY MANAGER</label>
									<input type="text" class="form-control viewonly shipTerritory newShipInput" name="ship-territory-manager" placeholder="Jane Doe" readonly>
								</div>
								<div class="form-group col-sm-12 col-md-6">
									<label class="input-label">EMAIL</label>
									<input type="email" class="form-control viewonly shipEmail newShipInput" name="ship-email" placeholder="john@email.com" readonly>
								</div>
							</div>
						</div>
						<hr>
						<!-- Bottom Part -->
						<div class="col-sm-12 table-responsive add_table">
							<label class="input-label">SALES ITEMS</label>
							<table class="table" id="salesOrderProducts">
								<thead>
									<tr>
										<th class="text-center">FREEBIE</th>
										<th class="text-center">SKU</th>
										<th class="text-center">DATE ADDED</th>
										<th class="text-center">QTY</th>
										<th class="text-center">UNIT PRICE</th>
										<th class="text-center">TOTAL</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr class="newProduct">
										<td class="font-weight-bold add-product-row" colspan="7" style="cursor: pointer;">
											<i class="bi bi-plus"></i> New Product
										</td>
									</tr>
									<tr class="productsTotal" style="border-color: #a7852d;">
										<td class="font-weight-bold text-center" style="color: #a7852d;">FREEBIES TOTAL</td>
										<td class="totalFreebies text-center">0.00</td>
										<td></td>
										<td class="font-weight-bold text-center" colspan="2" style="color: #a7852d;">SUBTOTAL</td>
										<td class="subTotal text-center">0.00</td>
										<td></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="text-center" rowspan="4" colspan="3">
											<span class="footerHead">
												CATEGORY OF ACCOUNT:
											</span><br>
											<span class="dcCategory text-center">
												CONFIRMED DISTRIBUTOR
											</span>
										</td>
										<td class="footerHead footerDiscount text-center" colspan="2">
											Less: Outright Discount
											( <span class="dcOutright text-light">15</span>% )
											<div class="checkbox">
												<label>
													<input class="cbDiscount cbDiscountOutright" type="checkbox" name="discount-outright">
												</label>
											</div>
										</td>
										<td class="text-center dcOutrightAmt">0.00</td>
										<td></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="footerHead footerDiscount text-center" colspan="2">
											Volume Discount
											( <span class="dcVolume text-light">10</span>% )
											<div class="checkbox">
												<label>
													<input class="cbDiscount cbDiscountVolume" type="checkbox" name="discount-volume">
												</label>
											</div>
										</td>
										<td class="text-center dcVolumeAmt">0.00</td>
										<td></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="footerHead footerDiscount text-center" colspan="2">
											PBD Discount
											( <span class="dcPBD text-light">5</span>% )
											<div class="checkbox">
												<label>
													<input class="cbDiscount cbDiscountPBD" type="checkbox" name="discount-pbd">
												</label>
											</div>
										</td>
										<td class="text-center dcPBDAmt">0.00</td>
										<td></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="footerHead footerDiscount text-center" colspan="2">
											Manpower Discount
											( <span class="dcManpower text-light">5</span>% )
											<div class="checkbox">
												<label>
													<input class="cbDiscount cbDiscountManpower" type="checkbox" name="discount-manpower">
												</label>
											</div>
										</td>
										<td class="text-center dcManpowerAmt">0.00</td>
										<td></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="font-weight-bold text-center" style="color: #a7852d;">TOTAL DISCOUNT</td>
										<td class="totalDiscount text-center">0.00</td>
										<td></td>
										<td class="font-weight-bold text-center" colspan="2" style="color: #a7852d;">TOTAL</td>
										<td class="text-center total">0.00</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="feedback-form modal-footer">
					<button type="submit" class="btn btn-success"><i class="bi bi-plus-square"></i> Add Sales Order</button>
				</div>
			</div>
		</form>
	</div>
</div>