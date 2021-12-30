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
									<td colspan="2"><?=$salesOrder['DateCreation']?></td>
								</tr>
								<tr>
									<td colspan="3" class="fw-bold">Bill To:</td>
									<td colspan="3" class="fw-bold">Ship To:</td>
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
											<td class="text-center" colspan="2">
												<?=$pDescription?>
											</td>
											<td class="text-center">
												<?=number_format($row['PriceUnit'], 2)?>
											</td>
											<td class="text-center">
												<?=number_format($amount, 2)?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
								<tr>
									<td colspan="2" rowspan="2" class="fw-bold text-center">Category of Account:</td>
									<td class="text-end fw-bold" colspan="2">Sub-total <b>PHP </b></td>
									<td colspan="2" class="text-center"><?=number_format($amountTotal, 2)?></td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">Outright Discount (<?=$salesOrder['discountOutright']?>%)</td>
									<td colspan="2" class="text-center">
										<?php
										$discountOutright = $amountTotal * ($salesOrder['discountOutright'] * 0.01);
										?>
										<?=number_format($discountOutright, 2)?>
									</td>
								</tr>
								<tr>
									<?php $accountCategories = array('CONFIRMED DISTRIBUTOR', 'DISTRIBUTOR ON PROBATION', 'DIRECT DEALER', 'DIRECT END USER'); ?>
									<td colspan="2" rowspan="3" class="text-center">
										<?=$accountCategories[$clientBTDetails['Category']]?>
									</td>
									<td colspan="2" class="fw-bold">Volume Discount (<?=$salesOrder['discountVolume']?>%)</td>
									<td colspan="2" class="text-center">
										<?php
										$discountVolume = $amountTotal * ($salesOrder['discountVolume'] * 0.01);
										?>
										<?=number_format($discountVolume, 2)?>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">PBD Discount (<?=$salesOrder['discountPBD']?>%)</td>
									<td colspan="2" class="text-center">
										<?php
										$discountPBD = $amountTotal * ($salesOrder['discountPBD'] * 0.01);
										?>
										<?=number_format($discountPBD, 2)?>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="fw-bold">Manpower Discount (<?=$salesOrder['discountManpower']?>%)</td>
									<td colspan="2" class="text-center">
										<?php
										$discountManpower = $amountTotal * ($salesOrder['discountManpower'] * 0.01);
										?>
										<?=number_format($discountManpower, 2)?>
									</td>
								</tr>
								<tr>
									<td class="fw-bold">PREPARED BY</td>
									<td colspan="2"><input type="text" class="inputManual mt-3"></td>
									<td class="text-end"><b>TOTAL</b></td>
									<td colspan="2" class="text-center">
										<?=number_format($amountTotal - ($discountOutright + $discountVolume + $discountPBD + $discountManpower), 2)?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button type="submit" id="generateform" class="btn btn-success">
					<i class="bi bi-check2"></i> Generate Form
				</button>
			</div>
		</div>
	</div>
</div>
