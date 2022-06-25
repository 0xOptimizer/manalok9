<?php
$globalHeader;

date_default_timezone_set('Asia/Manila');

if ($this->input->get('orderNo')) {
	$orderNo = $this->input->get('orderNo');
} else {
	redirect('admin/sales_orders');
}
$getSalesOrderByOrderNo = $this->Model_Selects->GetSalesOrderByNo($orderNo);
if ($getSalesOrderByOrderNo->num_rows() < 1) {
	redirect('admin/sales_orders');
}

$salesOrder = $getSalesOrderByOrderNo->row_array();
$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($orderNo);
$getAdtlFeesByOrderNo = $this->Model_Selects->GetAdtlFeesByOrderNo($orderNo);

$clientBTDetails = $this->Model_Selects->GetClientByNo($salesOrder['BillToClientNo'])->row_array();
$clientSTDetails = $this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array();

$getSOInvoices = $this->Model_Selects->GetInvoicesBySONo($orderNo);

$getAccounts = $this->Model_Selects->GetAccountSelection();


$return = $this->Model_Selects->GetReturnBySalesNo($salesOrder['OrderNo']);
if ($return->num_rows() > 0) {
	$returnDetails = $return->row_array();
	$returnProducts = $this->Model_Selects->GetReturnProductsByReturnNo($returnDetails['ReturnNo']);
}

$getReplacements = $this->Model_Selects->GetReplacementsByOrderNo($salesOrder['OrderNo']);

?>
<style>
	.rotate-text {
		-webkit-transform:rotate(-75deg);
	}
	.card-container a {
		text-decoration: none;
	}
	.card-headers {
		border-radius: 3px 3px 0px 0px;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-right: 20px;
		padding-left: 20px;
		color: #FFFFFF;
	}
	.sectionToggle:hover {
		background-color: rgba(75, 75, 75, 0.3);
	}
	@media print {
		.printExclude {
			display: none;
		}
		.modal-backdrop {
			opacity: 0 !important;
		}
		#app {
			display: none;
		}
		#salesOrderForm {
			display: block;
		}
		#salesOrderForm td {
			color: black !important;
		}
		#salesOrderForm td span {
			max-width: 100%;
		}
	}
