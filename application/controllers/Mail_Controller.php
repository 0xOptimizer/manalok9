<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_Controller extends CI_Controller {

	public function mail_attachment_temp()
	{
		$this->load->view('admin/template/mail_attachment');
	}
	public function Email_Configuration()
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'devt5599@gmail.com',
			'smtp_pass' => 'Test_Dev_email2021',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1', //utf-8 if sending template email
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);
	}
	public function SampleMail()
	{

		
		$this->Email_Configuration();

		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=iso-8859-1'); //utf-8 if sending template email
      // $this->email->set_header('Content-type', 'text/html');

      $this->email->from('devt5599@gmail.com');
      $this->email->to('cubelobritz@gmail.com');
      $this->email->subject('Purchase Orders with attachment');

      // $message = $this->load->view('admin/template/mail_attachment','',true);

      $this->email->message('');
      $this->email->attach('C:\xampp\htdocs\manalok9\assets\images\plus.png');
      if($this->email->send())
      {
      	echo 'Email sent.';
      }
      else
      {
      	show_error($this->email->print_debugger());
      }
   }
}
