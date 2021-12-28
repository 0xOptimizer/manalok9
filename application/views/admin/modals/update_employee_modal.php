<div class="modal fade" id="UpdateEmployeeModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<form action="<?php echo base_url() . 'FORM_updateUser';?>" method="POST" enctype="multipart/form-data">
		<input id="UpdateUserID" type="hidden" name="userID">
		<input id="UpdateDefaultImage" type="hidden" name="defaultImage">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;">
					<input class="form-check-input cursor-pointer" type="checkbox" value="" id="UpdateEmployeeToggle">
					<label class="form-check-label cursor-pointer" for="UpdateEmployeeToggle">
						Update Employee
					</label>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Left Part -->
					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="form-row">
									<div class="form-group col-sm-12 col-md-12">
										<div class="form-group col-sm-12 text-center">
											<input type="file" id="UpdatePFPInput" name="pImage" style="display: none;">
											<input type="hidden" id="UpdatepImageChecker" name="pImageChecker">
											<img class="image-hover" id="UpdatePFPInputPreview" src="<?php echo base_url() ?>assets/images/faces/1.jpg" width="192" height="192" alt="Image Preview" style="border-radius: 8px;" loading="lazy">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-row">
									<div class="form-group col-sm-12">
										<label class="input-label">FIRST NAME</label>
										<input id="UpdateFirstName" type="text" class="form-control" name="firstName" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">MIDDLE NAME</label>
										<input id="UpdateMiddleName" type="text" class="form-control" name="middleName" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">LAST NAME</label>
										<input id="UpdateLastName" type="text" class="form-control" name="lastName" readonly>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="row">
									<div class="form-group col-sm-12 col-md-6">
										<label class="input-label">DATE OF BIRTH</label>
										<input id="UpdateDateOfBirth" type="date" class="form-control" name="birthDate" readonly>
									</div>
									<div class="form-group col-sm-12 col-md-6">
										<label class="input-label">NAME EXTENSION</label>
										<input id="UpdateNameExtension" type="text" class="form-control" name="nameExtension" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">CONTACT</label>
										<input id="UpdateContactNumber" type="text" class="form-control" name="contactNumber" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">ADDRESS</label>
										<input id="UpdateAddress" type="text" class="form-control" name="locationAddress" readonly>
									</div>
									<div class="form-group col-sm-12 mt-2 employee-comment-input">
										<label class="input-label">COMMENT</label>
										<input id="UpdateComment" type="text" class="form-control" name="adminComment" readonly>
									</div>
									<div class="form-group col-sm-12">
										<label class="input-label">PRIVILEGE</label>
										<select id="UpdatePrivilege" class="form-control" name="userPrivilege" readonly disabled>
											<option value="0" selected>None</option>
											<option value="1">Normal</option>
											<option value="2">Admin</option>
											<option value="3">Developer</option>
										</select>
									</div>
									<div class="form-group col-sm-12 allowedActions_Update">
										<label class="input-label">ALLOWED ACTIONS</label>
										<div class="row mx-3">
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="products_view_update" id="productsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="productsView_Update">PRODUCTS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="products_add_update" id="productsAdd_Update" disabled="">
													<label class="form-check-label" for="productsAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="products_edit_update" id="productsEdit_Update" disabled="">
													<label class="form-check-label" for="productsEdit_Update">Edit</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="products_delete_update" id="productsDelete_Update" disabled="">
													<label class="form-check-label" for="productsDelete_Update">Delete</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="releasing_view_update" id="releaseView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="releaseView_Update">RELEASE</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="restocking_view_update" id="restockView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="restockView_Update">RESTOCK</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="inventory_view_update" id="inventoryView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="inventoryView_Update">INVENTORY</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="users_view_update" id="usersView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="usersView_Update">USERS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="users_add_update" id="usersAdd_Update" disabled="">
													<label class="form-check-label" for="usersAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="users_edit_update" id="usersEdit_Update" disabled="">
													<label class="form-check-label" for="usersEdit_Update">Edit</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="vendors_view_update" id="vendorsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="vendorsView_Update">VENDORS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="vendors_add_update" id="vendorsAdd_Update" disabled="">
													<label class="form-check-label" for="vendorsAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="vendors_edit_update" id="vendorsEdit_Update" disabled="">
													<label class="form-check-label" for="vendorsEdit_Update">Edit</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="vendors_delete_update" id="vendorsDelete_Update" disabled="">
													<label class="form-check-label" for="vendorsDelete_Update">Delete</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="purchase_orders_view_update" id="purchaseOrdersView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="purchaseOrdersView_Update">PURCHASE ORDERS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="purchase_orders_add_update" id="purchaseOrdersAdd_Update" disabled="">
													<label class="form-check-label" for="purchaseOrdersAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="purchase_orders_approve_update" id="purchaseOrdersApprove_Update" disabled="">
													<label class="form-check-label" for="purchaseOrdersApprove_Update">Approval</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="purchase_orders_bill_creation_update" id="purchaseOrdersBillsCreation_Update" disabled="">
													<label class="form-check-label" for="purchaseOrdersBillsCreation_Update">Bills Creation</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="bills_view_update" id="billsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="billsView_Update">BILLS</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="clients_view_update" id="clientsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="clientsView_Update">CLIENTS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="clients_add_update" id="clientsAdd_Update" disabled="">
													<label class="form-check-label" for="clientsAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="clients_edit_update" id="clientsEdit_Update" disabled="">
													<label class="form-check-label" for="clientsEdit_Update">Edit</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="clients_delete_update" id="clientsDelete_Update" disabled="">
													<label class="form-check-label" for="clientsDelete_Update">Delete</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="sales_orders_view_update" id="salesOrdersView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="salesOrdersView_Update">SALES ORDERS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_add_update" id="salesOrdersAdd_Update" disabled="">
													<label class="form-check-label" for="salesOrdersAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_mark_for_invoicing_update" id="salesOrdersMarkForInvoicing_Update" disabled="">
													<label class="form-check-label" for="salesOrdersMarkForInvoicing_Update">Mark for Invoicing</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_schedule_delivery_update" id="salesOrdersScheduleDelivery_Update" disabled="">
													<label class="form-check-label" for="salesOrdersScheduleDelivery_Update">Schedule Delivery</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_mark_as_delivered_update" id="salesOrdersMarkAsDelivered_Update" disabled="">
													<label class="form-check-label" for="salesOrdersMarkAsDelivered_Update">Mark as Delivered</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_mark_as_received_update" id="salesOrdersMarkAsReceived_Update" disabled="">
													<label class="form-check-label" for="salesOrdersMarkAsReceived_Update">Mark as Received</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_fulfill_update" id="salesOrdersMarkAsFulfilled_Update" disabled="">
													<label class="form-check-label" for="salesOrdersMarkAsFulfilled_Update">Mark as Fulfilled</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="sales_orders_invoice_creation_update" id="salesOrdersInvoicesCreation_Update" disabled="">
													<label class="form-check-label" for="salesOrdersInvoicesCreation_Update">Invoices Creation</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="invoice_view_update" id="invoiceView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="invoiceView_Update">INVOICES</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="brand_category_view_update" id="brandCategoryView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="brandCategoryView_Update">BRAND CATEGORY</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="trash_bin_view_update" id="trashBinView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="trashBinView_Update">TRASH BIN</label>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="accounts_view_update" id="accountsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="accountsView_Update">ACCOUNTS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="accounts_add_update" id="accountsAdd_Update" disabled="">
													<label class="form-check-label" for="accountsAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="accounts_edit_update" id="accountsEdit_Update" disabled="">
													<label class="form-check-label" for="accountsEdit_Update">Edit</label>
												</div>
											</div>
											<div class="form-check form-switch mt-2">
												<input class="form-check-input actionMain" type="checkbox" name="journal_transactions_view_update" id="journalTransactionsView_Update" disabled="">
												<label class="form-check-label fw-bolder" for="journalTransactionsView_Update">JOURNAL TRANSACTIONS</label>
											</div>
											<div class="col-sm-12 actionSub">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="journal_transactions_add_update" id="journalTransactionsAdd_Update" disabled="">
													<label class="form-check-label" for="journalTransactionsAdd_Update">Add</label>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="journal_transactions_delete_update" id="journalTransactionsDelete_Update" disabled="">
													<label class="form-check-label" for="journalTransactionsDelete_Update">Delete</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Right Part -->
					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-sm-12 table-responsive">
								<label class="input-label">LATEST ACTIVITIES</label>
								<table class="table" id="attendanceLogTable">
									<thead style="display: none;">
									<tr>
										<th>Event</th>
										<th>Time</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div class="col-sm-12">
								<label class="input-label">LOGIN CREDENTIALS</label>
								<div class="login-failed-banner my-2">
									<span class="text-center info-banner">
										<i class="bi bi-exclamation-diamond-fill"></i> No log in credentials set. This employee cannot log in.
									</span>
								</div>
								<div class="form-group col-sm-12">
									<label class="input-label">EMAIL</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-envelope-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
										</div>
										<input id="LoginEmail" type="text" class="form-control" name="loginEmail" readonly>
									</div>
								</div>
								<div class="form-group col-sm-12 currentpass-group">
									<label class="input-label">CURRENT PASSWORD (ENCRYPTED)<span class="newpass-btn-group" style="display: none;"> - <button type="button" class="newpass-btn btn btn-sm-primary"><i class="bi bi-brightness-high-fill"></i> set a new password</button></span></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
										</div>
										<input id="LoginPassword" type="password" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group col-sm-12 newpass-group" style="display: none;">
									<label class="input-label">NEW PASSWORD</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
										</div>
										<input id="NewLoginPassword" type="password" class="form-control" name="newLoginPassword" readonly>
									</div>
								</div>
								<div class="form-group col-sm-12 newpass-group" style="display: none;">
									<label class="input-label">REPEAT NEW PASSWORD</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="bi bi-key-fill h-100 w-100" style="font-size: 16px; margin-top: 5px;"></i></span>
										</div>
										<input id="RepeatNewLoginPassword" type="password" class="form-control" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<span class="error-saving-banner text-center warning-banner-sm" style="display: none;">
					<i class="bi bi-exclamation-diamond-fill"></i> Repeat password does not match
				</span>
				<button type="submit" class="save-btn btn btn-success"><i class="bi bi-check-square"></i> Save Changes</button>
			</div>
		</div>
		</form>
	</div>
</div>