</style>
</head>
<body>
<div id="app">
	<?php $this->load->view('main/template/sidebar') ?>
	<div id="main">
		<header class="mb-3">
			<a href="#" class="burger-btn d-block d-xl-none">
				<i class="bi bi-justify fs-3"></i>
			</a>
			<a href="<?=base_url() . 'admin/sales_orders'?>" class="btn btn-sm-primary"><i class="bi bi-caret-left-fill"></i> BACK TO SALES ORDERS</a>
		</header>

		<div class="page-heading">
			<div class="page-title">
				<div class="row">
					<div class="col-9">
						<h3><i class="bi bi-receipt"></i> <?=$salesOrder['OrderNo']?>
							<?php if ($salesOrder['Status'] == '1'): ?>
								<span class="info-banner-sm"><i class="bi bi-asterisk" style="color:#E4B55B;"></i> Pending</span>
							<?php elseif ($salesOrder['Status'] == '2'): ?>
								<span class="info-banner-sm"><i class="bi bi-cash" style="color:#E4B55B;"></i> For Invoicing</span>
							<?php elseif ($salesOrder['Status'] == '3'): ?>
								<span class="info-banner-sm"><i class="bi bi-truck" style="color:#E4B55B;"></i> For Delivery</span>
							<?php elseif ($salesOrder['Status'] == '4'): ?>
								<span class="info-banner-sm"><i class="bi bi-check2" style="color:#E4B55B;"></i> Delivered</span>
							<?php elseif ($salesOrder['Status'] == '5'): ?>
								<span class="info-banner-sm text-success"><i class="bi bi-check-circle"></i> Received</span>
							<?php else: ?>
								<span class="info-banner-sm text-danger"><i class="bi bi-trash"></i> Rejected</span>
							<?php endif; ?>
						</h3>
					</div>
					<div class="col-3 text-end">
						<form id="formDeleteSalesOrder" action="<?php echo base_url() . 'FORM_deleteSalesOrder';?>" method="POST">
							<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
							<button type="button" class="btn btn-danger deleteOrder"><i class="bi bi-trash-fill"></i> DELETE</button>
						</form>
					</div>
					<div class="col-8">
						<button type="button" class="generateform-btn btn btn-sm-primary" style="font-size: 12px;"><i class="bi bi-file-earmark-arrow-down"></i> GENERATE SO FORM</button>
						|
						<?php if ($this->session->userdata('UserRestrictions')['sales_orders_accounting']): ?>
							<button type="button" class="accounting-btn btn btn-sm-secondary" style="font-size: 12px;"><i class="bi bi-receipt"></i> ACCOUNTING</button>
						<?php endif; ?>
						<button type="button" class="log-btn btn btn-sm-secondary" style="font-size: 12px;"><i class="bi bi-list"></i> LOG</button>
					</div>
				</div>
			</div>
			<section class="section">
				<hr style="height: 4px;">

				<div class="row">
					<div class="col-12 col-md-6 mb-1">
						<h6>SALES ORDER #</h6>
						<label class="salesOrderNo"><?=$salesOrder['OrderNo']?></label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>SALES ORDER DATE</h6>
						<label><?=$salesOrder['Date']?></label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>BILL TO
							<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
								<?php if ($this->session->userdata('UserRestrictions')['mail_add']): ?>
									&nbsp;<button type="button" class="emailbtclient-btn btn btn-sm-primary" data-email="<?=$clientBTDetails['Email']?>"><i class="bi bi-envelope-fill"></i> EMAIL</button>
								<?php endif; ?>
							<?php endif; ?>
						</h6>
						<?php if ($clientBTDetails['ClientNo'] != NULL): ?>
							<label><?=$clientBTDetails['Name']?> (
								<a href="<?=base_url() . 'admin/clients#'. $clientBTDetails["ClientNo"]?>">
									<i class="bi bi-eye"></i> <?=$clientBTDetails['ClientNo']?>
								</a>
							)</label>
						<?php else: ?>
							<label class="warning-banner-sm">
								CLIENT DETAILS NOT AVAILABLE
							</label>
						<?php endif; ?>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>CATEGORY </h6>
						<label>
							<?php switch ($clientBTDetails['Category']) {
								case '0': echo 'Confirmed Distributor'; break;
								case '1': echo 'Distributor On Probation'; break;
								case '2': echo 'Direct Dealer'; break;
								case '3': echo 'Direct End User'; break;
								default: echo 'NONE'; break;
							} ?>
						</label>
					</div>
					<div class="col-12 col-md-6 mb-1">
						<h6>SHIP TO
							<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
								<?php if ($this->session->userdata('UserRestrictions')['mail_add']): ?>
									&nbsp;<button type="button" class="emailstclient-btn btn btn-sm-primary" data-email="<?=$clientSTDetails['Email']?>"><i class="bi bi-envelope-fill"></i> EMAIL</button>
								<?php endif; ?>
							<?php endif; ?>
						</h6>
						<?php if ($clientSTDetails['ClientNo'] != NULL): ?>
							<label><?=$clientSTDetails['Name']?> (
								<a href="<?=base_url() . 'admin/clients#'. $clientSTDetails["ClientNo"]?>">
									<i class="bi bi-eye"></i> <?=$clientSTDetails['ClientNo']?>
								</a>
							)</label>
						<?php else: ?>
							<label class="warning-banner-sm">
								CLIENT DETAILS NOT AVAILABLE
							</label>
						<?php endif; ?>
					</div>
					<?php if ($salesOrder['Status'] == '3'): ?>
						<div class="col-12 col-md-6 mb-3">
							<h6>DATE OF DELIVERY</h6>
							<?php if ($this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery']): ?>
								<button type="button" class="btn btn-sm-success deliveryschedule-btn reschedule-btn" data-datescheduled="<?=$salesOrder['DateDelivery']?>">
									<i class="bi bi-truck"></i> RESCHEDULE
								</button>
							<?php endif; ?>
							<label><?=$salesOrder['DateDelivery']?></label>
						</div>
					<?php endif; ?>
					<div class="col-12 col-md-6 mb-1">
						<h6>REMARKS 
							<button type="button" class="btn btn-sm addremarks-btn text-primary" data-remarks="<?=$salesOrder['Remarks']?>">
								<i class="bi bi-pencil-square"></i>
							</button>
						</h6>
						<label>
							<?=(($salesOrder['Remarks'] == NULL) ? '- - - - - -' : $salesOrder['Remarks'])?>
						</label>
					</div>
				</div>

				<hr style="height: 4px;">

				<?php
				// COMPUTE TOTALS
				$totalDiscount = $salesOrder['discountOutright'] + $salesOrder['discountVolume'] + $salesOrder['discountPBD'] + $salesOrder['discountManpower'];

				$transactionsPriceTotal = 0;
				$transactionsFreebiesTotal = 0;
				$transactionsUnitDiscountTotal = 0;
				$transactionsAdtlUnitDiscountTotal = 0;
				$transactionsAdtlFeesTotal = 0;

				?>

				<div class="row">
					<div class="col-12">
						<div class="row">
							<div class="col-12">
								<h4>
									<i class="bi bi-list-ul"></i> TRANSACTIONS
									<span class="text-center success-banner-sm">
										<i class="bi bi-list-ul"></i> <?=$getTransactionsByOrderNo->num_rows()?> TOTAL
									</span>
								</h4>
								<button type="button" class="transaction-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-plus-square"></i> NEW TRANSACTION</button>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 table-responsive mb-3">
								<table id="transactionsTable" class="standard-table table">
									<thead style="font-size: 12px;">
										<th class="text-center">TRANSACTION ID</th>
										<th class="text-center">PRODUCT STOCK ID</th>
										<th class="text-center">QTY</th>
										<th class="text-center">UNIT DISCOUNT</th>
										<th class="text-center">PRICE</th>
										<th class="text-center">TOTAL</th>
										<th class="text-center">FREEBIE</th>
										<th class="text-center"></th>
									</thead>
									<tbody>
										<?php
										if ($getTransactionsByOrderNo->num_rows() > 0):
											foreach ($getTransactionsByOrderNo->result_array() as $row):
												$price = $row['PriceUnit'];
												$unitDiscountPriceTotal = $price * ($row['UnitDiscount'] / 100);

												if ($row['Freebie'] == 0) {
													$transactionsPriceTotal += ($price * $row['Amount']);
													$transactionsUnitDiscountTotal += ($unitDiscountPriceTotal * $row['Amount']);
												} else {
													$transactionsFreebiesTotal += ($price * $row['Amount']);
												}
												// apply discount
												$price -= $unitDiscountPriceTotal;
												?>
												<tr>
													<td class="text-center">
														<?=$row['TransactionID']?>
													</td>
													<td class="text-center">
														<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['stockID']?></span>
													</td>
													<td class="text-center">
														<?=$row['Amount']?>
													</td>
													<td class="text-center">
														<?=$row['UnitDiscount']?>%
													</td>
													<td class="text-center">
														<?=number_format($price, 2)?>
													</td>
													<td class="text-center">
														<?=number_format($price * $row['Amount'], 2)?>
													</td>
													<td class="text-center">
														<?php if ($row['Freebie']): ?>
															<i class="bi bi-check-circle text-success"></i>
														<?php else: ?>
															<i class="bi bi-x-circle text-danger"></i>
														<?php endif; ?>
													</td>
													<td class="text-center">
														<?php if ($this->session->userdata('UserRestrictions')['sales_orders_update']): ?>
															<i class="bi bi-pencil text-success updateSOTransaction" data-tid="<?=$row['TransactionID']?>" data-qty="<?=$row['Amount']?>"></i>
															<a href="<?=base_url()?>FORM_removeSOTransaction?tid=<?=$row['TransactionID']?>">
																<button type="button" class="btn removeTransaction"><i class="bi bi-trash text-danger"></i></button>
															</a>
														<?php endif; ?>
													</td>
												</tr>
										<?php endforeach;
										endif; ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php if ($salesOrder['Status'] >= '2'): ?>
							<div class="row">
								<div class="col-12">
									<h6>
										<i class="bi bi-plus"></i> ADDITIONAL FEES
										<span class="text-center success-banner-sm">
											<i class="bi bi-plus"></i> <?=$getAdtlFeesByOrderNo->num_rows()?> TOTAL
										</span>
									</h6>
									<button type="button" class="adtlfee-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-plus-square"></i> NEW ADDITIONAL FEE</button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 table-responsive mb-3">
									<table id="transactionsTable" class="standard-table table">
										<thead style="font-size: 12px;">
											<th class="text-center">DESCRIPTION</th>
											<th class="text-center">QTY</th>
											<th class="text-center">UNIT DISCOUNT</th>
											<th class="text-center">UNIT PRICE</th>
											<th class="text-center">TOTAL</th>
											<th class="text-center">DATE ADDED</th>
											<th></th>
										</thead>
										<tbody>
											<?php
											if ($getAdtlFeesByOrderNo->num_rows() > 0):
												foreach ($getAdtlFeesByOrderNo->result_array() as $row):
													$price = $row['UnitPrice'];
													$unitDiscountPriceTotal = $price * ($row['UnitDiscount'] / 100);

													$transactionsAdtlFeesTotal += ($price * $row['Qty']);
													$transactionsAdtlUnitDiscountTotal += ($unitDiscountPriceTotal * $row['Qty']);
													// apply discount
													$price -= $unitDiscountPriceTotal;
													?>
													<tr>
														<td class="text-center afDescription" data-val="<?=$row['Description']?>">
															<?=$row['Description']?>
														</td>
														<td class="text-center afQty" data-val="<?=$row['Qty']?>">
															<?=$row['Qty']?>
														</td>
														<td class="text-center afUnitDiscount" data-val="<?=$row['UnitDiscount']?>">
															<?=$row['UnitDiscount']?>%
														</td>
														<td class="text-center afUnitPrice" data-val="<?=$row['UnitPrice']?>">
															<?=number_format($price, 2)?>
														</td>
														<td class="text-center">
															<?=number_format($price * $row['Qty'], 2)?>
														</td>
														<td class="text-center">
															<?=$row['Date']?>
														</td>
														<td class="text-center">
															<?php if ($this->session->userdata('UserRestrictions')['sales_orders_adtl_fees']): ?>
																<i class="bi bi-pencil text-success updateAdtlFee" data-adtlfeeno="<?=$row['AdtlFeeNo']?>"></i>
																<a href="FORM_removeSOAdtlFee?afno=<?=$row['AdtlFeeNo']?>">
																	<button type="button" class="btn removeAdtlFee"><i class="bi bi-trash text-danger"></i></button>
																</a>
															<?php endif; ?>
														</td>
													</tr>
											<?php endforeach;
											endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold">
														CATEGORY DISCOUNTS
													</span>
												</div>
												<div class="row">
													<div class="col-5 text-end">
														OUTRIGHT:
													</div>
													<div class="col-3 text-end">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<b>
																<?=number_format(($transactionsPriceTotal * ($salesOrder['discountOutright'] / 100)), 2)?>
															</b>
														</span>
													</div>
													<div class="col-4 text-start">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<i>
																( <?=$salesOrder['discountOutright']?>% )
															</i>
														</span>
													</div>
												</div>
												<div class="row">
													<div class="col-5 text-end">
														VOLUME:
													</div>
													<div class="col-3 text-end">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<b>
																<?=number_format(($transactionsPriceTotal * ($salesOrder['discountVolume'] / 100)), 2)?>
															</b>
														</span>
													</div>
													<div class="col-4 text-start">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<i>
																( <?=$salesOrder['discountVolume']?>% )
															</i>
														</span>
													</div>
												</div>
												<div class="row">
													<div class="col-5 text-end">
														PBD:
													</div>
													<div class="col-3 text-end">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<b>
																<?=number_format(($transactionsPriceTotal * ($salesOrder['discountPBD'] / 100)), 2)?>
															</b>
														</span>
													</div>
													<div class="col-4 text-start">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<i>
																( <?=$salesOrder['discountPBD']?>% )
															</i>
														</span>
													</div>
												</div>
												<div class="row">
													<div class="col-5 text-end">
														MANPOWER:
													</div>
													<div class="col-3 text-end">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<b>
																<?=number_format(($transactionsPriceTotal * ($salesOrder['discountManpower'] / 100)), 2)?>
															</b>
														</span>
													</div>
													<div class="col-4 text-start">
														<span style="font-size: 1.15em; color: #ebebeb;">
															<i>
																( <?=$salesOrder['discountManpower']?>% )
															</i>
														</span>
													</div>
												</div>
												<div class="row mt-3">
													<span class="head-text fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-info'>Info:<br></span> (Total Non-Freebie Transactions) * (Total Discounts)">
														<i class="bi bi-dash-circle text-danger"></i> TOTAL CATEGORY DISCOUNTS
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.15em; color: #ebebeb;">
														<b>
															<?=number_format(($transactionsPriceTotal * ($totalDiscount / 100)), 2)?>
														</b>
														<i>
															( <?=$totalDiscount?>% )
														</i>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-info'>Info:<br></span> (Total Unit Discounts) + (Total Unit Discounts Adtl)">
													<span class="head-text fw-bold">
														<i class="bi bi-dash-circle text-danger"></i> TOTAL UNIT DISCOUNTS
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.15em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsUnitDiscountTotal + $transactionsAdtlUnitDiscountTotal, 2)?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold">
														<i class="bi bi-plus-circle text-success"></i> TOTAL ADTL FEES
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.15em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsAdtlFeesTotal, 2)?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-info'>Info:<br></span> (Total Non-Freebie Transactions)">
														GROSS SALES
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsPriceTotal, 2)?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<span class='text-info'>Info:<br></span> (Total Gross Price + Total Adtl Fees) - (Total Category Discounts) - (Total Unit Discounts + Total Unit Discounts Adtl)">
													<span class="head-text fw-bold">
														TOTAL PRICE (DISCOUNTED)
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?php
															$totalPriceDiscounted = 
																($transactionsPriceTotal + $transactionsAdtlFeesTotal) - 
																($transactionsPriceTotal * ($totalDiscount / 100)) - 
																($transactionsUnitDiscountTotal + $transactionsAdtlUnitDiscountTotal);
															echo number_format($totalPriceDiscounted, 2);
															?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="text-center p-2">
												<div class="row">
													<span class="head-text fw-bold">
														TOTAL FREEBIES PRICE
													</span>
												</div>
												<div class="row">
													<span style="font-size: 1.5em; color: #ebebeb;">
														<b>
															<?=number_format($transactionsFreebiesTotal, 2)?>
														</b>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-12">
						<div class="row pt-4">
							<?php if ($salesOrder['Status'] == '1' && $this->session->userdata('UserRestrictions')['sales_orders_mark_for_invoicing']): ?>
								<div class="col-12 text-center">
									<h6>MARK FOR INVOICING</h6>
								</div>
								<div class="col-12 text-center">
									<form id="formApproveSalesOrder" action="<?php echo base_url() . 'FORM_approveSalesOrder';?>" method="POST">
										<input type="hidden" name="order_no" value="<?=$salesOrder['OrderNo']?>">
										<input id="orderApproved" type="hidden" name="approved">
										<button type="button" class="btn btn-danger rejectOrder"><i class="bi bi-trash-fill"></i> REJECT</button>
										<button type="button" class="btn btn-success approveOrder"><i class="bi bi-check2"></i> APPROVE</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '2' && $this->session->userdata('UserRestrictions')['sales_orders_schedule_delivery']): ?>
								<div class="col-12 text-center">
									<h6>ACTION</h6>
								</div>
								<div class="col-12 text-center">
									<button type="button" class="btn btn-success deliveryschedule-btn">
										<i class="bi bi-truck"></i> SCHEDULE FOR DELIVERY
									</button>
								</div>
							<?php elseif ($salesOrder['Status'] == '3' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_delivered']): ?>
								<div class="col-12 text-center">
									<h6>ACTION</h6>
								</div>
								<div class="col-12 text-center">
									<form id="formMarkDelivered" action="<?php echo base_url() . 'FORM_markDelivered';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success deliveredmark">
											<i class="bi bi-check2"></i> MARK AS DELIVERED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '4' && $this->session->userdata('UserRestrictions')['sales_orders_mark_as_received']): ?>
								<div class="col-12 text-center">
									<h6>ACTION</h6>
								</div>
								<div class="col-12 text-center">
									<form id="formMarkReceived" action="<?php echo base_url() . 'FORM_markReceived';?>" method="POST">
										<input type="hidden" name="order-no" value="<?=$salesOrder['OrderNo']?>">
										<button type="button" class="btn btn-success receivedmark">
											<i class="bi bi-check2"></i> MARK AS RECEIVED
										</button>
									</form>
								</div>
							<?php elseif ($salesOrder['Status'] == '5'): ?>
								<div class="col-12 text-center">
									<h5 class="text-success">[ SALES ORDER FULFILLED ]</h5>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php if ($salesOrder['Status'] >= '2'): ?>
			<hr style="height: 4px;">

			<div class="page-heading">
				<div class="page-title">
					<div class="row pt-3 toggleSectionInvoicing sectionToggle" style="cursor: pointer;">
						<div class="col-12">
							<h4>
								<i class="bi bi-receipt"></i> INVOICING
								<span class="text-center success-banner-sm">
									<i class="bi bi-receipt"></i> <?=$getSOInvoices->num_rows()?> TOTAL
								</span>
								<i class="bi bi-caret-down-fill float-end caret"></i>
							</h4>
						</div>
					</div>
					<?php if ($this->session->userdata('UserRestrictions')['sales_orders_invoice_creation']): ?>
						<div class="row pt-3">
							<div class="col-12">
								<button type="button" class="salesinvoicing-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-receipt"></i> NEW INVOICE</button>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<section class="sectionInvoicing d-none">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="invoicesTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">INVOICE #</th>
									<th class="text-center">CLIENT</th>
									<th class="text-center">AMOUNT</th>
									<th class="text-center">DATE</th>
									<th class="text-center">MODE OF PAYMENT</th>
									<th class="text-center"></th>
								</thead>
								<tbody>
								<?php if ($getSOInvoices->num_rows() > 0):
									foreach ($getSOInvoices->result_array() as $row): ?>
										<tr>
											<td class="text-center">
												<?=$row['InvoiceNo']?>
											</td>
											<td class="text-center">
												<?=$clientBTDetails['Name']?>
											</td>
											<td class="text-center">
												<?=number_format($row['Amount'], 2)?>
											</td>
											<td class="text-center">
												<?=$row['Date']?>
											</td>
											<td class="text-center">
												<?=$row['ModeOfPayment']?>
											</td>
											<td>
												<?php if ($this->session->userdata('UserRestrictions')['invoice_delete']): ?>
													<a href="FORM_removeInvoice?ino=<?=$row['InvoiceNo']?>">
														<button type="button" class="btn removeInvoice"><i class="bi bi-trash text-danger"></i></button>
													</a>
												<?php endif; ?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
									<?php
									$total_invoice_amount = $this->Model_Selects->GetTotalInvoicesBySONo($salesOrder['OrderNo'])->row_array()['Amount'];
									?>
									<tr>
										<td class="text-center fw-bold" colspan="2">TOTAL</td>
										<td class="text-center"><?=number_format($total_invoice_amount, 2)?></td>
										<td colspan="4"></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="text-center fw-bold" colspan="2">REMAINING PAYMENT (DISCOUNTED)</td>
										<td class="text-center">
											<?=number_format($totalPriceDiscounted - $total_invoice_amount, 2);?></td>
										<td colspan="4"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>

		<?php if (isset($returnProducts) && $returnProducts->num_rows() > 0):

			$returnItemsQtyTotal = array('GOOD' => 0, 'DAMAGED' => 0,'RETURNED' => 0);
			$returnItemsPriceTotal = array('GOOD' => 0, 'DAMAGED' => 0,'RETURNED' => 0);
			?>
			<hr style="height: 4px;">

			<div class="page-heading">
				<div class="page-title">
					<div class="row pt-3 toggleSectionReturns sectionToggle" style="cursor: pointer;">
						<div class="col-12">
							<h4>
								<i class="bi bi-reply-fill"></i> RETURNED ITEMS
								<span class="text-center success-banner-sm">
									<i class="bi bi-reply-fill"></i> <?=$returnProducts->num_rows()?> TOTAL
								</span>
								<i class="bi bi-caret-down-fill float-end caret"></i>
							</h4>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-12">
							<a href="<?=base_url() . 'admin/view_return?returnNo='. $returnDetails['ReturnNo']?>">
								<i class="bi bi-eye"></i> <?=$returnDetails['ReturnNo']?>
							</a>
						</div>
					</div>
				</div>
				<section class="sectionReturns d-none">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="transactionsTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">TRANSACTION ID</th>
									<th class="text-center">STOCK ID</th>
									<th class="text-center">DATE</th>
									<th class="text-center">REMARKS</th>
									<th class="text-center">QUANTITY</th>
									<th class="text-center">TOTAL PRICE</th>
									<th class="text-center">FREEBIE</th>
								</thead>
								<tbody>
									<?php 
									$totalReturnPrice = 0;
									$totalReturnPriceFreebie = 0;

									foreach ($returnProducts->result_array() as $row):
										$transactionDetails = $this->Model_Selects->GetTransactionsByTID($row['transactionid'])->row_array();

										$returnItemsQtyTotal[$row['remarks']] += $row['quantity'];
										$returnItemsPriceTotal[$row['remarks']] += $row['quantity'] * $transactionDetails['PriceUnit']; ?>
										<tr>
											<td class="text-center">
												<?=$row['transactionid']?>
											</td>
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$row['stockid']?></span>
											</td>
											<td class="text-center">
												<?=$row['date_added']?>
											</td>
											<td class="text-center remarks">
												<?=$row['remarks']?>
											</td>
											<td class="text-center quantity_total">
												<?=$row['quantity']?>
											</td>
											<?php
											$totalPrice = $row['quantity'] * $transactionDetails['PriceUnit'];
											
											if ($row['Freebie'] == 1) {
												$totalReturnPriceFreebie += $totalPrice;
											} else {
												$totalReturnPrice += $totalPrice;
											}
											?>
											<td class="text-center">
												<?=number_format($totalPrice, 2)?>
											</td>
											<td class="text-center">
												<?php if ($row['Freebie'] == 1): ?>
													<i class="bi bi-check-circle text-success"></i>
												<?php else: ?>
													<i class="bi bi-x-circle text-danger"></i>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
									<tr style="border-color: #a7852d;">
										<td class="text-end fw-bold" colspan="2">TOTAL FREEBIE</td>
										<td class="text-center">
											<?=number_format($totalReturnPriceFreebie, 2);?>
										</td>
										<td class="text-end fw-bold" colspan="2">TOTAL</td>
										<td class="text-center">
											<?=number_format($totalReturnPrice, 2);?>
										</td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 col-md-4 px-3">
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												GOOD RETURNS TOTAL QTY
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=$returnItemsQtyTotal['GOOD']?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												GOOD RETURNS TOTAL PRICE
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=number_format($returnItemsPriceTotal['GOOD'], 2)?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 px-3">
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												DAMAGED RETURNS TOTAL QTY
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=$returnItemsQtyTotal['DAMAGED']?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												DAMAGED RETURNS TOTAL PRICE
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=number_format($returnItemsPriceTotal['DAMAGED'], 2)?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 px-3">
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												RETURNED ITEMS TOTAL QTY
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=$returnItemsQtyTotal['RETURNED']?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="card">
									<div class="text-center p-2">
										<div class="row">
											<span class="head-text fw-bold">
												RETURNED ITEMS TOTAL PRICE
											</span>
										</div>
										<div class="row">
											<div class="col-12">
												<span style="font-size: 1.15em; color: #ebebeb;">
													<b>
														<?=number_format($returnItemsPriceTotal['RETURNED'], 2)?>
													</b>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>

		<?php if ($salesOrder['Status'] >= '2' && $this->session->userdata('UserRestrictions')['replacements_view']): ?>
			<hr style="height: 4px;">
			<?php
			$replacementsCostTotal = 0;
			$replacementsFreebieCostTotal = 0;
			$replacementsPriceTotal = 0;
			$replacementsFreebiePriceTotal = 0;
			?>

			<div class="page-heading">
				<div class="page-title">
					<div class="row pt-3 toggleSectionReplacements sectionToggle" style="cursor: pointer;">
						<div class="col-12">
							<h4>
								<i class="bi bi-arrow-left-right"></i> REPLACEMENTS
								<span class="text-center success-banner-sm">
									<i class="bi bi-arrow-left-right"></i> <?=$getReplacements->num_rows()?> TOTAL
								</span>
								<i class="bi bi-caret-down-fill float-end caret"></i>
							</h4>
						</div>
					</div>
					<?php if ($this->session->userdata('UserRestrictions')['replacements_add']): ?>
						<div class="row pt-3">
							<div class="col-12">
								<button type="button" class="salesreplacements-btn btn btn-sm-success" style="font-size: 12px;"><i class="bi bi-arrow-left-right"></i> NEW REPLACEMENT</button>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<section class="sectionReplacements d-none">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="replacementsTable" class="standard-table table">
								<thead style="font-size: 12px;">
									<th class="text-center">TRANSACTION ID</th>
									<th class="text-center">PRODUCT STOCK ID</th>
									<th class="text-center">QTY</th>
									<th class="text-center">COST</th>
									<th class="text-center">TOTAL COST</th>
									<th class="text-center">UNIT DISCOUNT</th>
									<th class="text-center">PRICE</th>
									<th class="text-center">TOTAL PRICE</th>
									<th class="text-center">FREEBIE</th>
									<th class="text-center">DATE ADDED</th>
									<th class="text-center"></th>
								</thead>
								<tbody>
								<?php if ($getReplacements->num_rows() > 0):
									foreach ($getReplacements->result_array() as $row):
										$transactionDetails = $this->Model_Selects->GetTransactionsByTID($row['TransactionID'])->row_array();
										?>
										<tr>
											<td class="text-center">
												<?=$row['TransactionID']?>
											</td>
											<td class="text-center">
												<span class="db-identifier" style="font-style: italic; font-size: 12px;"><?=$transactionDetails['stockID']?></span>
											</td>
											<td class="text-center">
												<?=$transactionDetails['Amount']?>
											</td>
											<?php
											$totalCost = $row['Cost'] * $transactionDetails['Amount'];

											if ($transactionDetails['Freebie']) {
												$replacementsFreebieCostTotal += $totalCost;
											} else {
												$replacementsCostTotal += $totalCost;
											}
											?>
											<td class="text-center">
												<?=number_format($row['Cost'], 2)?>
											</td>
											<td class="text-center">
												<?=number_format($totalCost, 2)?>
											</td>
											<td class="text-center">
												<?=$transactionDetails['UnitDiscount']?>%
											</td>
											<?php
											$unitPrice = $row['Price'] - ($row['Price'] * ($transactionDetails['UnitDiscount']) / 100);
											$totalPrice = ($transactionDetails['Amount']) * $unitPrice;

											if ($transactionDetails['Freebie']) {
												$replacementsFreebiePriceTotal += $totalPrice;
											} else {
												$replacementsPriceTotal += $totalPrice;
											}
											?>
											<td class="text-center">
												<?=number_format($unitPrice, 2)?>
											</td>
											<td class="text-center">
												<?=number_format($totalPrice, 2)?>
											</td>
											<td class="text-center">
												<?php if ($transactionDetails['Freebie']): ?>
													<i class="bi bi-check-circle text-success"></i>
												<?php else: ?>
													<i class="bi bi-x-circle text-danger"></i>
												<?php endif; ?>
											</td>
											<td class="text-center">
												<?=$row['DateAdded']?>
											</td>
											<td class="text-center">
												<?php if ($transactionDetails['Status'] == '0'): ?>
													<?php if ($this->session->userdata('UserRestrictions')['replacements_approve']): ?>
														<button class="btn btn-primary approveReplacement" data-replacementno="<?=$row['ReplacementNo']?>">
															<i class="bi bi-check"></i> APPROVE
														</button>
													<?php endif; ?>
												<?php else: ?>
													<?php if ($this->session->userdata('UserRestrictions')['replacements_delete']): ?>
														<a href="FORM_removeReplacement?rno=<?=$row['ReplacementNo']?>">
															<button type="button" class="btn removeReplacement"><i class="bi bi-trash text-danger"></i></button>
														</a>
													<?php endif; ?>
												<?php endif; ?>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
									<tr style="border-color: #a7852d;">
										<td class="text-end fw-bold" colspan="4">TOTAL COST</td>
										<td class="text-center"><?=number_format($replacementsCostTotal, 2)?></td>
										<td class="text-end fw-bold" colspan="2">TOTAL PRICE</td>
										<td class="text-center"><?=number_format($replacementsPriceTotal, 2)?></td>
										<td colspan="3"></td>
									</tr>
									<tr style="border-color: #a7852d;">
										<td class="text-end fw-bold" colspan="4">TOTAL COST FREEBIE</td>
										<td class="text-center"><?=number_format($replacementsFreebieCostTotal, 2)?></td>
										<td class="text-end fw-bold" colspan="2">TOTAL PRICE FREEBIE</td>
										<td class="text-center"><?=number_format($replacementsFreebiePriceTotal, 2)?></td>
										<td colspan="3"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		<?php endif; ?>
	</div>
