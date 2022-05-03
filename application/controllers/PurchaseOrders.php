<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrders extends MY_Controller {

	public $globalData = [];
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Security');
		$this->load->model('Model_Selects');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Updates');
		$this->load->model('Model_Deletes');
		$this->load->model('Model_Logbook');
		if ($this->Model_Security->CheckPrivilegeLevel() >= 0) {
			$this->globalData['userID'] = 'N/A';
			if ($this->session->userdata('UserID')) {
				$this->globalData['userID'] = $this->session->userdata('UserID');
			}
			$this->globalData['fullName'] = 'N/A';
			if ($this->session->userdata('FullName')) {
				$this->globalData['fullName'] = $this->session->userdata('FullName');
			}
			$this->globalData['fisrtName'] = 'N/A';
			if ($this->session->userdata('FirstName')) {
				$this->globalData['firstName'] = $this->session->userdata('FirstName');
			}
			$this->globalData['middleName'] = 'N/A';
			if ($this->session->userdata('MiddleName')) {
				$this->globalData['middleName'] = $this->session->userdata('MiddleName');
			}
			$this->globalData['lastName'] = 'N/A';
			if ($this->session->userdata('LastName')) {
				$this->globalData['lastName'] = $this->session->userdata('LastName');
			}
			$this->globalData['nameExtension'] = 'N/A';
			if ($this->session->userdata('NameExtension')) {
				$this->globalData['nameExtension'] = $this->session->userdata('NameExtension');
			}
			$this->globalData['image'] = 'N/A';
			if ($this->session->userdata('Image')) {
				$this->globalData['image'] = $this->session->userdata('Image');
			}
		}
		if (!$this->Model_Security->CheckPrivilegeLevel()) {
			redirect();
		}
	}


