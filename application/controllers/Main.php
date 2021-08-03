<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Security');
	}
	public function index()
	{
		$header['pageTitle'] = 'Login';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('main/login', $data);
	}
	public function login()
	{
		$header['pageTitle'] = 'Login';
		$data['globalHeader'] = $this->load->view('main/globals/header', $header);
		$this->load->view('main/login', $data);
	}
	public function FORM_loginValidation()
	{
		if ($this->agent->is_browser()) {
		$agent = 'Desktop: ' . $this->agent->browser().' '.$this->agent->version();
		} elseif ($this->agent->is_robot()) {
			$agent = 'Robot: ' . $this->agent->robot();
		} elseif ($this->agent->is_mobile()) {
			$agent = 'Mobile: ' . $this->agent->mobile();
		} else {
			$agent = 'Unidentified User Agent';
		}
		$platform = $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
		$ipAddress = $this->input->ip_address();
		$email = $this->input->post('email',TRUE);
		$password = $this->input->post('password',TRUE);
		if ($email == NULL || $password == NULL) {
			$p_text = '<div class="row mb-1">
							<span class="text-center warning-banner">
								<i class="bi bi-exclamation-diamond-fill"></i> Incorrect email or password.
							</span>
						</div>';
			$this->session->set_flashdata('prompt',$p_text);
			redirect(base_url());
		}
		else
		{
			$getLoginEmail = $this->Model_Security->GetLoginEmail($email);
			if ($getLoginEmail->num_rows() > 0) {
				$loginRow = $getLoginEmail->row_array();
				if (password_verify($password, $loginRow['LoginPassword'])) {
					$getUserID = $this->Model_Selects->GetUserID($loginRow['UserID'], 'users');
					if ($getUserID->num_rows() > 0) {
						foreach($getUserID->result_array() as $row) {
							$lastName = $row['LastName'];
							$firstName = $row['FirstName'];
							$middleName = $row['MiddleName'];
							$nameExtension = $row['NameExtension'];
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
							$data = array(
								'UserID' => $row['UserID'],
								'FirstName' => $firstName,
								'MiddleName' => $middleName,
								'LastName' => $lastName,
								'NameExtension' => $nameExtension,
								'Image' => $row['Image'],
								'FullName' => $fullName,
							);
							$this->session->set_userdata($data);
							$historyData = array(
								'UserID' => $row['UserID'],
								'LoginEmail' => $email,
								'LoginPassword' => password_hash($password, PASSWORD_BYCRYPT),
								'Agent' => $agent,
								'Platform' => $platform,
								'IPAddress' => $ipAddress,
								'Success' => '1',
								'DateAdded' => date('Y-m-d h:i:s A'),
							);
							$insertLoginHistory = $this->Model_Inserts->InsertLoginHistory($historyData);
						}
						redirect(base_url() . 'admin');
					} else {
						$p_text = '<div class="row">
							<span class="text-center warning-banner">
								<i class="bi bi-exclamation-diamond-fill"></i> Error connecting to the server. Please check your internet connection and try again!
							</span>
						</div>';
						$this->session->set_flashdata('prompt',$p_text);
						$historyData = array(
							'UserID' => $row['UserID'],
							'LoginEmail' => $email,
							'LoginPassword' => $password,
							'Agent' => $agent,
							'Platform' => $platform,
							'IPAddress' => $ipAddress,
							'Success' => '0',
							'DateAdded' => date('Y-m-d h:i:s A'),
						);
						$insertLoginHistory = $this->Model_Inserts->InsertLoginHistory($historyData);
						redirect(base_url());
					}
				}
				else
				{
					$p_text = '<div class="row">
							<span class="text-center warning-banner">
								<i class="bi bi-exclamation-diamond-fill"></i> Incorrect email or password.
							</span>
						</div>';
					$this->session->set_flashdata('prompt',$p_text);
					$historyData = array(
						'UserID' => $row['UserID'],
						'LoginEmail' => $email,
						'LoginPassword' => $password,
						'Agent' => $agent,
						'Platform' => $platform,
						'IPAddress' => $ipAddress,
						'Success' => '0',
						'DateAdded' => date('Y-m-d h:i:s A'),
					);
					$insertLoginHistory = $this->Model_Inserts->InsertLoginHistory($historyData);
					redirect(base_url());
				}
			}
			else
			{
				$p_text = '<div class="row">
							<span class="text-center warning-banner">
								<i class="bi bi-exclamation-diamond-fill"></i> Incorrect email or password.
							</span>
						</div>';
				$this->session->set_flashdata('prompt',$p_text);
				$historyData = array(
					'UserID' => $row['UserID'],
					'LoginEmail' => $email,
					'LoginPassword' => $password,
					'Agent' => $agent,
					'Platform' => $platform,
					'IPAddress' => $ipAddress,
					'Success' => '0',
					'DateAdded' => date('Y-m-d h:i:s A'),
				);
				$insertLoginHistory = $this->Model_Inserts->InsertLoginHistory($historyData);
				redirect(base_url());
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}
}
