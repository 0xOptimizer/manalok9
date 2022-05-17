<?php if (!$this->session->userdata('UserRestrictions')['purchase_orders_view']) return; ?>
<!-- FORM TRANSACTION SELECTION -->
<div class="modal fade" id="PurchaseOrderFormTransactionsModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-file-earmark-excel-fill" style="font-size: 24px;"></i> Generate Purchase Order Form</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="standard-table table">
						<thead style="font-size: 12px;">
							<th class="text-center fw-bold">QTY</th>
							<th class="text-center fw-bold">ITEM NO.</th>
							<th class="text-center fw-bold">DESCRIPTION</th>
							<th class="text-center fw-bold">UNIT COST</th>
							<th class="text-center fw-bold">AMOUNT</th>
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
										$pDescription = $pDetails['Product_Name'];
									}

									$amount = $row['Amount'] * $row['PriceUnit'];
									?>
									<tr class="add-formtransaction-row" data-type="regularTransaction" data-id="<?=$row['ID']?>">
										<td class="text-center">
											<?=$row['Amount']?>
										</td>
										<td class="text-center">
											<?=$row['Code']?>
										</td>
										<td class="text-center">
											<?=$pDescription?>
										</td>
										<td class="text-center">
											<?=number_format($row['PriceUnit'], 2)?>
										</td>
										<td class="text-center amount" data-amount="<?=$amount?>">
											<?=number_format($amount, 2)?>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
							<tr>
								<td class="text-center" colspan="5"><b>MANUAL TRANSACTIONS</b></td>
							</tr>
							<?php if ($getManualTransactionsByPONo->num_rows() > 0): 
								foreach ($getManualTransactionsByPONo->result_array() as $row): 
								
									$amount = $row['Qty'] * $row['UnitCost']; ?>
									<tr class="add-formtransaction-row" data-type="manualTransaction" data-id="<?=$row['ID']?>">
										<td class="text-center">
											<?=$row['Qty']?>
										</td>
										<td class="text-center">
											<?=$row['ItemNo']?>
										</td>
										<td class="text-center">
											<?=$row['Description']?>
										</td>
										<td class="text-center">
											<?=number_format($row['UnitCost'], 2)?>
										</td>
										<td class="text-center amount" data-amount="<?=$amount?>">
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
<div class="modal fade" id="PurchaseOrderFormModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-receipt" style="font-size: 24px;"></i> Generate Purchase Order Form</h4>
			</div>
			<div class="modal-body">
				<div id="purchaseOrderForm">
					<div class="table-responsive">
						<table class="standard-table table table-bordered">
							<tbody>
								<tr>
									<td class="text-center" colspan="3">
										<img src="<?=base_url() . 'assets/images/manalok9_logo.png'?>" width="250" height="70">
									</td>
									<td colspan="3">
										<b>Purchase Order</b>
									</td>
								</tr>
								<tr>
									<td class="fw-bold" colspan="2">Order From:</td>
									<td class="fw-bold">Deliver To:</td>
									<td class="fw-bold">Purchase No.:</td>
									<td colspan="2"><?=$purchaseOrder['OrderNo']?></td>
								</tr>
								<tr>
									<td colspan="2"><?=$vendorDetails['VendorNo']?></td>
									<td rowspan="5"><textarea id="deliverto" class="inputManual"></textarea></td>
									<td class="fw-bold">Date:</td>
									<td colspan="2"><?=date('Y-m-d', strtotime($purchaseOrder['DateCreation']))?></td>
								</tr>
								<tr>
									<td colspan="2"><?=$vendorDetails['Name']?></td>
									<td class="fw-bold">Page:</td>
									<td colspan="2"><input id="page" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td colspan="2"><?=$vendorDetails['TIN']?></td>
									<td colspan="4" rowspan="3"></td>
								</tr>
								<tr>
									<td colspan="2"><?=$vendorDetails['Address']?></td>
								</tr>
								<tr>
									<td colspan="2"><?=$vendorDetails['ContactNum']?></td>
								</tr>
								<tr>
									<td class="fw-bold">ATTN:</td>
									<td colspan="5"><input id="attn" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold text-center">SHIP VIA</td>
									<td class="fw-bold text-center">DELIVERY DATE</td>
									<td colspan="2" class="fw-bold text-center">SUPPLIER INV. NO.</td>
									<td class="fw-bold text-center">TERMS</td>
								</tr>
								<tr>
									<td class="text-center" colspan="2"><?=$purchaseOrder['ShipVia']?></td>
									<td class="text-center"><?=$purchaseOrder['DateDelivery']?></td>
									<td class="text-center" colspan="2"><input id="supplierinvoiceno" class="inputManual" type="text"></td>
									<td class="text-center"><input id="terms" class="inputManual" type="text"></td>
								</tr>
								<tr><td colspan="6">&nbsp;</td></tr>
								<tr>
									<td class="text-center fw-bold">QTY</td>
									<td class="text-center fw-bold">ITEM NO.</td>
									<td class="text-center fw-bold">DESCRIPTION</td>
									<td class="text-center fw-bold">UNIT COST</td>
									<td class="text-center fw-bold">UNIT</td>
									<td class="text-center fw-bold">AMOUNT</td>
								</tr>
								<tr class="printExclude select-formtransaction-row">
									<td class="text-center" colspan="6" style="background-color: rgba(25, 135, 84, 0.5);">
										<i class="bi bi-plus-square"></i> ADD TRANSACTION
									</td>
								</tr>
								<tr>
									<td rowspan="5" class="fw-bold">MEMO:</td>
									<td rowspan="5" colspan="2">
										<textarea id="memo" class="inputManual"></textarea>
									</td>
									<td colspan="2" class="fw-bold">TOTAL AMOUNT</td>
									<td class="text-center" id="totalAmount">0.00</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">FREIGHT</td>
									<td class="text-center"><input id="freight" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">SALES TAX</td>
									<td class="text-center"><input id="salestax" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">LESS DEPOSIT</td>
									<td class="text-center"><input id="lessdeposit" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">BALANCE DUE</td>
									<td class="text-center"><input id="balancedue" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td class="fw-bold" colspan="2">REMARKS</td>
									<td colspan="4"><?=$purchaseOrder['Remarks']?></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">PREPARED BY</td>
									<td colspan="2" class="fw-bold">ORDERED BY</td>
									<td colspan="2" class="fw-bold">APPROVED BY</td>
								</tr>
								<tr>
									<td colspan="2"><input id="preparedby" type="text" class="inputManual mt-3"></td>
									<td colspan="2"><input id="orderedby" type="text" class="inputManual mt-3"></td>
									<td colspan="2"><input id="approvedby" type="text" class="inputManual mt-3"></td>
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
<!-- EXPORT DETAILS -->
<form id="formExportTable" action="<?php echo base_url() . 'admin/xlsPurchaseOrder';?>" method="POST">
	<input type="hidden" name="order_no" value="<?=$purchaseOrder['OrderNo']?>">
	<input type="hidden" name="filename" value="purchase_order_<?=$purchaseOrder['OrderNo']?>">
	<input id="xls_deliverto" type="hidden" name="deliverto">
	<input id="xls_page" type="hidden" name="page">
	<input id="xls_attn" type="hidden" name="attn">
	<input id="xls_supplierinvoiceno" type="hidden" name="supplierinvoiceno">
	<input id="xls_terms" type="hidden" name="terms">
	<input id="xls_memo" type="hidden" name="memo">
	<input id="xls_freight" type="hidden" name="freight">
	<input id="xls_salestax" type="hidden" name="salestax">
	<input id="xls_lessdeposit" type="hidden" name="lessdeposit">
	<input id="xls_balancedue" type="hidden" name="balancedue">
	<input id="xls_preparedby" type="hidden" name="preparedby">
	<input id="xls_orderedby" type="hidden" name="orderedby">
	<input id="xls_approvedby" type="hidden" name="approvedby">
</form>