// ############################ [ VENDORS ] ############################
	public function vendors() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('vendors_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Vendors';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/vendors', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addNewVendor()
	{
		if ($this->Model_Security->CheckUserRestriction('vendors_add')) {
			// Fetch data
			$vendorNo = 'V' . strtoupper(uniqid());
			$name = $this->input->post('add-name');
			$tin = $this->input->post('add-tin');
			$address = $this->input->post('add-address');
			$contactNum = $this->input->post('add-contact-num');
			$kind = $this->input->post('add-kind');
			$email = $this->input->post('add-email');
			
			// Insert
			$data = array(
				'VendorNo' => $vendorNo,
				'Name' => $name,
				'TIN' => $tin,
				'Address' => $address,
				'ContactNum' => $contactNum,
				'ProductServiceKind' => $kind,
				'Email' => $email,
			);
			$insertNewVendor = $this->Model_Inserts->InsertNewVendor($data);
			if ($insertNewVendor == TRUE) {
				$vendorID = $this->db->insert_id();
				$this->session->set_flashdata('highlight-id', $vendorID);

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Added new vendor.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new vendor.', 'added a new vendor' . ($name ? ' ' . $name : '') . ' [ID: ' . $vendorID . '].', base_url('admin/vendors'));
				redirect('admin/vendors');
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/vendors');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateVendor()
	{
		if ($this->Model_Security->CheckUserRestriction('vendors_edit')) {
			// Fetch data
			$vendorID = $this->input->post('upd-vendor-id');
			$name = $this->input->post('upd-name');
			$tin = $this->input->post('upd-tin');
			$address = $this->input->post('upd-address');
			$contactNum = $this->input->post('upd-contact-num');
			$kind = $this->input->post('upd-kind');
			$email = $this->input->post('upd-email');

			// Insert
			$data = array(
				'Name' => $name,
				'TIN' => $tin,
				'Address' => $address,
				'ContactNum' => $contactNum,
				'ProductServiceKind' => $kind,
				'Email' => $email,
			);
			$updateVendor = $this->Model_Updates->UpdateVendor($data, $vendorID);
			if ($updateVendor == TRUE) {

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Updated vendor.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				$this->Model_Logbook->LogbookEntry('updated vendor details.', 'updated details of vendor' . ($name ? ' ' . $name : '') . ' [vendorID: ' . $vendorID . '].', base_url('admin/vendors'));
				$this->session->set_flashdata('highlight-id', $vendorID);
				redirect('admin/vendors');
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/vendors');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_deleteVendor()
	{
		if ($this->Model_Security->CheckUserRestriction('vendors_delete')) {
			$vendorNo = $this->input->post('vendor-no');

			$getVendorByNo = $this->Model_Selects->GetVendorByNo($vendorNo);

			if ($getVendorByNo->num_rows() > 0) {
				if ($this->Model_Updates->Remove_vendor($getVendorByNo->row_array()['ID'])) {

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Deleted vendor.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('deleted vendor record.', 'deleted a vendor record [ID: ' . $vendorID . '].', base_url('admin/vendors'));
					redirect('admin/vendors');
				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/vendors');
				}
			}
		} else {
			redirect(base_url());
		}
	}
// ############################ [ PURCHASE ORDERS ] ############################
	public function purchase_orders() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/purchase_orders', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_purchase_order() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/view_purchase_order', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_purchase_orders_summary() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders Summary';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/purchase_orders_summary', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addPurchaseOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_add')) {
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$orderNo = 'PO' . strtoupper(uniqid());
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				$purchaseFromNo = $this->input->post('purchaseFromNo');
				$productCount = $this->input->post('productCount');
				$shipVia = $this->input->post('shipVia');
				$deliveryDate = $this->input->post('deliveryDate');

				if ($purchaseFromNo == 'newVendor') {
					$purchaseFromNo = 'V' . strtoupper(uniqid());
					$name = $this->input->post('vendor-name');
					$tin = $this->input->post('vendor-tin');
					$address = $this->input->post('vendor-address');
					$contactNum = $this->input->post('vendor-contact-num');
					$kind = $this->input->post('vendor-kind');
					$email = $this->input->post('vendor-email');
					
					// Insert
					$data = array(
						'VendorNo' => $purchaseFromNo,
						'Name' => $name,
						'TIN' => $tin,
						'Address' => $address,
						'ContactNum' => $contactNum,
						'ProductServiceKind' => $kind,
						'Email' => $email,
					);
					$insertNewVendor = $this->Model_Inserts->InsertNewVendor($data);
				}

				// INSERT PURCHASE ORDER
				$data = array(
					'OrderNo' => $orderNo,
					'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
					'DateCreation' => date('Y-m-d H:i:s'),
					'VendorNo' => $purchaseFromNo,
					'ShipVia' => $shipVia,
					'DateDelivery' => date('Y-m-d', strtotime($deliveryDate)),
					'Status' => '1',
				);
				$insertNewPurchaseOrder = $this->Model_Inserts->InsertPurchaseOrder($data);
				if ($insertNewPurchaseOrder == TRUE) {
					$orderID = $this->db->insert_id();
					// create new restock transactions
					if ($productCount > 0) {
						for ($i = 0; $i < $productCount; $i++) {
							$code = trim($this->input->post('productCodeInput_' . $i));
							$qty = trim($this->input->post('productQtyInput_' . $i));
							$cost = trim($this->input->post('productCostInput_' . $i));
							$price = trim($this->input->post('productPriceInput_' . $i));
							$expiration = trim($this->input->post('productExpirationInput_' . $i));
							$p_details = $this->Model_Selects->GetProductByCode($code)->row_array();

							$transactionID = '';
							$transactionID .= strtoupper($code);
							$transactionID .= '-';
							$transactionID .= strtoupper(uniqid());

							if ($qty > 0) {
								$data = array(
									'UID' => $p_details['U_ID'],
									'Product_SKU' => $p_details['Code'],
									'Stocks' => $qty,
									'Current_Stocks' => $qty,
									'Released_Stocks' => 0,
									'Retail_Price' => $price,
									'Price_PerItem' => $cost,
									'Total_Price' => $cost * $qty,
									// 'Manufactured_By' => $p_details['manufacturer'],
									// 'Description' => $p_details['description'],
									'Expiration_Date' => $expiration,
									'Date_Added' => date('Y-m-d H:i:s'),
									'UserID' => $userID,
									'Status' => '0',
								);
								$Insert_toStock_tb = $this->Model_Inserts->Insert_toStock_tb($data);
								$stockID = $this->db->insert_id();
								if ($Insert_toStock_tb == true) {
									$data = array(
										'Code' => $code,
										'TransactionID' => $transactionID,
										'OrderNo' => $orderNo,
										'stockID' => $stockID,
										'Type' => '0',
										'Amount' => $qty,
										'Date' => $date,
										'DateAdded' => date('Y-m-d H:i:s'),
										'Status' => 0,
										'UserID' => $userID,

										'PriceUnit' => $cost,
										'PriceTotal' => $cost * $qty,
									);
									$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
								}
							}
						}
					}
					// for ($i = 0; $i < $productCount; $i++) {
					// 	$code = trim($this->input->post('productCodeInput_' . $i));
					// 	$qty = trim($this->input->post('productQtyInput_' . $i));
					// 	$p_details = $this->Model_Selects->GetProductByCode($code)->row_array();

					// 	$data = array(
					// 		'Code' => $code,
					// 		'TransactionID' => strtoupper($code) . '' . strtoupper(uniqid()),
					// 		'OrderNo' => $orderNo,
					// 		'Type' => '0',
					// 		'Amount' => $qty,
					// 		'PriceUnit' => $p_details['Cost_PerItem'],
					// 		'Date' => $date,
					// 		'DateAdded' => date('Y-m-d H:i:s'),
					// 		'Status' => 0,
					// 		'UserID' => $this->session->userdata('UserID'),
					// 		'PriceTotal' => $qty * $p_details['Cost_PerItem'],
					// 	);
					// 	$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
					// }
					$this->session->set_flashdata('highlight-id', $orderID);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added new Purchase Order.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// UPDATE REMAINING PAYMENT
					$this->totalRemainingPOPayment($orderNo);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new purchase order.', 'added purchase order ' . $orderNo . ' [PurchaseOrderID: ' . $orderID . '].', base_url('admin/view_purchase_order?orderNo='. $orderNo));
					redirect('admin/purchase_orders');
				}
				else
				{
					redirect('admin/purchase_orders');
				}
			}
			else
			{
				redirect('admin/purchase_orders');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_approvePurchaseOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_approve')) {
			$orderNo = $this->input->post('order_no');
			if ($this->session->userdata('Privilege') > 1) {
				$orderDetails = $this->Model_Selects->GetPurchaseOrderByNo($orderNo)->row_array();
				$approved = $this->input->post('approved');

				if ($approved == '1' && $orderDetails['Status'] == '1') { // if approved and pending
					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
					foreach ($orderTransactions as $key => $t) {
						if ($t['Status'] == 0) { // if not approved
							$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
							$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();
							// approve transaction
							$dataTransaction = array(
								'TransactionID' => $t['TransactionID'],
								'Status' => '1',
								'Date_Approval' => date('Y-m-d H:i:s'),
							);
							// RESTOCK
							$NewStock = $p['InStock'] + $t['Amount'];
							$NewRelease = $p['Released'];
							$dataProduct = array(
								'Code' => $t['Code'],
								'InStock' => $NewStock,
								'Released' => $NewRelease,
							);
							// STOCK HISTORY
							$dataStockHistory = array(
								'stockid' => $t['stockID'],
								'transactionid' => $t['TransactionID'],
								'uid' => $p['U_ID'],
								'prd_sku' => $p['Code'],
								'quantity' => $t['Amount'],
								'cost' => $t['Price_PerItem'],
								'total_cost' => $t['Price_PerItem'] * $t['Amount'],
								'price' => $t['PriceUnit'],
								'total_price' => $t['PriceUnit'] * $t['Amount'],
								'userid' => $t['UserID'],
								'date_added' => date('Y/m/d H:i:s'),
								'status' => 'restocked',
							);

							$this->Model_Updates->ApproveTransaction($dataTransaction);
							$this->Model_Updates->UpdateStock_product($dataProduct);
							$this->Model_Inserts->Insert_StockHistory($dataStockHistory);

							// update product_stocks entry
							$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();

							$data = array(
								'Status' => '1',
							);
							$UpdateProduct_stock = $this->Model_Updates->UpdateProduct_stock($t['stockID'],$data);
						}
					}
					// update order status
					$data = array(
						'DateApproved' => date('Y-m-d H:i:s'),
						'Status' => '2',
					);
					$this->Model_Updates->UpdatePurchaseOrderByOrderNo($orderNo, $data);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('approved purchase order.', 'approved purchase order ' . $orderDetails['OrderNo'] . ' [PurchaseOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_purchase_order?orderNo=' . $orderNo));
				} elseif ($approved == '0' && $orderDetails['Status'] == '1') { // if rejected and pending
					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
					foreach ($orderTransactions as $key => $t) {
						if ($t['Status'] == 1) { // if approved, revert stocks
							$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
							// RESTOCK
							$NewStock = $p['InStock'] - $t['Amount'];
							$NewRelease = $p['Released'];
							$dataProduct = array(
								'Code' => $t['Code'],
								'InStock' => $NewStock,
								'Released' => $NewRelease,
							);
							$this->Model_Updates->UpdateStock_product($dataProduct);
						}
						$dataTransaction = array(
							'TransactionID' => $t['TransactionID'],
						);
						$this->Model_Updates->RejectOrderTransaction($dataTransaction);

						$this->Model_Deletes->Delete_Stock($t['stockID']);
					}
					// update order status
					$data = array(
						'OrderNo' => $orderNo,
						'Status' => '0',
					);
					$this->Model_Updates->UpdatePurchaseOrderByOrderNo($orderNo, $data);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Rejected Purchase Order.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('rejected purchase order.', 'rejected purchase order ' . $orderDetails['OrderNo'] . ' [PurchaseOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_purchase_order?orderNo=' . $orderNo));
				}
			}
			redirect('admin/view_purchase_order?orderNo=' . $orderNo);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateRemarks()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_remarks')) {
			$purchaseOrderNo = $this->input->post('order-no');
			$remarks = $this->input->post('remarks');

			// Update
			$data = array(
				'Remarks' => $remarks,
			);
			$UpdatePurchaseOrder = $this->Model_Updates->UpdatePurchaseOrderByOrderNo($purchaseOrderNo, $data);
			if ($UpdatePurchaseOrder == TRUE) {

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Updated remarks.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('updated remarks.', 'updated remarks for purchase order [No: ' . $purchaseOrderNo . '].', base_url('admin/view_purchase_order?orderNo=' . $purchaseOrderNo));
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}

// ############################ [ BILLS ] ############################
	public function bills() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('bills_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Bills';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/bills', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addPOBill()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_bill_creation')) {
			$purchaseOrderNo = $this->input->post('purchase-order-no');
			$description = $this->input->post('description');
			$amount = $this->input->post('amount');
			$modeOfPayment = $this->input->post('mode-payment');
			$date = $this->input->post('date');
			$time = $this->input->post('time');

			// Insert
			$data = array(
				'BillNo' => 'B' . strtoupper(uniqid()),
				'OrderNo' => $purchaseOrderNo,
				'Description' => $description,
				'Amount' => $amount,
				'ModeOfPayment' => $modeOfPayment,
				'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
			);
			$insertBill = $this->Model_Inserts->InsertBill($data);
			if ($insertBill == TRUE) {
				$billID = $this->db->insert_id();

				$updatePORemainingPayment = $this->totalRemainingPOPayment($purchaseOrderNo);
				if ($updatePORemainingPayment) {
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Bill.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Purchase Order remaining payment not updated.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new bill.', 'generated a new bill [ID: ' . $billID . '] for purchase order [OrderNo: ' . $purchaseOrderNo . '].', base_url('admin/bills'));
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_addBill()
	{
		if ($this->Model_Security->CheckUserRestriction('bills_add')) {
			$description = $this->input->post('description');
			$amount = $this->input->post('amount');
			$modeOfPayment = $this->input->post('mode-payment');
			$date = $this->input->post('date');
			$time = $this->input->post('time');

			// Insert
			$data = array(
				'BillNo' => 'B' . strtoupper(uniqid()),
				'Description' => $description,
				'Amount' => $amount,
				'ModeOfPayment' => $modeOfPayment,
				'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
			);
			$insertBill = $this->Model_Inserts->InsertBill($data);
			if ($insertBill == TRUE) {
				$billID = $this->db->insert_id();

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Added new Bill.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new bill.', 'generated a new bill [ID: ' . $billID . '].', base_url('admin/bills'));
				redirect('admin/bills');
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/bills');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeBill()
	{
		if ($this->Model_Security->CheckUserRestriction('bills_delete')) {
			$billNo = $this->input->get('bno');
			if ($billNo != NULL) {
				$bill = $this->Model_Selects->GetBillByBillNo($billNo);

				$removeBill = $this->Model_Updates->remove_bill($billNo);
				if ($removeBill) {
					if ($bill->num_rows() > 0) {
						$billDetails = $bill->row_array();

						$updatePORemainingPayment = $this->totalRemainingPOPayment($billDetails['OrderNo']);
						if (!$updatePORemainingPayment) {
							$prompt_txt =
							'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Danger!</strong> Purchase Order remaining payment not updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
						}
					}

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Bill.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('deleted bill.', 'deleted bill [No: ' . $billNo . '].', base_url('admin/bills'));
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ MANUAL PURCHASES ] ############################
	public function manual_purchases() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('manual_purchases_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Manual Purchases';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders/manual_transactions', $data);
		} else {
			redirect(base_url());
		}
	}
	
	public function FORM_addNewManualTransaction()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_add_manual_transaction')) {
			$purchaseOrderNo = $this->input->post('purchase-order-no');
			$itemNo = $this->input->post('item-no');
			$description = $this->input->post('description');
			$qty = $this->input->post('qty');
			$unitCost = $this->input->post('unit-cost');

			// Insert
			$data = array(
				'ManualTransactionNo' => 'MT' . strtoupper(uniqid()),
				'OrderNo' => $purchaseOrderNo,
				'ItemNo' => $itemNo,
				'Description' => $description,
				'Qty' => $qty,
				'UnitCost' => $unitCost,
				'Date' => date('Y-m-d H:i:s'),
			);
			$insertManualTransaction = $this->Model_Inserts->InsertManualTransaction($data);
			if ($insertManualTransaction == TRUE) {
				$mTransactionID = $this->db->insert_id();

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Added new Manual Transaction.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// UPDATE REMAINING PAYMENT
				$this->totalRemainingPOPayment($purchaseOrderNo);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('added a new manual purchase transaction.', 'added a new manual purchase transaction [ID: ' . $mTransactionID . '] for purchase order [OrderNo: ' . $purchaseOrderNo . '].', base_url('admin/manual_transactions'));
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_purchase_order?orderNo=' . $purchaseOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeManualTransaction()
	{
		if ($this->Model_Security->CheckUserRestriction('purchase_orders_remove_manual_transaction')) {
			$manualTransactionNo = $this->input->get('mtno');
			if ($manualTransactionNo != NULL) {


				$manualTransaction = $this->Model_Selects->GetManualTransactionByManualTransactionNo($manualTransactionNo);

				$removeManualTransaction = $this->Model_Deletes->Delete_ManualTransaction($manualTransactionNo);
				if ($removeManualTransaction) {
					if ($manualTransaction->num_rows() > 0) {
						$manualTransactionDetails = $manualTransaction->row_array();

						$updatePORemainingPayment = $this->totalRemainingPOPayment($manualTransactionDetails['OrderNo']);
						if (!$updatePORemainingPayment) {
							$prompt_txt =
							'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Danger!</strong> Purchase Order remaining payment not updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
						}
					}

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Manual Transaction.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('removed manual transaction.', 'removed manual transaction' . ' [manualTransactionNo: ' . $manualTransactionNo . '].', $_SERVER['HTTP_REFERER']);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}


// ############################ [ PRIVATE FUNCTIONS ] ############################
	private function totalRemainingPOPayment($purchaseOrderNo) {
		$getPurchaseOrderByOrderNo = $this->Model_Selects->GetPurchaseOrderByNo($purchaseOrderNo);
		$purchaseOrder = $getPurchaseOrderByOrderNo->row_array();
		$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($purchaseOrderNo);
		$getManualTransactionsByPONo = $this->Model_Selects->GetManualTransactionsByPONo($purchaseOrderNo);

		$transactionsCostTotal = 0;
		$transactionsManualCostTotal = 0;

		if ($getTransactionsByOrderNo->num_rows() > 0) {
			foreach ($getTransactionsByOrderNo->result_array() as $tRow) {
				$stock = $this->Model_Selects->Check_prd_stockid($tRow['stockID']);
				if ($stock->num_rows() > 0) {
					$stockRetailPrice = $stock->row_array()['Retail_Price'];
				}

				$totalCost = $tRow['Amount'] * $tRow['PriceUnit'];
				$transactionsCostTotal += $totalCost;
			}
		}
		if ($getManualTransactionsByPONo->num_rows() > 0) {
			foreach ($getManualTransactionsByPONo->result_array() as $row) {
				$totalCost = $row['Qty'] * $row['UnitCost'];
				$transactionsManualCostTotal += $totalCost;
			}
		}

		$totalPrice = $transactionsCostTotal + $transactionsManualCostTotal;

		$total_bill_amount = $this->Model_Selects->GetTotalBillsByPONo($purchaseOrderNo);
		if ($total_bill_amount->num_rows()) {
			$amount = $total_bill_amount->row_array()['Amount'];
		} else {
			$amount = 0;
		}

		$totalRemainingPayment = $totalPrice - $amount;
		// Update SO Total
		$data = array(
			'TotalRemainingPayment' => $totalRemainingPayment,
		);
		return $this->Model_Updates->UpdatePurchaseOrderByOrderNo($purchaseOrderNo, $data);
	}
}