</div>
<div class="prompts">
	<?php print $this->session->flashdata('prompt_status'); ?>
</div>

<?php $this->load->view('admin/_modals/sales_orders/sales_order_form.php', array(
	'salesOrder' => $salesOrder,
	'getTransactionsByOrderNo' => $getTransactionsByOrderNo,
	'getAdtlFeesByOrderNo' => $getAdtlFeesByOrderNo,
	'clientBTDetails' => $clientBTDetails,
	'clientSTDetails' => $clientSTDetails
)); ?>
<?php $this->load->view('admin/_modals/sales_orders/sales_order_accounting'); ?>
<?php $this->load->view('admin/_modals/sales_orders/sales_order_logs'); ?>
<?php $this->load->view('admin/_modals/sales_orders/add_adtl_fee_so', array('salesOrderNo' => $salesOrder['OrderNo'])); ?>
<?php $this->load->view('admin/_modals/sales_orders/update_adtl_fee_so'); ?>
<?php $this->load->view('admin/_modals/sales_orders/schedule_delivery_sales_order'); ?>
<?php $this->load->view('admin/_modals/sales_orders/add_invoice_so', array('salesOrder' => $salesOrder)); ?>
<?php $this->load->view('admin/_modals/sales_orders/sales_order_remarks', array('salesOrder' => $salesOrder)); ?>
<?php $this->load->view('admin/_modals/mails/add_mail.php'); ?>
<?php $this->load->view('admin/_modals/sales_orders/add_replacement_so', array('salesOrderNo' => $salesOrder['OrderNo'])); ?>
<?php $this->load->view('admin/_modals/sales_orders/approve_replacement_so', array('salesOrderNo' => $salesOrder['OrderNo'])); ?>
<?php $this->load->view('admin/_modals/sales_orders/add_transaction_so', array('salesOrderNo' => $salesOrder['OrderNo'])); ?>
<?php $this->load->view('admin/_modals/sales_orders/update_transaction_so'); ?>

