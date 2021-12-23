<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Security extends CI_Model {

	public function CheckPrivilegeLevel()
	{
		// ~ essentials ~
		$userID = $this->session->userdata('UserID');
		if ($userID) {
			$getUserID = $this->Model_Selects->GetUserID($userID, 'users');
			if ($getUserID->num_rows() > 0) {
				$privilegeLevel = 0;
				foreach($getUserID->result_array() as $row) {
					$privilegeLevel = $row['Privilege'];
				}
				return $privilegeLevel;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	public function GetLoginEmail($email)
	{
		$this->db->select('*');
		$this->db->order_by('ID', 'desc');
		$this->db->where('LoginEmail', $email);
		$result = $this->db->get('users_login');
		return $result;
	}
	public function LogUser($data)
	{
		$result = $this->db->insert('security_log', $data);
		return $result;
	}


	public function CheckUserRestriction($user_id, $action) {
		$this->db->select('*');
		$this->db->where('UserID', $user_id);
		$this->db->where('Action', $action);
		$result = $this->db->get('user_restrictions')->row_array()['Allowed'];
		return $result;
	}
}
