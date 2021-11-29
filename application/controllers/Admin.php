<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public $globalData = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Logbook');
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
	public function index()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Dashboard';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);

		$c_year = date('Y');
		$c_month = date('m');
		// Total Products per month
		$all_months = array(
			'January' => '01',
			'February' => '02',
			'March' => '03',
			'April' => '04',
			'May' => '05',
			'June' => '06',
			'July' => '07',
			'August' => '08',
			'September' => '09',
			'October' => '10',
			'November' => '11',
			'December' => '12'
		);
		$mt = array();
		foreach ($all_months as $row => $val) {
			$tppm = $this->Model_Selects->C_Products_perMonth($c_year,$val);
			if ($tppm > 0) {
				$mt[] = $tppm['total'];
			}
			else
			{
				$mt[] = "0";
			}
		}
		$data['month_count'] = $mt;
		$data['all_months'] = $all_months;
		
		// Total product stock
		$data['tps'] = $this->Model_Selects->total_product_stocks();
		$data['tps_m'] = $this->Model_Selects->total_product_thismonth($c_year,$c_month);

		$this->load->view('admin/dashboard', $data);
	}
	public function users()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Users';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/users', $data);
	}
	public function vendors()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Vendors';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/vendors', $data);
	}
	public function clients()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Clients';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/clients', $data);
	}
	public function products()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Products';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);

		### FILL SELECT OPTIONS
		$data['AllItem_Code'] = $this->Model_Selects->AllItem_Code();
		$data['GetPROdtype'] = $this->Model_Selects->GetPROdtype();

		$this->load->view('admin/products', $data);
	}
	public function view_product()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Products';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/view_product', $data);
	}
	public function inventory()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Inventory';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/inventory', $data);
	}
	public function security()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Security Oveview';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/dashboard_security', $data);
	}
	public function view_transactions()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Transactions';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/page_transactions', $data);
	}
	public function purchase_orders()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_purchase_order()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/view_purchase_order', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_purchase_orders_summary()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Purchase Orders Summary';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/purchase_orders_summary', $data);
		} else {
			redirect(base_url());
		}
	}
	public function sales_orders()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders', $data);
		} else {
			redirect(base_url());
		}
	}
	public function bills()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Bills';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/bills', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_sales_order()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/view_sales_order', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_sales_orders_summary()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Sales Orders Summary';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/sales_orders_summary', $data);
		} else {
			redirect(base_url());
		}
	}
	public function invoices()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Invoices';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/invoices', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_settings_itemcode()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Item Code Settings';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$data['AllItem_Code'] = $this->Model_Selects->AllItem_Code();
		$this->load->view('admin/settings_itemcode', $data);
	}

	public function product_releasing()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Release Transactions';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$data['Filter_releaseprod'] = $this->Model_Selects->Filter_releaseprod();

		$user_id = $_SESSION['UserID'];
		$data['cart_releasing'] = $this->Model_Selects->cart_releasing($user_id);
		$this->load->view('admin/release_product', $data);
	}
	public function product_restocking()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Restock Transactions';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$data['Filter_restockprod'] = $this->Model_Selects->Filter_restockprod();
		$this->load->view('admin/restock_product', $data);
	}


	public function journals()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Journals';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/journal_transactions', $data);
		} else {
			redirect(base_url());
		}
	}
	public function accounts()
	{
		if ($this->session->userdata('Privilege') > 1) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Accounts';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounts', $data);
		} else {
			redirect(base_url());
		}
	}
	

	// Form inputs
	public function FORM_addNewUser()
	{	
		# PERSONAL INFORMATION
		$firstName = $this->input->post('firstName');
		$middleName = $this->input->post('middleName');
		$lastName = $this->input->post('lastName');
		$nameExtension = $this->input->post('nameExtension');
		$dateOfBirth = $this->input->post('birthDate');
		$contactNumber = $this->input->post('contactNumber');
		$address = $this->input->post('locationAddress');
		$comment = $this->input->post('adminComment');
		$privilege = $this->input->post('userPrivilege');

		$pImageChecker = $this->input->post('pImageChecker');
		$userID = uniqid();
		
		$config['upload_path'] = './uploads/'.$userID;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 4000;
		$config['max_width'] = 4000;
		$config['max_height'] = 4000;
		$this->load->library('upload', $config);
		if (!is_dir('uploads'))
		{
			mkdir('./uploads', 0777, true);
		}
		if (!is_dir('uploads/' . $userID))
		{
			mkdir('./uploads/' . $userID, 0777, true);
			$dir_exist = false;
		}
		if ($pImageChecker != NULL) {
			// Reminder: enctype="multipart/form-data" in the form tag;
			if ( ! $this->upload->do_upload('pImage'))
			{
				echo $this->upload->display_errors();
				exit();
				// redirect('NewEmployee');
			}
			else
			{
				$pImage = 'uploads/'.$userID.'/'.$this->upload->data('file_name');
				// Create thumbnail
				$this->load->library('image_lib');
				$tconfig['image_library'] = 'gd2';
				$tconfig['source_image'] = './uploads/'.$userID.'/'.$this->upload->data('file_name');
				$tconfig['create_thumb'] = TRUE;
				$tconfig['maintain_ratio'] = TRUE;
				$tconfig['width'] = 70;
				$tconfig['height'] = 70;
				$tconfig['new_image'] = './uploads/'.$userID.'/';

				$this->load->library('image_lib', $tconfig);
				$this->image_lib->initialize($tconfig);

				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
			        // $this->Model_Logbook->SetPrompts('error', 'error', $this->image_lib->display_errors() . $tconfig['source_image']);
				}
				$this->image_lib->clear();
			}
		} else {
			$pImage = 'assets/images/faces/1.jpg';
		}
		// INSERT EMPLOYEE
		$data = array(
			'UserID' => $userID,
			'Image' => $pImage,
			'FirstName' => $firstName,
			'MiddleName' => $middleName,
			'LastName' => $lastName,
			'NameExtension' => $nameExtension,
			'DateOfBirth' => $dateOfBirth,
			'ContactNumber' => $contactNumber,
			'Address' => $address,
			'Comment' => $comment,
			'Privilege' => ($privilege == NULL ? 0 : $privilege),
			'DateAdded' => date('Y-m-d h:i:s A'),
		);
		$insertNewEmployee = $this->Model_Inserts->InsertNewUser($data);
		if ($insertNewEmployee == TRUE) {
			$this->session->set_flashdata('isApplicantAdded', 'true');
			// $this->Model_Logbook->SetPrompts('success', 'success', 'New employee added.');
			// LOGBOOK
			$this->Model_Logbook->LogbookEntry('created a new user.', 'added a new user' . ($firstName ? ' ' . $firstName : '') . ($middleName ? ' ' . $middleName : '') . ($lastName ? ' ' . $lastName : '') . ' [UserID: ' . $userID . '].', base_url('admin/users'));
			// $this->Model_Logbook->LogbookExtendedEntry(0, 'Applicant ID: <b>' . $userID . '</b>');
			// $this->Model_Logbook->LogbookExtendedEntry(0, 'Referral: <b>' . $Referral . '</b>');
			redirect('admin/users');
		}
		else
		{
			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/users');
		}
	}
	public function FORM_updateUser()
	{	
		# PERSONAL INFORMATION
		$defaultImage = $this->input->post('defaultImage');
		$firstName = $this->input->post('firstName');
		$middleName = $this->input->post('middleName');
		$lastName = $this->input->post('lastName');
		$nameExtension = $this->input->post('nameExtension');
		$dateOfBirth = $this->input->post('birthDate');
		$contactNumber = $this->input->post('contactNumber');
		$address = $this->input->post('locationAddress');
		$comment = $this->input->post('adminComment');
		$privilege = $this->input->post('userPrivilege');

		$pImageChecker = $this->input->post('pImageChecker');
		$userID = $this->input->post('userID');

		$loginEmail = $this->input->post('loginEmail');
		$loginPassword = $this->input->post('newLoginPassword');
		
		$config['upload_path'] = './uploads/'.$userID;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 4000;
		$config['max_width'] = 4000;
		$config['max_height'] = 4000;
		$this->load->library('upload', $config);
		if (!is_dir('uploads'))
		{
			mkdir('./uploads', 0777, true);
		}
		if (!is_dir('uploads/' . $userID))
		{
			mkdir('./uploads/' . $userID, 0777, true);
			$dir_exist = false;
		}
		if ($pImageChecker != NULL) {
			// Reminder: enctype="multipart/form-data" in the form tag;
			if ( ! $this->upload->do_upload('pImage'))
			{
				echo $this->upload->display_errors();
				exit();
				redirect('NewEmployee');
			}
			else
			{
				$pImage = 'uploads/'.$userID.'/'.$this->upload->data('file_name');
				// Create thumbnail
				$this->load->library('image_lib');
				$tconfig['image_library'] = 'gd2';
				$tconfig['source_image'] = './uploads/'.$userID.'/'.$this->upload->data('file_name');
				$tconfig['create_thumb'] = TRUE;
				$tconfig['maintain_ratio'] = TRUE;
				$tconfig['width'] = 70;
				$tconfig['height'] = 70;
				$tconfig['new_image'] = './uploads/'.$userID.'/';

				$this->load->library('image_lib', $tconfig);
				$this->image_lib->initialize($tconfig);

				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
			        // $this->Model_Logbook->SetPrompts('error', 'error', $this->image_lib->display_errors() . $tconfig['source_image']);
				}
				$this->image_lib->clear();
			}
		} else {
			$pImage = $defaultImage;
		}
		// UPDATE EMPLOYEE
		$data = array(
			'Image' => $pImage,
			'FirstName' => $firstName,
			'MiddleName' => $middleName,
			'LastName' => $lastName,
			'NameExtension' => $nameExtension,
			'DateOfBirth' => $dateOfBirth,
			'ContactNumber' => $contactNumber,
			'Address' => $address,
			'Comment' => $comment,
			'Privilege' => $privilege,
			'DateAdded' => date('Y-m-d h:i:s A'),
		);
		$updateEmployee = $this->Model_Updates->UpdateUser($data, $userID);
		if ($updateEmployee == TRUE) {
			$this->Model_Logbook->LogbookEntry('updated user details.', 'updated details of user' . ($firstName ? ' ' . $firstName : '') . ($middleName ? ' ' . $middleName : '') . ($lastName ? ' ' . $lastName : '') . ' [UserID: ' . $userID . '].', base_url('admin/users'));
			if ($loginEmail != NULL && $loginPassword != NULL) {
				$loginData = array(
					'LoginEmail' => $loginEmail,
					'LoginPassword' => password_hash($loginPassword, PASSWORD_BCRYPT),
				);
				$updateEmployeeLogin = $this->Model_Updates->UpdateUserLogin($loginData, $userID);
				if ($updateEmployeeLogin) {
					$this->Model_Logbook->LogbookEntry('updated user login details.', 'updated login details of user' . ($loginEmail ? ' ' . $loginEmail : '') . ' [UserID: ' . $userID . '].', base_url('admin/users'));
					redirect('admin/users');
				} else {
					redirect('admin/users');
				}
			} else {
				redirect('admin/users');
			}
		}
		else
		{
			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/users');
		}
	}
	public function FORM_selfAddNewUser()
	{	
		# PERSONAL INFORMATION
		$firstName = "demo";
		$middleName = "demo";
		$lastName = "demo";
		$nameExtension = "demo";
		$dateOfBirth = $this->input->post('birthDate');
		$contactNumber = $this->input->post('contactNumber');
		$address = $this->input->post('locationAddress');

		$pImageChecker = $this->input->post('pImageChecker');
		$userID = uniqid();

		$loginEmail = $this->input->post('loginEmail');
		$loginPassword = $this->input->post('loginPassword');
		
		$config['upload_path'] = './uploads/'.$userID;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 4000;
		$config['max_width'] = 4000;
		$config['max_height'] = 4000;
		$this->load->library('upload', $config);
		if (!is_dir('uploads'))
		{
			mkdir('./uploads', 0777, true);
		}
		if (!is_dir('uploads/' . $userID))
		{
			mkdir('./uploads/' . $userID, 0777, true);
			$dir_exist = false;
		}
		if ($pImageChecker != NULL) {
			// Reminder: enctype="multipart/form-data" in the form tag;
			if ( ! $this->upload->do_upload('pImage'))
			{
				echo $this->upload->display_errors();
				exit();
				// redirect('NewEmployee');
			}
			else
			{
				$pImage = 'uploads/'.$userID.'/'.$this->upload->data('file_name');
				// Create thumbnail
				$this->load->library('image_lib');
				$tconfig['image_library'] = 'gd2';
				$tconfig['source_image'] = './uploads/'.$userID.'/'.$this->upload->data('file_name');
				$tconfig['create_thumb'] = TRUE;
				$tconfig['maintain_ratio'] = TRUE;
				$tconfig['width'] = 70;
				$tconfig['height'] = 70;
				$tconfig['new_image'] = './uploads/'.$userID.'/';

				$this->load->library('image_lib', $tconfig);
				$this->image_lib->initialize($tconfig);

				$this->image_lib->resize();
				if ( ! $this->image_lib->resize())
				{
			        // $this->Model_Logbook->SetPrompts('error', 'error', $this->image_lib->display_errors() . $tconfig['source_image']);
				}
				$this->image_lib->clear();
			}
		} else {
			$pImage = 'assets/images/faces/1.jpg';
		}
		// INSERT EMPLOYEE
		$data = array(
			'UserID' => $userID,
			'Image' => $pImage,
			'FirstName' => $firstName,
			'MiddleName' => $middleName,
			'LastName' => $lastName,
			'NameExtension' => $nameExtension,
			'DateOfBirth' => $dateOfBirth,
			'ContactNumber' => $contactNumber,
			'Address' => $address,
			'DateAdded' => date('Y-m-d h:i:s A'),
		);
		$insertNewEmployee = $this->Model_Inserts->InsertNewUser($data);
		if ($insertNewEmployee == TRUE) {
			$this->session->set_flashdata('isApplicantAdded', 'true');
			if ($loginEmail != NULL && $loginPassword != NULL) {
				$loginData = array(
					'UserID' => $userID,
					'LoginEmail' => $loginEmail,
					'LoginPassword' => password_hash($loginPassword, PASSWORD_BCRYPT),
				);
				$insertUserLogin = $this->Model_Inserts->InsertUserLogin($loginData);
				if ($insertUserLogin) {
					redirect('login');
				} else {
					redirect('login');
				}
			} else {
				redirect('login');
			}
		}
		else
		{
			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('login');
		}
	}
	public function FORM_addNewVendor()
	{	
		// Fetch data
		$vendorNo = 'V-' . str_pad($this->db->count_all('vendors') + 1, 6, '0', STR_PAD_LEFT);
		$name = $this->input->post('add-name');
		$tin = $this->input->post('add-tin');
		$address = $this->input->post('add-address');
		$contactNum = $this->input->post('add-contact-num');
		$kind = $this->input->post('add-kind');
		
		// Insert
		$data = array(
			'VendorNo' => $vendorNo,
			'Name' => $name,
			'TIN' => $tin,
			'Address' => $address,
			'ContactNum' => $contactNum,
			'ProductServiceKind' => $kind,
		);
		$insertNewVendor = $this->Model_Inserts->InsertNewVendor($data);
		if ($insertNewVendor == TRUE) {
			$vendorID = $this->db->insert_id();
			$this->session->set_flashdata('highlight-id', $vendorID);
			// $this->Model_Logbook->SetPrompts('success', 'success', 'New employee added.');
			// LOGBOOK
			$this->Model_Logbook->LogbookEntry('created a new vendor.', 'added a new vendor' . ($name ? ' ' . $name : '') . ' [ID: ' . $vendorID . '].', base_url('admin/vendors'));
			redirect('admin/vendors');
		}
		else
		{
			$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/vendors');
		}
	}
	public function FORM_updateVendor()
	{	
		// Fetch data
		$vendorID = $this->input->post('upd-vendor-id');
		$name = $this->input->post('upd-name');
		$tin = $this->input->post('upd-tin');
		$address = $this->input->post('upd-address');
		$contactNum = $this->input->post('upd-contact-num');
		$kind = $this->input->post('upd-kind');

		// Insert
		$data = array(
			'Name' => $name,
			'TIN' => $tin,
			'Address' => $address,
			'ContactNum' => $contactNum,
			'ProductServiceKind' => $kind,
		);
		$updateVendor = $this->Model_Updates->UpdateVendor($data, $vendorID);
		if ($updateVendor == TRUE) {
			$this->Model_Logbook->LogbookEntry('updated vendor details.', 'updated details of vendor' . ($name ? ' ' . $name : '') . ' [vendorID: ' . $vendorID . '].', base_url('admin/vendors'));
			$this->session->set_flashdata('highlight-id', $vendorID);
			redirect('admin/vendors');
		}
		else
		{
			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/vendors');
		}
	}
	public function FORM_addNewClient()
	{	
		// Fetch data
		$clientNo = 'C-' . str_pad($this->db->count_all('clients') + 1, 6, '0', STR_PAD_LEFT);
		$name = $this->input->post('add-name');
		$tin = $this->input->post('add-tin');
		$address = $this->input->post('add-address');
		$cityStateProvinceZip = $this->input->post('add-city-state-province-zip');
		$country = $this->input->post('add-country');
		$contactNum = $this->input->post('add-contact-num');
		$category = $this->input->post('add-category');
		$territoryManager = $this->input->post('add-territory-manager');

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
			$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/clients');
		}
	}
	public function FORM_updateClient()
	{	
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

		// Insert
		$data = array(
			'Name' => $name,
			'TIN' => $tin,
			'Address' => $address,
			'CityStateProvinceZip' => $cityStateProvinceZip,
			'Country' => $country,
			'ContactNum' => $contactNum,
			'Category' => $category,
			'TerritoryManager' => $territoryManager,
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
			redirect('admin/clients');
		}
	}
	public function FORM_addNewProduct()
	{
		require 'vendor/autoload.php';
		// Fetch data
		$code = $this->input->post('product-code');
		$name = $this->input->post('product-name');
		$category = $this->input->post('product-category');
		$pro_weight = $this->input->post('pro_weight') . ' ' . $this->input->post('pro_weight_size');
		$prc_pitem = $this->input->post('prc_pitem');
		$cst_pitem = $this->input->post('cst_pitem');
		
		$description = $this->input->post('product-description');
		
		// BARCODE GENEREATOR
		
		$colorblk = [0, 0, 0];
		$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
		file_put_contents('assets/barcode_images/'.$code.'-pbarcode.png', $generator->getBarcode($code, $generator::TYPE_CODE_128, 3, 50, $colorblk));

		// Insert
		$data = array(
			'Code' => $code,
			'Product_Name' => $name,
			'Product_Category' => $category,
			'Product_Weight' => $pro_weight,
			'Price_PerItem' => $prc_pitem,
			'Cost_PerItem' => $cst_pitem,
			'Description' => $description,
			'DateAdded' => date('Y-m-d h:i:s A'),
			'Barcode_Images' => 'assets/barcode_images/'.$code.'-pbarcode.png',
		);
		$insertNewProduct = $this->Model_Inserts->InsertNewProduct($data);
		if ($insertNewProduct == TRUE) {
			$this->session->set_flashdata('highlight-id', $code);
			// $this->Model_Logbook->SetPrompts('success', 'success', 'New employee added.');
			// LOGBOOK
			// $this->Model_Logbook->LogbookEntry('Green', 'Applicant', ' added a new applicant: <a class="logbook-tooltip-highlight" href="' . base_url() . 'ViewEmployee?id=' . $ApplicantID . '" target="_blank">' . ucfirst($LastName) . ', ' . ucfirst($FirstName) .  ' ' . ucfirst($MiddleName) . '</a>');
			$this->Model_Logbook->LogbookEntry('created a new product.', 'added a new product' . ($description ? ' ' . $description : '') . ' [Code: ' . $code . '].', base_url('admin/products'));


			// $this->Model_Logbook->LogbookExtendedEntry(0, 'Applicant ID: <b>' . $ApplicantID . '</b>');
			// $this->Model_Logbook->LogbookExtendedEntry(0, 'Referral: <b>' . $Referral . '</b>');
			redirect('admin/products');
		}
		else
		{
			$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/products');
		}
	}
	public function Add_newProductV2()
	{
		require 'vendor/autoload.php';

		// INSERT TO TABLE PRODUCT DETAILS
		$prd_brand1 = $this->input->post('prd_brand1');
		$prd_line = $this->input->post('prd_line');
		$prd_type = $this->input->post('prd_type');
		$prd_variant = $this->input->post('prd_variant');
		$prd_size = $this->input->post('prd_size');
		$prd_brand2 = $this->input->post('prd_brand2');
		$prd_char = $this->input->post('prd_char');
		$prd_chartype = $this->input->post('prd_chartype');
		// INSERT TO TABLE PRODUCTS
		$product_code = $this->input->post('product_code');
		$unit_cost = $this->input->post('unit_cost');
		$unit_price = $this->input->post('unit_price');
		$product_name = $this->input->post('product_name');
		$product_description = $this->input->post('product_description');

		// VALIDATE VALUES
		if ($prd_brand1 == null || $prd_line == null || $prd_type == null || $prd_variant == null || $prd_size == null || $prd_brand2 == null || $prd_char == null || $prd_chartype == null || $product_code == null || $unit_cost == null || $unit_price == null || $product_name == null || $product_description == null) {
			redirect('admin/products');
		}
		// CHECK PRODUCT IN DATABASE IF EXIST
		$Code = $product_code;
		$CheckProduct_byCode = $this->Model_Selects->CheckProduct_byCode($Code);
		if ($CheckProduct_byCode->num_rows() > 0) {
			// CANCEL INSERT PROMPT PRODUCT EXIST
			redirect('admin/products');
		}
		else
		{
			// BARCODE GENEREATOR
			$colorblk = [0, 0, 0];
			$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
			file_put_contents('assets/barcode_images/'.$product_code.'-pbarcode.png', $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 4, 70, $colorblk));

			// Insert
			$data = array(
				'Code' => $product_code,
				'Product_Name' => $product_name,
				'Product_Category' => $prd_type,
				'Product_Weight' => $prd_size,
				'Price_PerItem' => $unit_price,
				'Cost_PerItem' => $unit_cost,
				'Description' => $product_description,
				'DateAdded' => date('Y-m-d h:i:s A'),
				'Barcode_Images' => 'assets/barcode_images/'.$product_code.'-pbarcode.png',
				'Status' => 1, // Status = added
			);
			$insertNewProduct = $this->Model_Inserts->InsertNewProduct($data);
			if ($insertNewProduct == TRUE) {
				$data = array(
					'item_code' => $product_code,
					'first_brand' => $prd_brand1,
					'second_brand' => $prd_brand2,
					'prd_char' => $prd_char,
					'char_type' => $prd_chartype,
					'prd_line' => $prd_line,
					'prd_type' => $prd_type,
					'prd_variant' => $prd_variant,
					'prd_size' => $prd_size,
				);
				$InsertPrd_Details = $this->Model_Inserts->InsertPrd_Details($data);

				$this->session->set_flashdata('highlight-id', $product_code);
				$this->Model_Logbook->LogbookEntry('created a new product.', 'added a new product' . ($description ? ' ' . $description : '') . ' [Code: ' . $product_code . '].', base_url('admin/products'));

				redirect('admin/products');
			}
			else
			{
				$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				redirect('admin/products');
			}
		}
	}
	public function FORM_addNewTransaction()
	{	
		// Fetch data
		$code = $this->input->post('transaction-code');
		$type = $this->input->post('transaction-type');
		$amount = $this->input->post('transaction-amount');
		$date = $this->input->post('transaction-date');
		if ($this->session->userdata('Privilege') < 2 && $type == '1') {
			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/viewproduct?code=' . $code);
		} else {

			$getProductByCode = $this->Model_Selects->GetProductByCode($code);
			$get_prdsCol = $getProductByCode->row_array();
			// Prompts
			
			if ($type == 1) {
				if ($get_prdsCol['InStock'] < $amount) {
				// Code for Low on stocks
					echo "Low on STocks";
					exit();
				}
			}

			// // ~ calculate stocks changed
			// $inStock = 0;
			// if ($getProductByCode->num_rows() > 0) {
			// 	foreach($getProductByCode->result_array() as $row) {
			// 		$inStock = $row['InStock'];
			// 	}
			// }
			if ($type == 0) {
				// ~~ restocked
				$priceTotal = 0;
			// 	$inStock += $amount;
			} else {
				// ~~ released
				$priceTotal = $get_prdsCol['PriceSelling'] * $amount;
			// 	$inStock -= $amount;
			}

			// ~ creating transaction id
			$transactionID = '';
			$transactionID .= strtoupper($code);
			$transactionID .= '-';
			$transactionID .= strtoupper(uniqid());

			// Insert
			$data = array(
				'Code' => $code,
				'TransactionID' => $transactionID,
				'Type' => $type,
				'Amount' => $amount,
				'Date' => $date,
				'DateAdded' => date('Y-m-d h:i:s A'),
				'Status' => 0,
				'UserID' => $this->session->userdata('UserID'),

				'PriceTotal' => $priceTotal,
			);
			$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
			if ($insertNewTransaction == TRUE) {
				$this->session->set_flashdata('highlight-id', $transactionID);
				// $updateStocksCount = $this->Model_Updates->UpdateStocksCount($code, $inStock);
				// if ($updateStocksCount) {

				// } else {
				// 	// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				// redirect('admin/viewproduct?code=' . $code);
				// }
				$this->Model_Logbook->LogbookEntry('added new transaction.', ($type == '0' ? 'restocked ' : 'released ') . $amount . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $transactionID . '].', base_url('admin/viewproduct?code=' . $code));
				redirect('admin/viewproduct?code=' . $code);
			}
			else
			{
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				redirect('admin/viewproduct?code=' . $code);
			}
		}
	}
	// AJAX GET
	public function getTransactionDetails()
	{
		$transactionID = $this->input->get('transaction_id');
		$data = array('TransactionID' => $transactionID, );
		$getTransactionsByTransactionID = $this->Model_Selects->getall_transaction($data);
		print json_encode($getTransactionsByTransactionID);
	}
	public function FORM_approveTransaction()
	{
		if ($this->session->userdata('Privilege') < 2) {
			echo 'ERROR';
			exit();
		} else {
			$TransactionID = $this->input->post('transaction_id');

			$CheckIFApproved = $this->Model_Selects->CheckIFApproved($TransactionID);
			$code = $CheckIFApproved['Code'];
			$CheckStocksByCode = $this->Model_Selects->CheckStocksByCode($code);

			if ($CheckIFApproved['Status'] == 1) {
				echo 'APPROVED';
				exit();
			}
			if ($CheckIFApproved['Type'] == 0) {
				// RESTOCK
				$NewStock = $CheckStocksByCode['InStock'] + $CheckIFApproved['Amount'];
				$NewRelease = $CheckStocksByCode['Released'];
			}
			else
			{
				// RELEASE
				$NewStock = $CheckStocksByCode['InStock'] - $CheckIFApproved['Amount'];
				$NewRelease = $CheckStocksByCode['Released'] + $CheckIFApproved['Amount'];

				if ($CheckStocksByCode['InStock'] < $CheckIFApproved['Amount']) {
					echo 'NO_STOCK';
					exit();
				}
			}

			$data = array(
				'Code' => $code,
				'InStock' => $NewStock,
				'Released' => $NewRelease,
			);
			$UpdateStock_product = $this->Model_Updates->UpdateStock_product($data);
			if ($UpdateStock_product == TRUE) {
				$data = array(
					'TransactionID' => $TransactionID,
					'Status' => 1,
					'Date_Approval' => date('Y-m-d-H-i-s'),
				);
				$this->Model_Updates->ApproveTransaction($data);
				if ($CheckIFApproved['Type'] == 0) {
					$this->Model_Logbook->LogbookEntry('added new transaction.', ($CheckIFApproved['Type'] == '0' ? 'restocked ' : 'released ') . $CheckIFApproved['Amount'] . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $TransactionID . '].', base_url('admin/viewproduct?code=' . $code));
					echo 'NEW_STOCK_ADDED';
					exit();
				}
				else
				{
					$this->Model_Logbook->LogbookEntry('added new transaction.', ($CheckIFApproved['Type'] == '0' ? 'restocked ' : 'released ') . $CheckIFApproved['Amount'] . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $TransactionID . '].', base_url('admin/viewproduct?code=' . $code));
					echo 'STOCK_RELEASE';
					exit();
				}
			}
			else
			{
				echo 'ERROR';
				exit();
			}
		}
	}
	public function getOrderDetails() // UPDATE
	{
		$orderID = $this->input->get('order_id');
		$getTransactionsByPurchaseOrderID = $this->Model_Selects->GetOrderTransactions($orderID);
		print json_encode($getTransactionsByPurchaseOrderID->result_array());
	}
	// Database backup
	public function database_backup()
	{
		date_default_timezone_set('Asia/Manila');
		$this->load->dbutil();

		$date = date('Y-m-d-H-i-s');
		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'manalok9'.$date.'.sql'
		);


		$backup =& $this->dbutil->backup($prefs); 

		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 


		$this->load->helper('download');
		force_download($db_name, $backup);
	}

	// Purchase Orders
	public function FORM_addPurchaseOrder()
	{	
		if ($this->session->userdata('Privilege') > 1) {
			$orderNo = 'PO-' . str_pad($this->db->count_all('purchase_orders') + 1, 6, '0', STR_PAD_LEFT);
			$date = $this->input->post('date');
			$purchaseFromNo = $this->input->post('purchaseFromNo');
			$productCount = $this->input->post('productCount');
			$shipVia = $this->input->post('shipVia');
			$deliveryDate = $this->input->post('deliveryDate');

			if ($purchaseFromNo == 'newVendor') {
				$purchaseFromNo = 'V-' . str_pad($this->db->count_all('vendors') + 1, 6, '0', STR_PAD_LEFT);
				$name = $this->input->post('vendor-name');
				$tin = $this->input->post('vendor-tin');
				$address = $this->input->post('vendor-address');
				$contactNum = $this->input->post('vendor-contact-num');
				$kind = $this->input->post('vendor-kind');
				
				// Insert
				$data = array(
					'VendorNo' => $purchaseFromNo,
					'Name' => $name,
					'TIN' => $tin,
					'Address' => $address,
					'ContactNum' => $contactNum,
					'ProductServiceKind' => $kind,
				);
				$insertNewVendor = $this->Model_Inserts->InsertNewVendor($data);
			}

			// INSERT PURCHASE ORDER
			$data = array(
				'OrderNo' => $orderNo,
				'Date' => $date,
				'DateCreation' => date('Y-m-d h:i:s A'),
				'VendorNo' => $purchaseFromNo,
				'ShipVia' => $shipVia,
				'DateDelivery' => $deliveryDate,
				'Status' => '1',
			);
			$insertNewPurchaseOrder = $this->Model_Inserts->InsertPurchaseOrder($data);
			if ($insertNewPurchaseOrder == TRUE) {
				$orderID = $this->db->insert_id();
				// create new restock transactions
				for ($i = 0; $i < $productCount; $i++) {
					$code = trim($this->input->post('productCodeInput_' . $i));
					$unitPrice = trim($this->input->post('productPriceInput_' . $i));
					$qty = trim($this->input->post('productQtyInput_' . $i));
					$getProductByCode = $this->Model_Selects->GetProductByCode($code)->row_array();

					$data = array(
						'Code' => $code,
						'TransactionID' => strtoupper($code) . '-' . str_pad($this->db->count_all('products_transactions') + 1, 6, '0', STR_PAD_LEFT),
						'OrderNo' => $orderNo,
						'Type' => '0',
						'Amount' => $qty,
						'PriceUnit' => $unitPrice,
						'Date' => $date,
						'DateAdded' => date('Y-m-d h:i:s A'),
						'Status' => 0,
						'UserID' => $this->session->userdata('UserID'),
					);
					$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
				}
				$this->session->set_flashdata('highlight-id', $orderID);
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new purchase order.', 'added purchase order ' . $orderNo . ' [PurchaseOrderID: ' . $orderID . '].', base_url('admin/purchase_orders'));
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
	}
	public function FORM_approvePurchaseOrder()
	{
		$orderNo = $this->input->post('order_no');
		if ($this->session->userdata('Privilege') > 1) {
			$orderDetails = $this->Model_Selects->GetPurchaseOrderByNo($orderNo)->row_array();
			$approved = $this->input->post('approved');

			if ($approved == '1' && $orderDetails['Status'] == '1') { // if approved and pending
				$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($orderNo)->result_array();
				foreach ($orderTransactions as $key => $t) {
					if ($t['Status'] == 0) { // if not approved
						$p = $this->Model_Selects->CheckStocksByCode($t['Code']);
						// approve transaction
						$dataTransaction = array(
							'TransactionID' => $t['TransactionID'],
							'Status' => '1',
							'Date_Approval' => date('Y-m-d-H-i-s'),
						);
						// RESTOCK
						$NewStock = $p['InStock'] + $t['Amount'];
						$NewRelease = $p['Released'];
						$dataProduct = array(
							'Code' => $t['Code'],
							'InStock' => $NewStock,
							'Released' => $NewRelease,
						);
						$this->Model_Updates->ApproveTransaction($dataTransaction);
						$this->Model_Updates->UpdateStock_product($dataProduct);
					}
				}
				// update order status
				$data = array(
					'OrderNo' => $orderNo,
					'Status' => '2',
				);
				$this->Model_Updates->UpdatePurchaseOrder($data);

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
				}
				// update order status
				$data = array(
					'OrderNo' => $orderNo,
					'Status' => '0',
				);
				$this->Model_Updates->UpdatePurchaseOrder($data);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('rejected purchase order.', 'rejected purchase order ' . $orderDetails['OrderNo'] . ' [PurchaseOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_purchase_order?orderNo=' . $orderNo));
			}
		}
		redirect('admin/view_purchase_order?orderNo=' . $orderNo);
	}
	public function FORM_removePurchaseOrderTransaction()
	{
		$orderNo = $this->input->post('order_no');
		if ($this->session->userdata('Privilege') > 1) {
			$TransactionID = $this->input->post('transaction_id');

			$CheckIFApproved = $this->Model_Selects->CheckIFApproved($TransactionID);
			$code = $CheckIFApproved['Code'];
			$CheckStocksByCode = $this->Model_Selects->CheckStocksByCode($code);

			$orderDetails = $this->Model_Selects->GetPurchaseOrderByNo($orderNo)->row_array();

			if ($CheckIFApproved['Type'] == '0' && $CheckIFApproved['OrderNo'] != NULL && $orderDetails['Status'] == '1') { // if restocked, if status pending
				if ($CheckIFApproved['Status'] == '1') { // if approved, revert changes
					// RESTOCK
					$NewStock = $CheckStocksByCode['InStock'] + $CheckIFApproved['Amount'];
					$NewRelease = $CheckStocksByCode['Released'];
					$data = array(
						'Code' => $code,
						'InStock' => $NewStock,
						'Released' => $NewRelease,
					);
					$this->Model_Updates->UpdateStock_product($data);
				}
				
				$data = array(
					'TransactionID' => $TransactionID,
				);
				$removeOT = $this->Model_Updates->RemoveOrderTransaction($data);
				if ($removeOT == TRUE) {
					// if transactions is less than 1, change order status to rejected
					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($CheckIFApproved['OrderNo']);
					if ($orderTransactions->num_rows() < 1) {
						$data = array(
							'OrderNo' => $CheckIFApproved['OrderNo'],
							'Status' => '0',
						);
						$this->Model_Updates->UpdatePurchaseOrder($data);
					}
					// LOGBOOK
					$orderDetails = $this->Model_Selects->GetPurchaseOrderByNo($CheckIFApproved['OrderNo'])->row_array();
					$this->Model_Logbook->LogbookEntry('removed transaction from purchase order.', 'removed transaction ' . $TransactionID . ' from purchase order ' . $orderDetails['OrderNo'] . ' [PurchaseOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_purchase_order?orderNo=' . $orderNo));
				}
			}
		}
		redirect('admin/view_purchase_order?orderNo=' . $orderNo);
	}
	// Sales Orders
	public function FORM_addSalesOrder()
	{	
		if ($this->session->userdata('Privilege') > 1) {
			$orderNo = 'SO-' . str_pad($this->db->count_all('sales_orders') + 1, 6, '0', STR_PAD_LEFT);
			$date = $this->input->post('date');
			$billToNo = $this->input->post('billToNo');
			$shipToNo = $this->input->post('shipToNo');
			$productCount = $this->input->post('productCount');

			if ($billToNo == 'newBillClient') {
				$billToNo = 'C-' . str_pad($this->db->count_all('clients') + 1, 6, '0', STR_PAD_LEFT);
				$billName = $this->input->post('bill-name');
				$billTin = $this->input->post('bill-tin');
				$billAddress = $this->input->post('bill-address');
				$billCityStateProvinceZip = $this->input->post('bill-city-state-province-zip');
				$billCountry = $this->input->post('bill-country');
				$billContactNum = $this->input->post('bill-contact-num');
				$billCategory = $this->input->post('bill-category');
				$billTerritoryManager = $this->input->post('bill-territory-manager');

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
				);
				$insertNewClient = $this->Model_Inserts->InsertNewClient($data);

				if ($shipToNo == 'shipToBillingClient') { // set ship client no to bill no
					$shipToNo = $billToNo;
				}
			}
			if ($shipToNo == 'newShipClient') {
				$shipToNo = 'C-' . str_pad($this->db->count_all('clients') + 1, 6, '0', STR_PAD_LEFT);
				$shipName = $this->input->post('ship-name');
				$shipTin = $this->input->post('ship-tin');
				$shipAddress = $this->input->post('ship-address');
				$shipCityStateProvinceZip = $this->input->post('ship-city-state-province-zip');
				$shipCountry = $this->input->post('ship-country');
				$shipContactNum = $this->input->post('ship-contact-num');
				$shipCategory = $this->input->post('ship-category');
				$shipTerritoryManager = $this->input->post('ship-territory-manager');

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
				);
				$insertNewClient = $this->Model_Inserts->InsertNewClient($data);
			}

			// INSERT SALES ORDER
			$data = array(
				'OrderNo' => $orderNo,
				'Date' => $date,
				'DateCreation' => date('Y-m-d h:i:s A'),
				'BillToClientNo' => $billToNo,
				'ShipToClientNo' => $shipToNo,
				'Status' => '1',
			);
			$insertNewSalesOrder = $this->Model_Inserts->InsertSalesOrder($data);
			if ($insertNewSalesOrder == TRUE) {
				$orderID = $this->db->insert_id();
				// create new release transactions
				for ($i = 0; $i < $productCount; $i++) {
					$code = trim($this->input->post('productCodeInput_' . $i));
					$unitPrice = trim($this->input->post('productPriceInput_' . $i));
					$qty = trim($this->input->post('productQtyInput_' . $i));
					$getProductByCode = $this->Model_Selects->GetProductByCode($code)->row_array();

					$data = array(
						'Code' => $code,
						'TransactionID' => strtoupper($code) . '-' . str_pad($this->db->count_all('products_transactions') + 1, 6, '0', STR_PAD_LEFT),
						'OrderNo' => $orderNo,
						'Type' => '1',
						'Amount' => $qty,
						'PriceUnit' => $unitPrice,
						'Date' => $date,
						'DateAdded' => date('Y-m-d h:i:s A'),
						'Status' => 0,
						'UserID' => $this->session->userdata('UserID'),
					);
					$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
				}
				$this->session->set_flashdata('highlight-id', $orderID);
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new sales order.', 'added sales order ' . $orderNo . ' [SalesOrderID: ' . $orderID . '].', base_url('admin/sales_orders'));
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
	}
	public function FORM_approveSalesOrder()
	{
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
							// approve transaction
							$dataTransaction = array(
								'TransactionID' => $t['TransactionID'],
								'Status' => '1',
								'Date_Approval' => date('Y-m-d-H-i-s'),
							);
							// RELEASE
							$NewStock = $p['InStock'] - $t['Amount'];
							$NewRelease = $p['Released'] + $t['Amount'];
							$dataProduct = array(
								'Code' => $t['Code'],
								'InStock' => $NewStock,
								'Released' => $NewRelease,
							);
							$transactions[] = array(
								'dataTransaction' => $dataTransaction,
								'dataProduct' => $dataProduct,
							);
						} else {
							echo 'approval aborted, not enough stock for ' . $t['TransactionID'];
							exit();
						}
					}
				}
				foreach ($transactions as $row) { // update transactions/products with enough stock
					$this->Model_Updates->ApproveTransaction($row['dataTransaction']);
					$this->Model_Updates->UpdateStock_product($row['dataProduct']);
				}
				// update order status
				$data = array(
					'OrderNo' => $orderNo,
					'Status' => '2',
				);
				$this->Model_Updates->UpdateSalesOrder($data);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('approved sales order.', 'approved sales order ' . $orderDetails['OrderNo'] . ' [SalesOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
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
				}
				// update order status
				$data = array(
					'OrderNo' => $orderNo,
					'Status' => '0',
				);
				$this->Model_Updates->UpdateSalesOrder($data);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('rejected sales order.', 'rejected sales order ' . $orderDetails['OrderNo'] . ' [SalesOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
			}
		}
		redirect('admin/view_sales_order?orderNo=' . $orderNo);
	}
	public function FORM_removeSalesOrderTransaction()
	{
		$orderNo = $this->input->post('order_no');
		if ($this->session->userdata('Privilege') > 1) {
			$TransactionID = $this->input->post('transaction_id');

			$CheckIFApproved = $this->Model_Selects->CheckIFApproved($TransactionID);
			$code = $CheckIFApproved['Code'];
			$CheckStocksByCode = $this->Model_Selects->CheckStocksByCode($code);

			$orderDetails = $this->Model_Selects->GetSalesOrderByNo($orderNo)->row_array();

			if ($CheckIFApproved['Type'] == '1' && $CheckIFApproved['OrderNo'] != NULL && $orderDetails['Status'] == '1') { // if released, if status pending
				if ($CheckIFApproved['Status'] == '1') { // if approved, revert changes
					// RESTOCK
					$NewStock = $CheckStocksByCode['InStock'] + $CheckIFApproved['Amount'];
					$NewRelease = $CheckStocksByCode['Released'] - $CheckIFApproved['Amount'];
					$data = array(
						'Code' => $code,
						'InStock' => $NewStock,
						'Released' => $NewRelease,
					);
					$this->Model_Updates->UpdateStock_product($data);
				}
				
				$data = array(
					'TransactionID' => $TransactionID,
				);
				$removeOT = $this->Model_Updates->RemoveOrderTransaction($data);
				if ($removeOT == TRUE) {
					// if transactions is less than 1, change order status to rejected
					$orderTransactions = $this->Model_Selects->GetTransactionsByOrderNo($CheckIFApproved['OrderNo']);
					if ($orderTransactions->num_rows() < 1) {
						$data = array(
							'OrderNo' => $CheckIFApproved['OrderNo'],
							'Status' => '0',
						);
						$this->Model_Updates->UpdateSalesOrder($data);
					}
					// LOGBOOK
					$orderDetails = $this->Model_Selects->GetSalesOrderByNo($CheckIFApproved['OrderNo'])->row_array();
					$this->Model_Logbook->LogbookEntry('removed transaction from sales order.', 'removed transaction ' . $TransactionID . ' from sales order ' . $orderDetails['OrderNo'] . ' [SalesOrderID: ' . $orderDetails['ID'] . '].', base_url('admin/view_sales_order?orderNo=' . $orderNo));
				}
			}
		}
		redirect('admin/view_sales_order?orderNo=' . $orderNo);
	}

	// VENDOR / CLIENT
	public function getVendorDetails()
	{
		$vendorID = $this->input->get('vendor_id');
		$getVendorByID = $this->Model_Selects->GetVendorByID($vendorID)->row_array();
		print json_encode($getVendorByID);
	}
	public function getClientDetails()
	{
		$clientID = $this->input->get('client_id');
		$getClientByID = $this->Model_Selects->GetClientByID($clientID)->row_array();
		print json_encode($getClientByID);
	}
	public function get_productDetails()
	{
		$product_id = $this->input->post('product_code');
		$Get_productByPID = $this->Model_Selects->Get_productByPID($product_id);
		if ($Get_productByPID->num_rows() > 0) {
			$nrow = $Get_productByPID->row_array();
			$data = array(
				'Status' => 'success',
				'Code' => $nrow['Code'],
				'Product_Name' => $nrow['Product_Name'],
				'Description' => $nrow['Description'],
				'InStock' => $nrow['InStock'],
				'Released' => $nrow['Released'],
				'Product_Category' => $nrow['Product_Category'],
				'Product_Weight' => $nrow['Product_Weight'],
				'Price_PerItem' => $nrow['Price_PerItem'],

			);
			$result = json_encode($data);
			echo $result;
			exit();
		}
		else
		{
			$data = array(
				'Status' => 'error',
			);
			$result = json_encode($data);
			echo $result;
			exit();
		}
	}
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

	### UNIQUE ID START
	public function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min;
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1;
		$bits = (int) $log + 1;
		$filter = (int) (1 << $bits) - 1;
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter;
		} while ($rnd > $range);
		return $min + $rnd;
	}
	public function getToken($length)
	{
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet);

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
	    }

	    return $token;
	}
	### UNIQUE ID END
	public function SubmitNewItemcode()
	{
		### SET TIMEZONE TO PH
		date_default_timezone_set('Asia/Manila');

		### GENERATE UNIQUE ID
		$length = 44;
		$ntokkken = $this->getToken($length);

		### VARIABLES
		$unID = $ntokkken;
		$brand_top = $this->input->post('brand_top');
		$cat_char = $this->input->post('cat_char');
		$prod_type = $this->input->post('prod_type');
		$brand_bot = $this->input->post('brand_bot');
		$prod_line = $this->input->post('prod_line');
		$new_type = $this->input->post('new_type');
		$prod_variant = $this->input->post('prod_variant');
		$prod_size = $this->input->post('prod_size');
		$prod_itemcode = $this->input->post('prod_itemcode');
		$timezone = date_default_timezone_get();

		### CHECK ITEM CODE IF EXIST
		$CheckItemCode = $this->Model_Selects->CheckItemCode($prod_itemcode);
		if ($CheckItemCode->num_rows() > 0) {
			### PROMPT ITEM CODE EXIST
			redirect('admin/settings_itemcodepage');
		}
		### CONDITIONS
		if ($brand_top == NULL || $cat_char == NULL || $prod_type == NULL || $brand_bot == NULL || $prod_line == NULL || $new_type == NULL || $prod_variant == NULL || $prod_size == NULL || $prod_itemcode == NULL ) {
			### ERROR PROMPT
			redirect('admin/settings_itemcodepage');
		}
		else
		{
			### INSERT TO TABLE
			$data = array(
				'uniqueID' => $unID, 
				'Brand_Top' => $brand_top, 
				'Cat_Char' => $cat_char, 
				'Prod_Type' => $prod_type, 
				'Brand_Bot' => $brand_bot, 
				'Prod_Line' => $prod_line, 
				'New_Type' => $new_type, 
				'Prod_Variant' => $prod_variant, 
				'Prod_Size' => $prod_size, 
				'ItemCode' => $prod_itemcode, 
				'TimeStamp' => $timezone, 
			);

			$AddNewItem_Code = $this->Model_Inserts->AddNewItem_Code($data);
			if ($AddNewItem_Code == TRUE) {
				### PROMPT SUCCESS
				redirect('admin/settings_itemcodepage');
			}
			else
			{
				### PROMPT ERROR
				redirect('admin/settings_itemcodepage');
			}
		}
	}
	public function remove_thisicode()
	{
		$uniqueID = $this->input->get('uid');
		$CheckItemcode_byuid = $this->Model_Selects->CheckItemcode_byuid($uniqueID);
		if ($CheckItemcode_byuid->num_rows() < 1) {

			### UNIQUE ID DOES'NT EXIST THEN PROMPT
			redirect('admin/settings_itemcodepage');
		}
		else
		{
			### DELETE USING UNIQUE ID THEN PROMPT
			$remove_itemCode = $this->Model_Updates->remove_itemCode($uniqueID);
			if ($remove_itemCode == TRUE) {

				### PROMPT SUCCESS
				redirect('admin/settings_itemcodepage');
			}
			else
			{

				### PROMPT ERROR
				redirect('admin/settings_itemcodepage');
			}
		}
	}
	public function Restock_from_cart()
	{
		if (!isset($_SESSION['cart_sess'])) {
			### PROMPT ERROR CART EMPTY OR NO SESSION CART
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$cart_data = $_SESSION['cart_sess'];
			foreach ($cart_data as $row => $val) {
				$Code = $val['item_code'];

				$CheckProduct_restock = $this->Model_Selects->CheckProduct_restock($Code);

				if ($CheckProduct_restock->num_rows() > 0) {
					$cpres = $CheckProduct_restock->row_array();

					$dbCode = $cpres['Code'];
					$dbInStock = $cpres['InStock'];

					$nCode = $val['item_code'];
					$nInStock = $val['qty'];

					$newStock = $nInStock + $dbInStock;
					$UpdateStock_fromCart = $this->Model_Updates->UpdateStock_fromCart($nCode,$newStock);

					// Fetch data
					$code = $Code;
					$type = 0;
					$amount = $nInStock;
					$date = '';

					$getProductByCode = $this->Model_Selects->GetProductByCode($code);
					$get_prdsCol = $getProductByCode->row_array();

					$total_price = $nInStock * $get_prdsCol['Price_PerItem'];

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
						'PriceUnit' => $get_prdsCol['Price_PerItem'],
						'PriceTotal' => $total_price,
					);
					$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
					if ($insertNewTransaction == TRUE) {

						$this->Model_Logbook->LogbookEntry('added new transaction.', ($type == '0' ? 'restocked ' : 'released ') . $amount . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $transactionID . '].', base_url('admin/viewproduct?code=' . $code));
					}
				}
			}
			unset($_SESSION['cart_sess']);
			redirect($_SERVER['HTTP_REFERER']);
			
		}
	}
	public function release_fromcart()
	{
		$this->load->model('Model_Updates');

		$user_id = $this->session->userdata('UserID');
		$status = 0;
		$Getsum_releasequantity = $this->Model_Selects->Getsum_releasequantity($user_id,$status);
		foreach ($Getsum_releasequantity->result_array() as $row) {

			// FROM CART RELEASE
			$cart_id = $row['cart_id'];
			$Code = $row['item_code'];
			$cart_quantity = $row['quantity'];
			$total_price = $row['total_price'];

			$Get_ProductRow = $this->Model_Selects->Get_ProductRow($Code);
			if ($Get_ProductRow->num_rows() > 0) {
				// UPDATE RELEASE
				$gprow = $Get_ProductRow->row_array();

				$Released = $cart_quantity + $gprow['Released'];
				$UpdateReleasedata = $this->Model_Updates->UpdateReleasedata($Code,$Released);
				if ($UpdateReleasedata == true) {
					// UPDATE CART ID STATUS TO APPROVED
					$Update_CartRelease = $this->Model_Updates->Update_CartRelease($cart_id);
					if ($Update_CartRelease == true) {

						// Fetch data
						$code = $Code;
						$type = 1;
						$amount = $cart_quantity;
						$date = $row['time_stamp'];
						
						$getProductByCode = $this->Model_Selects->GetProductByCode($code);
						$get_prdsCol = $getProductByCode->row_array();


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
							'PriceUnit' => $get_prdsCol['Price_PerItem'],
							'PriceTotal' => $total_price,
						);
						$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
						if ($insertNewTransaction == TRUE) {

							$this->Model_Logbook->LogbookEntry('added new transaction.', ($type == '0' ? 'restocked ' : 'released ') . $amount . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $transactionID . '].', base_url('admin/viewproduct?code=' . $code));
							redirect($_SERVER['HTTP_REFERER']);
						}
						else
						{
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					else
					{
						echo "ERROR1";
					}
				}
				else
				{
					echo 'ERROR2';
				}
			}
			else
			{
				echo 'ERROR3';
			}

		}
		

	}
	public function FORM_addAccount()
	{	
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$description = $this->input->post('description');

		// Insert
		$data = array(
			'Name' => $name,
			'Type' => $type,
			'Description' => $description,
		);
		$getAccountByName = $this->Model_Selects->getAccountByName($name);
		if ($getAccountByName->num_rows() < 1) {
			$insertAccount = $this->Model_Inserts->InsertAccount($data);
			if ($insertAccount == TRUE) {
				$accountID = $this->db->insert_id();
				$this->session->set_flashdata('highlight-id', $accountID);
				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new account.', 'added a new account' . ($name ? ' ' . $name : '') . ' [ID: ' . $accountID . '].', base_url('admin/accounts'));
				redirect('admin/accounts');
			}
			else
			{
				$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				redirect('admin/accounts');
			}
		} else {
			$this->Model_Logbook->SetPrompts('error', 'error', 'Account with the same name already exists. ['. $name .']');
			redirect('admin/accounts');
		}
	}

	public function FORM_addJournal()
	{	
		$description = $this->input->post('description');
		$date = $this->input->post('date');

		$transactionCount = $this->input->post('transactions-count');

		// Insert
		$data = array(
			'Description' => $description,
			'Date' => $date
		);
		$insertJournal = $this->Model_Inserts->InsertJournal($data);
		if ($insertJournal == TRUE) {
			$journalID = $this->db->insert_id();

			// create new journal transactions
			for ($i = 0; $i < $transactionCount; $i++) {
				$accountID = trim($this->input->post('accountIDInput_' . $i));
				$debit = trim($this->input->post('debitInput_' . $i));
				$credit = trim($this->input->post('creditInput_' . $i));

				$data = array(
					'JournalID' => $journalID,
					'AccountID' => $accountID,
					'Debit' => $debit,
					'Credit' => $credit,
				);
				$insertJournalTransaction = $this->Model_Inserts->InsertJournalTransaction($data);
			}

			$this->session->set_flashdata('highlight-id', $journalID);
			// LOGBOOK
			$this->Model_Logbook->LogbookEntry('created a new journal.', 'added a new journal [ID: ' . $journalID . '].', base_url('admin/journals'));
			redirect('admin/journals');
		}
		else
		{
			$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
			redirect('admin/journals');
		}
	}
	

	public function move_to_archive()
	{
		$Code = $this->input->get('code');
		// CHECK IF CODE EXIST
		$CheckProduct_byCode = $this->Model_Selects->CheckProduct_byCode($Code);
		if ($CheckProduct_byCode->num_rows() > 0) {
			// UPDATE STATUS SET TO 2 = ARCHIVED
			$MoveProd_toarchive = $this->Model_Updates->MoveProd_toarchive($Code);
			if ($MoveProd_toarchive == true) {
				redirect($_SERVER['HTTP_REFERER']);

			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);

			}
		}
		else
		{
			redirect($_SERVER['HTTP_REFERER']);

		}
	}

	// SETTINGS BRAND CATEGORY
	public function view_settings_bcat()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Brand Category Settings';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		// GET ALL BRANDS
		$data['All_Brands'] = $this->Model_Selects->All_Brands();
		$this->load->view('admin/settings_brandcat', $data);
	}
	public function Add_BrandCategory()
	{

		$brand_name = $this->input->post('brand_name');
		$brand_char = $this->input->post('brand_char');
		$brand_type = $this->input->post('brand_type');

		$brand_name_abbr = $this->input->post('brand_name_abbr');
		$brand_type_abbr = $this->input->post('brand_type_abbr');
		$prod_line = $this->input->post('prod_line');
		$prod_line_abbr = $this->input->post('prod_line_abbr');
		$prod_type = $this->input->post('prod_type');
		$prod_type_abbr = $this->input->post('prod_type_abbr');

		$prod_size = $this->input->post('prod_size');
		$prod_size_abbr = $this->input->post('prod_size_abbr');
		$vcpd = $this->input->post('vcpd');
		$vcpd_abbr = $this->input->post('vcpd_abbr');

		$length = 22;
		$UniqueID = $this->getToken($length);

		if ($brand_name == null || $brand_char == null || $brand_type == null || $brand_name_abbr == null || $brand_type_abbr == null || $prod_line == null || $prod_line_abbr == null || $prod_type == null || $prod_type_abbr == null) {
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$data = array(
				'Brand_Name' => strtoupper($brand_name),
				'Brand_Char' => strtoupper($brand_char),
			);
			$CheckBrand_Char = $this->Model_Selects->CheckBrand_Char($data);
			if ($CheckBrand_Char->num_rows() > 0) {
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{

				$data = 
				array(
					'Brand_Name' => strtoupper($brand_name),
					'Brand_Char' => str_pad($brand_char, 3, '0', STR_PAD_LEFT),
					'Brand_Type' => strtoupper($brand_type),
					'UniqueID' => $UniqueID,
				);

				$Insert_BrandCategory = $this->Model_Inserts->Insert_BrandCategory($data);
				if ($Insert_BrandCategory == true) {
					$data = array(
						'UniqueID' => $UniqueID,
						'Brand_Abbr' => strtoupper($brand_name_abbr),
						'Brand_Type_Abbr' => strtoupper($brand_type_abbr),
						'Product_Line' => strtoupper($prod_line),
						'Product_line_Abbr' => strtoupper($prod_line_abbr),
						'Product_Type' => strtoupper($prod_type),
						'Product_Type_Abbr' => strtoupper($prod_type_abbr),
					);
					$Insert_BrandProperties = $this->Model_Inserts->Insert_BrandProperties($data);

					if (!empty($prod_size) || !empty($prod_size_abbr)) {
						$data = array(
							'UniqueID' => $UniqueID,
							'Product_Size' => strtoupper($prod_size),
							'Product_Size_Abbr' => strtoupper($prod_size_abbr),
						);
						$Insert_BrandSizes = $this->Model_Inserts->Insert_BrandSizes($data);
					}
					
					if (!empty($vcpd) || !empty($vcpd_abbr)) {
						$data = array(
							'UniqueID' => $UniqueID,
							'Vcpd' => strtoupper($vcpd),
							'Vcpd_Abbr' => strtoupper($vcpd_abbr),
						);
						$Insert_BrandVariants = $this->Model_Inserts->Insert_BrandVariants($data);
					}
					
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}
	public function Update_BrandCategory()
	{

		$UniqueID = $this->input->post('uid');
		$brand_name = $this->input->post('brand_name');
		$brand_char = $this->input->post('brand_char');
		$brand_type = $this->input->post('brand_type');

		$brand_name_abbr = $this->input->post('brand_name_abbr');
		$brand_type_abbr = $this->input->post('brand_type_abbr');
		$prod_line = $this->input->post('prod_line');
		$prod_line_abbr = $this->input->post('prod_line_abbr');
		$prod_type = $this->input->post('prod_type');
		$prod_type_abbr = $this->input->post('prod_type_abbr');

		if ($brand_name == null || $brand_char == null || $brand_type == null || $brand_name_abbr == null || $brand_type_abbr == null || $prod_line == null || $prod_line_abbr == null || $prod_type == null || $prod_type_abbr == null) {
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$CheckBrand_UniqueID = $this->Model_Selects->CheckBrand_UniqueID($UniqueID);
			if ($CheckBrand_UniqueID->num_rows() > 0) {
				$data = array(
					'Brand_Name' => strtoupper($brand_name),
					'Brand_Char' => str_pad($brand_char, 3, '0', STR_PAD_LEFT),
					'Brand_Type' => strtoupper($brand_type),
				);
				$Update_BrandCat = $this->Model_Updates->Update_BrandCat($UniqueID,$data);
				if ($Update_BrandCat == true) {
					$data = array(
						'Brand_Abbr' => strtoupper($brand_name_abbr),
						'Brand_Type_Abbr' => strtoupper($brand_type_abbr),
						'Product_Line' => strtoupper($prod_line),
						'Product_line_Abbr' => strtoupper($prod_line_abbr),
						'Product_Type' => strtoupper($prod_type),
						'Product_Type_Abbr' => strtoupper($prod_type_abbr),
					);
					$Update_BrandProperty = $this->Model_Updates->Update_BrandProperty($UniqueID,$data);
					if ($Update_BrandProperty == true) {
						redirect($_SERVER['HTTP_REFERER']);

					}
					else
					{
						redirect($_SERVER['HTTP_REFERER']);

					}
				}
				else
				{
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	public function Add_BrandVariant()
	{
		$uid = $this->input->post('uid');
		$vcpd = $this->input->post('vcpd');
		$vcpdabr = $this->input->post('vcpdabr');
		if (empty($uid) || empty($vcpd) || empty($vcpdabr)) {
			echo "Empty Fields!";
			exit();
		}
		else
		{
			$UniqueID = $uid;
			$CheckBrand_UniqueID = $this->Model_Selects->CheckBrand_UniqueID($UniqueID);
			if ($CheckBrand_UniqueID->num_rows() > 0) {
				$data = array(
					'UniqueID' => $uid,
					'Vcpd' => $vcpd,
					'Vcpd_Abbr' => $vcpdabr,
				);
				$AddBrand_Var = $this->Model_Inserts->AddBrand_Var($data);
				if ($AddBrand_Var == true) {
					echo "Variant added!";
					exit();
				}
				else
				{
					echo "Error";
					exit();
				}
			}
			else
			{
				echo "It doesn'\t exist!";
				exit();
			}
		}
	}
}
