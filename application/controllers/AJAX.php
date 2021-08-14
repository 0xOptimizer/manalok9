<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AJAX extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Inserts');
	}

	public function getUserLogs()
	{
		$id = $this->input->get('userID');
		if (strlen($id) > 0) {
			$userHistory = $this->Model_Selects->GetUserHistory($id)->result_array();

			echo json_encode($userHistory);
		}
	}
}
