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
		$this->load->model('Model_Updates');
		$this->load->model('Model_Deletes');
		if ($this->Model_Security->CheckPrivilegeLevel() >= 0) {
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
		if (!$this->Model_Security->CheckPrivilegeLevel()) {
			redirect();
		}
		// $this->output->enable_profiler(TRUE);
	}

	

// ############################ [ RELEASING ] ############################
	// public function product_releasing()
	// {
	// 	$data = [];
	// 	$data = array_merge($data, $this->globalData);
	// 	$header['pageTitle'] = 'Release Transactions';
	// 	$data['globalHeader'] = $this->load->view('main/globals/header', $header);
	// 	$data['Filter_releaseprod'] = $this->Model_Selects->Filter_releaseprod();

	// 	$user_id = $_SESSION['UserID'];
	// 	$data['cart_releasing'] = $this->Model_Selects->cart_releasing($user_id);
	// 	$this->load->view('admin/release_product', $data);
	// }

// ############################ [ RESTOCKING ] ############################
	// public function product_restocking()
	// {
	// 	$data = [];
	// 	$data = array_merge($data, $this->globalData);
	// 	$header['pageTitle'] = 'Restock Transactions';
	// 	$data['globalHeader'] = $this->load->view('main/globals/header', $header);
	// 	$data['Filter_restockprod'] = $this->Model_Selects->Filter_restockprod();
	// 	$this->load->view('admin/restock_product', $data);
	// }

	// public function view_transactions()
	// {
	// 	$data = [];
	// 	$data = array_merge($data, $this->globalData);
	// 	$header['pageTitle'] = 'Transactions';
	// 	$data['globalHeader'] = $this->load->view('main/globals/header', $header);
	// 	$this->load->view('admin/page_transactions', $data);
	// }

// ############################ [ PRODUCT SETTINGS ] ############################
	// public function view_settings_itemcode()
	// {
	// 	$data = [];
	// 	$data = array_merge($data, $this->globalData);
	// 	$header['pageTitle'] = 'Item Code Settings';
	// 	$data['globalHeader'] = $this->load->view('main/globals/header', $header);
	// 	$data['AllItem_Code'] = $this->Model_Selects->AllItem_Code();
	// 	$this->load->view('admin/settings_itemcode', $data);
	// }

// ############################ [ DASHBOARD ] ############################
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
			$tppm = $this->Model_Selects->C_Stocks_perMonth($c_year,$val);
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
		// $data['tps_m'] = $this->Model_Selects->total_product_thismonth($c_year,$c_month);

		// TOTAL PRODUCT STOCK THIS MONTH
		$data['totalrestock'] = $this->Model_Selects->total_restock();
		/* TOTAL RELEASED */
		$data['total_released'] = $this->Model_Selects->total_released();
		
		$this->load->view('admin/dashboard', $data);
	}
	public function security()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Security Oveview';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('admin/dashboard_security', $data);
	}

