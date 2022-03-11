<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class AJAX extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Inserts');
		date_default_timezone_set('Asia/Manila');
		$this->load->model('Model_Logbook');
		$this->load->model('Model_Updates');
		
		if (!$this->Model_Security->CheckPrivilegeLevel()) {
			redirect();
		}
	}

	public function getUserLogs()
	{
		$id = $this->input->get('userID');
		if (strlen($id) > 0) {
			$userHistory = $this->Model_Selects->GetUserHistory($id)->result_array();

			foreach ($userHistory as $key => $row) {
				$dateDiff = strtotime(date('Y-m-d h:i:s A')) - strtotime($row['DateAdded']);
				$days = $dateDiff / (60 * 60 * 24);
				$hours = $dateDiff / (60 * 60);
				$minutes = $dateDiff / 60;
				if ($days > 1) {
					$timePassed = floor($days) . ' day';
					if ($days >= 2) {
						$timePassed .= 's';
					}
				}
				elseif ($hours > 1) {
					$timePassed = floor($hours) . ' hour';
					if ($hours >= 2) {
						$timePassed .= 's';
					}
				}
				elseif ($minutes > 1) {
					$timePassed = floor($minutes) . ' minute';
					if ($minutes >= 2) {
						$timePassed .= 's';
					}
				} else {
					$timePassed = $dateDiff . ' seconds';
				}

				$userHistory[$key]['TimePassed'] = $timePassed . ' ago';
			}

			echo json_encode($userHistory);
		}
	}
	public function getUserRestrictions()
	{
		$id = $this->input->get('userID');
		if (strlen($id) > 0) {
			$userRestrictions = $this->Model_Selects->GetUserRestrictions($id)->result_array();

			foreach ($userRestrictions as $key => $row) {

				$userRestrictions[$key] = $row;
			}

			echo json_encode($userRestrictions);
		}
	}
	public function getProductStocks()
	{
		$sku = $this->input->get('sku');
		if (strlen($sku) > 0) {
			$productStocks = $this->Model_Selects->GetProductStocks($sku)->result_array();

			echo json_encode($productStocks);
		}
	}
	public function getClientSalesOrders()
	{
		$clientNo = $this->input->get('no');
		if (strlen($clientNo) > 0) {
			$clientSalesOrders = $this->Model_Selects->GetUnreturnedSalesOrdersByBillClientNoFulfilled($clientNo)->result_array();

			foreach ($clientSalesOrders as $key => $row) {
				$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($row['OrderNo']);

				$clientSalesOrders[$key]['ItemCount'] = $orderTransactions->num_rows();
			}

			echo json_encode($clientSalesOrders);
		}
	}
	public function getClientSalesOrderProducts()
	{
		$salesOrderNo = $this->input->get('no');
		if (strlen($salesOrderNo) > 0) {
			$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($salesOrderNo)->result_array();

			echo json_encode($orderTransactions);
		}
	}

	public function validateEmailRegistration()
	{
		$email = $this->input->post('email');
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$checkIfEmailExists = $this->Model_Security->GetLoginEmail($email);
			if ($checkIfEmailExists->num_rows() <= 0) {
				echo '<span class="registration-message-banners success-banner-sm" data-feedback="0">
					<i class="bi bi-check-circle-fill"></i> Email valid
				</span>';
			} else {
				echo '<span class="registration-message-banners warning-banner-sm" data-feedback="3">
					<i class="bi bi-exclamation-triangle-fill"></i> Email already registered
				</span>';
			}
		} else {
			echo '<span class="registration-message-banners warning-banner-sm" data-feedback="2">
				<i class="bi bi-exclamation-triangle-fill"></i> Invalid email format
			</span>';
		}
	}
	public function sendRegistrationEmail()
	{


		$email = $this->input->post('email');

		if ($email) {
			// ~ create token
			$token = bin2hex(random_bytes(24));
				$data = array(
				'Email' => $email,
				'Token' => $token,
				'DateAdded' => date('Y-m-d h:i:s A'),
			);
			$insertRegistrationToken = $this->Model_Inserts->InsertRegistrationToken($data);
			if ($insertRegistrationToken == TRUE) {
				// ~ intializing smtp
				$smtp = new PHPMailer();
				$smtp->IsSMTP();
				// ~ email headers
				$smtp->Mailer = 'smtp';
				$smtp->SMTPDebug  = 1;  
				$smtp->SMTPAuth   = TRUE;
				$smtp->SMTPSecure = 'tls';
				$smtp->Port       = 587;
				$smtp->Host       = 'smtp.gmail.com';
				$smtp->Username   = 'devt5599@gmail.com';
				$smtp->Password   = ''; // NEED PASSWORD ---------------------------------------
				// ~ email content
				$smtp->IsHTML(true);
				$smtp->AddAddress($email, 'recipient-name');
				$smtp->SetFrom('no-reply@manalok9-demo.cf', 'Manalo K9');
				$smtp->Subject = 'Manalo K9 - Registration';
				$content = 'Your registration token has arrived. Please click or copy the link below to create your account.<br><br>' . base_url() . 'register?token=' . $token;

				$smtp->MsgHTML($content);
				if(!$smtp->Send()) {
					echo '<span class="registration-message-banners warning-banner-sm" data-feedback="2">
						<i class="bi bi-exclamation-triangle-fill"></i> Error while sending email
					</span>';
				} else {
					echo '<span class="registration-message-banners success-banner-sm" data-feedback="0">
						<i class="bi bi-check-circle-fill"></i> Email sent successfully
					</span>';
				}
				$this->Model_Logbook->LogbookEntry('created a new registration token.', 'created a new registration token.', base_url() . 'register?token=' . $token . '">');
			}
			else
			{
				echo '<span class="registration-message-banners warning-banner-sm" data-feedback="2">
					<i class="bi bi-exclamation-triangle-fill"></i> Database error
				</span>';
			}
			
		} else {
			echo '<span class="registration-message-banners warning-banner-sm" data-feedback="2">
				<i class="bi bi-exclamation-triangle-fill"></i> Email address is required
			</span>';
		}
	}

	// CLIENT NAME SEARCH
	public function searchClientName()
	{
		$search = $this->input->get('search');
		if (strlen($search) > 0) {
			$searchResult = $this->Model_Selects->FindClientName($search)->result_array();

			echo json_encode($searchResult);
		}
	}
	public function searchClientDetails()
	{
		$no = $this->input->get('no');
		if (strlen($no) > 0) {
			$clientDetails = $this->Model_Selects->GetClientByNo($no)->row_array();

			echo json_encode($clientDetails);
		}
	}
	public function getClientDetails()
	{
		$clientNo = $this->input->get('client_no');
		$getClientByNo = $this->Model_Selects->GetClientByNo($clientNo)->row_array();
		print json_encode($getClientByNo);
	}
	// VENDOR NAME SEARCH
	public function searchVendorName()
	{
		$search = $this->input->get('search');
		if (strlen($search) > 0) {
			$searchResult = $this->Model_Selects->FindVendorName($search)->result_array();

			echo json_encode($searchResult);
		} else {
			echo json_encode($this->Model_Selects->FindVendorAll()->result_array());
		}
	}
	public function searchVendorDetails()
	{
		$no = $this->input->get('no');
		if (strlen($no) > 0) {
			$vendorDetails = $this->Model_Selects->GetVendorByNo($no)->row_array();

			echo json_encode($vendorDetails);
		}
	}
	public function getVendorDetails()
	{
		$vendorNo = $this->input->get('vendor_no');
		$getVendorByNo = $this->Model_Selects->GetVendorByNo($vendorNo)->row_array();
		print json_encode($getVendorByNo);
	}
	
	// RETURNS
	public function getReturnTransactionDetails()
	{
		$tid = $this->input->get('tid');
		if (strlen($tid) > 0) {
			$transactionDetails['ORDERED'] = $this->Model_Selects->GetTransactionsByTID($tid)->row_array()['Amount'] + 0;

			$transactionDetails['GOOD'] = $this->Model_Selects->GetReturnProductSumQtyByTIDRemark($tid, 'GOOD')->row_array()['quantity'] + 0;
			$transactionDetails['DAMAGED'] = $this->Model_Selects->GetReturnProductSumQtyByTIDRemark($tid, 'DAMAGED')->row_array()['quantity'] + 0;
			$transactionDetails['RETURNED'] = $this->Model_Selects->GetReturnProductSumQtyByTIDRemark($tid, 'RETURNED')->row_array()['quantity'] + 0;
			

			echo json_encode($transactionDetails);
		}
	}

	// ACCOUNTING
	public function getJournalDetails()
	{
		$journalID = $this->input->get('journal_id');
		$getJournalByID = $this->Model_Selects->GetJournalByID($journalID)->row_array();
		print json_encode($getJournalByID);
	}
	public function getJournalTransactions()
	{
		$journalID = $this->input->get('journal_id');
		$GetTransactionsByJournalID = $this->Model_Selects->GetTransactionsByJournalID($journalID)->result_array();
		print json_encode($GetTransactionsByJournalID);
	}
	public function getAccountTransactionsRange()
	{
		$account_id = $this->input->get('account_id');
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		if (strlen($account_id) > 0) {
			$accountTransactionDetails = $this->Model_Selects->GetTransactionsRangeByAccountID($date_from, $date_to,  $account_id)->result_array();

			echo json_encode($accountTransactionDetails);
		}
	}
	public function Add_idtoCart()
	{

		$item_code = $this->input->post('item_code');
		$qtyValue = $this->input->post('qtyValue');
		$skuCode = $this->input->post('item_code');

		$prompt_text = '';


		if (empty($item_code)) {
			echo 'Error! Item code doesn\'t exist.';
			exit();
		}
		if (empty($qtyValue)) {
			echo 'Warning! Input Quantity.';
			exit();
		}

		$CheckSKU_Code = $this->Model_Selects->CheckSKU_Code($skuCode);
		if ($CheckSKU_Code->num_rows() < 1) {
			echo 'Product not found!';
			exit();
		}
		if (isset($item_code) || isset($qtyValue)) {

			if (!isset($_SESSION['cart_sess'])) {
				$_SESSION['cart_sess'] = array();
			}

			$data = array(
				'item_code' => $item_code, 
				'qty' => $qtyValue, 
			);

			if (isset($_SESSION['cart_sess'])) {
	
				foreach ($_SESSION['cart_sess'] as $row => $val) {
					if ($val['item_code'] == $item_code) {
						$_SESSION['cart_sess'][$row]['qty'] = $val['qty'] + $qtyValue;
						echo 'Quantity added to existing product in cart.';
						exit();
					}
				}

				array_push($_SESSION['cart_sess'],$data);
				echo 'Product added to cart.';

				exit();
			}

		}
	}
	public function Clear_cartSess()
	{
		unset($_SESSION['cart_sess']);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function remove_fromCart()
	{

		$item_code = $this->input->post('item_code');
		if (isset($_SESSION['cart_sess'])) {
			$cart_sess = $_SESSION['cart_sess'];
			$key = array_search($item_code, array_column($cart_sess, 'item_code'));

			unset($_SESSION['cart_sess'][$key]);

			$final_session = array_values($_SESSION['cart_sess']);
			$_SESSION['cart_sess'] = $final_session;
			if (empty($_SESSION['cart_sess'])) {
				unset($_SESSION['cart_sess']);
			}
			echo 'Product removed from cart.';
			exit();
		
		}
		else
		{
			// redirect($_SERVER['HTTP_REFERER']);
			echo 'error';
			exit();

		}
	}
	public function get_Cartdata()
	{
		if (isset($_SESSION['cart_sess'])) {
			foreach ($_SESSION['cart_sess'] as $row) {
				$data = array();
				$data['item_code'] = $row['item_code'];
				$data['qty'] = $row['qty'];
				$cart_data[] = $data;
			}
			$jsondata = json_encode($cart_data);
			
			echo $jsondata;
		}
	}
	public function add_cart_releasing()
	{
		date_default_timezone_set('Asia/Manila');

		$item_code = $this->input->post('item_code');
		$qtyValue = $this->input->post('qtyValue');
		$skuCode =  $this->input->post('item_code');

		$prompt_text = '';

		if (empty($item_code)) {
			echo 'item code error';
			exit();
		}
		if (empty($qtyValue)) {
			echo 'quantity error';
			exit();
		}
		$CheckSKU_Code = $this->Model_Selects->CheckSKU_Code($skuCode);
		if ($CheckSKU_Code->num_rows() < 1) {
			echo 'Product not found!';
			exit();
		}
		// CHECK STOCK\
		$Code = $item_code;
		$CheckStocks_releasing = $this->Model_Selects->CheckStocks_releasing($Code);
		$csrrr = $CheckStocks_releasing->row_array();

		if ($CheckStocks_releasing->num_rows() < 1) {
			echo 'product null';
			exit();
		}

		// PROMPT STOCK IS LOW
		if ($csrrr['InStock'] < $qtyValue) {
			echo 'low stock';
			exit();
		}

		// PREPARE DATA
		$tota_p = $csrrr['Price_PerItem'] * $qtyValue;
		$data = array(
			'user_id' => $this->session->userdata('UserID'),
			'item_code' => $item_code,
			'quantity' => $qtyValue,
			'total_price' => $tota_p,
			'time_stamp' => date('Y-m-d H:i:s'),
			'status' => 0
		);
		// INSERT TO CART RELEASING
		$Insertto_releasingcart = $this->Model_Inserts->Insertto_releasingcart($data);


		if ($Insertto_releasingcart == TRUE) {

			// UPDATE STOCK INSTOCK - QUANTITY
			$nCode = $csrrr['Code'];
			$InStock = $csrrr['InStock'] - $qtyValue;
			$updata = array(
				'Code' => $nCode,
				'InStock' => $InStock
			);
			$Update_releasedata = $this->Model_Updates->Update_releasedata($updata);
			
			if ($Update_releasedata == TRUE) {
				echo 'success';
				exit();
			}
			else
			{
				echo 'error';
				exit();
			}
		}
		else
		{
			echo 'error';
			exit();
		}

	}
	public function GetBrand_data()
	{
		$UniqueID = $this->input->post('uid');
		$CheckBrand_Data = $this->Model_Selects->CheckBrand_Data($UniqueID);
		if ($CheckBrand_Data->num_rows() > 0) {
			// GET ALL DATA
			$cbd = $CheckBrand_Data->row_array();
			$response['Brand'] = array(
				
				'Brand_Name' => $cbd['Brand_Name'],
				'Brand_Char' => $cbd['Brand_Char'],
				'Brand_Type' => $cbd['Brand_Type'],
				'UniqueID' => $cbd['UniqueID'],
			);

			$CheckBrand_Properties = $this->Model_Selects->CheckBrand_Properties($UniqueID);
			$cbp = $CheckBrand_Properties->row_array();
			$response['Brand_Properties'] = array(
				'Brand_Abbr' => $cbp['Brand_Abbr'],
				'Brand_Type_Abbr' => $cbp['Brand_Type_Abbr'],
				'Product_Line' => $cbp['Product_Line'],
				'Product_line_Abbr' => $cbp['Product_line_Abbr'],
				'Product_Type' => $cbp['Product_Type'],
				'Product_Type_Abbr' => $cbp['Product_Type_Abbr'],
			);

			$CheckBrand_Variants = $this->Model_Selects->CheckBrand_Variants($UniqueID);
			$response['Brand_Variants'] = $CheckBrand_Variants->result_array();
			$CheckBrand_Sizes = $this->Model_Selects->CheckBrand_Sizes($UniqueID);
			$response['Brand_Sizes'] = $CheckBrand_Sizes->result_array();
			
		}
		else
		{
			// RESPONSE
			$response['Error'] = array(
				'error404' => 'Data not found.',
			);
			
		}

		$jsondata = json_encode($response);
		echo $jsondata;
	}
	public function Add_BrandSizes()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_add')) {
			$UniqueID = $this->input->post('uid');
			if (empty($UniqueID)) {
				echo 'Error! Please Try Again';
				exit();
			}
			$GetAll_BrandSizes = $this->Model_Selects->GetAll_BrandSizes($UniqueID);
			$result = $GetAll_BrandSizes->result_array();
				
			$result = json_encode($result);
			echo $result;
			exit();
		} else {
			redirect(base_url());
		}
	}
	public function AddNew_BrandSizes()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_add')) {
			$UniqueID = $this->input->post('uid');
			$Product_Size = $this->input->post('prd_size');
			$Product_Size_Abbr = $this->input->post('prd_sizeabbr');

			if (empty($UniqueID) || empty($Product_Size) || empty($Product_Size_Abbr)) {
				echo "Warning! Empty fields please try again.";
				exit();
			}
			$CheckBrand_UniqueID = $this->Model_Selects->CheckBrand_UniqueID($UniqueID);
			if ($CheckBrand_UniqueID->num_rows() > 0) {
				$data = array(
					'UniqueID' => $UniqueID,
					'Product_Size' => strtoupper($Product_Size),
					'Product_Size_Abbr' => strtoupper($Product_Size_Abbr),
				);
				$Add_NewBrandsize = $this->Model_Inserts->Add_NewBrandsize($data);
				if ($Add_NewBrandsize == true) {

					echo "Succes! New size added.";
					exit();
				}
				else
				{
					echo "Error! Please try again.";
					exit();
				}
			}
			else
			{
				echo "Error! Please try again.";
					exit();
			}
		} else {
			redirect(base_url());
		}
	}
	public function Fill_Select_BrandData()
	{
		$UniqueID = $this->input->post('uid');
		if (empty($UniqueID)) {
			$data['status_response'] = array('status' => 0, );
		}
		else
		{
			$data['status_response'] = array('status' => 1, );
		}

		$CheckBrand_Data = $this->Model_Selects->CheckBrand_Data($UniqueID);
		$data['brand_category'] = $CheckBrand_Data->result_array();

		$CheckBrand_Properties = $this->Model_Selects->CheckBrand_Properties($UniqueID);
		$data['brand_properties'] = $CheckBrand_Properties->result_array();

		$CheckBrand_Variants = $this->Model_Selects->CheckBrand_Variants($UniqueID);
		$data['brand_variants'] = $CheckBrand_Variants->result_array();
		
		$CheckBrand_Sizes = $this->Model_Selects->CheckBrand_Sizes($UniqueID);
		$data['brand_sizes'] = $CheckBrand_Sizes->result_array();
		
		$result = json_encode($data);
		echo $result;
	}
	public function Check_sku_code()
	{
		$skuCode = $this->input->post('sku_code');
		if (empty($skuCode)) {
			$data['status'] = array('message' => 'SKU EMPTY', );
			$result = json_encode($data);
			echo $result;
			exit();
		}
		else
		{
			$CheckSKU_Code = $this->Model_Selects->CheckSKU_Code($skuCode);
			if ($CheckSKU_Code->num_rows() > 0) {

				$data['status'] = array('message' => 'SKU FOUND', );

				$data['products'] = $CheckSKU_Code->row_array();

				$GetProductDetails = $this->Model_Selects->GetProductDetails($skuCode);

				$data['product_details'] = $GetProductDetails->row_array();

				$result = json_encode($data);
				echo $result;
				exit();
			}
			else
			{
				$data['status'] = array('message' => 'SKU NULL', );
				$result = json_encode($data);
				echo $result;
				exit();
			}
		}
	}
	public function Get_ProductJSON()
	{
		$ID = $this->input->post('prd_id');
		// GET PRODUCT DATA
		$GetProduct_ID = $this->Model_Selects->GetProduct_ID($ID);
		if ($GetProduct_ID->num_rows() > 0) {
			// FOUND GET DETAILS AND PROPERTIES
			$prd_result = $GetProduct_ID->row_array();

			$item_code = $prd_result['Code'];

			$GetProduct_Prop = $this->Model_Selects->GetProduct_Prop($item_code);
			$prd_result_prop = NULL;
			if ($GetProduct_Prop->num_rows() > 0) {
				$prd_result_prop = $GetProduct_Prop->row_array();
			}

			$data['prd_status'] = array(
				'status' => 'success',
				'message' => 'product details fetch',
			);
			$data['prd_details'] = $prd_result;
			$data['prd_properties'] = $prd_result_prop;
			
			$result = json_encode($data);
			echo $result;
			exit();
		}
		else
		{
			// NOT FOUND
			$data['prd_status'] = array(
				'status' => 'error',
				'message' => 'product doesn\'t exist',
			);
			$result = json_encode($data);
			echo $result;
			exit();
		}
	}
}
