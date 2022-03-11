<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Model_Security');
		date_default_timezone_set('Asia/Manila');
		$userID = $this->session->userdata('UserID');
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
		$ipAddress = $this->input->ip_address();;
		$country = 'TBD';
		$pageURL = base_url($this->uri->uri_string());
		$data = array(
			'UserID' => $userID,
			'Agent' => $agent,
			'Platform' => $platform,
			'IPAddress' => $ipAddress,
			'Country' => $country,
			'PageURL' => $pageURL,
			'DateAdded' => date('Y-m-d h:i:s A'),
		);
		$LogUser = $this->Model_Security->LogUser($data);
		$RecordLastLogin = $this->Model_Security->RecordLastLogin($userID);

		if ((!isset($userID) || $userID == '') && $pageURL != base_url() && $pageURL != base_url('FORM_loginValidation')) {
			redirect(base_url());
		}
		if (isset($userID) && $userID != '' && $pageURL == base_url()) {
			redirect(base_url() . 'admin');
		}
	}
}
