<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AJAX extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Inserts');
	}
}
