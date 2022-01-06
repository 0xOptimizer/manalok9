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
			'date_added' => $date_added
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
}
