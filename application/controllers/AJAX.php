<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AJAX extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Inserts');
		date_default_timezone_set('Asia/Manila');
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
}
