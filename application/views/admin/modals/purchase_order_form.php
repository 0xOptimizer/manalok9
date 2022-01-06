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
									<td colspan="2"><?=$purchaseOrder['DateCreation']?></td>
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
									<td colspan="2" class="fw-bold">SHIP VIA</td>
									<td class="fw-bold">DELIVERY DATE</td>
									<td colspan="2" class="fw-bold">SUPPLIER INV. NO.</td>
									<td class="fw-bold">TERMS</td>
								</tr>
								<tr>
									<td colspan="2"><?=$purchaseOrder['ShipVia']?></td>
									<td><?=$purchaseOrder['DateDelivery']?></td>
									<td colspan="2"><input id="supplierinvoiceno" class="inputManual" type="text"></td>
									<td><input id="terms" class="inputManual" type="text"></td>
								</tr>
								<tr>
									<td class="text-center fw-bold">QTY</td>
									<td class="text-center fw-bold">ITEM NO.</td>
									<td class="text-center fw-bold">DESCRIPTION</td>
									<td class="text-center fw-bold">UNIT COST</td>
									<td class="text-center fw-bold">UNIT</td>
									<td class="text-center fw-bold">AMOUNT</td>
								</tr>
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

										$amount = $row['Amount'] * $row['PriceUnit'];
										$amountTotal += $amount;
										?>
										<tr>
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
											<td>
												<!-- UNIT -->
											</td>
											<td class="text-center">
												<?=number_format($amount, 2)?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
								<tr>
									<td rowspan="5" class="fw-bold">MEMO:</td>
									<td rowspan="5" colspan="2">
										<textarea id="memo" class="inputManual"></textarea>
									</td>
									<td colspan="2" class="fw-bold">TOTAL AMOUNT</td>
									<td class="text-center"><?=number_format($amountTotal, 2)?></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">FREIGHT</td>
									<td><input id="freight" class="inputManual" type="number"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">SALES TAX</td>
									<td><input id="salestax" class="inputManual" type="number"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">LESS DEPOSIT</td>
									<td><input id="lessdeposit" class="inputManual" type="number"></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">BALANCE DUE</td>
									<td><input id="balancedue" class="inputManual" type="number"></td>
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