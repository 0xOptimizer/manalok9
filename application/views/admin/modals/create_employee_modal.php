<div class="modal fade" id="NewEmployeeModal" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: auto;">
	<div class="modal-dialog" role="document">
		<form action="<?php echo base_url() . 'FORM_addNewUser';?>" method="POST" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-person-badge-fill" style="font-size: 24px;"></i> New Employee</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="form-row">
							<div class="form-group col-sm-12 col-md-12">
								<div class="form-group col-sm-12 text-center">
									<input type="file" id="PFPInput" name="pImage" style="display: none;">
									<input type="hidden" id="pImageChecker" name="pImageChecker">
									<img class="image-hover" id="PFPInputPreview" src="<?php echo base_url() ?>assets/images/faces/1.jpg" width="192" height="192" alt="Image Preview" style="border-radius: 8px;">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="form-row">
							<div class="form-group col-sm-12">
								<label class="input-label">FIRST NAME</label>
								<input type="text" class="form-control" name="firstName">
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">MIDDLE NAME</label>
								<input type="text" class="form-control" name="middleName">
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">LAST NAME</label>
								<input type="text" class="form-control" name="lastName">
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="form-group col-sm-12 col-md-6">
								<label class="input-label">DATE OF BIRTH</label>
								<input type="date" class="form-control" name="birthDate">
							</div>
							<div class="form-group col-sm-12 col-md-6">
								<label class="input-label">NAME EXTENSION</label>
								<input type="text" class="form-control" name="nameExtension">
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">CONTACT</label>
								<input type="text" class="form-control" name="contactNumber">
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">ADDRESS</label>
								<input type="text" class="form-control" name="locationAddress">
							</div>
							<div class="form-group col-sm-12 mt-2 employee-comment-input" style="display: none;">
								<label class="input-label">COMMENT</label>
								<input type="text" class="form-control" name="adminComment">
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">PRIVILEGE</label>
								<select class="form-control" name="userPrivilege">
									<option value="0" selected>None</option>
									<option value="1">Normal</option>
									<option value="2">Admin</option>
									<option value="3">Developer</option>
								</select>
							</div>
							<div class="form-group col-sm-12">
								<label class="input-label">ALLOWED ACTIONS</label>
								<div class="row mx-3">
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="products_view" id="productsView_New">
										<label class="form-check-label fw-bolder" for="productsView_New">PRODUCTS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="products_add" id="productsAdd_New" disabled="">
											<label class="form-check-label" for="productsAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="products_edit" id="productsEdit_New" disabled="">
											<label class="form-check-label" for="productsEdit_New">Edit</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="products_delete" id="productsDelete_New" disabled="">
											<label class="form-check-label" for="productsDelete_New">Delete</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="releasing_view" id="releaseView">
										<label class="form-check-label fw-bolder" for="releaseView">RELEASE</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="restocking_view" id="restockView">
										<label class="form-check-label fw-bolder" for="restockView">RESTOCK</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="inventory_view" id="inventoryView_New">
										<label class="form-check-label fw-bolder" for="inventoryView_New">INVENTORY</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="users_view" id="usersView_New">
										<label class="form-check-label fw-bolder" for="usersView_New">USERS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="users_add" id="usersAdd_New" disabled="">
											<label class="form-check-label" for="usersAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="users_edit" id="usersEdit_New" disabled="">
											<label class="form-check-label" for="usersEdit_New">Edit</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="vendors_view" id="vendorsView_New">
										<label class="form-check-label fw-bolder" for="vendorsView_New">VENDORS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="vendors_add" id="vendorsAdd_New" disabled="">
											<label class="form-check-label" for="vendorsAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="vendors_edit" id="vendorsEdit_New" disabled="">
											<label class="form-check-label" for="vendorsEdit_New">Edit</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="vendors_delete" id="vendorsDelete_New" disabled="">
											<label class="form-check-label" for="vendorsDelete_New">Delete</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="purchase_orders_view" id="purchaseOrdersView_New">
										<label class="form-check-label fw-bolder" for="purchaseOrdersView_New">PURCHASE ORDERS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="purchase_orders_add" id="purchaseOrdersAdd_New" disabled="">
											<label class="form-check-label" for="purchaseOrdersAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="purchase_orders_approve" id="purchaseOrdersApprove_New" disabled="">
											<label class="form-check-label" for="purchaseOrdersApprove_New">Approval</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="purchase_orders_bill_creation" id="purchaseOrdersBillsCreation_New" disabled="">
											<label class="form-check-label" for="purchaseOrdersBillsCreation">Bill_News Creation</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="bills_view" id="billsView_New">
										<label class="form-check-label fw-bolder" for="billsView_New">BILLS</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="clients_view" id="clientsView_New">
										<label class="form-check-label fw-bolder" for="clientsView_New">CLIENTS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="clients_add" id="clientsAdd_New" disabled="">
											<label class="form-check-label" for="clientsAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="clients_edit" id="clientsEdit_New" disabled="">
											<label class="form-check-label" for="clientsEdit_New">Edit</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="clients_delete" id="clientsDelete_New" disabled="">
											<label class="form-check-label" for="clientsDelete_New">Delete</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="sales_orders_view" id="salesOrdersView_New">
										<label class="form-check-label fw-bolder" for="salesOrdersView_New">SALES ORDERS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_add" id="salesOrdersAdd_New" disabled="">
											<label class="form-check-label" for="salesOrdersAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_mark_for_invoicing" id="salesOrdersMarkForInvoicing_New" disabled="">
											<label class="form-check-label" for="salesOrdersMarkForInvoicing_New">Mark for Invoicing</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_schedule_delivery" id="salesOrdersScheduleDelivery_New" disabled="">
											<label class="form-check-label" for="salesOrdersScheduleDelivery_New">Schedule Delivery</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_mark_as_delivered" id="salesOrdersMarkAsDelivered_New" disabled="">
											<label class="form-check-label" for="salesOrdersMarkAsDelivered_New">Mark as Delivered</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_mark_as_received" id="salesOrdersMarkAsReceived_New" disabled="">
											<label class="form-check-label" for="salesOrdersMarkAsReceived_New">Mark as Received</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_fulfill" id="salesOrdersMarkAsFulfilled_New" disabled="">
											<label class="form-check-label" for="salesOrdersMarkAsFulfilled_New">Mark as Fulfilled</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="sales_orders_invoice_creation" id="salesOrdersInvoicesCreation_New" disabled="">
											<label class="form-check-label" for="salesOrdersInvoicesCreation_New">Invoices Creation</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="invoice_view" id="invoiceView_New">
										<label class="form-check-label fw-bolder" for="invoiceView_New">INVOICES</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="brand_category_view" id="brandCategoryView_New">
										<label class="form-check-label fw-bolder" for="brandCategoryView_New">BRAND CATEGORY</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input" type="checkbox" name="trash_bin_view" id="trashBinView_New">
										<label class="form-check-label fw-bolder" for="trashBinView_New">TRASH BIN</label>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="accounts_view" id="accountsView_New">
										<label class="form-check-label fw-bolder" for="accountsView_New">ACCOUNTS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="accounts_add" id="accountsAdd_New" disabled="">
											<label class="form-check-label" for="accountsAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="accounts_edit" id="accountsEdit_New" disabled="">
											<label class="form-check-label" for="accountsEdit_New">Edit</label>
										</div>
									</div>
									<div class="form-check form-switch mt-2">
										<input class="form-check-input actionMain" type="checkbox" name="journal_transactions_view" id="journalTransactionsView_New">
										<label class="form-check-label fw-bolder" for="journalTransactionsView_New">JOURNAL TRANSACTIONS</label>
									</div>
									<div class="col-sm-12 actionSub">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="journal_transactions_add" id="journalTransactionsAdd_New" disabled="">
											<label class="form-check-label" for="journalTransactionsAdd_New">Add</label>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" name="journal_transactions_delete" id="journalTransactionsDelete_New" disabled="">
											<label class="form-check-label" for="journalTransactionsDelete_New">Delete</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="feedback-form modal-footer">
				<button type="button" class="btn btn-primary employee-add-new-comment-btn"><i class="bi bi-pen-fill"></i> Comment</button>
				<button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> Save</button>
			</div>
		</div>
		</form>
	</div>
</div>