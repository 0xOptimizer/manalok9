<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Email extends CI_Model {

	// public function Delete_product($ID)
	// {
	// 	$this->db->where('ID', $ID);
	// 	$result = $this->db->delete('products');
	// 	return $result;
	// }

	public function sendEmail($send_to, $mail_subject, $mail_message) {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'devt5599@gmail.com',
			'smtp_pass' => '', // NEED PASSWORD ---------------------------------------
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);

		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=iso-8859-1');
		// $this->email->set_header('Content-type', 'text/html');


		$this->email->from('ManaloK9 noreply');
		$this->email->to($send_to);
		$this->email->subject($mail_subject);


		$this->email->message($mail_message);

		if($this->email->send())
		{
			$data = array(
				'sent_to' => $send_to,
				'subject' => $mail_subject,
				'message' => $mail_message,
				'attachment' => 'No attachment',
			);
			$EmailInsert = $this->Model_Inserts->EmailInsert($data);
		}
	}
}