// ############################ [ PRODUCTS ] ############################
	public function products()
	{
		if ($this->Model_Security->CheckUserRestriction('products_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Products';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);

			### FILL SELECT OPTIONS
			$data['AllItem_Code'] = $this->Model_Selects->AllItem_Code();
			$data['GetPROdtype'] = $this->Model_Selects->GetPROdtype();

			$data['Get_Brand_Data'] = $this->Model_Selects->Get_Brand_Data();

			$this->load->view('admin/products', $data);
		} else {
			redirect(base_url());
		}
	}
	public function view_product()
	{
		if ($this->Model_Security->CheckUserRestriction('products_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Products';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/view_product', $data);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ INVENTORY ] ############################
	public function inventory()
	{
		if ($this->Model_Security->CheckUserRestriction('inventory_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Inventory';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/inventory', $data);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ USERS ] ############################
	public function users()
	{
		if ($this->Model_Security->CheckUserRestriction('users_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Users';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/users', $data);
		} else {
			redirect(base_url());
		}
	}
	public function user_activities()
	{
		if ($this->Model_Security->CheckUserRestriction('users_activities')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'User Activities';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/user_activities', $data);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ BRANDING ] ############################
	public function view_settings_bcat()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Brand Category Settings';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			// GET ALL BRANDS
			$data['All_Brands'] = $this->Model_Selects->All_Brands();
			$this->load->view('admin/settings_brandcat', $data);
		} else {
			redirect(base_url());
		}
	}

// ############################ [ TRASH BIN ] ############################
	public function trash_bin()
	{
		if ($this->Model_Security->CheckUserRestriction('trash_bin_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Trash';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);

			// GET ALL PRODUCTS IN TRASH
			$data['Trashed_Products'] = $this->Model_Selects->Trashed_Products();

			$this->load->view('admin/trash_bin', $data);
		} else {
			redirect(base_url());
		}
	}
	
// ############################ [ PAGE MAIL ] ############################
	public function page_mail()
	{
		if ($this->Model_Security->CheckUserRestriction('mail_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Mail';

			$data['GetAll_Mail'] = $this->Model_Selects->GetAll_Mail();

			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/page_mail', $data);
		} else {
			redirect(base_url());
		}
	}


	// Form inputs
	public function FORM_addNewUser()
	{
		if ($this->Model_Security->CheckUserRestriction('users_add')) {
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

			// USER RESTRICTIONS
			$userRestrictions = array();
			foreach ($this->config->item('user_restrictions') as $restriction) {
				$userRestrictions[$restriction] = ($this->input->post($restriction) == 'on' ? '1' : '0');
			}


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
						$prompt_txt =
						'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> '. $this->image_lib->display_errors() . $tconfig['source_image'] .'
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
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
				
				// INSERT USER RESTRICTIONS
				$data = $userRestrictions;
				$data['UserID'] = $userID;
				$this->Model_Inserts->InsertUserRestrictions($data);

				// LOGBOOK
				$this->Model_Logbook->LogbookEntry('created a new user.', 'added a new user' . ($firstName ? ' ' . $firstName : '') . ($middleName ? ' ' . $middleName : '') . ($lastName ? ' ' . $lastName : '') . ' [UserID: ' . $userID . '].', base_url('admin/users'));
				// $this->Model_Logbook->LogbookExtendedEntry(0, 'Applicant ID: <b>' . $userID . '</b>');
				// $this->Model_Logbook->LogbookExtendedEntry(0, 'Referral: <b>' . $Referral . '</b>');
				redirect('admin/users');
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
				redirect('admin/users');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateUser()
	{
		if ($this->Model_Security->CheckUserRestriction('users_edit')) {
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

			// USER RESTRICTIONS
			$userRestrictions = array();
			foreach ($this->config->item('user_restrictions') as $restriction) {
				$userRestrictions[$restriction] = ($this->input->post($restriction .'_update') == 'on' ? '1' : '0');
			}
			
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
						$prompt_txt =
						'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> '. $this->image_lib->display_errors() . $tconfig['source_image'] .'
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
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
				// UPDATE RESTRICTIONS
				$GetUserRestrictions = $this->Model_Selects->GetUserRestrictions($userID);

				$data = $userRestrictions;
				if ($GetUserRestrictions->num_rows() > 0) {
					$this->Model_Updates->UpdateUserRestrictions($userID, $data);
				} else {
					// INSERT USER RESTRICTIONS IF NOT EXISTING
					$data['UserID'] = $userID;
					$this->Model_Inserts->InsertUserRestrictions($data);
				}

				$this->Model_Logbook->LogbookEntry('updated user details.', 'updated details of user' . ($firstName ? ' ' . $firstName : '') . ($middleName ? ' ' . $middleName : '') . ($lastName ? ' ' . $lastName : '') . ' [UserID: ' . $userID . '].', base_url('admin/users'));
				if ($this->Model_Security->CheckUserRestriction('users_edit_login')) {
					if (($loginEmail != NULL && $loginPassword != NULL) || ($loginEmail != NULL && $loginPassword == NULL)) {
						if ($loginEmail != NULL && $loginPassword == NULL) {
							$loginData = array(
								'LoginEmail' => $loginEmail,
							);
						} else {
							$loginData = array(
								'LoginEmail' => $loginEmail,
								'LoginPassword' => password_hash($loginPassword, PASSWORD_BCRYPT),
							);
						}
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
				} else {
					redirect('admin/users');
				}
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
				redirect('admin/users');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_selfAddNewUser()
	{
		if ($this->Model_Security->CheckUserRestriction('users_add')) {
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
						$prompt_txt =
						'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Warning!</strong> '. $this->image_lib->display_errors() . $tconfig['source_image'] .'
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
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

				// USER RESTRICTIONS
				$userRestrictions = array();
				foreach ($this->config->item('user_restrictions') as $restriction) {
					$userRestrictions[$restriction] = 0;
				}
				$data = $userRestrictions;
				$data['UserID'] = $userID;
				$this->Model_Inserts->InsertUserRestrictions($data);

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
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('login');
			}
		} else {
			redirect(base_url());
		}
	}
	
	public function FORM_addNewProduct()
	{
		if ($this->Model_Security->CheckUserRestriction('products_add')) {
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
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Error uploading data. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/products');
			}
		} else {
			redirect(base_url());
		}
	}

	public function mt_randNumbers($length)
	{
		$res = '';

		for($i = 0; $i < $length; $i++) {
			$res .= mt_rand(0, 9);
		}

		return $res;
	}
	public function Add_newProductV2()
	{
		if ($this->Model_Security->CheckUserRestriction('products_add')) {
			require 'vendor/autoload.php';

			// INSERT TO TABLE PRODUCT DETAILS
			$length = 12;
			$U_ID = $this->mt_randNumbers($length);
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
				
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Complete all required data.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				redirect('admin/products');
			}
			// CHECK IF UID EXIST
			$CheckUID = $this->Model_Selects->CheckUID($U_ID);
			if ($CheckUID->num_rows() > 0) {

				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Product exist! Please check UID code.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				redirect('admin/products');
			}
			// CHECK PRODUCT IN DATABASE IF EXIST
			$Code = $product_code;
			$CheckProduct_byCode = $this->Model_Selects->CheckProduct_byCode($Code);
			if ($CheckProduct_byCode->num_rows() > 0) {
				// CANCEL INSERT PROMPT PRODUCT EXIST
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Product exist! Please check SKU code.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				redirect('admin/products');
			}
			else
			{
				// BARCODE GENEREATOR
				$colorblk = [0, 0, 0];

				/* CHECK DIR IF EXIST */
				if (!is_dir('assets/barcode_images/')) {
					mkdir('assets/barcode_images/', 0777, TRUE);
				}
				$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
				file_put_contents('assets/barcode_images/'.$U_ID.'-pbarcode.png', $generator->getBarcode($U_ID, $generator::TYPE_CODE_128, 4, 70, $colorblk));

				// Insert
				$data = array(
					'U_ID' => $U_ID,
					'Code' => $product_code,
					'Product_Name' => $product_name,
					'Product_Category' => $prd_type,
					'Product_Weight' => $prd_size,
					'Price_PerItem' => $unit_price,
					'Cost_PerItem' => $unit_cost,
					'Description' => $product_description,
					'DateAdded' => date('Y-m-d h:i:s A'),
					'Barcode_Images' => 'assets/barcode_images/'.$U_ID.'-pbarcode.png',
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
					$this->Model_Logbook->LogbookEntry('created a new product.', 'added a new product' . ($product_description ? ' ' . $product_description : '') . ' [Code: ' . $product_code . '].', base_url('admin/products'));

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> New product added.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect('admin/products');
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');

					$prompt_txt =
					'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Please! Try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect('admin/products');
				}
			}
		} else {
			redirect(base_url());
		}
	}
	// public function FORM_addNewTransaction()
	// {	
	// 	// Fetch data
	// 	$code = $this->input->post('transaction-code');
	// 	$type = $this->input->post('transaction-type');
	// 	$amount = $this->input->post('transaction-amount');
	// 	$date = $this->input->post('transaction-date');
	// 	if ($this->session->userdata('Privilege') < 2 && $type == '1') {
	// 		// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
	// 		redirect('admin/viewproduct?code=' . $code);
	// 	} else {

	// 		$getProductByCode = $this->Model_Selects->GetProductByCode($code);
	// 		$get_prdsCol = $getProductByCode->row_array();
	// 		// Prompts
			
	// 		if ($type == 1) {
	// 			if ($get_prdsCol['InStock'] < $amount) {
	// 			// Code for Low on stocks
	// 				echo "Low on STocks";
	// 				exit();
	// 			}
	// 		}

	// 		// // ~ calculate stocks changed
	// 		// $inStock = 0;
	// 		// if ($getProductByCode->num_rows() > 0) {
	// 		// 	foreach($getProductByCode->result_array() as $row) {
	// 		// 		$inStock = $row['InStock'];
	// 		// 	}
	// 		// }
	// 		if ($type == 0) {
	// 			// ~~ restocked
	// 			$priceTotal = 0;
	// 		// 	$inStock += $amount;
	// 		} else {
	// 			// ~~ released
	// 			$priceTotal = $get_prdsCol['PriceSelling'] * $amount;
	// 		// 	$inStock -= $amount;
	// 		}

	// 		// ~ creating transaction id
	// 		$transactionID = '';
	// 		$transactionID .= strtoupper($code);
	// 		$transactionID .= '-';
	// 		$transactionID .= strtoupper(uniqid());

	// 		// Insert
	// 		$data = array(
	// 			'Code' => $code,
	// 			'TransactionID' => $transactionID,
	// 			'Type' => $type,
	// 			'Amount' => $amount,
	// 			'Date' => $date,
	// 			'DateAdded' => date('Y-m-d h:i:s A'),
	// 			'Status' => 0,
	// 			'UserID' => $this->session->userdata('UserID'),

	// 			'PriceTotal' => $priceTotal,
	// 		);
	// 		$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
	// 		if ($insertNewTransaction == TRUE) {
	// 			$this->session->set_flashdata('highlight-id', $transactionID);
	// 			// $updateStocksCount = $this->Model_Updates->UpdateStocksCount($code, $inStock);
	// 			// if ($updateStocksCount) {

	// 			// } else {
	// 			// 	// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
	// 			// redirect('admin/viewproduct?code=' . $code);
	// 			// }
	// 			$this->Model_Logbook->LogbookEntry('added new transaction.', ($type == '0' ? 'restocked ' : 'released ') . $amount . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $transactionID . '].', base_url('admin/viewproduct?code=' . $code));
	// 			redirect('admin/viewproduct?code=' . $code);
	// 		}
	// 		else
	// 		{
	// 			// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
	// 			redirect('admin/viewproduct?code=' . $code);
	// 		}
	// 	}
	// }
	// AJAX GET
	// public function getTransactionDetails()
	// {
	// 	$transactionID = $this->input->get('transaction_id');
	// 	$data = array('TransactionID' => $transactionID, );
	// 	$getTransactionsByTransactionID = $this->Model_Selects->getall_transaction($data);
	// 	print json_encode($getTransactionsByTransactionID);
	// }
	// public function FORM_approveTransaction()
	// {
	// 	if ($this->session->userdata('Privilege') < 2) {
	// 		echo 'ERROR';
	// 		exit();
	// 	} else {
	// 		$TransactionID = $this->input->post('transaction_id');

	// 		$CheckIFApproved = $this->Model_Selects->CheckIFApproved($TransactionID);
	// 		$code = $CheckIFApproved['Code'];
	// 		$CheckStocksByCode = $this->Model_Selects->CheckStocksByCode($code);

	// 		if ($CheckIFApproved['Status'] == 1) {
	// 			echo 'APPROVED';
	// 			exit();
	// 		}
	// 		if ($CheckIFApproved['Type'] == 0) {
	// 			// RESTOCK
	// 			$NewStock = $CheckStocksByCode['InStock'] + $CheckIFApproved['Amount'];
	// 			$NewRelease = $CheckStocksByCode['Released'];
	// 		}
	// 		else
	// 		{
	// 			// RELEASE
	// 			$NewStock = $CheckStocksByCode['InStock'] - $CheckIFApproved['Amount'];
	// 			$NewRelease = $CheckStocksByCode['Released'] + $CheckIFApproved['Amount'];

	// 			if ($CheckStocksByCode['InStock'] < $CheckIFApproved['Amount']) {
	// 				echo 'NO_STOCK';
	// 				exit();
	// 			}
	// 		}

	// 		$data = array(
	// 			'Code' => $code,
	// 			'InStock' => $NewStock,
	// 			'Released' => $NewRelease,
	// 		);
	// 		$UpdateStock_product = $this->Model_Updates->UpdateStock_product($data);
	// 		if ($UpdateStock_product == TRUE) {
	// 			$data = array(
	// 				'TransactionID' => $TransactionID,
	// 				'Status' => 1,
	// 				'Date_Approval' => date('Y-m-d h:i:s A'),
	// 			);
	// 			$this->Model_Updates->ApproveTransaction($data);
	// 			if ($CheckIFApproved['Type'] == 0) {
	// 				$this->Model_Logbook->LogbookEntry('added new transaction.', ($CheckIFApproved['Type'] == '0' ? 'restocked ' : 'released ') . $CheckIFApproved['Amount'] . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $TransactionID . '].', base_url('admin/viewproduct?code=' . $code));
	// 				echo 'NEW_STOCK_ADDED';
	// 				exit();
	// 			}
	// 			else
	// 			{
	// 				$this->Model_Logbook->LogbookEntry('added new transaction.', ($CheckIFApproved['Type'] == '0' ? 'restocked ' : 'released ') . $CheckIFApproved['Amount'] . ' for ' . ($code ? ' ' . $code : '') . ' [TransactionID: ' . $TransactionID . '].', base_url('admin/viewproduct?code=' . $code));
	// 				echo 'STOCK_RELEASE';
	// 				exit();
	// 			}
	// 		}
	// 		else
	// 		{
	// 			echo 'ERROR';
	// 			exit();
	// 		}
	// 	}
	// }
	// public function getOrderDetails() // UPDATE
	// {
	// 	$orderID = $this->input->get('order_id');
	// 	$getTransactionsByPurchaseOrderID = $this->Model_Selects->GetOrderTransactions($orderID);
	// 	print json_encode($getTransactionsByPurchaseOrderID->result_array());
	// }
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


	// public function get_productDetails()
	// {
	// 	$product_id = $this->input->post('product_code');
	// 	$Get_productByPID = $this->Model_Selects->Get_productByPID($product_id);
	// 	if ($Get_productByPID->num_rows() > 0) {
	// 		$nrow = $Get_productByPID->row_array();
	// 		$data = array(
	// 			'Status' => 'success',
	// 			'Code' => $nrow['Code'],
	// 			'Product_Name' => $nrow['Product_Name'],
	// 			'Description' => $nrow['Description'],
	// 			'InStock' => $nrow['InStock'],
	// 			'Released' => $nrow['Released'],
	// 			'Product_Category' => $nrow['Product_Category'],
	// 			'Product_Weight' => $nrow['Product_Weight'],
	// 			'Price_PerItem' => $nrow['Price_PerItem'],

	// 		);
	// 		$result = json_encode($data);
	// 		echo $result;
	// 		exit();
	// 	}
	// 	else
	// 	{
	// 		$data = array(
	// 			'Status' => 'error',
	// 		);
	// 		$result = json_encode($data);
	// 		echo $result;
	// 		exit();
	// 	}
	// }

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
	// public function SubmitNewItemcode()
	// {
	// 	### SET TIMEZONE TO PH
	// 	date_default_timezone_set('Asia/Manila');

	// 	### GENERATE UNIQUE ID
	// 	$length = 44;
	// 	$ntokkken = $this->getToken($length);

	// 	### VARIABLES
	// 	$unID = $ntokkken;
	// 	$brand_top = $this->input->post('brand_top');
	// 	$cat_char = $this->input->post('cat_char');
	// 	$prod_type = $this->input->post('prod_type');
	// 	$brand_bot = $this->input->post('brand_bot');
	// 	$prod_line = $this->input->post('prod_line');
	// 	$new_type = $this->input->post('new_type');
	// 	$prod_variant = $this->input->post('prod_variant');
	// 	$prod_size = $this->input->post('prod_size');
	// 	$prod_itemcode = $this->input->post('prod_itemcode');
	// 	$timezone = date_default_timezone_get();

	// 	### CHECK ITEM CODE IF EXIST
	// 	$CheckItemCode = $this->Model_Selects->CheckItemCode($prod_itemcode);
	// 	if ($CheckItemCode->num_rows() > 0) {
	// 		### PROMPT ITEM CODE EXIST
	// 		redirect('admin/settings_itemcodepage');
	// 	}
	// 	### CONDITIONS
	// 	if ($brand_top == NULL || $cat_char == NULL || $prod_type == NULL || $brand_bot == NULL || $prod_line == NULL || $new_type == NULL || $prod_variant == NULL || $prod_size == NULL || $prod_itemcode == NULL ) {
	// 		### ERROR PROMPT
	// 		redirect('admin/settings_itemcodepage');
	// 	}
	// 	else
	// 	{
	// 		### INSERT TO TABLE
	// 		$data = array(
	// 			'uniqueID' => $unID, 
	// 			'Brand_Top' => $brand_top, 
	// 			'Cat_Char' => $cat_char, 
	// 			'Prod_Type' => $prod_type, 
	// 			'Brand_Bot' => $brand_bot, 
	// 			'Prod_Line' => $prod_line, 
	// 			'New_Type' => $new_type, 
	// 			'Prod_Variant' => $prod_variant, 
	// 			'Prod_Size' => $prod_size, 
	// 			'ItemCode' => $prod_itemcode, 
	// 			'TimeStamp' => $timezone, 
	// 		);

	// 		$AddNewItem_Code = $this->Model_Inserts->AddNewItem_Code($data);
	// 		if ($AddNewItem_Code == TRUE) {
	// 			### PROMPT SUCCESS
	// 			redirect('admin/settings_itemcodepage');
	// 		}
	// 		else
	// 		{
	// 			### PROMPT ERROR
	// 			redirect('admin/settings_itemcodepage');
	// 		}
	// 	}
	// }
	// public function remove_thisicode()
	// {
	// 	$uniqueID = $this->input->get('uid');
	// 	$CheckItemcode_byuid = $this->Model_Selects->CheckItemcode_byuid($uniqueID);
	// 	if ($CheckItemcode_byuid->num_rows() < 1) {

	// 		### UNIQUE ID DOES'NT EXIST THEN PROMPT
	// 		redirect('admin/settings_itemcodepage');
	// 	}
	// 	else
	// 	{
	// 		### DELETE USING UNIQUE ID THEN PROMPT
	// 		$remove_itemCode = $this->Model_Updates->remove_itemCode($uniqueID);
	// 		if ($remove_itemCode == TRUE) {

	// 			### PROMPT SUCCESS
	// 			redirect('admin/settings_itemcodepage');
	// 		}
	// 		else
	// 		{

	// 			### PROMPT ERROR
	// 			redirect('admin/settings_itemcodepage');
	// 		}
	// 	}
	// }
	public function Restock_from_cart()
	{
		if (!isset($_SESSION['cart_sess'])) {
			### PROMPT ERROR CART EMPTY OR NO SESSION CART
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$cart_data = $_SESSION['cart_sess'];
			$user_id = $_SESSION['UserID'];
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
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}

		}
		redirect($_SERVER['HTTP_REFERER']);

	}


	public function move_to_archive()
	{
		if ($this->Model_Security->CheckUserRestriction('products_delete')) {
			$Code = $this->input->get('code');
			// CHECK IF CODE EXIST
			$CheckProduct_byCode = $this->Model_Selects->CheckProduct_byCode($Code);
			if ($CheckProduct_byCode->num_rows() > 0) {
				// UPDATE STATUS SET TO 2 = ARCHIVED
				$MoveProd_toarchive = $this->Model_Updates->MoveProd_toarchive($Code);
				if ($MoveProd_toarchive == true) {
					// SUCCESS
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Product moved to archive.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect($_SERVER['HTTP_REFERER']);

				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect($_SERVER['HTTP_REFERER']);

				}
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Error!</strong> Product doesn\'t exist.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']);

			}
		} else {
			redirect(base_url());
		}
	}

	// SETTINGS BRAND CATEGORY
	public function Add_BrandCategory()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_add')) {
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

				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Complete all required data.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

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

					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Brand exist please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

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
						
						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> New brand added.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{

						$prompt_txt =
						'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Error!</strong> Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		} else {
			redirect(base_url());
		}
	}
	public function Update_BrandCategory()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_edit')) {
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

				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Complete all required data.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

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

							$prompt_txt =
							'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Success!</strong> Brand updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
							redirect($_SERVER['HTTP_REFERER']);

						}
						else
						{

							$prompt_txt =
							'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Warning!</strong> Property not updated.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);

							redirect($_SERVER['HTTP_REFERER']);

						}
					}
					else
					{

						$prompt_txt =
						'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Error!</strong> Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{

					$prompt_txt =
					'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Brand doesn\'t exist.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} else {
			redirect(base_url());
		}
	}
	public function Add_BrandVariant()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_add')) {
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
						'Vcpd' => strtoupper($vcpd),
						'Vcpd_Abbr' => strtoupper($vcpdabr),
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
		} else {
			redirect(base_url());
		}
	}
	public function remove_addVariants()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_edit')) {
			$id = $this->input->get('id');
			$CheckBrand_id = $this->Model_Selects->CheckBrand_id($id);
			if ($CheckBrand_id->num_rows() > 0) {
				$RemoveVariantBrand = $this->Model_Deletes->RemoveVariantBrand($id);
				if ($RemoveVariantBrand == true) {

					$prompt_txt =
					'<div class="alert alert-succes position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Variant removed.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{

					$prompt_txt =
					'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					redirect($_SERVER['HTTP_REFERER']); //ERROR PROMPT
				}
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Error!</strong> Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);

				redirect($_SERVER['HTTP_REFERER']); //ERROR PROMPT
			}
		} else {
			redirect(base_url());
		}
	}
	public function remove_addSizes()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_edit')) {
			$id = $this->input->get('id');
			$CheckSizeID = $this->Model_Selects->CheckSizeID($id);
			if ($CheckSizeID->num_rows() > 0) {
				$remove_size_id = $this->Model_Deletes->remove_size_id($id);
				if ($remove_size_id == true) {
					$prompt_txt =
					'<div class="alert alert-succes position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Size removed.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					$prompt_txt =
					'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Error!</strong> Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect($_SERVER['HTTP_REFERER']); //ERROR PROMPT
				}
			}
			else
			{
				$prompt_txt =
				'<div class="alert alert-error position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Error!</strong> Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']); //ERROR PROMPT
			}
		} else {
			redirect(base_url());
		}
	}
	// public function FORM_NewTransaction()
	// {
	// 	$skuCode = $this->input->post('transaction-code');
	// 	$Trans_Type = $this->input->post('transaction-type');
	// 	$Amount = $this->input->post('transaction-amount');
	// 	$Trans_Date = $this->input->post('transaction-date');

	// 	if (empty($skuCode) || empty($Amount) || empty($Trans_Date)) {
	// 		// redirect('admin/viewproduct?code=' . $skuCode);
	// 		echo 'NULL VALUE';
	// 	}
	// 	else
	// 	{
	// 		// CHECK PRODUCT IF IT EXIST
			
	// 		$transactionID = '';
	// 		$transactionID .= strtoupper($skuCode);
	// 		$transactionID .= '-';
	// 		$transactionID .= strtoupper(uniqid());

	// 		$CheckSKU_Code = $this->Model_Selects->CheckSKU_Code($skuCode);

	// 		if ($CheckSKU_Code->num_rows() > 0) {
	// 			$prd_details = $CheckSKU_Code->row_array();
	// 			$c_stock = $prd_details['InStock'];
	// 			$price_peritem = $prd_details['Cost_PerItem'];

	// 			if ($Trans_Type <= 0) {

	// 				// RESTOCK
					
	// 				$priceTotal = $price_peritem * $Amount;

	// 				$code = $skuCode;
	// 				$inStock = $c_stock + $Amount;

	// 			}
	// 			else
	// 			{

	// 				// RELEASE
					
	// 				$priceTotal = $price_peritem * $Amount;

	// 				$code = $skuCode;
	// 				if ($c_stock < $Amount) {
	// 					// LOW STOCK
	// 					redirect('admin/viewproduct?code=' . $skuCode);
	// 				}
	// 				else
	// 				{
	// 					$inStock = $c_stock - $Amount;
	// 				}

	// 			}

	// 			$data = array(
	// 				'Code' => $skuCode,
	// 				'TransactionID' => $transactionID,
	// 				'Type' => $Trans_Type,
	// 				'Amount' => $Amount,
	// 				'Date' => $Trans_Date,
	// 				'DateAdded' => date('Y-m-d h:i:s A'),
	// 				'Status' => 0,
	// 				'UserID' => $this->session->userdata('UserID'),

	// 				'PriceTotal' => $priceTotal,
	// 			);
	// 			$insertNewTransaction = $this->Model_Inserts->InsertNewTransaction($data);
	// 			if ($insertNewTransaction == true) {
					
	// 				// $updateStocksCount = $this->Model_Updates->UpdateStocksCount($code, $inStock);
	// 				redirect('admin/viewproduct?code=' . $skuCode);
	// 			}
	// 			else
	// 			{
	// 				// ERROR
	// 				redirect('admin/viewproduct?code=' . $skuCode);
					
	// 			}
	// 		}
	// 		else
	// 		{
	// 			// PROMPT PRODUCT DOESNT EXIST
	// 			redirect('admin/viewproduct?code=' . $skuCode);
				
	// 		}
	// 	}
	// }
	public function redo_arch()
	{
		if ($this->Model_Security->CheckUserRestriction('trash_bin_retrieve')) {
			$ID = $this->input->get('prd_id');
			$CheckPrd_id = $this->Model_Selects->CheckPrd_id($ID);
			if ($CheckPrd_id->num_rows() > 0) {
				$UpdateStatus_Retrived = $this->Model_Updates->UpdateStatus_Retrived($ID);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			redirect(base_url());
		}
	}
	public function delete_prd()
	{
		if ($this->Model_Security->CheckUserRestriction('trash_bin_delete')) {
			$ID = $this->input->get('prd_id');
			$CheckPrd_id = $this->Model_Selects->CheckPrd_id($ID);
			if ($CheckPrd_id->num_rows() > 0) {
				$Delete_product = $this->Model_Deletes->Delete_product($ID);
				if ($Delete_product == true) {
					$prd_dtls = $CheckPrd_id->row_array();
					$skuCode = $prd_dtls['Code'];
					$deletePrd_details = $this->Model_Deletes->Delete_Stock_Code($skuCode); // also delete associated stocks
					$deletePrd_details = $this->Model_Deletes->deletePrd_details($skuCode);
					$deletePrd_trans = $this->Model_Deletes->deletePrd_trans($skuCode);

				}
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			redirect(base_url());
		}
	}
	public function Del_brand()
	{
		if ($this->Model_Security->CheckUserRestriction('branding_delete')) {
			$UniqueID = $this->input->get('uid');
			$ChecBrand_Cat = $this->Model_Selects->ChecBrand_Cat($UniqueID);
			$ChecBrand_Prop = $this->Model_Selects->ChecBrand_Prop($UniqueID);
			$ChecBrand_Size = $this->Model_Selects->ChecBrand_Size($UniqueID);

			if ($ChecBrand_Cat->num_rows() > 0) {
				$this->Model_Deletes->remove_brands($UniqueID);
				if ($ChecBrand_Prop->num_rows() > 0) {
					$this->Model_Deletes->remove_brandsprop($UniqueID);
				}
				if ($ChecBrand_Size->num_rows() > 0) {
					$this->Model_Deletes->remove_brandssize($UniqueID);
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			redirect(base_url());
		}
	}
	public function UpdatePricesss()
	{
		if ($this->Model_Security->CheckUserRestriction('products_edit')) {
			$ID = $this->input->post('unit_id');
			$Price_PerItem = $this->input->post('unit_price');
			$Cost_PerItem = $this->input->post('unit_cost');
			$Product_Name = $this->input->post('Product_Name');
			$Description = $this->input->post('description');

			if (empty($ID) || empty($Price_PerItem) || empty($Cost_PerItem) || empty($Product_Name)) {
				// NULL VALUE
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Empty value detected. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				// VALUE EXIST CHECK ID IF EXIST IN DATABASE
				$CheckProduct_BY_ID = $this->Model_Selects->CheckProduct_BY_ID($ID);
				if ($CheckProduct_BY_ID->num_rows() > 0) {
					// UPDATE PRICES
					$data = array(
						'Product_Name' => $Product_Name,
						'Price_PerItem' => $Price_PerItem, 
						'Cost_PerItem' => $Cost_PerItem,
						'Description' => $Description, 
					);
					$UpdatePriceProduct = $this->Model_Updates->UpdatePriceProduct($ID,$data);
					if ($UpdatePriceProduct == true) {
						// PROMPT SUCCESS
						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Product updated.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);

						redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
						$prompt_txt =
						'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Something\'s wrong while updating.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
						redirect($_SERVER['HTTP_REFERER']);

					}
				}
				else
				{
					// ID DOESNT EXIST
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> This product doesn\'t exist.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect($_SERVER['HTTP_REFERER']);

				}
			}
		} else {
			redirect(base_url());
		}
	}
	public function removeFCartrelease()
	{
		$cart_id = $this->input->get('c_id');
		if (empty($cart_id)) {
			// PROMPT URL QUERY STRING EMPTY
			redirect($_SERVER['HTTP_REFERER']);
		}
		// CHECK CART ID
		$CheckCart_ByID = $this->Model_Selects->CheckCart_ByID($cart_id);
		if ($CheckCart_ByID->num_rows() > 0) {
			$RemoveCart_rel = $this->Model_Deletes->RemoveCart_rel($cart_id);
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			// PROMPT CART ID NOT FOUND
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
		// if ($this->Model_Security->CheckUserRestriction('products_add')) {

		// } else {
		// 	redirect(base_url());
		// }
