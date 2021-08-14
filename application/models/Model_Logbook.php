<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Logbook extends CI_Model {

	public function LogbookEntry($logbookEvent, $logbookDescription = '', $pageURL = '')
	{
		$data = array(
			'UserID' => $this->session->userdata('UserID'),
			'Event' => $logbookEvent,
			'Description' => $logbookDescription,
			'PageURL' => $pageURL,
			'DateAdded' => date('Y-m-d h:i:s A')
		);
		$logbookInsert = $this->Model_Inserts->InsertLogbook($data);
	}
}
