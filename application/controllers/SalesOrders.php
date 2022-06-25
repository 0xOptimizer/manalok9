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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Added new Client.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new client.', 'added a new client' . ($name ? ' ' . $name : '') . ' [ID: ' . $clientID . '].', base_url('admin/clients'));
				redirect('admin/clients');
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Updated Client.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				$this->Model_Logbook->LogbookEntry('updated client details.', 'updated details of client' . ($name ? ' ' . $name : '') . ' [clientID: ' . $clientID . '].', base_url('admin/clients'));
				$this->session->set_flashdata('highlight-id', $clientID);
				redirect('admin/clients');
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
				if ($this->Model_Updates->Remove_client($getClientByNo->row_array()['ID'])) {

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Client.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('deleted client record.', 'deleted a client record [ID: ' . $clientID . '].', base_url('admin/clients'));
					redirect('admin/clients');
				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

	public function FORM_addNewSOTransaction()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_update')) {	
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$salesOrderNo = $this->input->post('sales-order-no');
				$code = $this->input->post('product-sku');
				$stockID = $this->input->post('product-stock-id');
				$freebie = (($this->input->post('freebie') == 'on') ? '1' : '0');
				$discount = $this->input->post('discount');
				$qty = $this->input->post('qty');

				$so = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
				if ($so->num_rows() > 0) {
					$soDetails = $so->row_array();

					$p = $this->Model_Selects->GetProductByCode($code)->row_array();
					$s = $this->Model_Selects->Check_prd_stockid($stockID)->row_array();

					$transactionID = '';
					$transactionID .= strtoupper($code);
					$transactionID .= '-';
					$transactionID .= strtoupper(uniqid());

					$t = array(
						'Code' => $code,
						'TransactionID' => $transactionID,
						'OrderNo' => $salesOrderNo,
						'stockID' => $stockID,
						'Type' => '1',
						'Amount' => $qty,
						'Date' => date('Y/m/d H:i:s'),
						'DateAdded' => date('Y-m-d H:i:s'),
						'Status' => 0,
						'UserID' => $userID,

						'PriceUnit' => $s['Retail_Price'],
						'PriceTotal' => $s['Retail_Price'] * $qty,
						'Freebie' => $freebie,
						'UnitDiscount' => (($discount > 0) ? $discount : 0),
					);

					if ($t['Amount'] <= $p['InStock']) { // check if stock is enough
						$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($t);

						if ($insertNewTransaction && $soDetails['Status'] >= 4) { // if sales ordered delivered
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
							// RELEASED
							$discount = $t['UnitDiscount'];
							$price = $s['Retail_Price'];
							if ($t['Freebie'] == '0') {
								if ($discount > 0) {
									$dcTotal = $discount;
								} else {
									$dcTotal = 0;
								}

								$dcTotal = $price * ($dcTotal / 100);
								$finalPrice = $price;

								$finalDiscount = $dcTotal;
							} else {
								$finalPrice = $price;

								$finalDiscount = $price;
							}
							/* INSERT DATA TO STOCK HISTORY */
							$dataStockHistory = array(
								'stockid' => $t['stockID'],
								'transactionid' => $t['TransactionID'],
								'uid' => $p['U_ID'],
								'prd_sku' => $p['Code'],
								'quantity' => $t['Amount'],
								'cost' => $s['Price_PerItem'],
								'total_cost' => $s['Price_PerItem'] * $t['Amount'],
								'price' => $finalPrice,
								'total_price' => $finalPrice * $t['Amount'],
								'userid' => $userID,
								'date_added' => date('Y/m/d H:i:s'),
								'status' => 'released',
							);
							/* INSERT DISCOUNT DATA TO STOCK HISTORY */
							$dataStockHistoryDiscount = array(
								'stockid' => $t['stockID'],
								'transactionid' => $t['TransactionID'],
								'uid' => $p['U_ID'],
								'prd_sku' => $p['Code'],
								'quantity' => $t['Amount'],
								'cost' => $s['Price_PerItem'],
								'total_cost' => $s['Price_PerItem'] * $t['Amount'],
								'price' => $finalDiscount,
								'total_price' => $finalDiscount * $t['Amount'],
								'userid' => $userID,
								'date_added' => date('Y/m/d H:i:s'),
								'status' => 'discount',
							);

							$this->Model_Updates->ApproveTransaction($dataTransaction);
							$this->Model_Updates->UpdateStock_product($dataProduct);
							$this->Model_Updates->UpdateProduct_stock($t['stockID'], $dataStocks);
							$this->Model_Inserts->Insert_StockHistory($dataStockHistory);
							$this->Model_Inserts->Insert_StockHistory($dataStockHistoryDiscount);
						}

						if ($insertNewTransaction == true) {

							// update remaining payment
							$this->totalRemainingSOPayment($t['OrderNo']);

							$salesOrder = $this->Model_Selects->GetSalesOrderByNo($t['OrderNo'])->row_array();
							$this->updateSOPromoDiscount($t['OrderNo'],$salesOrder['discountPromotional']);

							$prompt_txt =
							'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Success!</strong> Added SO Transaction.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);

							$this->Model_Logbook->LogbookEntry('added new transaction.', 'added transaction ' . $transactionID . ' to sales order [SalesOrderNo: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo='. $salesOrderNo));
							redirect($_SERVER['HTTP_REFERER']);
						}
					} else {
						$prompt_txt =
						'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Approval aborted, not enough stock for ' . $t['TransactionID'] . '!
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
					}
				} else {
					$prompt_txt =
					'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeSOTransaction()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_update')) {
			$transactionID = $this->input->get('tid');

			if ($transactionID != NULL) {
				$transaction = $this->Model_Selects->GetTransactionsByTID($transactionID);
				if ($transaction->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$t = $this->Model_Selects->CheckIFApproved($transactionID);
					$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
					// if transaction approved, revert stocks
					if ($t['Status'] == 1) {
						$this->Model_Updates->UpdateStockReleaseRevert($t['stockID'],$t['Amount']);
						$this->Model_Updates->UpdateProductReleaseRevert($t['Code'],$t['Amount']);
					}
					$this->Model_Deletes->Delete_Transaction($t['TransactionID']);
					$this->Model_Deletes->Delete_StockHistory($t['TransactionID']);
					$this->Model_Deletes->Delete_ReturnProductTID($t['TransactionID']);

					// update remaining payment
					$this->totalRemainingSOPayment($t['OrderNo']);

					$salesOrder = $this->Model_Selects->GetSalesOrderByNo($t['OrderNo'])->row_array();
					$this->updateSOPromoDiscount($t['OrderNo'],$salesOrder['discountPromotional']);


					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Transaction.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('deleted SO transaction.', 'deleted SO transaction ' . $transactionID . ' [SalesOrderNo: ' . $t['OrderNo'] . '].', base_url('admin/view_sales_order?orderNo=' . $t['OrderNo']));
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateSOTransaction()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_update')) {
			$transactionID = $this->input->post('tid');
			$qty = $this->input->post('qty');

			if ($transactionID != NULL && $qty != NULL && $qty > 0) {
				$transaction = $this->Model_Selects->GetTransactionsByTID($transactionID);
				if ($transaction->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$t = $this->Model_Selects->CheckIFApproved($transactionID);
					$p = $this->Model_Selects->CheckStocksByCode($t['Code']);

					if (($qty - $t['Amount']) <= $p['InStock']) {
						// UPDATE MULTIPLE DETAILS
						// TRANSACTION
						$dataTransaction = array(
							'Amount' => $qty,
							'PriceTotal' => $t['PriceUnit'] * $qty,
						);
						$this->Model_Updates->UpdateProductTransaction($t['ID'], $dataTransaction);

						if ($t['Status'] == 1) {
							// PRODUCT
							$NewStock = $p['InStock'] - ($qty - $t['Amount']);
							$NewRelease = $p['Released'] + ($qty - $t['Amount']);
							$dataProduct = array(
								'Code' => $t['Code'],
								'InStock' => $NewStock,
								'Released' => $NewRelease,
							);
							// STOCKS
							$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();
							$n_cstocks = $s['Current_Stocks'] - ($qty - $t['Amount']);
							$n_rstocks = $s['Released_Stocks'] + ($qty - $t['Amount']);
							$dataStocks = array(
								'Current_Stocks' => $n_cstocks,
								'Released_Stocks' => $n_rstocks,
							);
							/* UPDATE DATA TO STOCK HISTORY */
							$shr = $this->Model_Selects->GetStockHistoryReleasedTransactionID($t['TransactionID']);
							if ($shr->num_rows() > 0) {
								$shr = $shr->row_array();
								$dataStockHistoryReleased = array(
									'quantity' => $qty,
									'total_cost' => $shr['cost'] * $qty,
									'total_price' => $shr['price'] * $qty,
								);
								$this->Model_Updates->UpdateStockHistoryReleasedTransactionID($t['TransactionID'], $dataStockHistoryReleased);
							}
							/* UPDATE DISCOUNT DATA TO STOCK HISTORY */
							$shd = $this->Model_Selects->GetStockHistoryDiscountTransactionID($t['TransactionID']);
							if ($shd->num_rows() > 0) {
								$shd = $shd->row_array();
								$dataStockHistoryDiscount = array(
									'quantity' => $qty,
									'total_cost' => $shd['cost'] * $qty,
									'total_price' => $shd['price'] * $qty,
								);
								$this->Model_Updates->UpdateStockHistoryDiscountTransactionID($t['TransactionID'], $dataStockHistoryDiscount);
							}

							$this->Model_Updates->UpdateStock_product($dataProduct);
							$this->Model_Updates->UpdateProduct_stock($t['stockID'], $dataStocks);
						}



						// update remaining payment
						$this->totalRemainingSOPayment($t['OrderNo']);

						$salesOrder = $this->Model_Selects->GetSalesOrderByNo($t['OrderNo'])->row_array();
						$this->updateSOPromoDiscount($t['OrderNo'],$salesOrder['discountPromotional']);


						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Updated Transaction.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						// LOGBOOK
						$this->Model_Logbook->LogbookEntry('updated SO transaction.', 'updated SO transaction ' . $transactionID . ' [SalesOrderNo: ' . $t['OrderNo'] . '].', base_url('admin/view_sales_order?orderNo=' . $t['OrderNo']));
					} else {
						$prompt_txt =
						'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Not enough quantity. ('. ($qty - $t['Amount']) .' < '. $p['InStock'] .')
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
					}

				}
			} else {
				$prompt_txt =
				'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Danger!</strong> Something went wrong.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateSOPromoDiscount()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_update')) {
			
			$salesOrderNo = $this->input->post('sales-order-no');
			$discountPromotional = $this->input->post('promotional_discount');

			$this->updateSOPromoDiscount($salesOrderNo,$discountPromotional);

			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_deleteSalesOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_delete')) {
			if (isset($_SESSION['UserID'])) {
				$orderNo = $this->input->post('order-no');
				$orderDetails = $this->Model_Selects->GetSalesOrderByNo($orderNo)->row_array();

				$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
				foreach ($orderTransactions as $key => $t) {
					$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();

					$this->Model_Deletes->Delete_Transaction($t['TransactionID']);
					$this->Model_Deletes->Delete_StockHistory($t['TransactionID']);
					$this->Model_Deletes->Delete_ReturnProductTID($t['TransactionID']);

					// if transaction approved, revert stocks
					if ($t['Status'] == 1) {
						$this->Model_Updates->UpdateStockReleaseRevert($t['stockID'],$t['Amount']);
						$this->Model_Updates->UpdateProductReleaseRevert($t['Code'],$t['Amount']);
					}
				}

				$this->Model_Deletes->Delete_InvoiceON($orderNo);
				$this->Model_Deletes->Delete_AdtlFeesON($orderNo);
				$this->Model_Deletes->Delete_ReplacementON($orderNo);
				$this->Model_Deletes->Delete_ReturnON($orderNo);

				$this->Model_Deletes->Delete_SalesOrderON($orderNo);

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Deleted Sales Order '. $orderNo .'.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('deleted Sales Order.', 'sales order deleted [No: ' . $orderNo . '].', base_url('admin/view_sales_order'));

				redirect('admin/sales_orders');
			}
		}
	}
	public function FORM_addSalesOrder()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_add')) {
			if (isset($_SESSION['UserID'])) {
				$userID = $_SESSION['UserID'];

				$current_no = explode('-', $this->Model_Selects->GetLatestSalesOrderNo());
				$current_no = intval($current_no[2]);
				$current_no = $current_no + 1;

				$orderNo = 'MK9-'. date('y') .'-'. str_pad($current_no, 7, '0', STR_PAD_LEFT);
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
					} elseif ($shipToNo == 'shipToBillingClient') { // set ship client no to bill no
						$shipToNo = $billToNo;
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
					}
					$this->session->set_flashdata('highlight-id', $orderID);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Sales Order.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// UPDATE REMAINING PAYMENT
					$this->totalRemainingSOPayment($orderNo);

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
						// update order status
						$data = array(
							'Status' => '2',
							'MarkDateInvoicing' => date('Y-m-d H:i:s'),
						);
						$this->Model_Updates->UpdateSalesOrderByOrderNo($orderNo, $data);

						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Approved Sales Order.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

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
						$this->Model_Deletes->Delete_StockHistory($t['TransactionID']);
					}
					// update order status
					$data = array(
						'Status' => '0',
						'MarkDateInvoicing' => date('Y-m-d H:i:s'),
					);
					$this->Model_Updates->UpdateSalesOrderByOrderNo($orderNo, $data);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Rejected Sales Order.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Scheduled Delivery.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

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
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
			$orderNo = $this->input->post('order-no');
			$orderDetails = $this->Model_Selects->GetSalesOrderByNo($orderNo)->row_array();

			$transactions = array();

			// total category discounts
			$discountTotal = $orderDetails['discountOutright'] + $orderDetails['discountVolume'] + $orderDetails['discountPBD'] + $orderDetails['discountManpower'];

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
						// RELEASE PRODUCT
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

						// RELEASED HISTORY
						$price = $t['PriceUnit'];
						if ($t['Freebie'] == '0') {
							if ($t['UnitDiscount'] > 0) {
								$dcTotal = $t['UnitDiscount'];
							} else {
								$dcTotal = $discountTotal;
							}

							$dcTotal = $price * ($dcTotal / 100);
							$finalPrice = $price;

							$finalDiscount = $dcTotal;
						} else {
							$finalPrice = $price;

							$finalDiscount = $price;
						}
						$dataStockHistory = array(
							'stockid' => $t['stockID'],
							'transactionid' => $t['TransactionID'],
							'uid' => $p['U_ID'],
							'prd_sku' => $p['Code'],
							'quantity' => $t['Amount'],
							'cost' => $s['Price_PerItem'],
							'total_cost' => $s['Price_PerItem'] * $t['Amount'],
							'price' => $finalPrice,
							'total_price' => $finalPrice * $t['Amount'],
							'userid' => $t['UserID'],
							'date_added' => date('Y/m/d H:i:s'),
							'status' => 'released',
						);
						/* DISCOUNT DATA TO STOCK HISTORY */
						$dataStockHistoryDiscount = array(
							'stockid' => $t['stockID'],
							'transactionid' => $t['TransactionID'],
							'uid' => $p['U_ID'],
							'prd_sku' => $p['Code'],
							'quantity' => $t['Amount'],
							'cost' => $finalDiscount,
							'total_cost' => $finalDiscount * $t['Amount'],
							'price' => 0,
							'total_price' => 0,
							'userid' => $t['UserID'],
							'date_added' => date('Y/m/d H:i:s'),
							'status' => 'discount',
						);
						
						$transactions[] = array(
							'dataTransaction' => $dataTransaction,
							'dataProduct' => $dataProduct,
							'dataStocks' => $dataStocks,
							'stockID' => $t['stockID'],
							'dataStockHistory' => $dataStockHistory,
							'dataStockHistoryDiscount' => $dataStockHistoryDiscount,
						);
					} else {
						$prompt_txt =
						'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

					/* INSERT STOCK DATA TO STOCK HISTORY */
					$this->Model_Inserts->Insert_StockHistory($row['dataStockHistory']);
					$this->Model_Inserts->Insert_StockHistory($row['dataStockHistoryDiscount']);
				}

				// Update
				$data = array(
					'Status' => '4',
					'MarkDateDelivered' => date('Y-m-d H:i:s'),
				);
				$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($orderNo, $data);
				if ($UpdateSalesOrder == TRUE) {

					$salesOrder = $this->Model_Selects->GetSalesOrderByNo($t['OrderNo'])->row_array();
					$this->updateSOPromoDiscount($t['OrderNo'],$salesOrder['discountPromotional']);
					
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Marked as Delivered.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('marked SO as delivered.', 'sales order marked as delivered [No: ' . $orderNo . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));

					$order = $this->Model_Selects->GetSalesOrderByNo($orderNo);
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
					redirect('admin/view_sales_order?orderNo=' . $orderNo);
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>DANGER!</strong> Something has gone wrong. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/view_sales_order?orderNo=' . $orderNo);
				}
			}
			else
			{
				// $error_txt = $prompt_txt;
				// $prompt_txt =
				// '<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				// <strong>Warning!</strong> <span class="text-dark">Error uploading data. Please try again. ['. $error_txt .']</span>
				// <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				// </div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/view_sales_order?orderNo=' . $orderNo);
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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Marked as Received.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('marked SO as received.', 'sales order marked as received [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));

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
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Updated Remarks.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('updated remarks.', 'updated remarks for sales order [No: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
			$unitDiscount = $this->input->post('unit-discount');
			$unitPrice = $this->input->post('unit-price');

			$orderDetails = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo)->row_array();
			if ($orderDetails['Status'] >= 2) {
				// Insert
				$data = array(
					'AdtlFeeNo' => $adtlFeeNo,
					'Description' => $description,
					'Qty' => $qty,
					'UnitDiscount' => $unitDiscount,
					'UnitPrice' => $unitPrice,
					'Date' => date('Y-m-d H:i:s', strtotime($date .' '. $time)),
					'OrderNo' => $salesOrderNo,
				);
				$insertAdtlFee = $this->Model_Inserts->InsertAdtlFee($data);
				if ($insertAdtlFee == TRUE) {
					$adtlFeeID = $this->db->insert_id();

					/* INSERT DISCOUNT DATA TO STOCK HISTORY */
					$finalPrice = $unitPrice - ($unitPrice * ($unitDiscount / 100));
					$data = array(
						'stockid' => $adtlFeeID,
						'transactionid' => $adtlFeeNo,
						'quantity' => $qty,
						'cost' => NULL,
						'total_cost' => NULL,
						'price' => $finalPrice,
						'total_price' => $finalPrice * $qty,
						'userid' => $userID,
						'date_added' => date('Y/m/d H:i:s'),
						'status' => 'adtl_fee',
					);
					$Insert_StockHistory = $this->Model_Inserts->Insert_StockHistory($data);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Aditional Fee.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// UPDATE REMAINING PAYMENT
					$this->totalRemainingSOPayment($salesOrderNo);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('added a new additional fee.', 'adde a new additional fee [ID: ' . $adtlFeeID . '] for sales order [OrderNo: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo=' . $salesOrderNo));
					redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
	public function FORM_updateSOAdtlFee()
	{
		if ($this->Model_Security->CheckUserRestriction('clients_edit')) {
			// Fetch data
			$salesOrderNo = $this->input->post('sales-order-no');
			$adtlFeeNo = $this->input->post('adtl-fee-no');
			$description = $this->input->post('description');
			$qty = $this->input->post('qty');
			$unitDiscount = $this->input->post('unit-discount');
			$unitPrice = $this->input->post('unit-price');

			// Update
			$data = array(
				'Description' => $description,
				'Qty' => $qty,
				'UnitDiscount' => $unitDiscount,
				'UnitPrice' => $unitPrice,
			);
			$updateAdtlFee = $this->Model_Updates->UpdateAdtlFee($data, $adtlFeeNo);
			if ($updateAdtlFee == TRUE) {

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Updated Aditional Fee.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// UPDATE REMAINING PAYMENT
				$this->totalRemainingSOPayment($salesOrderNo);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('updated client details.', 'updated details of adtl fee' . ' [adtlFeeNo: ' . $adtlFeeNo . '].', $_SERVER['HTTP_REFERER']);
				$this->session->set_flashdata('highlight-id', $adtlFeeNo);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_removeSOAdtlFee()
	{
		if ($this->Model_Security->CheckUserRestriction('sales_orders_adtl_fees')) {
			$adtlFeeNo = $this->input->get('afno');
			if ($adtlFeeNo != NULL) {
				$adtlFee = $this->Model_Selects->GetAdtlFeesByAdtlFeeNo($adtlFeeNo);

				$removeAdtlFee = $this->Model_Deletes->Delete_AdtlFee($adtlFeeNo);
				if ($removeAdtlFee) {
					if ($adtlFee->num_rows() > 0) {
						$adtlFeeDetails = $adtlFee->row_array();

						$updateSORemainingPayment = $this->totalRemainingSOPayment($adtlFeeDetails['OrderNo']);
						if (!$updateSORemainingPayment) {
							$prompt_txt =
							'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Danger!</strong> Sales Order remaining payment not updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
						}
					}

					$this->Model_Deletes->Delete_StockHistory($adtlFeeNo);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Aditional Fee.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('removed adtl fee.', 'removed adtl fee' . ' [adtlFeeNo: ' . $adtlFeeNo . '].', $_SERVER['HTTP_REFERER']);
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

				$updateSORemainingPayment = $this->totalRemainingSOPayment($salesOrderNo);
				if ($updateSORemainingPayment) {
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Invoice.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Sales Order remaining payment not updated.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// UPDATE REMAINING PAYMENT
				$this->totalRemainingSOPayment($salesOrderNo);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new invoice.', 'generated a new invoice [ID: ' . $invoiceID . '] for sales order [OrderNo: ' . $salesOrderNo . '].', base_url('admin/invoices'));
				redirect('admin/view_sales_order?orderNo=' . $salesOrderNo);
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Added Invoice.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('generated a new invoice.', 'generated a new invoice [ID: ' . $invoiceID . '].', base_url('admin/invoices'));
				redirect('admin/invoices');
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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
			if ($invoiceNo != NULL) {
				$invoice = $this->Model_Selects->GetInvoiceByInvoiceNo($invoiceNo);

				$removeInvoice = $this->Model_Updates->remove_invoice($invoiceNo);
				if ($removeInvoice) {
					if ($invoice->num_rows() > 0) {
						$invoiceDetails = $invoice->row_array();

						$updateSORemainingPayment = $this->totalRemainingSOPayment($invoiceDetails['OrderNo']);
						if (!$updateSORemainingPayment) {
							$prompt_txt =
							'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Danger!</strong> Sales Order remaining payment not updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
						}
					}

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Removed Invoice.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('deleted invoice.', 'deleted invoice [No: ' . $invoiceNo . '].', base_url('admin/invoices'));
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

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Return.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

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
					'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
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

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added Return.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
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
	public function FORM_removeReturnProduct()
	{
		if ($this->Model_Security->CheckUserRestriction('return_product_delete')) {
			$returnProductID = $this->input->get('rid');
			if ($returnProductID != NULL) {
				$rProduct = $this->Model_Selects->GetReturnProductByID($returnProductID);
				if ($rProduct->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$rProductDetails = $rProduct->row_array();

					if ($rProductDetails['remarks'] == 'RETURNED') {
						$prompt_txt =
						'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Returned to inventory cannot be deleted.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
					} else {
						$result = $this->Model_Deletes->Delete_ReturnProduct($returnProductID);

						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Removed Return.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
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

				$replacementNo = 'RP' . strtoupper(uniqid());
				$salesOrderNo = $this->input->post('sales-order-no');
				$code = $this->input->post('product-sku');
				$stockID = $this->input->post('product-stock-id');
				$freebie = (($this->input->post('freebie') == 'on') ? '1' : '0');
				$discount = $this->input->post('discount');
				$qty = $this->input->post('qty');

				$soDetails = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo)->row_array();

				if ($soDetails['Status'] >= 2) {
					$p_details = $this->Model_Selects->GetProductByCode($code)->row_array();
					$s_details = $this->Model_Selects->Check_prd_stockid($stockID)->row_array();

					$transactionID = '';
					$transactionID .= strtoupper($code);
					$transactionID .= '-';
					$transactionID .= strtoupper(uniqid());

					$data = array(
						'Code' => $code,
						'TransactionID' => $transactionID,
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
						$replacementNo = 'RP' . strtoupper(uniqid());
						/* INSERT REPLACEMENT */
						$data = array(
							'ReplacementNo' => $replacementNo,
							'TransactionID' => $transactionID,
							'DateAdded' => date('Y/m/d H:i:s'),
							'Cost' => $s_details['Price_PerItem'],
							'Price' => $s_details['Retail_Price'],
							'OrderNo' => $salesOrderNo,
							'Status' => '1',
						);
						$InsertNewReplacement = $this->Model_Inserts->InsertNewReplacement($data);

						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Added Replacement.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						$this->Model_Logbook->LogbookEntry('added new replacement.', 'added replacement ' . $replacementNo . ' to sales order [SalesOrderNo: ' . $salesOrderNo . '].', base_url('admin/view_sales_order?orderNo='. $salesOrderNo));
						redirect($_SERVER['HTTP_REFERER']);
					}
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
	public function FORM_approveReplacement()
	{
		if ($this->Model_Security->CheckUserRestriction('replacements_approve')) {
			$userID = $_SESSION['UserID'];

			$orderNo = $this->input->post('sales-order-no');
			$replacementNo = $this->input->post('replacement-no');

			$orderDetails = $this->Model_Selects->GetSalesOrderByNo($orderNo)->row_array();
			$replacementDetails = $this->Model_Selects->GetReplacementByNo($replacementNo)->row_array();
			$submit = $this->input->post('submit');

			$t = $this->Model_Selects->CheckIFApproved($replacementDetails['TransactionID']);
			$p = $this->Model_Selects->CheckStocksByCode($t['Code']);

			if ($submit == 'approve' && $replacementDetails['OrderNo'] == $orderNo && $t['Status'] == 0) { // if approved and pending transaction
				// check if stock is enough
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
					// RELEASED
					$discount = $t['UnitDiscount'];
					$price = $s['Retail_Price'];
					if ($t['Freebie'] == '0') {
						if ($discount > 0) {
							$dcTotal = $discount;
						} else {
							$dcTotal = 0;
						}

						$dcTotal = $price * ($dcTotal / 100);
						$finalPrice = $price;

						$finalDiscount = $dcTotal;
					} else {
						$finalPrice = $price;

						$finalDiscount = $price;
					}
					/* INSERT DATA TO STOCK HISTORY */
					$dataStockHistory = array(
						'stockid' => $t['stockID'],
						'transactionid' => $replacementDetails['TransactionID'],
						'uid' => $p['U_ID'],
						'prd_sku' => $p['Code'],
						'quantity' => $t['Amount'],
						'cost' => $s['Price_PerItem'],
						'total_cost' => $s['Price_PerItem'] * $t['Amount'],
						'price' => $finalPrice,
						'total_price' => $finalPrice * $t['Amount'],
						'userid' => $userID,
						'date_added' => date('Y/m/d H:i:s'),
						'status' => 'released',
					);
					/* INSERT DISCOUNT DATA TO STOCK HISTORY */
					$dataStockHistoryDiscount = array(
						'stockid' => $t['stockID'],
						'transactionid' => $replacementDetails['TransactionID'],
						'uid' => $p['U_ID'],
						'prd_sku' => $p['Code'],
						'quantity' => $t['Amount'],
						'cost' => $s['Price_PerItem'],
						'total_cost' => $s['Price_PerItem'] * $t['Amount'],
						'price' => $finalDiscount,
						'total_price' => $finalDiscount * $t['Amount'],
						'userid' => $userID,
						'date_added' => date('Y/m/d H:i:s'),
						'status' => 'discount',
					);

					$this->Model_Updates->ApproveTransaction($dataTransaction);
					$this->Model_Updates->UpdateStock_product($dataProduct);
					$this->Model_Updates->UpdateProduct_stock($t['stockID'], $dataStocks);
					$this->Model_Inserts->Insert_StockHistory($dataStockHistory);
					$this->Model_Inserts->Insert_StockHistory($dataStockHistoryDiscount);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Approved Replacement.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('approved replacement.', 'approved replacement ' . $replacementNo . ' [SalesOrderNo: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
				} else {
					$prompt_txt =
					'<div class="alert alert-warning text-dark position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Approval aborted, not enough stock for ' . $t['TransactionID'] . '!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}
			} elseif ($submit == 'reject' && $replacementDetails['OrderNo'] == $orderNo) { // if rejected and pending
				// if transaction approved, revert stocks
				if ($t['Status'] == 1) {
					$dataTransaction = array(
						'TransactionID' => $t['TransactionID'],
					);

					// RESTOCK
					$NewStock = $p['InStock'] + $t['Amount'];
					$NewRelease = $p['Released'] - $t['Amount'];
					$dataProduct = array(
						'Code' => $t['Code'],
						'InStock' => $NewStock,
						'Released' => $NewRelease,
					);

					// STOCKS
					$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();
					$n_cstocks = $s['Current_Stocks'] + $t['Amount'];
					$n_rstocks = $s['Released_Stocks'] - $t['Amount'];
					$dataStocks = array(
						'Current_Stocks' => $n_cstocks,
						'Released_Stocks' => $n_rstocks,
					);

					$this->Model_Updates->UpdateProduct_stock($t['stockID'], $dataStocks);

					$this->Model_Updates->RejectOrderTransaction($dataTransaction);
					$this->Model_Updates->UpdateStock_product($dataProduct);
				}

				$this->Model_Deletes->Delete_StockHistory($t['TransactionID']);

				// update replacement status
				$data = array(
					'Status' => '0',
				);
				$this->Model_Updates->UpdateReplacementByNo($data, $replacementNo);

				$prompt_txt =
				'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Rejected Replacement.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('rejected replacement.', 'rejected replacement ' . $replacementNo . ' [SalesOrderNo: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
			}
			redirect('admin/view_sales_order?orderNo=' . $orderNo);
		}
		redirect(base_url());
	}

	public function FORM_removeReplacement()
	{
		if ($this->Model_Security->CheckUserRestriction('replacements_delete')) {
			$replacementNo = $this->input->get('rno');

			if ($replacementNo != NULL) {
				$replacement = $this->Model_Selects->GetReplacementByNo($replacementNo);
				if ($replacement->num_rows() < 1) {
					$prompt_txt =
					'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Danger!</strong> Something went wrong.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				} else {
					$replacementDetails = $replacement->row_array();

					$t = $this->Model_Selects->CheckIFApproved($replacementDetails['TransactionID']);
					$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
					// if transaction approved, revert stocks
					if ($t['Status'] == 1) {
						$dataTransaction = array(
							'TransactionID' => $t['TransactionID'],
						);

						// RESTOCK
						$NewStock = $p['InStock'] + $t['Amount'];
						$NewRelease = $p['Released'] - $t['Amount'];
						$dataProduct = array(
							'Code' => $t['Code'],
							'InStock' => $NewStock,
							'Released' => $NewRelease,
						);

						// STOCKS
						$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();
						$n_cstocks = $s['Current_Stocks'] + $t['Amount'];
						$n_rstocks = $s['Released_Stocks'] - $t['Amount'];
						$dataStocks = array(
							'Current_Stocks' => $n_cstocks,
							'Released_Stocks' => $n_rstocks,
						);

						$this->Model_Updates->UpdateProduct_stock($t['stockID'], $dataStocks);

						$this->Model_Updates->RejectOrderTransaction($dataTransaction);
						$this->Model_Updates->UpdateStock_product($dataProduct);
						

						$this->Model_Deletes->Delete_StockHistory($t['TransactionID']);

						// update replacement status
						$data = array(
							'Status' => '0',
						);
						$this->Model_Updates->UpdateReplacementByNo($data, $replacementNo);

						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Removed Replacement.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						// LOGBOOK
						$this->Model_Logbook->LogbookEntry('deleted replacement.', 'deleted replacement ' . $replacementNo . ' [SalesOrderNo: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
					}
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}



// ############################ [ PRIVATE FUNCTIONS ] ############################
	private function totalRemainingSOPayment($salesOrderNo) {
		$getSalesOrderByOrderNo = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
		$salesOrder = $getSalesOrderByOrderNo->row_array();
		$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($salesOrderNo);
		$getAdtlFeesByOrderNo = $this->Model_Selects->GetAdtlFeesByOrderNo($salesOrderNo);

		$totalDiscount = $salesOrder['discountOutright'] + $salesOrder['discountVolume'] + $salesOrder['discountPBD'] + $salesOrder['discountManpower'];
		$transactionsPriceTotal = 0;
		$transactionsFreebiesTotal = 0;
		$transactionsUnitDiscountTotal = 0;
		$transactionsAdtlUnitDiscountTotal = 0;
		$transactionsAdtlFeesTotal = 0;


		$transactionsPromoDiscountTotal = 0;


		if ($getTransactionsByOrderNo->num_rows() > 0) {
			foreach ($getTransactionsByOrderNo->result_array() as $row) {
				$price = $row['PriceUnit'];



				// TOTAL PROMO DISCOUNT FIRST THEN TOTAL UNIT DISCOUNT

				$promoDiscountPriceTotal = $price * ($salesOrder['discountPromotional'] / 100);

				$unitDiscountPriceTotal = ($price - $promoDiscountPriceTotal) * ($row['UnitDiscount'] / 100);




				if ($row['Freebie'] == 0) { //not freebie
					$transactionsPriceTotal += ($price * $row['Amount']);
					$transactionsUnitDiscountTotal += ($unitDiscountPriceTotal * $row['Amount']);

					$transactionsPromoDiscountTotal += ($promoDiscountPriceTotal * $row['Amount']);
				} else {
					$transactionsFreebiesTotal += ($price * $row['Amount']);
				}
				// apply discounts
				$price -= $promoDiscountPriceTotal;
				$price -= $unitDiscountPriceTotal;
			}
		}

		if ($getAdtlFeesByOrderNo->num_rows() > 0) {
			foreach ($getAdtlFeesByOrderNo->result_array() as $row) {
				$price = $row['UnitPrice'];
				$unitDiscountPriceTotal = $price * ($row['UnitDiscount'] / 100);

				$transactionsAdtlFeesTotal += ($price * $row['Qty']);
				$transactionsAdtlUnitDiscountTotal += ($unitDiscountPriceTotal * $row['Qty']);
				// apply discount
				$price -= $unitDiscountPriceTotal;
			}
		}

		$totalPriceDiscounted = 
			($transactionsPriceTotal + $transactionsAdtlFeesTotal) - 
			($transactionsPriceTotal * ($totalDiscount / 100)) - 
			($transactionsUnitDiscountTotal + $transactionsAdtlUnitDiscountTotal + $transactionsPromoDiscountTotal);

		$total_invoice_amount = $this->Model_Selects->GetTotalInvoicesBySONo($salesOrderNo);
		if ($total_invoice_amount->num_rows()) {
			$amount = $total_invoice_amount->row_array()['Amount'];
		} else {
			$amount = 0;
		}

		$totalRemainingPayment = $totalPriceDiscounted - $amount;
		// Update SO Total
		$data = array(
			'TotalRemainingPayment' => $totalRemainingPayment,
		);
		return $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
	}


	private function updateSOPromoDiscount($salesOrderNo,$discountPromotional) {

		$so = $this->Model_Selects->GetSalesOrderByNo($salesOrderNo);
		if ($so->num_rows() > 0) {
			$userID = $_SESSION['UserID'];

			// Update
			$data = array(
				'discountPromotional' => $discountPromotional,
			);
			$UpdateSalesOrder = $this->Model_Updates->UpdateSalesOrderByOrderNo($salesOrderNo, $data);
			if ($UpdateSalesOrder == TRUE) {

				$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($salesOrderNo)->result_array();
				foreach ($orderTransactions as $key => $t) {
					$transaction = $this->Model_Selects->GetTransactionsByTID($t['TransactionID']);
					if ($transaction->num_rows() > 0) {
						$t = $this->Model_Selects->CheckIFApproved($t['TransactionID']);
						$p = $this->Model_Selects->CheckStocksByCode($t['Code']);

						// UPDATE MULTIPLE DETAILS
						if ($t['Status'] == 1) {
							/* UPDATE DATA TO STOCK HISTORY */
							$shr = $this->Model_Selects->GetStockHistoryReleasedTransactionID($t['TransactionID']);
							if ($shr->num_rows() > 0) {
								$shr = $shr->row_array();


								/*

								UPDATE PROMO DISCOUNT BEFORE UPDATING UNIT DISCOUNT

								USE PROMO DISCOUNTED PRICE WHEN COMPUTING UNIT DISCOUNT

								*/

								$promoDiscountPriceTotal = $shr['price'] * ($discountPromotional / 100);
								$unitDiscountPriceTotal = ($shr['price'] - $promoDiscountPriceTotal) * ($t['UnitDiscount'] / 100);

								//Y?
								$promoDiscountCostTotal = $shr['cost'] * ($discountPromotional / 100);
								$unitDiscountCostTotal = ($shr['cost'] - $promoDiscountCostTotal) * ($t['UnitDiscount'] / 100);


								/* UPDATE DISCOUNT PROMO DATA TO STOCK HISTORY */
								$shdp = $this->Model_Selects->GetStockHistoryDiscountPromoTransactionID($t['TransactionID']);
								if ($shdp->num_rows() > 0) {
									$shdp = $shdp->row_array();
									$dataStockHistoryDiscountPromo = array(
										'cost' => $promoDiscountCostTotal,
										'total_cost' => $promoDiscountCostTotal * $t['Amount'],
										'price' => $promoDiscountPriceTotal,
										'total_price' => $promoDiscountPriceTotal * $t['Amount'],
									);
									$this->Model_Updates->UpdateStockHistoryDiscountPromoTransactionID($t['TransactionID'], $dataStockHistoryDiscountPromo);
								} else {
									$s = $this->Model_Selects->Check_prd_stockid($t['stockID'])->row_array();

									/* INSERT DISCOUNT PROMO DATA TO STOCK HISTORY */
									$dataStockHistoryDiscount = array(
										'stockid' => $t['stockID'],
										'transactionid' => $t['TransactionID'],
										'uid' => $p['U_ID'],
										'prd_sku' => $p['Code'],
										'quantity' => $t['Amount'],
										'cost' => $promoDiscountCostTotal,
										'total_cost' => $promoDiscountCostTotal * $t['Amount'],
										'price' => $promoDiscountPriceTotal,
										'total_price' => $promoDiscountPriceTotal * $t['Amount'],
										'userid' => $userID,
										'date_added' => date('Y/m/d H:i:s'),
										'status' => 'discount',
										'discount_type' => 'promo',
									);

									$this->Model_Inserts->Insert_StockHistory($dataStockHistoryDiscount);
								}

								/* UPDATE DISCOUNT DATA TO STOCK HISTORY */
								$shd = $this->Model_Selects->GetStockHistoryDiscountTransactionID($t['TransactionID']);
								if ($shd->num_rows() > 0) {
									$shd = $shd->row_array();
									$dataStockHistoryDiscount = array(
										'cost' => $unitDiscountCostTotal,
										'total_cost' => $unitDiscountCostTotal * $t['Amount'],
										'price' => $unitDiscountPriceTotal,
										'total_price' => $unitDiscountPriceTotal * $t['Amount'],
									);
									$this->Model_Updates->UpdateStockHistoryDiscountTransactionID($t['TransactionID'], $dataStockHistoryDiscount);
								}

							}
						}
					}
				}

				// update remaining payment
				$this->totalRemainingSOPayment($salesOrderNo); //update this function

				// add promo discount insert to sales history function on sales history state update
			}
		}
	}
}
