<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesOrders extends MY_Controller {

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
		$this->load->model('Model_Email');
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


// ############################ [ CLIENTS ] ############################
	public function clients() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('clients_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Clients';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/clients', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addNewClient()
	{
		if ($this->Model_Security->CheckUserRestriction('clients_add')) {
			// Fetch data
			$clientNo = 'C' . strtoupper(uniqid());
			$name = $this->input->post('add-name');
			$tin = $this->input->post('add-tin');
			$address = $this->input->post('add-address');
			$cityStateProvinceZip = $this->input->post('add-city-state-province-zip');
			$country = $this->input->post('add-country');
			$contactNum = $this->input->post('add-contact-num');
			$category = $this->input->post('add-category');
			$territoryManager = $this->input->post('add-territory-manager');
			$email = $this->input->post('add-email');

			// Insert
			$data = array(
				'ClientNo' => $clientNo,
				'Name' => $name,
				'TIN' => $tin,
				'Address' => $address,
				'CityStateProvinceZip' => $cityStateProvinceZip,
				'Country' => $country,
				'ContactNum' => $contactNum,
				'Category' => $category,
				'TerritoryManager' => $territoryManager,
				'Email' => $email,
			);
			$insertNewClient = $this->Model_Inserts->InsertNewClient($data);
			if ($insertNewClient == TRUE) {
				$clientID = $this->db->insert_id();
				$this->session->set_flashdata('highlight-id', $clientID);
				// $this->Model_Logbook->SetPrompts('success', 'success', 'New employee added.');
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new client.', 'added a new client' . ($name ? ' ' . $name : '') . ' [ID: ' . $clientID . '].', base_url('admin/clients'));
				redirect('admin/clients');
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/clients');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateClient()
	{
		if ($this->Model_Security->CheckUserRestriction('clients_edit')) {
			// Fetch data
			$clientID = $this->input->post('upd-client-id');
			$name = $this->input->post('upd-name');
			$tin = $this->input->post('upd-tin');
			$address = $this->input->post('upd-address');
			$cityStateProvinceZip = $this->input->post('upd-city-state-province-zip');
			$country = $this->input->post('upd-country');
			$contactNum = $this->input->post('upd-contact-num');
			$category = $this->input->post('upd-category');
			$territoryManager = $this->input->post('upd-territory-manager');
			$email = $this->input->post('upd-email');

			// Update
			$data = array(
				'Name' => $name,
				'TIN' => $tin,
				'Address' => $address,
				'CityStateProvinceZip' => $cityStateProvinceZip,
				'Country' => $country,
				'ContactNum' => $contactNum,
				'Category' => $category,
				'TerritoryManager' => $territoryManager,
				'Email' => $email,
			);
			$updateClient = $this->Model_Updates->UpdateClient($data, $clientID);
			if ($updateClient == TRUE) {
				$this->Model_Logbook->LogbookEntry('updated client details.', 'updated details of client' . ($name ? ' ' . $name : '') . ' [clientID: ' . $clientID . '].', base_url('admin/clients'));
				$this->session->set_flashdata('highlight-id', $clientID);
				redirect('admin/clients');
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/clients');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_deleteClient()
	{
		if ($this->Model_Security->CheckUserRestriction('clients_delete')) {
			$clientNo = $this->input->post('client-no');

			$getClientByNo = $this->Model_Selects->GetClientByNo($clientNo);

			if ($getClientByNo->num_rows() > 0) {
				if ($this->Model_Deletes->Delete_client($getClientByNo->row_array()['ID'])) {
					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('deleted client record.', 'deleted a client record [ID: ' . $clientID . '].', base_url('admin/clients'));
					redirect('admin/clients');
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
					$prompt_txt =
					'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/clients');
				}
			}
		} else {
			redirect(base_url());
		}
	}

// ############################ [ SALES ORDERS ] ############################
	public function sales_orders() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/sales_orders', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_sales_order() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/view_sales_order', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_sales_orders_summary() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders Summary';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/sales_orders_summary', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addSalesOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_add')) {
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$orderNo = 'SO' . strtoupper(uniqid());
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				$billToNo = $this->input->post('billToNo');
				$shipToNo = $this->input->post('shipToNo');
				$productCount = $this->input->post('productCount');

				// BILLING CLIENT
				$billName = $this->input->post('bill-name');
				$billTin = $this->input->post('bill-tin');
				$billAddress = $this->input->post('bill-address');
				$billCityStateProvinceZip = $this->input->post('bill-city-state-province-zip');
				$billCountry = $this->input->post('bill-country');
				$billContactNum = $this->input->post('bill-contact-num');
				$billCategory = $this->input->post('bill-category');
				$billTerritoryManager = $this->input->post('bill-territory-manager');
				$billEmail = $this->input->post('bill-email');

				if ($billToNo == 'newBillClient') {
					$billToNo = 'C' . strtoupper(uniqid());

					// Insert
					$data = array(
						'ClientNo' => $billToNo,
						'Name' => $billName,
						'TIN' => $billTin,
						'Address' => $billAddress,
						'CityStateProvinceZip' => $billCityStateProvinceZip,
						'Country' => $billCountry,
						'ContactNum' => $billContactNum,
						'Category' => $billCategory,
						'TerritoryManager' => $billTerritoryManager,
						'Email' => $billEmail,
					);
					$insertNewClient = $this->Model_Inserts->InsertNewClient($data);
				} else {
					// Update
					$data = array(
						'Name' => $billName,
						'TIN' => $billTin,
						'Address' => $billAddress,
						'CityStateProvinceZip' => $billCityStateProvinceZip,
						'Country' => $billCountry,
						'ContactNum' => $billContactNum,
						'Category' => $billCategory,
						'TerritoryManager' => $billTerritoryManager,
						'Email' => $billEmail,
					);
					$updateClient = $this->Model_Updates->UpdateClientByNo($data, $billToNo);
				}

				if ($shipToNo != $billToNo) {
					// SHIPPING CLIENT
					$shipName = $this->input->post('ship-name');
					$shipTin = $this->input->post('ship-tin');
					$shipAddress = $this->input->post('ship-address');
					$shipCityStateProvinceZip = $this->input->post('ship-city-state-province-zip');
					$shipCountry = $this->input->post('ship-country');
					$shipContactNum = $this->input->post('ship-contact-num');
					$shipCategory = $this->input->post('ship-category');
					$shipTerritoryManager = $this->input->post('ship-territory-manager');
					$shipEmail = $this->input->post('ship-email');

					if ($shipToNo == 'newShipClient' && $shipToNo != 'shipToBillingClient') {
						$shipToNo = 'C' . strtoupper(uniqid());

						// Insert
						$data = array(
							'ClientNo' => $shipToNo,
							'Name' => $shipName,
							'TIN' => $shipTin,
							'Address' => $shipAddress,
							'CityStateProvinceZip' => $shipCityStateProvinceZip,
							'Country' => $shipCountry,
							'ContactNum' => $shipContactNum,
							'Category' => $shipCategory,
							'TerritoryManager' => $shipTerritoryManager,
							'Email' => $shipEmail,
						);
						$insertNewClient = $this->Model_Inserts->InsertNewClient($data);
					} elseif ($shipToNo != 'shipToBillingClient') {
						// Update
						$data = array(
							'Name' => $shipName,
							'TIN' => $shipTin,
							'Address' => $shipAddress,
							'CityStateProvinceZip' => $shipCityStateProvinceZip,
							'Country' => $shipCountry,
							'ContactNum' => $shipContactNum,
							'Category' => $shipCategory,
							'TerritoryManager' => $shipTerritoryManager,
							'Email' => $shipEmail,
						);
						$updateClient = $this->Model_Updates->UpdateClientByNo($data, $shipToNo);
					}
				} else { // set ship client no to bill no
					$shipToNo = $billToNo;
				}

				// check account category
				$shipClientDetails = $this->Model_Selects->GetClientByNo($shipToNo)->row_array();
				$discounts = array();
				switch ($shipClientDetails['Category']) { // get account discounts
					case '0':
					$discounts = array(
						'Outright' => 15,
						'Volume' => 10,
						'PBD' => 5,
						'Manpower' => 5,
					); break;
					case '1':
					$discounts = array(
						'Outright' => 12,
						'Volume' => 10,
						'PBD' => 5,
						'Manpower' => 5,
					); break;
					case '2':
					$discounts = array(
						'Outright' => 10,
						'Volume' => 10,
						'PBD' => 5,
						'Manpower' => 0,
					); break;
					case '3':
					$discounts = array(
						'Outright' => 10,
						'Volume' => 10,
						'PBD' => 5,
						'Manpower' => 0,
					); break;
				}
				$dcOutright = 0;
				$dcVolume = 0;
				$dcPBD = 0;
				$dcManpower = 0;

				// $totalDiscount = 0; // compute total discount
				if ($this->input->post('discount-outright') == 'on') {
					$dcOutright = $discounts['Outright'];
				}
				if ($this->input->post('discount-volume') == 'on') {
					$dcVolume = $discounts['Volume'];
				}
				if ($this->input->post('discount-pbd') == 'on') {
					$dcPBD = $discounts['PBD'];
				}
				if ($this->input->post('discount-manpower') == 'on') {
					$dcManpower = $discounts['Manpower'];
				}

				// INSERT SALES ORDER
				$data = array(
					'OrderNo' => $orderNo,
					'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
					'DateCreation' => date('Y-m-d H:i:s'),
					'BillToClientNo' => $billToNo,
					'ShipToClientNo' => $shipToNo,
					'discountOutright' => $dcOutright,
					'discountVolume' => $dcVolume,
					'discountPBD' => $dcPBD,
					'discountManpower' => $dcManpower,
					'Status' => '1',
				);
				$insertNewSalesOrder = $this->Model_Inserts->InsertSalesOrder($data);
				if ($insertNewSalesOrder == TRUE) {
					$orderID = $this->db->insert_id();
					// create new release transactions
					for ($i = 0; $i < $productCount; $i++) {
						$freebie = (($this->input->post('productFreebieInput_' . $i) == 'on') ? '1' : '0');
						$discount = trim($this->input->post('productDiscountInput_' . $i));
						
						$code = trim($this->input->post('productSKUInput_' . $i));
						$stockID = trim($this->input->post('productStockIDInput_' . $i));
						$qty = trim($this->input->post('productQtyInput_' . $i));
						$p_details = $this->Model_Selects->GetProductByCode($code)->row_array();
						$s_details = $this->Model_Selects->Check_prd_stockid($stockID)->row_array();

						$transactionID = '';
						$transactionID .= strtoupper($code);
						$transactionID .= '-';
						$transactionID .= strtoupper(uniqid());

						$data = array(
							'Code' => $code,
							'TransactionID' => $transactionID,
							'OrderNo' => $orderNo,
							'stockID' => $stockID,
							'Type' => '1',
							'Amount' => $qty,
							'Date' => date('Y/m/d H:i:s'),
							'DateAdded' => date('Y-m-d H:i:s'),
							'Status' => 0,
							'UserID' => $userID,

							'PriceUnit' => $s_details['Retail_Price'],
							'PriceTotal' => $s_details['Retail_Price'] * $qty,
							'Freebie' => $freebie,
							'UnitDiscount' => (($discount > 0) ? $discount : 0),
						);
						$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
						if ($insertNewTransaction == true) {
							/* INSERT RELEASE DATA TO TABLE PRODUCT RELEASED */
							$data = array(
								'stockid' => $stockID,
								'transactionid' => $transactionID,
								'uid' => $p_details['U_ID'],
								'prd_sku' => $p_details['Code'],
								'quantity' => $qty,
								'retail_price' => $s_details['Retail_Price'],
								'total_price' => $s_details['Retail_Price'] * $qty,
								'userid' => $userID,
								'date_added' => date('Y/m/d H:i:s'),
								'status' => 'released',
								'Freebie' => $freebie,
								'UnitDiscount' => (($discount > 0) ? $discount : 0),
							);
							$Insert_Releasedata = $this->Model_Inserts->Insert_Releasedata($data);
						}
					}
					$this->session->set_flashdata('highlight-id', $orderID);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new sales order.', 'added sales order ' . $orderNo . ' [SalesOrderID: ' . $orderID . '].', base_url('admin/view_sales_order?orderNo='. $orderNo));
					redirect('admin/sales_orders');
				}
				else
				{
					redirect('admin/sales_orders');
				}
			}
			else
			{
				redirect('admin/sales_orders');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_approveSalesOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_mark_for_invoicing')) {
			$orderNo = $this->input->post('order_no');
			if ($this->session->userdata('Privilege') > 1) {
				$orderDetails = $this->Model_Selects->GetSalesOrderByNo($orderNo)->row_array();
				$approved = $this->input->post('approved');

				if ($approved == '1' && $orderDetails['Status'] == '1') { // if approved and pending
					$transactions = array();

					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
					foreach ($orderTransactions as $key => $t) {
						if ($t['Status'] == 0) { // if not approved
							// check if stock is enough
							$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
							// IF NOT ENOUGH STOCK FOR APPROVAL, REDIRECT
							if ($t['Amount'] <= $p['InStock']) {
								// TRANSACTION
								$dataTransaction = array(
									'TransactionID' => $t['TransactionID'],
									'Status' => '1',
									'Date_Approval' => date('Y-m-d H:i:s'),
								);
								// RELEASE
								$NewStock = $p['InStock'] - $t['Amount'];
								$NewRelease = $p['Released'] + $t['Amount'];
								$dataProduct = array(
									'Code' => $t['Code'],
									'InStock' => $NewStock,
									'Released' => $NewRelease,
								);
								// STOCKS
								$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();
								$n_cstocks = $s['Current_Stocks'] - $t['Amount'];
								$n_rstocks = $s['Released_Stocks'] + $t['Amount'];
								$dataStocks = array(
									'Current_Stocks' => $n_cstocks,
									'Released_Stocks' => $n_rstocks,
								);
								
								$transactions[] = array(
									'dataTransaction' => $dataTransaction,
									'dataProduct' => $dataProduct,
									'dataStocks' => $dataStocks,
									'stockID' => $t['stockID'],
								);
							} else {
								$prompt_txt =
								'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
								<strong>Warning!</strong> Approval aborted, not enough stock for ' . $t['TransactionID'] . '!
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
								$this->session->set_flashdata('prompt_status',$prompt_txt);
							}
						}
					}

					if (!isset($prompt_txt) || $prompt_txt == NULL) {
						foreach ($transactions as $row) { // update transactions/products with enough stock
							$this->Model_Updates->ApproveTransaction($row['dataTransaction']);
							$this->Model_Updates->UpdateStock_product($row['dataProduct']);
							$this->Model_Updates->UpdateProduct_stock($row['stockID'], $row['dataStocks']);
						}
						// update order status
						$data = array(
							'Status' => '2',
							'MarkDateInvoicing' => date('Y-m-d H:i:s'),
						);
						$this->Model_Updates->UpdateSalesOrderByOrderNo($orderNo, $data);

						// LOGBOOK
						$this->Model_Logbook->LogbookEntry('approved sales order.', 'approved sales order ' . $orderDetails['OrderNo'] . ' [SalesOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));

						// EMAIL CLIENT
						$client = $this->Model_Selects->GetClientByNo($orderDetails['BillToClientNo']);
						if ($client->num_rows() > 0) {
							$this->Model_Email->sendEmail(
								$client->row_array()['Email'],
								'Your Order Has Been Approved',
								'Your sales order [Order No ' . $orderDetails['OrderNo'] . '] has been approved and marked for invoicing.'
							);
						}
					}
				} elseif ($approved == '0' && $orderDetails['Status'] == '1') { // if rejected and pending
					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
					foreach ($orderTransactions as $key => $t) {
						if ($t['Status'] == 1) { // if approved, revert stocks
							$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
							// RESTOCK
							$NewStock = $p['InStock'] + $t['Amount'];
							$NewRelease = $p['Released'] - $t['Amount'];
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
						$this->Model_Deletes->Delete_Release($t['TransactionID']);
					}
					// update order status
					$data = array(
						'Status' => '0',
					);
					$this->Model_Updates->UpdateSalesOrderByOrderNo($orderNo, $data);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('rejected sales order.', 'rejected sales order ' . $orderDetails['OrderNo'] . ' [SalesOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
				}
			}
			redirect('admin/view_sales_order?orderNo=' . $orderNo);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_scheduleDelivery()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_schedule_delivery')) {
			$salesOrderNo = $this->input->post('order-no');
			$date = $this->input->post('date');

			// Update
			$data = array(
				'DateDelivery' => $date,
				'Status' => '3',
				'MarkDateDelivery' => date('Y-m-d H:i:s'),
			);
			$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
			if ($UpdateSalesOrder == TRUE) {
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('scheduled delivery.', 'scheduled delivery for sales order [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);

				$order = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
				if ($order->num_rows() > 0) {
					$orderDetails = $order->row_array();
					// EMAIL CLIENT
					$client = $this->Model_Selects->GetClientByNo($orderDetails['BillToClientNo']);
					if ($client->num_rows() > 0) {
						$this->Model_Email->sendEmail(
							$client->row_array()['Email'],
							'Your Order Has Been Scheduled For Delivery',
							'Your sales order [Order No ' . $orderDetails['OrderNo'] . '] has been scheduled for delivery on ' . $date . '.'
						);
					}
				}
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_markDelivered()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_mark_as_delivered')) {
			$salesOrderNo = $this->input->post('order-no');

			// Update
			$data = array(
				'Status' => '4',
				'MarkDateDelivered' => date('Y-m-d H:i:s'),
			);
			$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
			if ($UpdateSalesOrder == TRUE) {
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('marked SO as delivered.', 'sales order marked as delivered [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);

				$order = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
				if ($order->num_rows() > 0) {
					$orderDetails = $order->row_array();
					// EMAIL CLIENT
					$client = $this->Model_Selects->GetClientByNo($orderDetails['BillToClientNo']);
					if ($client->num_rows() > 0) {
						$this->Model_Email->sendEmail(
							$client->row_array()['Email'],
							'Your Order Has Been Delivered',
							'Your sales order [Order No ' . $orderDetails['OrderNo'] . '] has been successfully delivered.'
						);
					}
				}
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_markReceived()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_mark_as_received')) {
			$salesOrderNo = $this->input->post('order-no');

			// Update
			$data = array(
				'Status' => '5',
				'MarkDateReceived' => date('Y-m-d H:i:s'),
			);
			$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
			if ($UpdateSalesOrder == TRUE) {
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('marked SO as received.', 'sales order marked as received [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);

				$order = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
				if ($order->num_rows() > 0) {
					$orderDetails = $order->row_array();
					// EMAIL CLIENT
					$client = $this->Model_Selects->GetClientByNo($orderDetails['BillToClientNo']);
					if ($client->num_rows() > 0) {
						$this->Model_Email->sendEmail(
							$client->row_array()['Email'],
							'Your Order Has Been Fulfilled',
							'Your sales order [Order No ' . $orderDetails['OrderNo'] . '] has been fulfilled.'
						);
					}
				}
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateRemarks()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_remarks')) {
			$salesOrderNo = $this->input->post('order-no');
			$remarks = $this->input->post('remarks');

			// Update
			$data = array(
				'Remarks' => $remarks,
			);
			$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
			if ($UpdateSalesOrder == TRUE) {
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('updated remarks.', 'updated remarks for sales order [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}

// ############################ [ ADDITIONAL FEE ] ############################
	public function FORM_addNewSOAdtlFee()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_adtl_fees')) {

			$adtlFeeNo = 'AF' . strtoupper(uniqid());
			$salesOrderNo = $this->input->post('sales-order-no');
			$description = $this->input->post('description');
			$qty = $this->input->post('qty');
			$unitPrice = $this->input->post('unit-price');

			$orderDetails = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo)->row_array();
			if ($orderDetails['Status'] > 2) {
				// Insert
				$data = array(
					'AdtlFeeNo' => $adtlFeeNo,
					'Description' => $description,
					'Qty' => $qty,
					'UnitPrice' => $unitPrice,
					'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
				);
				$insertAdtlFee = $this->Model_Inserts->InsertAdtlFee($data);
				if ($insertAdtlFee == TRUE) {
					$adtlFeeID = $this->db->insert_id();

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('added a new additional fee.', 'adde a new additional fee [ID: ' . $adtlFeeID . '] for sales order [OrderNo: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
					redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
				}
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeAdtlFee()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_adtl_fees')) {
			$adtlFeeNo = $this->input->get('afno');
			if ($adtlFeeNo != NULL) {
				$result = $this->Model_Updates->remove_adtlfee($adtlFeeNo);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ INVOICES ] ############################
	public function invoices() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('invoice_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Invoices';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/invoices', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addSOInvoice()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_invoice_creation')) {
			$salesOrderNo = $this->input->post('sales-order-no');
			$description = $this->input->post('description');
			$amount = $this->input->post('amount');
			$modeOfPayment = $this->input->post('mode-payment');
			$date = $this->input->post('date');
			$time = $this->input->post('time');

			// Insert
			$data = array(
				'InvoiceNo' => 'I' . strtoupper(uniqid()),
				'OrderNo' => $salesOrderNo,
				'Description' => $description,
				'Amount' => $amount,
				'ModeOfPayment' => $modeOfPayment,
				'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
			);
			$insertInvoice = $this->Model_Inserts->InsertInvoice($data);
			if ($insertInvoice == TRUE) {
				$invoiceID = $this->db->insert_id();

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new invoice.', 'generated a new invoice [ID: ' . $invoiceID . '] for sales order [OrderNo: ' . $salesOrderNo . '].', base_url('admin/invoices'));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_addInvoice()
	{
		if ($this->Model_Security->CheckUserRestriction('invoice_add')) {
			$description = $this->input->post('description');
			$amount = $this->input->post('amount');
			$modeOfPayment = $this->input->post('mode-payment');
			$date = $this->input->post('date');
			$time = $this->input->post('time');

			// Insert
			$data = array(
				'InvoiceNo' => 'I' . strtoupper(uniqid()),
				'Description' => $description,
				'Amount' => $amount,
				'ModeOfPayment' => $modeOfPayment,
				'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
			);
			$insertInvoice = $this->Model_Inserts->InsertInvoice($data);
			if ($insertInvoice == TRUE) {
				$invoiceID = $this->db->insert_id();

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new invoice.', 'generated a new invoice [ID: ' . $invoiceID . '].', base_url('admin/invoices'));
				redirect('admin/invoices');
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/invoices');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeInvoice()
	{
		if ($this->Model_Security->CheckUserRestriction('invoice_delete')) {
			$invoiceNo = $this->input->get('ino');
			if ($this->session->userdata('Privilege') > 1 && $invoiceNo != NULL) {
				$result = $this->Model_Updates->remove_invoice($invoiceNo);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ RETURNS ] ############################
	public function returns() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('returns_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Returns';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/returns', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_return() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('return_product_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Returns';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/view_return', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addNewReturn()
	{
		if ($this->Model_Security->CheckUserRestriction('returns_add')) {	
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$returnNo = 'RT' . strtoupper(uniqid());
				$salesOrderNo = $this->input->post('salesOrderNo');

				$productCount = $this->input->post('sopCount');

				$soDetails = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo)->row_array();

				// INSERT RETURN
				$data = array(
					'ReturnNo' => $returnNo,
					'DateCreation' => date('Y-m-d H:i:s'),
					'SalesOrderNo' => $salesOrderNo,
					'ClientNo' => $soDetails['BillToClientNo'],
					'Status' => '1',
				);
				$insertNewReturn = $this->Model_Inserts->InsertReturn($data);
				if ($insertNewReturn == TRUE) {
					// // create new return items
					// for ($i = 0; $i < $productCount; $i++) {
					// 	$transactionID = trim($this->input->post('productTIDInput_' . $i));
					// 	$qty = trim($this->input->post('productQtyInput_' . $i));
					// 	$remarks = trim($this->input->post('productRemarksInput_' . $i));

					// 	$t_details = $this->Model_Selects->GetTransactionsByTID($transactionID)->row_array();

					// 	$data = array(
					// 		'returnno' => $returnNo,
					// 		'stockid' => $t_details['stockID'],
					// 		'transactionid' => $t_details['TransactionID'],
					// 		'prd_sku' => $t_details['Code'],
					// 		'quantity' => $qty,
					// 		'quantity_total' => $t_details['Amount'],
					// 		'remarks' => $remarks,
					// 		'userid' => $userID,
					// 		'date_added' => date('Y-m-d H:i:s'),
					// 		'status' => 'returned',
					// 		'Freebie' => $t_details['Freebie'],
					// 	);
					// 	$InsertReturnData = $this->Model_Inserts->InsertReturnData($data);
					// }
					$this->session->set_flashdata('highlight-id', $returnNo);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new sales order.', 'added return ' . $returnNo . ' [ReturnNo: ' . $returnNo . '].', base_url('admin/returns'));
					redirect('admin/returns');
				}
				else
				{
					redirect('admin/returns');
				}
			}
			else
			{
				redirect('admin/returns');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_addNewReturnProduct()
	{
		if ($this->Model_Security->CheckUserRestriction('return_product_add')) {
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$returnNo = $this->input->post('returnNo');
				$transactionID = $this->input->post('transactionID');
				$remarks = $this->input->post('remarks');
				$qty = $this->input->post('qty');

				if ($qty == NULL || $qty < 1) {
					$prompt_txt =
					'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Invalid Qty.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$t_details = $this->Model_Selects->GetTransactionsByTID($transactionID)->row_array();
					$data = array(
						'returnno' => $returnNo,
						'stockid' => $t_details['stockID'],
						'transactionid' => $t_details['TransactionID'],
						'prd_sku' => $t_details['Code'],
						'remarks' => $remarks,
						'quantity' => $qty,
						'userid' => $userID,
						'date_added' => date('Y-m-d H:i:s'),
						'Freebie' => $t_details['Freebie'],
					);
					$InsertReturnData = $this->Model_Inserts->InsertReturnData($data);

					if ($InsertReturnData && $remarks == 'RETURNED') {
						$p = $this->Model_Selects->CheckStocksByCode($t_details['Code']);
						$t = $this->Model_Selects->GetTransactionsByTID($t_details['TransactionID'])->row_array();
						$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();

						$dataProduct = array(
							'Code' => $t['Code'],
							'InStock' => $p['InStock'] + $qty,
							'Released' => $p['Released'] - $qty,
						);
						$dataStocks = array(
							'Current_Stocks' => $s['Current_Stocks'] + $qty,
							'Released_Stocks' =>  $s['Released_Stocks'] - $qty,
						);

						$this->Model_Updates->UpdateStock_product($dataProduct);
						$this->Model_Updates->UpdateProduct_stock($t_details['stockID'], $dataStocks);
					}
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('added product to returns.', 'added transaction ' . $transactionID . ' to return [ReturnNo: ' . $returnNo . '].', base_url('admin/returns'));
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect('admin/returns');
			}
		} else {
			redirect(base_url());
		}
	}
	// public function FORM_updateReturnProduct()
	// {
	// 	if ($this->Model_Security->CheckUserRestriction('return_product_edit')) {
	// 		if (isset($_SESSION['UserID'])) {
	// 			$userID = $_SESSION['UserID'];

	// 			$returnNo = $this->input->post('returnNo');
	// 			$transactionID = $this->input->post('transactionID');
	// 			$remarks = $this->input->post('remarks');

	// 			$data = array(
	// 				'remarks' => $remarks,
	// 				'transactionID' => $transactionID,
	// 			);
	// 			$UpdateReturnProduct = $this->Model_Updates->UpdateReturnProduct($data);

	// 			// LOGBOOK
	// 			$this->Model_Logbook->LogbookEntry('updated return product.', 'udpated return product ' . $transactionID . ' to return [ReturnNo: ' . $returnNo . '].', base_url('admin/returns'));
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 		else
	// 		{
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 	} else {
	// 		redirect(base_url());
	// 	}
	// }
	// public function FORM_updateReturnProductToInventory()
	// {
	// 	if ($this->Model_Security->CheckUserRestriction('return_product_return_to_inventory')) {
	// 		if (isset($_SESSION['UserID'])) {
	// 			$userID = $_SESSION['UserID'];

	// 			$returnNo = $this->input->post('returnNo');
	// 			$transactionID = $this->input->post('transactionID');
	// 			$qtyReturned = $this->input->post('qty');

	// 			if ($qtyReturned == NULL || $qtyReturned < 1) {
	// 				$qtyReturned = 0;
	// 			}
	// 			$returnProduct = $this->Model_Selects->GetReturnProductByTID($transactionID);
	// 			if ($returnProduct->num_rows() < 1) {
	// 				$prompt_txt =
	// 				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
	// 				<strong>Warning!</strong> Something went wrong, please try again.
	// 				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	// 				</div>';
	// 				$this->session->set_flashdata('prompt_status',$prompt_txt);
	// 				redirect($_SERVER['HTTP_REFERER']);
	// 			} elseif ($qtyReturned == NULL || $qtyReturned < 1) {
	// 				$prompt_txt =
	// 				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
	// 				<strong>Warning!</strong> Invalid Qty.
	// 				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	// 				</div>';
	// 				$this->session->set_flashdata('prompt_status',$prompt_txt);
	// 				redirect($_SERVER['HTTP_REFERER']);
	// 			} else {
	// 				$returnProductDetails = $returnProduct->row_array();
	// 				$data = array(
	// 					'newQty' => $returnProductDetails['quantity'] - $qtyReturned,
	// 					'newTotal' => $returnProductDetails['quantity_total'] - $qtyReturned,
	// 					'returned' => $returnProductDetails['returned'] + $qtyReturned,
	// 					'transactionID' => $transactionID,
	// 				);
	// 				$ReturnProductInventory = $this->Model_Updates->ReturnProductInventory($data);
	// 				if ($ReturnProductInventory) {
	// 					$p = $this->Model_Selects->CheckStocksByCode($returnProductDetails['prd_sku']);
	// 					$t = $this->Model_Selects->GetTransactionsByTID($transactionID)->row_array();
	// 					$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();

	// 					$dataProduct = array(
	// 						'Code' => $t['Code'],
	// 						'InStock' => $p['InStock'] + $qtyReturned,
	// 						'Released' => $p['Released'] - $qtyReturned,
	// 					);
	// 					$dataStocks = array(
	// 						'Current_Stocks' => $s['Current_Stocks'] + $qtyReturned,
	// 						'Released_Stocks' =>  $s['Released_Stocks'] - $qtyReturned,
	// 					);

	// 					$this->Model_Updates->UpdateStock_product($dataProduct);
	// 					// $this->Model_Updates->UpdateStocksCount($p['Code'], $p['InStock'] + $qtyReturned);
	// 					$this->Model_Updates->UpdateProduct_stock($returnProductDetails['stockid'], $dataStocks);
	// 				}
	// 			}

	// 			// LOGBOOK
	// 			$this->Model_Logbook->LogbookEntry('updated return product.', 'udpated return product ' . $transactionID . ' to return [ReturnNo: ' . $returnNo . '].', base_url('admin/returns'));
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 		else
	// 		{
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 	} else {
	// 		redirect(base_url());
	// 	}
	// }

	public function FORM_removeReturnProduct()
	{
		if ($this->Model_Security->CheckUserRestriction('return_product_delete')) {
			$returnProductID = $this->input->get('rid');
			if ($returnProductID != NULL) {
				$rProduct = $this->Model_Selects->GetReturnProductByID($returnProductID);
				if ($rProduct->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$rProductDetails = $rProduct->row_array();

					if ($rProductDetails['remarks'] == 'RETURNED') {
						$prompt_txt =
						'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Returned to inventory cannot be deleted.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
					} else {
						$result = $this->Model_Deletes->Delete_ReturnProduct($returnProductID);
					}
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ REPLACEMENTS ] ############################
	public function replacements() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('replacements_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Replacements';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders/replacements', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addNewReplacement()
	{
		if ($this->Model_Security->CheckUserRestriction('replacements_add')) {	
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$replacementNo = 'RT' . strtoupper(uniqid());
				$salesOrderNo = $this->input->post('salesOrderNo');

				$productCount = $this->input->post('sopCount');

				$soDetails = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo)->row_array();

				// INSERT SALES ORDER
				$data = array(
					'ReplacementNo' => $replacementNo,
					'DateCreation' => date('Y-m-d H:i:s'),
					'SalesOrderNo' => $salesOrderNo,
					'ClientNo' => $soDetails['BillToClientNo'],
					'Status' => '1',
				);
				$insertNewReplacement = $this->Model_Inserts->InsertReplacement($data);
				if ($insertNewReplacement == TRUE) {
					$orderID = $this->db->insert_id();
					// create new replacement items
					for ($i = 0; $i < $productCount; $i++) {
						$transactionID = trim($this->input->post('productTIDInput_' . $i));
						$qty = trim($this->input->post('productQtyInput_' . $i));
						$remarks = trim($this->input->post('productRemarksInput_' . $i));

						$t_details = $this->Model_Selects->GetTransactionsByTID($transactionID)->row_array();

						$data = array(
							'replacementno' => $replacementNo,
							'stockid' => $t_details['stockID'],
							'transactionid' => $t_details['TransactionID'],
							'prd_sku' => $t_details['Code'],
							'quantity' => $qty,
							'quantity_total' => $t_details['Amount'],
							'remarks' => $remarks,
							'userid' => $userID,
							'date_added' => date('Y-m-d H:i:s'),
							'status' => 'replacemented',
							'Freebie' => $t_details['Freebie'],
						);
						$InsertReplacementData = $this->Model_Inserts->InsertReplacementData($data);
					}
					$this->session->set_flashdata('highlight-id', $replacementNo);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new sales order.', 'added replacement ' . $replacementNo . ' [ReplacementNo: ' . $replacementNo . '].', base_url('admin/replacements'));
					redirect('admin/replacements');
				}
				else
				{
					redirect('admin/replacements');
				}
			}
			else
			{
				redirect('admin/replacements');
			}
		} else {
			redirect(base_url());
		}
	}

	public function FORM_removeReplacement()
	{
		if ($this->Model_Security->CheckUserRestriction('replacement_delete')) {
			$replacementProductID = $this->input->get('rid');
			if ($replacementProductID != NULL) {
				$rProduct = $this->Model_Selects->GetReplacementProductByID($replacementProductID);
				if ($rProduct->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$rProductDetails = $rProduct->row_array();

					if ($rProductDetails['remarks'] == 'RETURNED') {
						$prompt_txt =
						'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Replacemented to inventory cannot be deleted.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
					} else {
						$result = $this->Model_Deletes->Delete_ReplacementProduct($replacementProductID);
					}
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}
}
