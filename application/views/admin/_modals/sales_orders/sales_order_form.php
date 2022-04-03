<?php if (!$this->session->userdata('UserRestrictions')['sales_orders_view']) return; ?>
<!-- FORM TRANSACTION SELECTION -->
<div class="modal fade" id="SalesOrderFormTransactionsModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-file-earmark-excel-fill" style="font-size: 24px;"></i> Generate Sales Order Form</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center fw-bold">QTY</th>
							<th class="text-center fw-bold" colspan="2">ITEM DESCRIPTION</th>
							<th class="text-center fw-bold">UNIT PRICE</th>
							<th class="text-center fw-bold" colspan="2">TOTAL</th>
						</thead>
						<tbody>
							<?php
							if ($getTransactionsByOrderNo->num_rows() > 0):
								$amountTotal = 0;
								foreach ($getTransactionsByOrderNo->result_array() as $row):
									$product = $this->Model_Selects->GetProductByCode($row['Code']);
									$pDescription = '';
									if ($product->num_rows() > 0) {
										$pDetails = $product->row_array();
										$pDescription = $pDetails['Description'];
									}

									if ($row['Freebie'] != '1') {
										$unitPrice = $row['PriceUnit'];
									} else {
										$unitPrice = 0;
									}

									$unitDiscountAmount = $unitPrice * ($row['UnitDiscount'] / 100);
									$amount = $row['Amount'] * ($unitPrice - $unitDiscountAmount);
									$amountTotal += $amount;
									?>
									<tr class="add-formtransaction-row" data-type="regularTransaction" data-id="<?=$row['ID']?>">
										<td class="text-center">
											<?=$row['Amount']?>
										</td>
										<td class="text-center" colspan="2">
											<?=$pDescription?>
										</td>
										<td class="text-center">
											<?=number_format($unitPrice - $unitDiscountAmount, 2)?> <?=($row['UnitDiscount'] > 0 ? '('. $row['UnitDiscount'] .'%)' : '')?>
										</td>
										<td class="text-center amount" colspan="2" data-amount="<?=$amount?>">
											<?=number_format($amount, 2)?>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
							<tr>
								<td class="text-center" colspan="5"><b>ADTL FEES</b></td>
							</tr>
							<?php if ($getAdtlFeesByOrderNo->num_rows() > 0): 
								foreach ($getAdtlFeesByOrderNo->result_array() as $row):
									$unitDiscountAmount = $row['UnitPrice'] * ($row['UnitDiscount'] / 100);
									$amount = $row['Qty'] * ($row['UnitPrice'] - $unitDiscountAmount);
									$amountTotal += $amount;
									?>
									<tr class="add-formtransaction-row" data-type="adtlTransaction" data-id="<?=$row['ID']?>">
										<td class="text-center">
											<?=$row['Qty']?>
										</td>
										<td class="text-center" colspan="2">
											<?=$row['Description']?>
										</td>
										<td class="text-center">
											<?=number_format($row['UnitPrice'] - $unitDiscountAmount, 2)?> <?=($row['UnitDiscount'] > 0 ? '('. $row['UnitDiscount'] .'%)' : '')?>
										</td>
										<td class="text-center amount" colspan="2" data-amount="<?=$amount?>">
											<?=number_format($amount, 2)?>
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
<!-- FORM MODAL -->
<div class="modal fade" id="SalesOrderFormModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> Generate Sales Order Form</h4>
			</div>
			<div class="modal-body">
				<div id="salesOrderForm">
					<div class="table-responsive">
						<table class="standard-table table table-bordered">
							<tbody>
								<tr>
									<td class="text-center" colspan="3" rowspan="3">
										<img src="<?=base_url() . 'assets/images/manalok9_logo.png'?>" width="250" height="70">
									</td>
									<td colspan="3" class="text-center">
										<b>Sales Order Form</b>
									</td>
								</tr>
								<tr>
									<td class="fw-bold">Customer PO#:</td>
									<td colspan="2"><?=$salesOrder['OrderNo']?></td>
								</tr>
								<tr>
									<td class="fw-bold">Order Date:</td>
									<td colspan="2"><?=date('Y-m-d', strtotime($salesOrder['DateCreation']))?></td>
								</tr>
								<tr>
									<td colspan="3" class="fw-bold">BILL TO:</td>
									<td colspan="3" class="fw-bold">SHIP TO:</td>
								</tr>
								<tr>
									<td colspan="3"><?=$clientBTDetails['Name']?></td>
									<td colspan="3"><?=$clientSTDetails['Name']?></td>
								</tr>
								<tr>
									<td colspan="3"><?=$clientBTDetails['Address']?></td>
									<td colspan="3"><?=$clientSTDetails['Address']?></td>
								</tr>
								<tr>
									<td colspan="3"><?=$clientBTDetails['CityStateProvinceZip']?></td>
									<td colspan="3"><?=$clientSTDetails['CityStateProvinceZip']?></td>
								</tr>
								<tr>
									<td colspan="3"><?=$clientBTDetails['Country']?></td>
									<td colspan="3"><?=$clientSTDetails['Country']?></td>
								</tr>
								<tr>
									<td colspan="3"><?=$clientBTDetails['ContactNum']?></td>
									<td colspan="3"><?=$clientSTDetails['ContactNum']?></td>
								</tr>
								<tr><td colspan="6">&nbsp;</td></tr>
								<tr>
									<td class="fw-bold text-center">QTY</td>
									<td colspan="2" class="fw-bold text-center">ITEM DESCRIPTION</td>
									<td class="fw-bold text-center">UNIT PRICE</td>
									<td colspan="2" class="fw-bold text-center">TOTAL</td>
								</tr>
								<tr class="printExclude select-formtransaction-row">
									<td class="text-center" colspan="6" style="background-color: rgba(25, 135, 84, 0.5);">
										<i class="bi bi-plus-square"></i> ADD TRANSACTION
									</td>
								</tr>
								<tr>
									<td colspan="2" rowspan="2" class="fw-bold text-center">CATEGORY OF ACCOUNT:</td>
									<td class="text-end fw-bold" colspan="2">Sub-total <b>PHP </b></td>
									<td colspan="2" class="text-center" id="subTotal">0.00</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">Outright Discount (<?=$salesOrder['discountOutright']?>%)</td>
									<td colspan="2" class="text-center" id="dcOutright" data-discount="<?=$salesOrder['discountOutright']?>">
										0.00
									</td>
								</tr>
								<tr>
									<?php $accountCategories = array('CONFIRMED DISTRIBUTOR', 'DISTRIBUTOR ON PROBATION', 'DIRECT DEALER', 'DIRECT END USER'); ?>
									<td colspan="2" rowspan="2" class="text-center">
										<?=$accountCategories[$clientBTDetails['Category']]?>
									</td>
									<td colspan="2" class="fw-bold">Volume Discount (<?=$salesOrder['discountVolume']?>%)</td>
									<td colspan="2" class="text-center" id="dcVolume" data-discount="<?=$salesOrder['discountVolume']?>">
										0.00
									</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">PBD Discount (<?=$salesOrder['discountPBD']?>%)</td>
									<td colspan="2" class="text-center" id="dcPBD" data-discount="<?=$salesOrder['discountPBD']?>">
										0.00
									</td>
								</tr>
								<tr>
									<td class="fw-bold">
										REMARKS
									</td>
									<td>
										<?=$salesOrder['Remarks']?>
									</td>
									<td colspan="2" class="fw-bold">Manpower Discount (<?=$salesOrder['discountManpower']?>%)</td>
									<td colspan="2" class="text-center" id="dcManpower" data-discount="<?=$salesOrder['discountManpower']?>">
										0.00
									</td>
								</tr>
								<tr>
									<td class="fw-bold">PREPARED BY</td>
									<td colspan="2"><input id="prepared_by" type="text" class="inputManual mt-3"></td>
									<td class="text-end"><b>TOTAL</b></td>
									<td colspan="2" class="text-center" id="total">
										0.00
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button id="generate_excel" class="btn btn-success">
					<i class="bi bi-file-earmark-excel-fill"></i> EXCEL
				</button>
				<button id="generate_form" class="btn btn-primary">
					<i class="bi bi-file-earmark-word-fill"></i> PRINT
				</button>
			</div>
		</div>
	</div>
</div>
<form id="formExportTable" action="<?php echo base_url() . 'admin/xlsSalesOrder';?>" method="POST">
	<input type="hidden" name="order_no" value="<?=$salesOrder['OrderNo']?>">
	<input type="hidden" name="filename" value="sales_order_<?=$salesOrder['OrderNo']?>">
	<input id="xls_preparedby" type="hidden" name="prepared_by">
</form>