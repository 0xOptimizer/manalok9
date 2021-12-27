<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public $globalData = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Updates');
		if($this->Model_Security->CheckPrivilegeLevel() >= 1) {
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
	}
	public function FORM_selfUpdateUser()
	{	
		$userID = $this->session->userdata('UserID');
		if ($userID == NULL) {
			redirect(base_url() . 'login');
		} else {
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

			$pImageChecker = $this->input->post('pImageChecker');

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
					        $this->Model_Logbook->SetPrompts('error', 'error', $this->image_lib->display_errors() . $tconfig['source_image']);
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
				'DateAdded' => date('Y-m-d h:i:s A'),
			);
			$updateEmployee = $this->Model_Updates->UpdateUser($data, $userID);
			if ($updateEmployee == TRUE) {
				// Info Handler
				// ~ name
				$fullName = '';
				$fullNameHover = '';
				$isFullNameHoverable = false;
				if ($lastName) {
					$fullName = $fullName . $lastName . ', ';
					$fullNameHover = $fullNameHover . $lastName . ', ';
				} else {
					$fullNameHover = $fullNameHover . '[<i>No Last Name</i>], ';
					$isFullNameHoverable = true;
				}
				if ($firstName) {
					$fullName = $fullName . $firstName . ' ';
					$fullNameHover = $fullNameHover . $firstName . ' ';
				} else {
					$fullNameHover = $fullNameHover . '[<i>No First Name</i>] ';
					$isFullNameHoverable = true;
				}
				if ($middleName) {
					$fullName = $fullName . $middleName[0] . '.';
					$fullNameHover = $fullNameHover . $middleName[0] . '.';
				} else {
					$fullNameHover = $fullNameHover . '[<i>No MI</i>].';
					$isFullNameHoverable = true;
				}
				if ($nameExtension) {
					$fullName = $fullName . ', ' . $nameExtension;
					$fullNameHover = $fullNameHover . ', ' . $nameExtension;
				}
				if (strlen($fullName) > 90) {
					$fullName = substr($fullName, 0, 90);
					$fullName = $fullName . '...';
					$isFullNameHoverable = true;
				}
				$data['FullName'] = $fullName;
				$this->session->set_userdata($data);
				if ($loginEmail != NULL && $loginPassword != NULL) {
					$loginData = array(
						'LoginEmail' => $loginEmail,
						'LoginPassword' => password_hash($loginPassword, PASSWORD_BCRYPT),
					);
					$updateEmployeeLogin = $this->Model_Updates->UpdateUserLogin($loginData, $userID);
					if ($updateEmployeeLogin) {
						redirect(base_url() . 'profile');
					} else {
						redirect(base_url() . 'profile');
					}
				} else {
					redirect(base_url() . 'profile');
				}
			}
			else
			{
				$this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
				redirect(base_url() . 'profile');
			}
		}
	}
	public function index()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Your Corner';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('users/activities', $data);
	}
	public function profile()
	{
		$data = [];
		$data = array_merge($data, $this->globalData);
		$header['pageTitle'] = 'Your Profile';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$userID = $this->session->userdata('UserID');
		$data['getUserID'] = $this->Model_Selects->GetUserID($userID, 'users');
		$data['getLoginCredentials'] = $this->Model_Selects->GetUserID($userID, 'users_login');
		$this->load->view('users/profile', $data);
	}
	public function register()
	{
		$header['pageTitle'] = 'Register';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('users/register', $data);
	}
}