<script src="<?=base_url()?>/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?=base_url()?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/js/jquery.js"></script>
<?php $this->load->view('main/globals/scripts.php'); ?>

<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.10.20_dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/1.6.1_dataTables.buttons.min.js"></script>

<script>
$('.sidebar-admin-sales-orders').addClass('active');
$(document).ready(function() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	});

	function showAlert(type, message) {
		if ($('.alertNotification').length > 0) {
			$('.alertNotification').remove();
		}
		$('body').append($('<div>')
			.attr({
				class: 'alert position-fixed bottom-0 end-0 alert-dismissible fade show alertNotification alert-' + type, 
				role: 'alert',
				'data-bs-dismiss': 'alert'
			}).css({ 'z-index': 9999, cursor: 'pointer' })
			.append($('<strong>').html(type[0].toUpperCase() + type.slice(1) + '! '))
			.append($('<span>').html(message))
			.append($('<button>')
				.attr({
					type: 'button', 
					class: 'btn-close',
					'data-bs-dismiss': 'alert',
					'aria-label': 'Close'
				}))
		);
	}

	$('.salesinvoicing-btn').on('click', function() {
		$('#SalesInvoicing').modal('toggle');
	});
	$('.deliveryschedule-btn').on('click', function() {
		$('#DeliveryScheduling').modal('toggle');
	});
	$('.reschedule-btn').on('click', function() {
		$('#delivery_scheduling_date').val($(this).data('datescheduled'));
	});
	$('.addremarks-btn').on('click', function() {
		$('#SORemarks').modal('toggle');
		$('#sales_order_remarks').val($(this).data('remarks'));
	});

	$(document).on('click', '.removeInvoice', function() {
		if (!confirm('Remove Invoice?')) {
			event.preventDefault();
		}
	});

	var tableProducts = $('#selectproductsTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableProductsSearch').on('keyup change', function(){
		tableProducts.search($(this).val()).draw();
	});
	var tableStocks = $('#selectstocksTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		'createdRow': function(row, data, dataIndex) {
			let productstockID = data[1] + '_' + data[0];
			$(row).addClass('productStocks select-stock-row').data('sku', data[1]).data('productstockID', productstockID);

			if ($('#salesOrderProducts').find("[data-stockid='"+ productstockID +"']").length > 0 ) {
				$(row).addClass('trAdded');
			}
		},
		'columnDefs': [ {
				'targets': 0,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockID text-center').html($('<span>').addClass('db-identifier').css({ 'font-style': 'italic', 'font-size': '12px' }).html(cellData)).data('stockID',cellData);
				}
			}, {
				'targets': 1,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockSKU text-center');
				}
			}, {
				'targets': 2,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockCurrentStocks text-center');
				}
			}, {
				'targets': 3,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockPrice text-center').html(parseFloat(cellData).toFixed(2)).data('retailPrice', cellData);
				}
			}, {
				'targets': 4,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockDateAdded text-center');
				}
			}, {
				'targets': 5,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockExpirationDate text-center');
				}
			}
		]
	});
	$('#tableStocksSearch').on('keyup change', function(){
		tableStocks.search($(this).val()).draw();
	});

	// APPROVING
	$(document).on('click', '.rejectOrder', function() {
		if (!confirm('Reject Sales Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('0');
			$('#formApproveSalesOrder').submit();
		}
	});
	$(document).on('click', '.approveOrder', function() {
		if (!confirm('Approve Sales Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#orderApproved').val('1');
			$('#formApproveSalesOrder').submit();
		}
	});

	$(document).on('click', '.deliveredmark', function() {
		if (!confirm('Mark Sales Order as delivered? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#formMarkDelivered').submit();
		}
	});
	$(document).on('click', '.receivedmark', function() {
		if (!confirm('Mark Sales Order as received? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#formMarkReceived').submit();
		}
	});


	// ADTL FEES
	$('.adtlfee-btn').on('click', function() {
		$('#SalesAdtlFee').modal('toggle');
	});
	$(document).on('click', '.updateAdtlFee', function() {
		$('#UpdateAdtlFee').modal('toggle');
		$('#UpdateAdtlFeeNo').val($(this).data('adtlfeeno'));
		
		let tr = $(this).parents('tr');
		$('.updateAdtlFeeDescription').val(tr.find('.afDescription').data('val'));
		$('.updateAdtlFeeQty').val(tr.find('.afQty').data('val'));
		$('.updateAdtlFeeUnitDiscount').val(tr.find('.afUnitDiscount').data('val'));
		$('.updateAdtlFeeUnitPrice').val(tr.find('.afUnitPrice').data('val'));
	});
	$(document).on('hidden.bs.modal', '#UpdateAdtlFee', function (event) {
		$('#UpdateAdtlFeeNo').val(null);
	});
	$(document).on('click', '.removeAdtlFee', function() {
		if (!confirm('Remove Adtl Fee?')) {
			event.preventDefault();
		}
	});

	// PO FORM FUNCTIONS
	$('.select-formtransaction-row').on('click', function() {
		$('#SalesOrderFormModal').data('selectTransactions', true);
		$('#SalesOrderFormModal').modal('toggle');

		$('#SalesOrderFormModal').data('prevscroll', $('#SalesOrderFormModal').scrollTop());
	});
	$(document).on('hidden.bs.modal', '#SalesOrderFormModal', function (event) {
		if ($('#SalesOrderFormModal').data('selectTransactions')) {
			$('#SalesOrderFormTransactionsModal').modal('toggle');
			$('#SalesOrderFormModal').data('selectTransactions', false);
		}
	});
	$(document).on('hidden.bs.modal', '#SalesOrderFormTransactionsModal', function (event) {
		$('#SalesOrderFormModal').modal('toggle');
		setTimeout(function() {
			$('#SalesOrderFormModal').animate({
				scrollTop: $('#SalesOrderFormModal').data('prevscroll')
			}, 50);
		}, 50);
	});

	function moneyFormat(value) {
		return value.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
	}
	function updFormTotalPrice() {
		let totalAmount = 0;
		$.each($('.soFormTransaction .amount'), function(key, obj) {
			totalAmount += parseFloat($(this).data('amount'));
		});
		$('#subTotal').html(moneyFormat(totalAmount));

		let dcOutright = $('#dcOutright').data('discount');
		$('#dcOutright').html(moneyFormat(totalAmount * (dcOutright / 100)));
		let dcVolume = $('#dcVolume').data('discount');
		$('#dcVolume').html(moneyFormat(totalAmount * (dcVolume / 100)));
		let dcPBD = $('#dcPBD').data('discount');
		$('#dcPBD').html(moneyFormat(totalAmount * (dcPBD / 100)));
		let dcManpower = $('#dcManpower').data('discount');
		$('#dcManpower').html(moneyFormat(totalAmount * (dcManpower / 100)));

		$('#total').html(moneyFormat(totalAmount - (totalAmount * ((dcOutright + dcVolume + dcPBD + dcManpower) / 100))));
	}
	
	$(document).on('click', '.add-formtransaction-row', function() {
		let ftClass = 'formTransaction_' + $(this).data('id');
		if ($('.' + ftClass).length < 1) {
			let tRow = $(this).clone();
			tRow.removeClass('add-formtransaction-row').addClass('soFormTransaction ' + ftClass);
			tRow.find('.totalAmountUnit').addClass('amount').removeClass('totalAmountUnit');

			$('.select-formtransaction-row').before(tRow);

			$(this).addClass('bg-secondary');
		} else {
			$('.' + ftClass).remove();
			$(this).removeClass('bg-secondary');
		}
		updFormTotalPrice();
	});


	// FORM GENERATION
	$('.generateform-btn').on('click', function() {
		$('#SalesOrderFormModal').modal('toggle');
	});
	$('#generate_form').click(function() {
		$('.inputManual').hide();
		$.each($('.inputManual'), function(key, obj) {
			$(this).parent().append(
				$('<span>').html($(this).val())
			);
		});
		$('#salesOrderForm').appendTo('body');
		$('#SalesOrderFormModal').modal('toggle');
		window.print();
		$('#salesOrderForm').appendTo('#SalesOrderFormModal .modal-body');
		$('.inputManual').show();
		$('.inputManual').siblings('span').remove();
	});
	$('#generate_excel').click(function() {
		if ($('.soFormTransaction').length > 0) {
			$('#xls_preparedby').val($('#prepared_by').val());

			// SET ROW INPUT VALUES
			$('.excelExportInputRow').remove();
			$.each($('.soFormTransaction'), function(key, obj) {
				$('#formExportTable').append($('<input>')
					.attr({
						class: 'excelExportInputRow',
						type: 'hidden',
						name: $(this).data('type') + '[]' // to different between reg transactions and adtl fees
					}).val($(this).data('id'))
				);
			});

			$('#formExportTable').submit();
		} else {
			showAlert('warning', 'No transactions selected!');
		}
	});


	// ACCOUNTING
	$(document).on('click', '.btn-delete-journal', function() {
		let journal_id = $(this).parents('tr').data('id');
		if (!confirm('Delete Journal #'+ journal_id +'? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#journalIDDelete').val(journal_id);
			$('#formDeleteJournal').submit();
		}
	});

	$('.accounting-btn').on('click', function() {
		$('#AccountingModal').modal('toggle');
	});
	$('.log-btn').on('click', function() {
		$('#LogModal').modal('toggle');
	});

	$('.newtransaction-btn').on('click', function() {
		$('#AccountingModal').data('action', 'newtransaction');
		$('#AccountingModal').modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AccountingModal', function (event) {
		if ($('#AccountingModal').data('action') == 'newtransaction') {
			$('#AccountingModal').data('action', '');
			$('#AddJournalTransactionModal').modal('toggle');
		}
	});
	$(document).on('hidden.bs.modal', '#AddJournalTransactionModal', function (event) {
		$('#AccountingModal').modal('toggle');
	});


	$('.updateSOTransaction').on('click', function() {
		$('#sales_order_transaction_id').val($(this).data('tid'));
		$('#sales_order_transaction_label').html($(this).data('tid'));
		$('#sales_order_transaction_qty').val($(this).data('qty'));
		$('#UpdateTransactionModal').modal('toggle');
	});


	var accounts_list = <?=json_encode((isset($getAccounts) && $getAccounts->num_rows() > 0 ? $getAccounts->result_array() : array()))?>;
	var account_types = ['REVENUES', 'ASSETS', 'LIABILITIES', 'EXPENSES', 'EQUITY'];

	function updTransactionCount() {
		// update journal transaction count
		$('#transactionsCount').val($('.account_row').length);
		// update journal transaction input names
		$.each($('.account_row'), function(i, val) {
			$(this).find('.inpAccountID').attr('name', 'accountIDInput_' + i);
			$(this).find('.inpDebit').attr('name', 'debitInput_' + i);
			$(this).find('.inpCredit').attr('name', 'creditInput_' + i);
		});
		// total
		let debitTotal = 0;
		$.each($('.inpDebit'), function(i, val) {
			debitTotal += parseFloat($(this).val());
		});
		$('.debitTotal').html(debitTotal.toFixed(2));
		let creditTotal = 0;
		$.each($('.inpCredit'), function(i, val) {
			creditTotal += parseFloat($(this).val());
		});
		$('.creditTotal').html(creditTotal.toFixed(2));
	}
	$(document).on('click', '.add-account-row', function() {
		var this_row = 'ar_' + $('.account_row').length;
		$('.add-account-row').before($('<tr>')
			.attr({
				class: 'account_row highlighted ' + this_row,
			}).data('id', $('.account_row').length)
			.append($('<td>').attr({ // column-1
				class: ''
			}).append($('<select>').attr({
				class: 'select_accounts inpAccountID w-100'
			}).append($('<optgroup>').attr({
				class: 'type_0',
				label: 'REVENUES'
			})).append($('<optgroup>').attr({
				class: 'type_1',
				label: 'ASSETS'
			})).append($('<optgroup>').attr({
				class: 'type_2',
				label: 'LIABILITIES'
			})).append($('<optgroup>').attr({
				class: 'type_3',
				label: 'EXPENSES'
			})).append($('<optgroup>').attr({
				class: 'type_4',
				label: 'EQUITIES'
			}))))
			.append($('<td>').attr({ // column-2
				class: ''
			}).append($('<input>').attr({
				class: 'inpDebit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ // column-3
				class: ''
			}).append($('<input>').attr({
				class: 'inpCredit  w-100',
				type: 'number',
				min: '0',
				step: '0.0001',
				value: 0
			})))
			.append($('<td>').attr({ class: 'text-center' }).append($('<button>').attr({
				type: 'button',
				class: 'btn remove-account-row'
			}).append($('<i>').attr({ class: 'bi bi-x-square' }).css('color', '#a7852d'))))
		);

		for (var i = accounts_list.length - 1; i >= 0; i--) {
			$('.' + this_row + ' .type_' + accounts_list[i]['Type']).append($('<option>').attr({
				value: accounts_list[i]['ID']
			}).text(accounts_list[i]['Name']));
		}

		setTimeout(function() {
			$('.' + this_row).removeClass('highlighted');
		}, 2000);
		$('.' + this_row).fadeIn('2000');

		updTransactionCount();
	});

	// add two two transaction accounts
	$('.add-account-row').click(); $('.add-account-row').click();

	$(document).on('click', '.remove-account-row', function() {
		$(this).parents('tr').remove();

		updTransactionCount();
	});
	$(document).on('focus keyup change', '.inpDebit, .inpCredit', function() {
		updTransactionCount();
	});
	// disable other debit/credit on change
	$(document).on('focus keyup change', '.inpDebit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpCredit').val(0);
			$(this).parents('tr').find('.inpCredit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpCredit').removeAttr('disabled');
		}
	});
	$(document).on('focus keyup change', '.inpCredit', function() {
		if ($(this).val() > 0) {
			$(this).parents('tr').find('.inpDebit').val(0);
			$(this).parents('tr').find('.inpDebit').attr('disabled', '');
		} else {
			$(this).parents('tr').find('.inpDebit').removeAttr('disabled');
		}
	});

	$('#formAddJournal').on('submit', function(e) {
		let totalDebit = parseFloat($('.debitTotal').html());
		let totalCredit = parseFloat($('.creditTotal').html());
		if (totalDebit != totalCredit) {
			showAlert('warning', 'Debit and Credit must be equal.');
			e.preventDefault();
		} else if (totalDebit <= 0 || totalCredit <= 0) {
			showAlert('warning', 'Total must be more than 0.');
			e.preventDefault();
		}
	});

	// EMAIL
	$(document).on('click', '.emailbtclient-btn, .emailstclient-btn', function() {
		$('.send_to').val($(this).data('email'));
		$('.mail_subject').val(
			'Sales Order # ' + $('.salesOrderNo').html()
		);
		// $('.mail_message').val($(this).data('email'));
		// $('.mail_attachment').val($(this).data('email'));
		$('#add_mailtosend').modal('toggle');
	});
	$('#submit_formsend').on('click', function() {
		$('#form_emailsend').submit();
	});


	// SECTION VIEWS
	$(document).on('click', '.toggleSectionInvoicing', function() {
		$('.sectionInvoicing').toggleClass('d-none');
		$(this).find('.caret').toggleClass('bi-caret-down-fill').toggleClass('bi-caret-up-fill');

		if ($(this).find('.caret').hasClass('bi-caret-up-fill')) {
			$(document).scrollTop($(document).scrollTop() + $('.sectionInvoicing').height());
		}
	});
	$(document).on('click', '.toggleSectionReturns', function() {
		$('.sectionReturns').toggleClass('d-none');
		$(this).find('.caret').toggleClass('bi-caret-down-fill').toggleClass('bi-caret-up-fill');

		if ($(this).find('.caret').hasClass('bi-caret-up-fill')) {
			$(document).scrollTop($(document).scrollTop() + $('.sectionReturns').height());
		}
	});
	$(document).on('click', '.toggleSectionReplacements', function() {
		$('.sectionReplacements').toggleClass('d-none');
		$(this).find('.caret').toggleClass('bi-caret-down-fill').toggleClass('bi-caret-up-fill');

		if ($(this).find('.caret').hasClass('bi-caret-up-fill')) {
			$(document).scrollTop($(document).scrollTop() + $('.sectionReplacements').height());
		}
	});

	// REPLACEMENTS
	$('.salesreplacements-btn').on('click', function() {
		$('#AddReplacementModal').modal('toggle');
	});
	$('.newReplacementSKU-btn').parents('.btn').on('click', function() {
		$('#AddReplacementModal').data('select', true).modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AddReplacementModal', function (event) {
		if ($('#AddReplacementModal').data('select')) {
			$('#AddReplacementSKUModal').modal('toggle');
			$('#AddReplacementModal').data('select', false);
			$('#AddReplacementSKUModal').data('select', true);
		}
	});
	$(document).on('click', '.select-product-row', function() {
		// get product stocks
		$.get('getProductStocks', { dataType: 'json', sku: $(this).data('sku') })
		.done(function(data) {
			tableStocks.clear();
			let productStocks = $.parseJSON(data);
			$.each(productStocks, function(index, val) {
				tableStocks.row.add([
					val.ID,
					val.Product_SKU,
					val.Current_Stocks,
					val.Retail_Price,
					val.Date_Added,
					val.Expiration_Date
				]);
			});
			tableStocks.draw();
		});

		$('#AddReplacementSKUModal').data('select', true).modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AddReplacementSKUModal', function (event) {
		if ($('#AddReplacementSKUModal').data('select')) {
			$('#AddReplacementStockModal').modal('toggle');
			$('#AddReplacementSKUModal').data('select', false);
		}
	});

	$(document).on('click', '.select-stock-row', function() {
		let productSKU = $(this).data('sku');
		let stockID = $(this).children('.stockID').data('stockID');
		let stockPrice = $(this).children('.stockPrice').html();
				
		$('.newReplacementSKU').val(productSKU);
		$('.newReplacementSKU-btn').text(productSKU);
		$('.newReplacementStockID').val(stockID);
		$('.newReplacementStockID-text').text('#'+ stockID);
		$('.newReplacementQty').attr('max', $(this).children('.stockCurrentStocks').html());
		$('.newReplacementCost').data('unitCost', stockPrice).text(stockPrice);


		$('#AddReplacementStockModal').modal('toggle');
		tableStocks.clear();
		updProductCount();
	});
	$(document).on('hidden.bs.modal', '#AddReplacementStockModal', function (event) {
		$('#AddReplacementModal').modal('toggle');
	});

	$(document).on('focus keyup change', '.newReplacementQty, .newReplacementDiscount, .newReplacementFreebie', function() {
		updProductCount();
	});
	function updProductCount() {
		if ($('.newReplacementSKU').val().length > 0) {
			let totalCostUndiscounted = parseInt($('.newReplacementQty').val()) * parseFloat($('.newReplacementCost').data('unitCost'));
			let totalCostDiscounted = totalCostUndiscounted - (totalCostUndiscounted * (parseInt($('.newReplacementDiscount').val()) / 100));

			if (parseFloat(totalCostDiscounted) < 0) {
				showAlert('danger', 'Total Price for product is below zero!');
			}

			if ($('.newReplacementFreebie').prop('checked')) {
				$('.newReplacementTotalCost').text('0.00');
			} else {
				$('.newReplacementTotalCost').text(moneyFormat(totalCostDiscounted));
			}
		}
	}


	$(document).on('click', '.approveReplacement', function() {
		$('#ApproveReplacementModal').modal('toggle');
		$('#approveReplacementNo').val($(this).attr('data-replacementno'));
	});
	$(document).on('click', '.removeReplacement', function() {
		if (!confirm('Remove Replacement?')) {
			event.preventDefault();
		}
	});



	$(document).on('click', '.deleteOrder', function() {
		if (!confirm('Delete Sales Order? (This action cannot be undone)')) {
			event.preventDefault();
		} else {
			$('#formDeleteSalesOrder').submit();
		}
	});
	$(document).on('click', '.removeTransaction', function() {
		if (!confirm('Remove Transaction?')) {
			event.preventDefault();
		}
	});

	// TRANSACTIONS
	var tableProductsTransaction = $('#selectproductsTransactionTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
	});
	$('#tableProductsTransactionSearch').on('keyup change', function(){
		tableProductsTransaction.search($(this).val()).draw();
	});
	var tableStocksTransaction = $('#selectstocksTransactionTable').DataTable( {
		sDom: 'lrtip',
		'bLengthChange': false,
		'order': [[ 0, 'desc' ]],
		'createdRow': function(row, data, dataIndex) {
			let productstockID = data[1] + '_' + data[0];
			$(row).addClass('productStocks select-stock-transaction-row').data('sku', data[1]).data('productstockID', productstockID);
		},
		'columnDefs': [ {
				'targets': 0,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockID text-center').html($('<span>').addClass('db-identifier').css({ 'font-style': 'italic', 'font-size': '12px' }).html(cellData)).data('stockID',cellData);
				}
			}, {
				'targets': 1,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockSKU text-center');
				}
			}, {
				'targets': 2,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockCurrentStocks text-center');
				}
			}, {
				'targets': 3,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockPrice text-center').html(parseFloat(cellData).toFixed(2)).data('retailPrice', cellData);
				}
			}, {
				'targets': 4,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockDateAdded text-center');
				}
			}, {
				'targets': 5,
				'createdCell': function (td, cellData, rowData, row, col) {
					$(td).addClass('stockExpirationDate text-center');
				}
			}
		]
	});
	$('#tableStocksTransactionSearch').on('keyup change', function(){
		tableStocksTransaction.search($(this).val()).draw();
	});
	$('.transaction-btn').on('click', function() {
		$('#AddTransactionModal').modal('toggle');
	});
	$('.newTransactionSKU-btn').parents('.btn').on('click', function() {
		$('#AddTransactionModal').data('select', true).modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AddTransactionModal', function (event) {
		if ($('#AddTransactionModal').data('select')) {
			$('#AddTransactionSKUModal').modal('toggle');
			$('#AddTransactionModal').data('select', false);
			$('#AddTransactionSKUModal').data('select', true);
		}
	});
	$(document).on('click', '.select-product-transaction-row', function() {
		// get product stocks
		$.get('getProductStocks', { dataType: 'json', sku: $(this).data('sku') })
		.done(function(data) {
			tableStocksTransaction.clear();
			let productStocks = $.parseJSON(data);
			$.each(productStocks, function(index, val) {
				tableStocksTransaction.row.add([
					val.ID,
					val.Product_SKU,
					val.Current_Stocks,
					val.Retail_Price,
					val.Date_Added,
					val.Expiration_Date
				]);
			});
			tableStocksTransaction.draw();
		});

		$('#AddTransactionSKUModal').data('select', true).modal('toggle');
	});
	$(document).on('hidden.bs.modal', '#AddTransactionSKUModal', function (event) {
		if ($('#AddTransactionSKUModal').data('select')) {
			$('#AddTransactionStockModal').modal('toggle');
			$('#AddTransactionSKUModal').data('select', false);
		}
	});

	$(document).on('click', '.select-stock-transaction-row', function() {
		let productSKU = $(this).data('sku');
		let stockID = $(this).children('.stockID').data('stockID');
		let stockPrice = $(this).children('.stockPrice').html();
				
		$('.newTransactionSKU').val(productSKU);
		$('.newTransactionSKU-btn').text(productSKU);
		$('.newTransactionStockID').val(stockID);
		$('.newTransactionStockID-text').text('#'+ stockID);
		$('.newTransactionQty').attr('max', $(this).children('.stockCurrentStocks').html());
		$('.newTransactionCost').data('unitCost', stockPrice).text(stockPrice);


		$('#AddTransactionStockModal').modal('toggle');
		tableStocksTransaction.clear();
		updProductCount();
	});
	$(document).on('hidden.bs.modal', '#AddTransactionStockModal', function (event) {
		$('#AddTransactionModal').modal('toggle');
	});

	$(document).on('focus keyup change', '.newTransactionQty, .newTransactionDiscount, .newTransactionFreebie', function() {
		updProductCount();
	});
	function updProductCount() {
		if ($('.newTransactionSKU').val().length > 0) {
			let totalCostUndiscounted = parseInt($('.newTransactionQty').val()) * parseFloat($('.newTransactionCost').data('unitCost'));
			let totalCostDiscounted = totalCostUndiscounted - (totalCostUndiscounted * (parseInt($('.newTransactionDiscount').val()) / 100));

			if (parseFloat(totalCostDiscounted) < 0) {
				showAlert('danger', 'Total Price for product is below zero!');
			}

			if ($('.newTransactionFreebie').prop('checked')) {
				$('.newTransactionTotalCost').text('0.00');
			} else {
				$('.newTransactionTotalCost').text(moneyFormat(totalCostDiscounted));
			}
		}
	}
});
</script>

<script src="<?=base_url()?>/assets/js/main.js"></script>
</body>

</html>
