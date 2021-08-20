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
	public function products()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Products';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
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
	public function FORM_addNewProduct()
	{	
		// Fetch data
		$code = $this->input->post('product-code');
		$name = $this->input->post('product-name');
		$category = $this->input->post('product-category');
		$description = $this->input->post('product-description');

		// Insert
		$data = array(
			'Code' => $code,
			'Product_Name' => $name,
			'Product_Category' => $category,
			'Description' => $description,
			'DateAdded' => date('Y-m-d h:i:s A'),
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
			// if ($type == 0) {
			// 	// ~~ restocked
			// 	$inStock += $amount;
			// } else {
			// 	// ~~ released
			// 	$inStock -= $amount;
			// }

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
}
