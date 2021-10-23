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
				$smtp->Username   = 'jysantos099@gmail.com';
				$smtp->Password   = '';
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
	public function Add_idtoCart()
	{

		$item_code = $this->input->post('item_code');
		$qtyValue = $this->input->post('qtyValue');

		$prompt_text = '';

		if ($item_code == null) {
			echo 'Error! Item code doesn\'t exist.';
			exit();
		}
		if ($qtyValue == null) {
			echo 'Warning! Input Quantity.';
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
}
