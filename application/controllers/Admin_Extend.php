<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Extend extends CI_Controller {

	
	public $globalData = [];
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Logbook');
		$this->load->model('Model_Updates');
		$this->load->model('Model_Deletes');
		if($this->Model_Security->CheckPrivilegeLevel() >= 1) {
			$this->load->model('Model_Inserts');
			$this->load->model('Model_Updates');

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
		// $this->output->enable_profiler(TRUE);
	}
	
	/**************
	DISPLAY VIEWS
	***************/
	public function product_restockingv2()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Restock Transactions';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$data['get_allstocks'] = $this->Model_Selects->get_allstocks();
		$this->load->view('admin/restock_product_v2', $data);
	}
	public function product_releasingv2()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Release Transactions';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$data['get_allstocks'] = $this->Model_Selects->get_allstocks();
		$this->load->view('admin/release_product_v2', $data);
	}

	/**************
	ACTIONS
	***************/
	public function Get_Product_data()
	{
		$uid = $this->input->post('uids');
		$Checkprd_uid = $this->Model_Selects->Checkprd_uid($uid);
		if ($Checkprd_uid->num_rows() > 0) {
			$data['prd_status'] = array('status' => 'success', );
			$data['prd_details'] = $Checkprd_uid->row_array();
			echo json_encode($data);
			exit();
		}
		else
		{
			$data['prd_status'] = array('status' => 'error_uid_not_found', );
			echo json_encode($data);
			exit();
		}
	}
	public function Add_stockto_cart()
	{
		/* VARIABLES */
		$uid = $this->input->post('uids');
		$product_sku = $this->input->post('pre_sku');
		$quantity = $this->input->post('quant');
		$retail_price = $this->input->post('r_price');
		$original_price = $this->input->post('orig_price');
		$manufacturer = $this->input->post('manufacturer');
		$expiration = $this->input->post('expire_date');
		$description = $this->input->post('prd_descript');
		$user_id = $this->session->userdata('UserID');
		$date_added = date('Y/m/d H:i:s');

		/* CHECK UID IF EXIST FALSE PROMPT ERROR*/
		$Checkthis_prd_uid = $this->Model_Selects->Checkthis_prd_uid($uid);
		if ($Checkthis_prd_uid->num_rows() < 1) {
			$data['promptsss'] = array('status' => 'uid_not_found', );
			echo json_encode($data);
			exit();
		}

		/* CHECK SKU IF EXIST FALSE PROMPT ERROR*/
		$Checkthis_prd_sku = $this->Model_Selects->Checkthis_prd_sku($product_sku);
		if ($Checkthis_prd_sku->num_rows() < 1) {
			$data['promptsss'] = array('status' => 'sku_not_found', );
			echo json_encode($data);
			exit();
		}

		/* CHECK EMPTY VALUES OR NULL PROMPT ERROR */
		if (empty($uid) || empty($product_sku) || empty($quantity) || empty($retail_price) || empty($original_price) || empty($manufacturer) || empty($expiration)) {
			$data['promptsss'] = array('status' => 'empty_fields', );
			echo json_encode($data);
			exit();
		}

		/* CHECK IF NOT NUMERIC TRUE PROMPT ERROR */
		if (!is_numeric($quantity) || !is_numeric($retail_price) || !is_numeric($original_price)) {
			$data['promptsss'] = array('status' => 'not_numbers', );
			echo json_encode($data);
			exit();
		}
		
		/* INSERT VARIABLE TO ARRAY FOR INSERT */
		$data = array(
			'uid' => $uid,
			'product_sku' => $product_sku,
			'quantity' => $quantity,
			'retail_price' => $retail_price,
			'original_price' => $original_price ,
			'manufacturer' => $manufacturer,
			'expiration' => $expiration,
			'description' => $description,
			'user_id' => $user_id,
			'date_added' => $date_added,
			'status' => 1,
		);
		$Insert_toCartRestocking = $this->Model_Inserts->Insert_toCartRestocking($data);
		if ($Insert_toCartRestocking == true) {

			/* STOCK INSERTED SUCCESS PROMPT SUCCESS */
			$data['promptsss'] = array('status' => 'success', );
			echo json_encode($data);
			exit();
		}
		else
		{

			/* STOCK INSERTED ERROR PROMPT ERROR */
			$data['promptsss'] = array('status' => 'error', );
			echo json_encode($data);
			exit();
		}
	}
	public function Get_uid_prd()
	{
		/* VARIABLES */
		$product_sku = $this->input->post('pre_sku');

		/* CHECK SKU IF EXIST FALSE PROMPT ERROR*/
		$Checkthis_prd_sku = $this->Model_Selects->Checkthis_prd_sku($product_sku);
		if ($Checkthis_prd_sku->num_rows() > 0) {

			$cps_result = $Checkthis_prd_sku->row_array();
			$uid = $cps_result['U_ID'];
			$data['product'] = array('uid' => $uid);

			$data['status'] = array('code' => 'sku_found', );
			echo json_encode($data);
			exit();
		}
		else
		{
			$data['status'] = array('code' => 'sku_not_found', );
			echo json_encode($data);
			exit();
		}
	}
	public function get_cart_fill_table()
	{
		/* VARIABLES */
		$user_id = $this->session->userdata('UserID');
		$status = 1;

		/* GET DATA IN CART RESTOCKING */
		$Get_Cart_dataaa = $this->Model_Selects->Get_Cart_dataaa($user_id,$status);
		if ($Get_Cart_dataaa->num_rows() > 0) {
			foreach ($Get_Cart_dataaa->result_array() as $row) {
				$response = '
				<div class="row py-3">
				<div class="col-12 col-sm-12">
				<div class="cart_header d-flex flex-wrap justify-content-between">
				<h6 class="cart_header">
				<span class="text-primary">SKU</span> : '.$row['product_sku'].'
				</h6>
				<a type="button" class="btn-cartitem-delete text-danger" data-value="'.$row['id'].'"><i class="bi bi-trash"></i></a>
				</div>
				<div class="cart_body">
				<div class="content-row d-flex flex-wrap justify-content-between">
				<div class="content">
				<label>
				<span class="text-primary">Quantity :</span> '.$row['quantity'].'
				</label>
				</div>
				<div class="content">
				<label>
				<span class="text-primary">Retail Price :</span> '.$row['retail_price'].' php
				</label>
				</div>
				<div class="content">
				<label>
				<span class="text-primary">Original Price :</span> '.$row['original_price'].' php
				</label>
				</div>
				<div class="content">
				<label>
				<span class="text-primary">Expiration Date :</span> '.$row['expiration'].'
				</label>
				</div>
				</div>
				<div class="content-row d-flex flex-wrap justify-content-between">
				<div class="content">
				<label>
				<span class="text-primary">Manufacturer :</span> '.$row['manufacturer'].'
				</label>
				</div>
				</div>
				<div class="content-row d-flex flex-wrap justify-content-between">
				<div class="content">
				<label>
				<span class="text-primary">Description :</span> '.$row['description'].'
				</label>
				</div>
				</div>
				</div>
				</div>
				</div>
				';
				echo $response;
			}
			
			exit();
		}
		else
		{
			$response = 
			'<div class="row"><div class="col-12 col-sm-12 p-2 text-center"> Cart is empty.</div></div>';
			echo $response;
			exit();
		}
	}
	public function Delete_cart_itemrestock()
	{
		/* VARIABLES */
		$id = $this->input->post('cart_id');
		if (!empty($id)) {

			/* CHECK ID IF EXIST */
			$CheckCartItem_ID = $this->Model_Selects->CheckCartItem_ID($id);
			if ($CheckCartItem_ID->num_rows() > 0) {
				/* DELETE CART ITEM BY ID */
				$Delete_cartRestock_item = $this->Model_Deletes->Delete_cartRestock_item($id);
				if ($Delete_cartRestock_item == true) {
					echo 'deleted';
					exit();
				}
				else
				{
					echo 'error_deleting';
					exit();
				}
			}
			else
			{
				echo 'not_found';
				exit();
			}
		}
		else
		{
			echo 'error';
			exit();
		}
	}
	public function restockin_from_cart()
	{
		/* CHECK IF USER ID EXIST IN SESSION */
		if (isset($_SESSION['UserID'])) {

			/* VARIABLES */
			$user_id = $this->session->userdata('UserID');
			$status = 1;

			/* GET CART DATA BY USER ID */
			$Get_Cart_dataaa = $this->Model_Selects->Get_Cart_dataaa($user_id,$status);
			if ($Get_Cart_dataaa->num_rows() > 0) {

				foreach ($Get_Cart_dataaa->result_array() as $row) {

					$U_ID = $row['uid'];
					$Code = $row['product_sku'];
					$prd_rowdata = $this->Model_Selects->prd_rowdata($U_ID,$Code);
					if ($prd_rowdata->num_rows() > 0) {

						/* INSERT TO PRODUCT STOCKS */
						$total_price = $row['quantity'] * $row['original_price'];

						$data = array(
							'UID' => $row['uid'],
							'Product_SKU' => $row['product_sku'],
							'Stocks' => $row['quantity'],
							'Current_Stocks' => $row['quantity'],
							'Released_Stocks' => 0,
							'Retail_Price' => $row['retail_price'],
							'Price_PerItem' => $row['original_price'],
							'Total_Price' => $total_price,
							'Manufactured_By' => $row['manufacturer'],
							'Description' => $row['description'],
							'Expiration_Date' => $row['expiration'],
							'Date_Added' => $row['date_added'],
							'UserID' => $row['user_id'],
						);
						$Insert_toStock_tb = $this->Model_Inserts->Insert_toStock_tb($data);
						if ($Insert_toStock_tb == true) {

							/* UPDATE PRODUCT STOCKS */
							$prd = $prd_rowdata->row_array();

							$U_ID = $row['uid'];
							$Code = $row['product_sku'];
							$data = array(
								'InStock' => $prd['InStock'] + $row['quantity'],
							);
							$prd_update_stocks = $this->Model_Updates->prd_update_stocks($U_ID,$Code,$data);
							if ($prd_update_stocks != true) {
								$prompt_txt =
								'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
								<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
								$this->session->set_flashdata('prompt_status',$prompt_txt);
								redirect($_SERVER['HTTP_REFERER']);
							}

							/* UPDATE CART ITEM SET TO ADDED TO STOCK 2 */
							$Cart_ID = $row['id'];
							$status = 2;
							$cart_update_status = $this->Model_Updates->cart_update_status($Cart_ID,$status);
							if ($cart_update_status != true) {
								$prompt_txt =
								'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
								<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
								$this->session->set_flashdata('prompt_status',$prompt_txt);
								redirect($_SERVER['HTTP_REFERER']);
							}

							/* CREATE TRANSACTION */
							$code = $row['product_sku'];
							$type = 0;
							$amount = $row['quantity'];
							$date = $row['date_added'];

							$transactionID = '';
							$transactionID .= strtoupper($code);
							$transactionID .= '-';
							$transactionID .= strtoupper(uniqid());

							$data = array(
								'Code' => $code,
								'TransactionID' => $transactionID,
								'Type' => $type,
								'Amount' => $amount,
								'Date' => $date,
								'DateAdded' => date('Y-m-d h:i:s A'),
								'Status' => 1,
								'UserID' => $user_id,

								'PriceUnit' => $row['original_price'],
								'PriceTotal' => $total_price,
							);
							$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
							if ($insertNewTransaction == TRUE) {

								/* LOG TRANSACTIONS */
								$this->Model_Logbook->LogbookEntry('added new transaction.', ($type == '0' ? 'restocked ' : 'released ') . $amount . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $transactionID . '].', base_url('admin/viewproduct?code=' . $code));

								$prompt_txt =
								'<div class="alert alert-success position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
								<strong>Success!</strong> Product has been restocked.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
								$this->session->set_flashdata('prompt_status',$prompt_txt);

							}
							else
							{
								$prompt_txt =
								'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
								<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
								$this->session->set_flashdata('prompt_status',$prompt_txt);
								redirect($_SERVER['HTTP_REFERER']);
							}
						}
						else
						{
							$prompt_txt =
							'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					else
					{
						$prompt_txt =
						'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
						redirect($_SERVER['HTTP_REFERER']);
					}
				}


				redirect($_SERVER['HTTP_REFERER']);

			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Cart is empty!</strong> Add stock before restocking.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			redirect('');
		}
	}
	public function Get_Stock_details()
	{
		$UID = $this->input->post('uid');
		$Product_SKU = $this->input->post('prd_sku');
		if (empty($UID) || empty($Product_SKU)) {
			$data['prompt'] = array('status' => 'empty_var', );
			echo json_encode($data);
			exit();
		}
		else
		{
			$Get_Stock_indb = $this->Model_Selects->Get_Stock_indb($UID,$Product_SKU);
			if ($Get_Stock_indb->num_rows() > 0) {
				/* GET STOCK DETAILS */
				$gts = $Get_Stock_indb->row_array();
				$data['product_stocks'] = array(
					'id' => $gts['ID'],
					'uids' => $gts['UID'],
					'prd_sku' => $gts['Product_SKU'],
					'stocks' => $gts['Stocks'],
					'c_stocks' => $gts['Current_Stocks'],
					'r_stocks' => $gts['Released_Stocks'],
					'r_price' => $gts['Retail_Price'],
					'org_price' => $gts['Price_PerItem'],
					'total_price' => $gts['Total_Price'],
					'manufacturer' => $gts['Manufactured_By'],
					'description' => $gts['Description'],
					'exp_date' => $gts['Expiration_Date'],
					'date_added' => $gts['Date_Added'],
				);
				$data['prompt'] = array('status' => 'stock_found', );
				echo json_encode($data);
				exit();
			}
			else
			{
				$data['prompt'] = array('status' => 'stock_notfound', );
				echo json_encode($data);
				exit();
			}
		}
	}
	public function Getprd_stocks()
	{
		/* VARIABLES */
		$product_sku = $this->input->post('prd_sku');

		/* CHECK SKU IN PRODUCT TABLE */
		$Checkthis_prd_sku = $this->Model_Selects->Checkthis_prd_sku($product_sku);
		if ($Checkthis_prd_sku->num_rows() > 0) {

			/* CHECK UID AND SKU IN STOCKS */
			$prd = $Checkthis_prd_sku->row_array();
			$uid = $prd['U_ID'];

			$Check_thisstock = $this->Model_Selects->Check_thisstock($uid,$product_sku);
			if ($Check_thisstock->num_rows() > 0) {
				$data['prompt'] = array('status' => 'product_found_with_stock', );
				echo json_encode($data);
				exit();
			}
			else
			{
				$data['prompt'] = array('status' => 'product_found_no_stock', );
				echo json_encode($data);
				exit();
			}
		}
		else
		{
			$data['prompt'] = array('status' => 'product_notfound', );
			echo json_encode($data);
			exit();
		}
	}
	public function submit_get_prdstocks()
	{
		/* VARIABLES */
		$product_sku = $this->input->post('prd_sku');

		if (empty($product_sku)) {
			$data['prompt'] = array('status' => 'sku_input_null', );
			echo json_encode($data);
			exit();
		}

		/* CHECK SKU IN PRODUCT TABLE */
		$Checkthis_prd_sku = $this->Model_Selects->Checkthis_prd_sku($product_sku);
		if ($Checkthis_prd_sku->num_rows() > 0) {

			/* CHECK UID AND SKU IN STOCKS */
			$prd = $Checkthis_prd_sku->row_array();
			$uid = $prd['U_ID'];

			$Check_thisstock = $this->Model_Selects->Check_thisstock($uid,$product_sku);
			if ($Check_thisstock->num_rows() > 0) {

				/* GET STOCK DETAILS */
				$gts = $Check_thisstock->row_array();
				$data['product_stocks'] = array(
					'id' => $gts['ID'],
					'uids' => $gts['UID'],
					'prd_sku' => $gts['Product_SKU'],
					'stocks' => $gts['Stocks'],
					'c_stocks' => $gts['Current_Stocks'],
					'r_stocks' => $gts['Released_Stocks'],
					'r_price' => $gts['Retail_Price'],
					'org_price' => $gts['Price_PerItem'],
					'total_price' => $gts['Total_Price'],
					'manufacturer' => $gts['Manufactured_By'],
					'description' => $gts['Description'],
					'exp_date' => $gts['Expiration_Date'],
					'date_added' => $gts['Date_Added'],
				);
				$data['prompt'] = array('status' => 'stock_found', );
				echo json_encode($data);
				exit();
			}
			else
			{
				$data['prompt'] = array('status' => 'product_found_no_stock', );
				echo json_encode($data);
				exit();
			}
		}
		else
		{
			$data['prompt'] = array('status' => 'product_notfound', );
			echo json_encode($data);
			exit();
		}
	}
	public function submit_releasestockss()
	{
		$prompt_txt =
						'<div class="alert alert-warning position-absolute bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> Something\'s wrong while restocking. Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
	}
}
